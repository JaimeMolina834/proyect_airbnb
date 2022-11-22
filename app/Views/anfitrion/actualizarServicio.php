<?= $this->extend('anfitrion/main') ?>


<?= $this->section('title') ?>
Actualizar
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<!-- PERFIL ANFITRION -->
<div class="container-fluid mt-5 pt-5">
    <?php if (session('msg')) : ?>
        <article class="message is-<?= session('msg.type') ?>">
            <div class="message-body">
                <?= session('msg.body') ?>
            </div>
        </article>
    <?php endif; ?>


    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">

                    <h1 class="title">Actualiza tu servicio</h1>
                    <h2 class="subtitle">
                        Modifica los campos que deseas actualizar.
                    </h2>

                    <form action="<?= base_url('anfitrion/ActualizarServicio') ?>?id=<?= password_hash($servicio[0]->idServicio, PASSWORD_DEFAULT) ?>" method="POST" enctype="multipart/form-data">
                        <!-- primera fila -->
                        <div class="form-group">
                            <div class="row">

                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">Nombre de servicio</label>
                                    <div class="control">
                                        <input name='nombre' value='<?php if (old('nombre') != null) : ?><?= old('nombre') ?><?php else : ?><?= $servicio[0]->nombre ?><?php endif; ?>' class="input" type="text" placeholder="Ej: Servicio Cabañas">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.nombre') ?></p>
                                </div>

                                <!-- tercera columna -->
                                <div class="col-md-3">
                                    <label class="label">Tipo de hospedaje</label>
                                    <div class="control select is-link">
                                        <select name='idTipoHospedaje'>
                                            <?php if (old('idTipoHospedaje') != null) : ?>
                                                <?php foreach ($tipoHospedajes as $key) : ?>
                                                    <option value="<?= $key->idTipoHospedaje ?>" <?php if ($key->idTipoHospedaje == old('idTipoHospedaje')) : ?>selected<?php endif; ?>>
                                                        <?= $key->tipoHospedaje ?></option>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <?php foreach ($tipoHospedajes as $key) : ?>
                                                    <option value="<?= $key->idTipoHospedaje ?>" <?php if ($key->idTipoHospedaje == $servicio[0]->idTipoHospedaje) : ?>selected<?php endif; ?>>
                                                        <?= $key->tipoHospedaje ?></option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.idTipoHospedaje') ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- tercera fila -->
                        <div class="form-group">
                            <div class="row">

                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">Descripcion de servicio</label>
                                    <div class="control">
                                        <input name='descripcion' value='<?php if (old('descripcion') != null) : ?><?= old('descripcion') ?><?php else : ?><?= $servicio[0]->descripcion ?><?php endif; ?>' class="input" type="text" placeholder="Ej: Lugar turistico">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.descripcion') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Tarifa</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='precio' value='<?php if (old('precio') != null) : ?><?= old('precio') ?><?php else : ?><?= $tarifa[0]->precio ?><?php endif; ?>' class="input" type="number" placeholder="$100.00" min="0" max="1000">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.precio') ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- fila -->
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="label">Direccion</label>
                                    <div class="control">
                                        <input name='direccion' value='<?php if (old('direccion') != null) : ?><?= old('direccion') ?><?php else : ?><?= $servicio[0]->direccion ?><?php endif; ?>' class="input" type="text" placeholder="Ej: 3Av Norte." />
                                    </div>
                                    <p class="is-danger help"><?= session('errors.direccion') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Descuento</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='descuento' value='<?php if (old('descuento') != null) : ?><?= old('descuento') ?><?php else : ?><?= $tarifa[0]->descuento ?><?php endif; ?>' class="input" type="number" placeholder="10%" min="0" max="100">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span><br><br>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.descuento') ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- segunda fila -->
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-3">
                                    <label class="label">Adultos</label>
                                    <div class="control">
                                        <input name='adultos' value='<?php if (old('adultos') != null) : ?><?= old('adultos') ?><?php else : ?><?= $huespedes[0]->adulto ?><?php endif; ?>' class="input" type="number" placeholder="Cantidad" min="0" max="10">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.adultos') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Menores de edad</label>
                                    <div class="control">
                                        <input name='menores' value='<?php if (old('menores') != null) : ?><?= old('menores') ?><?php else : ?><?= $huespedes[0]->menores ?><?php endif; ?>' class="input" type="number" placeholder="Cantidad" min="0" max="10">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.menores') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Bebes</label>
                                    <div class="control">
                                        <input name='bebes' value='<?php if (old('bebes') != null) : ?><?= old('bebes') ?><?php else : ?><?= $huespedes[0]->bebes ?><?php endif; ?>' class="input" type="number" placeholder="Cantidad" min="0" max="10">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.bebes') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Mascotas</label>
                                    <div class="control">
                                        <input name='mascotas' value='<?php if (old('mascotas') != null) : ?><?= old('mascotas') ?><?php else : ?><?= $huespedes[0]->mascotas ?><?php endif; ?>' class="input" type="number" placeholder="Cantidad" min="0" max="10">
                                    </div><br>
                                    <p class="is-danger help"><?= session('errors.mascotas') ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="label">Sub servicios</label>
                                    <?php foreach ($subServicios as $key) : ?>
                                        <input <?php
                                                if (old('idSubServicio') != null) {
                                                    $arraySubServicio = (old('idSubServicio'));
                                                    $tamanoSubServicio = count($arraySubServicio);
                                                } else {
                                                    $arraySubServicio = $guardadoSubServicios;
                                                    $tamanoSubServicio = count($subServicios);
                                                } ?> <?php for ($i = 0; $i < $tamanoSubServicio; $i++) {
                                                            if (in_array($key->idSubServicio, $arraySubServicio)) {
                                                        ?> checked <?php }
                                                            } ?> type="checkbox" name="idSubServicio[]" value="<?= $key->idSubServicio ?>"><?= $key->subServicio ?><br>

                                    <?php endforeach; ?>
                                    <p class="is-danger help"><?= session('errors.idSubServicio') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Salud y seguridad</label>
                                    <?php foreach ($saludSeguridad as $key) : ?>
                                        <input <?php
                                                if (old('idSaludSeguridad') != null) {
                                                    $arraySaludSeguridad = (old('idSaludSeguridad'));
                                                    $tamanoSaludSeguridad = count($arraySaludSeguridad);
                                                } else {
                                                    $arraySaludSeguridad = $guardadoSaludSeguridad;
                                                    $tamanoSaludSeguridad = count($saludSeguridad);
                                                } ?> <?php for ($i = 0; $i < $tamanoSaludSeguridad; $i++) {
                                                            if (in_array($key->idSaludSeguridad, $arraySaludSeguridad)) {
                                                        ?> checked <?php }
                                                            } ?> type="checkbox" name="idSaludSeguridad[]" value="<?= $key->idSaludSeguridad ?>"><?= $key->saludSeguridad ?><br>
                                    <?php endforeach; ?>
                                    <p class="is-danger help"><?= session('errors.idSaludSeguridad') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Reglas de servicio</label>
                                    <?php foreach ($reglaServicios as $key) : ?>
                                        <input <?php
                                                if (old('idReglaServicio') != null) {
                                                    $arrayReglaServicio = (old('idReglaServicio'));
                                                    $tamanoReglaServicio = count($arrayReglaServicio);
                                                } else {
                                                    $arrayReglaServicio = $guardadoReglaServicio;
                                                    $tamanoReglaServicio = count($reglaServicios);
                                                } ?> <?php for ($i = 0; $i < $tamanoReglaServicio; $i++) {
                                                            if (in_array($key->idReglaServicio, $arrayReglaServicio)) {
                                                        ?> checked <?php }
                                                            } ?> type="checkbox" name="idReglaServicio[]" value="<?= $key->idReglaServicio ?>"><?= $key->reglaServicio ?><br>
                                    <?php endforeach; ?>
                                    <p class="is-danger help"><?= session('errors.idReglaServicio') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Politicas de cancelacion</label>
                                    <?php foreach ($politicaCancelacion as $key) : ?>
                                        <input <?php
                                                if (old('idPoliticaCancelacion') != null) {
                                                    $arrayPoliticaCancelacion = (old('idPoliticaCancelacion'));
                                                    $tamanoPoliticaCancelacion = count($arrayPoliticaCancelacion);
                                                } else {
                                                    $arrayPoliticaCancelacion = $guardadoPoliticaCancelacion;
                                                    $tamanoPoliticaCancelacion = count($politicaCancelacion);
                                                } ?> <?php for ($i = 0; $i < $tamanoPoliticaCancelacion; $i++) {
                                                            if (in_array($key->idPoliticaCancelacion, $arrayPoliticaCancelacion)) {
                                                        ?> checked <?php }
                                                            } ?>type="checkbox" name="idPoliticaCancelacion[]" value="<?= $key->idPoliticaCancelacion ?>"><?= $key->politicaCancelacion ?><br>
                                    <?php endforeach; ?>
                                    <p class="is-danger help"><?= session('errors.idPoliticaCancelacion') ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- tercera fila  -->
                        <div class="form-group">
                            <div class="row">

                                <!-- boton publicar -->
                                <div class="text mt-4">
                                    <div class="control">
                                        <button class="btn btn-success">Actualizar</button>
                                        <a class="btn btn-primary" aria-current="page" href="<?= base_url(route_to('anfitrionInicio')) ?>">Atras</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div><br><br>
</div>

<?= $this->endSection() ?>