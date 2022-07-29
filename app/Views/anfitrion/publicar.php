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

                    <form action="<?= base_url('anfitrion/RegistrarPublicacion') ?>" method="POST" enctype="multipart/form-data">
                        <!-- primera fila -->
                        <div class="form-group">
                            <div class="row">
                                <!-- AGREGAR FOTO -->
                                <div class="field">
                                    <label class="label">Agrega una foto</label>
                                    <div class="text-left">
                                        <img value='<?= old('foto') ?>' id="imagenPrevisualizacion" width="210" height="50" src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar">
                                        <h6></h6>
                                        <input value='<?= old('foto') ?>' id="seleccionArchivos" type="file" name="foto" class="text-left left-block file-upload">
                                        <p class="is-danger help"><?= session('errorImg.foto') ?></p>
                                    </div>
                                </div>

                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">Nombre de servicio</label>
                                    <div class="control">
                                        <input name='nombre' value='<?= old('nombre') ?>' class="input" type="text" placeholder="Ej: Servicio Cabañas">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.nombre') ?></p>
                                </div>

                                <!-- segunda columna -->
                                <div class="col-md-6">
                                    <label class="label">Descripcion de servicio</label>
                                    <div class="control">
                                        <input name='descripcion' value='<?= old('descripcion') ?>' class="input" type="text" placeholder="Ej: Lugar turistico">
                                    </div>
                                    <p class="is-danger help"><?= session('errors.descripcion') ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- tercera fila -->
                        <div class="form-group">
                            <div class="row">

                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">Tipo de hospedaje</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='idTipoHospedaje' value='<?= old('idTipoHospedaje') ?>' class="input" type="text" placeholder="Ej: Cabañas">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.idTipoHospedaje') ?></p>
                                </div>

                                <!-- tercera columna -->
                                <div class="col-md-6">
                                    <label class="label">Direccion</label>
                                    <div class="control">
                                        <input name='direccion' value='<?= old('direccion') ?>' class="input" type="text" placeholder="Ej: 3Av Norte." />
                                    </div>
                                    <p class="is-danger help"><?= session('errors.direccion') ?></p>
                                </div>
                            </div>
                        </div>


                        <!-- segunda fila -->
                        <div class="form-group">
                            <div class="row">

                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">Tarifa</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='idTarifa' value='<?= old('idTarifa') ?>' class="input" type="number" placeholder="$100.00">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.idTarifa') ?></p>
                                </div>

                                <!-- segunda columna -->
                                <div class="col-md-6">
                                    <label class="label">Municipio</label>
                                    <div class="control">
                                        <input name='idMunicipio' value='<?= old('idMunicipio') ?>' class="input" type="text" placeholder="Ej: 3Av Norte." />
                                    </div>
                                    <p class="is-danger help"><?= session('errors.idMunicipio') ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">

                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">Disponibilidad</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='disponibilidad' value='<?= old('disponibilidad') ?>' class="input" type="number" placeholder="Ej: 1">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.disponibilidad') ?></p>
                                </div>


                                <!-- primera columna -->
                                <div class="col-md-6">
                                    <label class="label">idAnfitrion</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input name='idAnfitrion' value='<?= old('idAnfitrion') ?>' class="input" type="number" placeholder="id: 00">
                                        <span class="icon is-small is-left">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <p class="is-danger help"><?= session('errors.idAnfitrion') ?></p>
                                </div>


                            </div>
                        </div>


                        <!-- tercera fila  -->
                        <div class="form-group">
                            <div class="row">

                                <!-- boton registro -->
                                <div class="text-center mt-6">
                                    <div class="control">
                                        <button class="btn btn-primary">Publicar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>



</div>


<?= $this->endSection() ?>