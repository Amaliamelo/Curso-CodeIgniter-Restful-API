<?php namespace App\Controllers\API;

use App\Models\tipo_transaccionModel;
use CodeIgniter\RESTful\ResourceController;

class tipo_transaccion extends ResourceController
{
    public function __construct() {
        $this -> model = $this->setModel(new tipo_transaccionModel());
    }

    public function index()
    {
        $tipo_transaccion = $this->model->findAll();
        return $this->respond($tipo_transaccion);
    }

    public function create(){
        try{
            $tipo_transaccion = $this->request->getJSON();

            if($this->model->insert($tipo_transaccion)):
                $tipo_transaccion->id = $this->model->insertID();
                return $this->respondCreated($tipo_transaccion);
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

            $tipo_transaccion = $this->model->find($id);
            if($tipo_transaccion == null)
                return $this->failNotFound('No se ha encontrado un tipo de Transaccion con el'.$id);

            return $this->respond($tipo_transaccion);

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function update($id = null)
    {
        try{
           
            if($id==null)
                return $this -> failValidationErrors('No se ha ppasado un Id valido');

            $tipo_transaccionVerificado = $this->model->find($id);
            if($tipo_transaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un tipo de Transaccion con el'.$id);

            $tipo_transaccion = $this->request->getJSON();

            if($this->model->update($id, $tipo_transaccion)):
                $tipo_transaccion->id = $id;
                return $this->respondUpdated($tipo_transaccion);
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

            $tipo_transaccionVerificado = $this->model->find($id);
            if($tipo_transaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un tipo de Transaccion con el'.$id);

            if($this->model->delete($id)):
                return $this->respondDeleted($tipo_transaccionVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}
