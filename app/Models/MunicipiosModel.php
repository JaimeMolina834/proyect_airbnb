<?php
namespace App\Models;

use CodeIgniter\Model;


class MunicipiosModel extends Model{
    protected $table      = 'tbl_municipios';
    protected $primaryKey = 'idMunicipio';

    protected $returnType     = 'object';
    protected $allowedFields = ['municipio','idDepartamento'];

    protected $useTimestamps =true;
    protected $asignarMunicipio;

}