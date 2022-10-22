<?php
namespace App\Models;

use CodeIgniter\Model;


class TipoHospedajeModel extends Model{
    protected $table      = 'tbl_tipo_hospedajes';
    protected $primaryKey = 'idTipoHospedaje';

    protected $returnType     = 'object';
    protected $allowedFields = ['tipoHospedaje'];

    protected $useTimestamps =true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
}