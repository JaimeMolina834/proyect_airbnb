<?php
namespace App\Models;

use CodeIgniter\Model;


class DepartamentosModel extends Model{
    protected $table      = 'tbl_departamentos';
    protected $primaryKey = 'idDepartamento';

    protected $returnType     = 'object';
    protected $allowedFields = ['departamento','idPais'];

    protected $useTimestamps =true;
    protected $asignarPais;

}