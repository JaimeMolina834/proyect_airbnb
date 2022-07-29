<?php
namespace App\Models;

use CodeIgniter\Model;

class ServiciosModel extends Model{
    protected $table      = 'tbl_servicios';
    protected $primaryKey = 'idServicio';

    protected $useAutoIncrement = true;

    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre','foto','descripcion', 'disponibilidad','direccion','idAnfitrion','idTipoHospedaje','idTarifa','idMunicipio','idHuesped'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
    protected $deletedField  = 'date_delete';
    
    /*Variables para antes de insertar en la tabla*/
    protected $asignarFoto;

    /*-------------------------------------------------------------------------------------------------------*/

    public function agregarFoto(string $foto){
        $this->asignarFoto = $foto;
    }
}