<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Usuario;

class IdiomasModel extends Model{
    protected $table      = 'tbl_idiomas';
    protected $primaryKey = 'idIdioma';

    protected $returnType     = 'object';
    protected $allowedFields = ['idioma'];

    protected $useTimestamps =true;
}