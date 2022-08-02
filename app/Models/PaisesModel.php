<?php
namespace App\Models;

use CodeIgniter\Model;


class PaisesModel extends Model{
    protected $table      = 'tbl_paises';
    protected $primaryKey = 'idPais';

    protected $returnType     = 'object';
    protected $allowedFields = ['pais'];

    protected $useTimestamps =true;
    protected $asignarPais;

}