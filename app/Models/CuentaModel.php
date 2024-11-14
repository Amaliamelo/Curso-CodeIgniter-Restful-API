<?php namespace App\Models;

use CodeIgniter\Model;

class CuentaModel extends Model
{
    protected $table         = 'cuenta';
    protected $primaryKey    = 'id';

    protected $returnType    = 'array';
    protected $allowedFields = ['moneda', 'fondo', 'cliente_id']; //Todos os campos que não estam nessa tab, o codeIgniter não vai olhar

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updateField   = 'updated_at';

    protected $validationRules  = [
        'moneda'     => 'required|alpha_numeric_space|min_length[3]|max_length[75]',
        'fondo'   => 'required|alpha_numeric_space|min_length[3]|max_length[75]',
        'cliente_id'   => 'required|alpha_numeric_space|min_length[1]|max_length[8]',
    ];

   /* protected $validationMensages = [
        'correo'    => [
            'valid_email' => 'Estimado usuario, debe ingresar un email valido'
        ]
    ];*/

    protected $skipValidation = false;
}


?>