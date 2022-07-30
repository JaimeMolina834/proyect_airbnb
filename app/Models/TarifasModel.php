<?php
namespace App\Models;

use CodeIgniter\Model;


class TarifasModel extends Model{
    
    protected $table      = 'tbl_tarifas';
    protected $primaryKey = 'idTarifa';

    protected $returnType     = 'object';
    protected $allowedFields = ['precio', 'descuento'];

    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $useTimestamps =true;


    

}

//select idTarifa  from tbl_tarifas order by idTarifa desc  limit 1;