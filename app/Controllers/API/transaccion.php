<?php namespace App\Controllers\API;

use App\Models\CuentaModel;
use App\Models\transaccionModel;
use CodeIgniter\RESTful\ResourceController;

class transaccion extends ResourceController
{
    public function __construct() {
        $this -> model = $this->setModel(new transaccionModel());
    }

    public function index()
    {
        $transacciones = $this->model->findAll();
        return $this->respond($transacciones);
    }

    public function create(){
        try{
            $transaccion = $this->request->getJSON();

            if($this->model->insert($transaccion)):
                $transaccion->id = $this->model->insertID();
                $transaccion->resultado = $this->actualizarFondoCuenta($transaccion->tipo_transaccion_id, $transaccion->monto, $transaccion->cuenta_id);
                return $this->respondCreated($transaccion);
            else :
                return $this -> failValidationErrors($this->model->validation->listErrors());
            endif;
            //o metodo insert devolve um boolean sempre q executa, bem , rue, falso, erro;

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function edit($id = null)
    {
        try{
           
            if($id==null)
                return $this -> failValidationErrors('No se ha ppasado un Id valido');

            $transaccion = $this->model->find($id);
            if($transaccion == null)
                return $this->failNotFound('No se ha encontrado un transaccion con el'.$id);

            return $this->respond($transaccion);

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function update($id = null)
    {
        try{
           
            if($id==null)
                return $this -> failValidationErrors('No se ha ppasado un Id valido');

            $transaccionVerificado = $this->model->find($id);
            if($transaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un transaccion con el'.$id);

            $transaccion = $this->request->getJSON();

            if($this->model->update($id, $transaccion)):
                $transaccion->id = $id;
                return $this->respondUpdated($transaccion);
            else:
                return $this -> failValidationErrors($this->model->validation->listErrors());
            endif;

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function delete($id = null)
    {
        try{
           
            if($id==null)
                return $this -> failValidationErrors('No se ha pasado un Id valido');

            $transaccionVerificado = $this->model->find($id);
            if($transaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un transaccion con el'.$id);

            if($this->model->delete($id)):
                return $this->respondDeleted($transaccionVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    private function actualizarFondoCuenta($tipoTransaccionId, $monto, $cuentaId)
    {
        $modelCuenta = new CuentaModel();
        $cuenta = $modelCuenta->find($cuentaId);

        switch ($tipoTransaccionId) {
            case 2:
                $cuenta["fondo"] += $monto;
                break;

            case 3:
                $cuenta["fondo"] -= $monto;
                break;
        }

        if($modelCuenta->update($cuentaId, $cuenta)) :
            return array('TransaccionExitosa' => true, 'NuevoFondo' => $cuenta["fondo"]);
        else:
            return array('TransaccionExitosa' => false, 'NuevoFondo' => $cuenta["fondo"]);
        endif;

    }
}
