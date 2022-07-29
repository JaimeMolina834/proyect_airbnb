<?php
namespace App\Models;

use CodeIgniter\Database\Query;
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
 /*-------------------------------------------------------------------------------------------------------*/
     public function insert_data($data){
        $this->db->insert("tbl_servicios",$data);
    }
 /*-------------------------------------------------------------------------------------------------------*/

    public function fetch_data(){
       // $query = $this->db->get("tbl_servicios");
       $query = $this->db->query("select * from tbl_servicios");
        return $query;
    }
}