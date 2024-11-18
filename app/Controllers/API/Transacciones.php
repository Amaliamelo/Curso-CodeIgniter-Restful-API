<?php namespace App\Controllers\API;

use App\Models\TransaccionesModel;
use CodeIgniter\RESTful\ResourceController;

class Transacciones extends ResourceController
{
    public function __construct() {
        $this -> model = $this->setModel(new TransaccionesModel());
    }

    public function index()
    {
        $Transacciones = $this->model->findAll();
        return $this->respond($Transacciones);
    }

    public function create(){
        try{
            $Transaccion = $this->request->getJSON();

            if($this->model->insert($Transaccion)):
                $Transaccion->id = $this->model->insertID();
                return $this->respondCreated($Transaccion);
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

            $Transaccion = $this->model->find($id);
            if($Transaccion == null)
                return $this->failNotFound('No se ha encontrado un Transaccion con el'.$id);

            return $this->respond($Transaccion);

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }

    public function update($id = null)
    {
        try{
           
            if($id==null)
                return $this -> failValidationErrors('No se ha ppasado un Id valido');

            $TransaccionVerificado = $this->model->find($id);
            if($TransaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un Transaccion con el'.$id);

            $Transaccion = $this->request->getJSON();

            if($this->model->update($id, $Transaccion)):
                $Transaccion->id = $id;
                return $this->respondUpdated($Transaccion);
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

            $TransaccionVerificado = $this->model->find($id);
            if($TransaccionVerificado == null)
                return $this->failNotFound('No se ha encontrado un Transaccion con el'.$id);

            if($this->model->delete($id)):
                return $this->respondDeleted($TransaccionVerificado);
            else:
                return $this->failServerError('No se ha podido eliminar el registro');
            endif;

        }catch (\Exception $e){
            return $this->failServerError('Ha ocurrido un error en el servidor');
        }
    }
}
