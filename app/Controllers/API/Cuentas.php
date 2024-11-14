<?php namespace App\Controllers\API;

use App\Models\CuentaModel;
use CodeIgniter\RESTful\ResourceController;

class Cuentas extends ResourceController
{
    public function __construct() {
        $this -> model = $this->setModel(new CuentaModel());
    }

    public function index()
    {
        $cuentas = $this->model->findAll();
        return $this->respond($cuentas);
    }

    public function create(){
        try{
            $cuenta = $this->request->getJSON();

            if($this->model->insert($cuenta)):
                $cuenta->id = $this->model->insertID();
                return $this->respondCreated($cuenta);
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

            $cuenta = $this->model->find($id);
            if($cuenta == null)
                return $this->failNotFound('No se ha encontrado un cuenta con el'.$id);

            return $this->respond($cuenta);

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function update($id = null)
    {
        try{
           
            if($id==null)
                return $this -> failValidationErrors('No se ha ppasado un Id valido');

            $cuentaVerificado = $this->model->find($id);
            if($cuentaVerificado == null)
                return $this->failNotFound('No se ha encontrado un cuenta con el'.$id);

            $cuenta = $this->request->getJSON();

            if($this->model->update($id, $cuenta)):
                $cuenta->id = $id;
                return $this->respondUpdated($cuenta);
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

            $cuentaVerificado = $this->model->find($id);
            if($cuentaVerificado == null)
                return $this->failNotFound('No se ha encontrado un cuenta con el'.$id);

            if($this->model->delete($id)):
                return $this->respondDeleted($cuentaVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}
