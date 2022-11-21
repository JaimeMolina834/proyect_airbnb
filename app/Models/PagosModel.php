<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use App\Entities\Reserva;

class PagosModel extends Model
{

    protected $table = 'tbl_pagos';
    protected $primaryKey = 'idPago';

    protected $returnType     = Reserva::class;
    protected $allowedFields = ['fechaEntrada','fechaSalida','total','encargadoReserva','idServicio','idUsuario'];

    protected $useTimestamps = true;
    protected $createdField  = 'date_create';
    protected $updatedField  = 'date_update';
}