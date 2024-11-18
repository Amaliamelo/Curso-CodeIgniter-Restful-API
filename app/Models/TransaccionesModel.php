<?php namespace App\Models;

use CodeIgniter\Model;

class TransaccionesModel extends Model
{
    protected $table         = 'tipo_transacion';
    protected $primaryKey    = 'id';

    protected $returnType    = 'array';
    protected $allowedFields = ['cuenta_id','tipo_transaccion_id', 'monto']; //Todos os campos que não estam nessa tab, o codeIgniter não vai olhar

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updateField   = 'updated_at';

    protected $validationRules  = [
        'monto'   => 'required|numeric',
        'cuenta_id'   => 'required|integer',
        'tipo_transaccion_id'   => 'required|integer',
    ];

    /*protected $validationMensages = [
        'cliente_id'    => [
            'is_valid_cliente' => 'Estimado usuario, debe ingresar un cliente valido',
            'is_allow_cliente' => 'Estimado usuario, debe ingresar un cliente de la lista permitida'
        ]
    ];*/

    protected $skipValidation = false;
}


?>