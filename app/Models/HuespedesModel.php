<?php
namespace App\Models;

use CodeIgniter\Model;


class HuespedesModel extends Model{
    
    protected $table      = 'tbl_huespedes';
    protected $primaryKey = 'idHuesped';

    protected $returnType     = 'object';
    protected $allowedFields = ['adulto','bebes','menores','mascotas','idServicio'];

    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $useTimestamps =true;


}