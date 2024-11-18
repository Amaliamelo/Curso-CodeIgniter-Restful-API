<?php namespace App\Controllers\API;

use App\Models\TiposTransaccionModel;
use CodeIgniter\RESTful\ResourceController;

class TiposTransaccion extends ResourceController
{
    public function __construct() {
        $this -> model = $this->setModel(new TiposTransaccionModel());
    }

    public function index()
    {
        $tipoTransacciones = $this->model->findAll();
        return $this->respond($tipoTransacciones);
    }

    public function create(){
        try{
            $tipoTransaccion = $this->request->getJSON();

            if($this->model->insert($tipoTransaccion)):
                $tipoTransaccion->id = $this->model->insertID();
                return $this->respondCreated($tipoTransaccion);
            else:
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

            $tipoTransaccion = $this->model->find($id);
            if($tipoTransaccion == null)
                return $this->failNotFound('No se ha encontrado un tipo de Transaccion con el'.$id);

            return $this->respond($tipoTransaccion);

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function update($id = null)
    {
        try{
           
            if($id==null)
                return $this -> failValidationErrors('No se ha ppasado un Id valido');

            $tipoTransaccionVerificado = $this->model->find($id);
            if($tipoTransaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un tipo de Transaccion con el'.$id);

            $tipoTransaccion = $this->request->getJSON();

            if($this->model->update($id, $tipoTransaccion)):
                $tipoTransaccion->id = $id;
                return $this->respondUpdated($tipoTransaccion);
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
                return $this -> failValidationErrors('No se ha ppasado un Id valido');

            $tipoTransaccionVerificado = $this->model->find($id);
            if($tipoTransaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un tipo de Transaccion con el'.$id);

            if($this->model->delete($id)):
                return $this->respondDeleted($tipoTransaccionVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}
