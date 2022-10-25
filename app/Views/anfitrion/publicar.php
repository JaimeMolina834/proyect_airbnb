<?= $this->extend('anfitrion/main') ?>


<?= $this->section('title') ?>
Publicar
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

                    <h1 class="title">Publica tu servicio</h1>
                    <h2 class="subtitle">
                        Llena los siguientes datos para poder publicar.
                    </h2>

                    <form action="<?= base_url('anfitrion/RegistrarPublicacion') ?>" method="POST"
                        enctype="multipart/form-data">
                        <!-- primera fila -->
                        <div class="form-group">
                            <div class="row">
                                <p class="is-danger help"><?= session('errorImg') ?></p>
                                <!-- AGREGAR FOTO -->
                                <div class="col-md-5">
                                    <label class="label">Agrega una foto</label>
                                    <div class="text-left">
                                        <img value='<?= old('foto') ?>' id="imagenPre1" width="118" height="50"
                                            src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                            class="avatar img-thumbnail rounded-circle" alt="avatar">
                                        <h6></h6>
                                        <button type="button" class="btn-warning">
                                            <i class="fa fa-camera"></i> Subir foto
                                            <input value='<?= old('foto') ?>' id="foto1" type="file" name="foto[]"
                                                class="text-left left-block file-upload">
                                        </button>
                                    </div>
                                </div>
                                <!-- segunda columna -->

                                <div class="col-md-5">
                                    <label class="label">Agrega una foto</label>
                                    <div class="text-left">
                                        <img value='<?= old('foto') ?>' id="imagenPre2" width="118" height="50"
                                            src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                            class="avatar img-thumbnail rounded-circle" alt="avatar">
                                        <h6></h6>
                                        <button type="button" class="btn-warning">
                                            <i class="fa fa-camera"></i> Subir foto
                                            <input value='<?= old('foto') ?>' id="foto2" type="file" name="foto[]"
                                                class="text-left left-block file-upload">
                                        </button>
                                    </div>
                                </div>
                                <!-- tercera columna -->
                                <div class="col-md-2">
                                    <label class="label">Agrega una foto</label>
                                    <div class="text-left">
                                        <img value='<?= old('foto') ?>' id="imagenPre3" width="118" height="50"
                                            src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                            class="avatar img-thumbnail rounded-circle" alt="avatar">
                                        <h6></h6>
                                        <button type="button" class="btn-warning">
                                            <i class="fa fa-camera"></i> Subir foto
                                            <input value='<?= old('foto') ?>' id="foto3" type="file" name="foto[]"
                                                class="text-left left-block file-upload">
                                        </button><br><br><br>
                                    </div>
                                </div>


                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">Nombre de servicio</label>
                                    <div class="control">
                                        <input name='nombre' value='<?= old('nombre') ?>' class="input" type="text"
                                            placeholder="Ej: Servicio Cabañas">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.nombre') ?></p>
                                </div>
                                <!-- segunda columna -->
                                <div class="col-md-3">
                                    <label class="label">Pais</label>
                                    <div class="control select is-link">
                                        <select id='pais' name="idPais">
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- tercera columna -->
                                <div class="col-md-3">
                                    <label class="label">Tipo de hospedaje</label>
                                    <div class="control select is-link">
                                        <select name='idTipoHospedaje'>
                                            <option>...</option>
                                            <?php foreach ($tipoHospedajes as $key) : ?>
                                            <option value="<?= $key->idTipoHospedaje ?>"
                                                <?php if ($key->idTipoHospedaje == old('idTipoHospedaje')) : ?>selected<?php endif; ?>>
                                                <?= $key->tipoHospedaje ?></option>
                                            <?php endforeach; ?>
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
                                        <input name='descripcion' value='<?= old('descripcion') ?>' class="input"
                                            type="text" placeholder="Ej: Lugar turistico">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.descripcion') ?></p>
                                </div>

                                <!-- segunda columna -->
                                <div class="col-md-3">
                                    <label class="label">Departamento</label>
                                    <div class="control select is-link">
                                        <select id='departamento' name='idDepartamento'>
                                            <option>...</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Tarifa</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='precio' value='<?= old('precio') ?>' class="input" type="number"
                                            placeholder="$100.00" min="0" max="1000">
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
                                        <input name='direccion' value='<?= old('direccion') ?>' class="input"
                                            type="text" placeholder="Ej: 3Av Norte." />
                                    </div>
                                    <p class="is-danger help"><?= session('errors.direccion') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Municipio</label>
                                    <div class="control select is-link">
                                        <select id='municipio' name='idMunicipio'>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.idMunicipio') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Descuento</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='descuento' value='<?= old('descuento') ?>' class="input"
                                            type="number" placeholder="10%" min="0" max="100">
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
                                        <input name='adultos' value='<?= old('adultos') ?>' class="input" type="number"
                                            placeholder="Cantidad" min="0" max="10">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.adultos') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Menores de edad</label>
                                    <div class="control">
                                        <input name='menores' value='<?= old('menores') ?>' class="input" type="number"
                                            placeholder="Cantidad" min="0" max="10">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.menores') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Bebes</label>
                                    <div class="control">
                                        <input name='bebes' value='<?= old('bebes') ?>' class="input" type="number"
                                            placeholder="Cantidad" min="0" max="10">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.bebes') ?></p>
                                </div>

                                <div class="col-md-3">
                                    <label class="label">Mascotas</label>
                                    <div class="control">
                                        <input name='mascotas' value='<?= old('mascotas') ?>' class="input"
                                            type="number" placeholder="Cantidad" min="0" max="10">
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
                                                    $arraySubServicio = $subServicios;
                                                    $tamanoSubServicio = count($subServicios);
                                                } ?> <?php for ($i = 0; $i < $tamanoSubServicio; $i++) {
                                                            if ($arraySubServicio[$i] == $key->idSubServicio) {
                                                        ?> checked <?php }
                                                        } ?> type="checkbox" name="idSubServicio[]"
                                        value="<?= $key->idSubServicio ?>"><?= $key->subServicio ?><br>

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
                                                    $arraySaludSeguridad = $saludSeguridad;
                                                    $tamanoSaludSeguridad = count($saludSeguridad);
                                                } ?> <?php for ($i = 0; $i < $tamanoSaludSeguridad; $i++) {
                                                            if ($arraySaludSeguridad[$i] == $key->idSaludSeguridad) {
                                                        ?> checked <?php }
                                                        } ?> type="checkbox" name="idSaludSeguridad[]"
                                        value="<?= $key->idSaludSeguridad ?>"><?= $key->saludSeguridad ?><br>
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
                                                    $arrayReglaServicio = $reglaServicios;
                                                    $tamanoReglaServicio = count($reglaServicios);
                                                } ?> <?php for ($i = 0; $i < $tamanoReglaServicio; $i++) {
                                                            if ($arrayReglaServicio[$i] == $key->idReglaServicio) {
                                                        ?> checked <?php }
                                                        } ?> type="checkbox" name="idReglaServicio[]"
                                        value="<?= $key->idReglaServicio ?>"><?= $key->reglaServicio ?><br>
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
                                                    $arrayPoliticaCancelacion = $politicaCancelacion;
                                                    $tamanoPoliticaCancelacion = count($politicaCancelacion);
                                                } ?> <?php for ($i = 0; $i < $tamanoPoliticaCancelacion; $i++) {
                                                            if ($arrayPoliticaCancelacion[$i] == $key->idPoliticaCancelacion) {
                                                        ?> checked <?php }
                                                        } ?>type="checkbox" name="idPoliticaCancelacion[]"
                                        value="<?= $key->idPoliticaCancelacion ?>"><?= $key->politicaCancelacion ?><br>
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
                                        <button class="btn btn-success">Publicar</button>
                                        <a class="btn btn-primary" aria-current="page"
                                            href="<?= base_url(route_to('anfitrionInicio')) ?>">Atras</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div><br><br>


<?= $this->endSection() ?>