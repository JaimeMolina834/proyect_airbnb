<?=$this->extend('anfitrion/main')?>

<?=$this->section('title')?>
Mis reservas
<?=$this->endSection()?>

<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<?=$this->endSection()?>

<?=$this->section('content')?>

<!-- PERFIL ANFITRION -->
<div class="container-sm">
    <?php setlocale(LC_TIME, 'es_ES.UTF-8');?>
    <?php if(session('msg')):?>
    <article class="message is-<?=session('msg.type')?>">
        <div class="message-body">
            <?=session('msg.body')?>
        </div>
    </article>
    <?php endif; ?>
    <h1 class="title">Mis reservas activas</h1>
    <?php if($reservas == null): ?>
    <h2 class="subtitle">
        No hay ninguna reserva activa.
    </h2>
    <?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>N°</th>
                <th>Fecha entrada</th>
                <th>Fecha Salida</th>
                <th>Total</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            <?php foreach($reservas as $keyReserva):?>
            <tr>
                <td><?=$i?></td>
                <td><?=date('d-m-Y',strtotime($keyReserva->fechaEntrada))?></td>
                <td><?=date('d-m-Y',strtotime($keyReserva->fechaSalida))?></td>
                <td>$<?=$keyReserva->total?></td>
                <td>
                    <a href="#Modal<?=$keyReserva->idPago?>" data-backdrop="false" data-toggle="modal"
                        class="btn btn-info"><i class="fas fa-thin fa-eye" aria-hidden="true"></i></a>
                </td>
            </tr>
            <?php $i++;?>
            <?php endforeach;?>
        </tbody>
    </table>


    <?php foreach ($reservas as $keyReserva) : ?>
    <div class="modal" id="Modal<?=$keyReserva->idPago?>" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-row" action="#" method="POST">
                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Fecha de entrada</label>
                            <h6 class="subtitle is-6 has-text-centered">
                                <?=date('d-m-Y',strtotime($keyReserva->fechaEntrada)) ?>
                            </h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Fecha de salida</label>
                            <h6 class="subtitle is-6 has-text-centered">
                                <?=date('d-m-Y',strtotime($keyReserva->fechaSalida)) ?></h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Total</label>
                            <h6 class="subtitle is-6 has-text-centered">$<?=$keyReserva->total ?></h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Quien la reservo</label>
                            <?php foreach($usuarios as $keyUsuario):?>
                            <?php if($keyReserva->idUsuario == $keyUsuario->idUsuario):?>
                            <h6 class="subtitle is-6 has-text-centered"><?=$keyUsuario->nombre?>
                                <?=$keyUsuario->apellido?></h6>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Contactos</label>
                            <?php foreach($usuarios as $keyUsuario):?>
                            <?php if($keyReserva->idUsuario == $keyUsuario->idUsuario):?>
                            <h6 class="subtitle is-6 has-text-centered">Email: <?=$keyUsuario->email?>
                                Numero de telefono: <?=$keyUsuario->numeroTelefono?></h6>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="label has-text-centered">Cuando la reservó</label>
                            <h6 class="subtitle is-6 has-text-centered">
                                <?php setlocale(LC_ALL,"es_ES") ?>
                                <?=date('l d, \d\e F \d\e Y \a \l\a\s H:i:s',strtotime($keyReserva->date_create)) ?>
                            </h6>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="label has-text-centered"></label>
                            </h6>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif;?>

    <h1 class="title">Historial</h1>
    <?php if($historial == null): ?>
    <h2 class="subtitle">
        No hay ninguna reserva en el historial.
    </h2>
    <?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>N°</th>
                <th>Fecha entrada</th>
                <th>Fecha Salida</th>
                <th>Total</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            <?php foreach($historial as $keyHistorial):?>
            <tr>
                <td><?=$i?></td>
                <td><?=date('d-m-Y',strtotime($keyHistorial->fechaEntrada))?></td>
                <td><?=date('d-m-Y',strtotime($keyHistorial->fechaSalida))?></td>
                <td>$<?=$keyHistorial->total?></td>
                <td>
                    <a href="#Modal<?=$keyHistorial->idPago?>" data-backdrop="false" data-toggle="modal"
                        class="btn btn-info"><i class="fas fa-thin fa-eye" aria-hidden="true"></i></a>
                </td>
            </tr>
            <?php $i++;?>
            <?php endforeach;?>
        </tbody>
    </table>

    <?php foreach ($historial as $keyHistorial) : ?>
    <div class="modal" id="Modal<?=$keyHistorial->idPago?>" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class="form-row" action="#" method="POST">
                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Fecha de entrada</label>
                            <h6 class="subtitle is-6 has-text-centered">
                                <?=date('d-m-Y',strtotime($keyHistorial->fechaEntrada)) ?>
                            </h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Fecha de salida</label>
                            <h6 class="subtitle is-6 has-text-centered">
                                <?=date('d-m-Y',strtotime($keyHistorial->fechaSalida)) ?></h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Total</label>
                            <h6 class="subtitle is-6 has-text-centered">$<?=$keyHistorial->total ?></h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Quien la reservo</label>
                            <?php foreach($usuarios as $keyUsuario):?>
                            <?php if($keyHistorial->idUsuario == $keyUsuario->idUsuario):?>
                            <h6 class="subtitle is-6 has-text-centered"><?=$keyUsuario->nombre?>
                                <?=$keyUsuario->apellido?></h6>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Contactos</label>
                            <?php foreach($usuarios as $keyUsuario):?>
                            <?php if($keyHistorial->idUsuario == $keyUsuario->idUsuario):?>
                            <h6 class="subtitle is-6 has-text-centered">Email: <?=$keyUsuario->email?>
                                Numero de telefono: <?=$keyUsuario->numeroTelefono?></h6>
                            <?php endif;?>
                            <?php endforeach;?>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="label has-text-centered">Cuando la reservó</label>
                            <h6 class="subtitle is-6 has-text-centered">
                                <?php //setlocale(LC_ALL,"es_ES") ?>
                                <?php setlocale(LC_TIME, 'es_ES.UTF-8')?>
                                <?=date('l d, \d\e F \d\e Y \a \l\a\s H:i:s',strtotime($keyHistorial->date_create)) ?>
                            </h6>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="label has-text-centered"></label>
                            </h6>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php endif;?>
</div>
<?=$this->endSection()?>