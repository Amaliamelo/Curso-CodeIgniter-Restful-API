<?php namespace App\Models;

use CodeIgniter\Model;

class tipo_transaccionModel extends Model
{
    protected $table         = 'tipo_transaccion';
    protected $primaryKey    = 'id';

    protected $returnType    = 'array';
    protected $allowedFields = ['descripcion']; //Todos os campos que não estam nessa tab, o codeIgniter não vai olhar

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updateField   = 'updated_at';

    protected $validationRules  = [
        'descripcion'     => 'required|alpha_numeric_space|min_length[3]|max_length[75]'
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