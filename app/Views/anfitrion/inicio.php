<?= $this->extend('anfitrion/main') ?>

<?= $this->section('title') ?>
Inicio Anfitrion
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class='section'>
    <div class='container'>

        <div class="d-flex justify-content-between">
            <span>

            </span>
            <span>
                <a class="btn btn-success" href="<?= base_url('anfitrion/publicar') ?>">Publicar</a><br><br>
            </span>
        </div>

        <?php if (session('msg')) : ?>
            <article class="message is-<?= session('msg.type') ?>">
                <div class="message-body">
                    <?= session('msg.body') ?>
                </div>
            </article>
        <?php endif; ?>
        <?php if (session()->is_logged) : ?>
            <h5>Estoy en inicio, soy <?= session('rol') ?></h5>
        <?php else : ?>
            <h5>Es el incio</h5>
        <?php endif; ?>

        <!------------------------------Inicio de Body-------------------------->

        <div class="row">
            <div class="form-row">
                <?php foreach ($servicios as $key) : ?>
                    <div class="col-3"><br>
                        <div class="card">
                            <div class="card" style="width: 22rem;">
                            <?php if(file_exists("C:/laragon/www/proyect_airbnb/public".$key->foto)): ?>
                        <img src="<?=$key->foto?>" class="mx-auto d-block">
                        <?php else: ?>
                        <img src="C:/laragon/www/proyect_airbnb/public/img/publicaciones/default.jpg" class="mx-auto d-block">
                        <?php endif;?>
                                <div class="card-content">
                                    <div class="media-content">

                                        <p class="title is-4"><?= $key->nombre ?></p>
                                        <p class="subtitle is-6">@<?= session('username') ?></p>
                                    </div>

                                    <div class="content">
                                        <br>
                                        <p><?= $key->descripcion ?></p>

                                        <?php foreach ($municipios as $keyMunicipio) : ?>

                                            <?php if ($key->idMunicipio == $keyMunicipio->idMunicipio) : ?>
                                                <p>Municipio-<?= $keyMunicipio->municipio ?></p>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                        <time><?=$key->date_update ?></time><br>
                                        <a href="" class="btn btn-primary">Ir</a>


                                        <a href="#Modal<?= $key->idServicio ?>" data-toggle="modal" class="btn btn-primary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>


    <?php foreach ($servicios as $key) : ?>
        <div class="modal fade bd-example-modal-lg" id="Modal<?= $key->idServicio ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="title"><?= $key->nombre ?></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-row" action="#" method="POST">
                            <div class="form-group col-md-12">
                            <?php if(file_exists("C:/laragon/www/proyect_airbnb/public".$key->foto)): ?>
                        <img src="<?=$key->foto?>" class="mx-auto d-block">
                        <?php else: ?>
                        <img src="C:/laragon/www/proyect_airbnb/public/img/publicaciones/default.jpg" class="mx-auto d-block">
                        <?php endif;?>
                             
                            </div>

                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Tarifa</label>
                                <?php foreach ($tarifas as $keyTarifa) : ?>

                                    <?php if ($key->idTarifa == $keyTarifa->idTarifa) : ?>
                                        <h6 class="subtitle is-6 has-text-centered">$<?= $keyTarifa->precio ?></h6>
                                    <?php endif; ?>

                                <?php endforeach; ?>

                            </div>

                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Tipo de Hospedaje</label>
                                <?php foreach ($tipoHospedajes as $keyTipoHospedaje) : ?>

                                    <?php if ($key->idTipoHospedaje == $keyTipoHospedaje->idTipoHospedaje) : ?>
                                        <h6 class="subtitle is-6 has-text-centered"><?= $keyTipoHospedaje->tipoHospedaje ?></h6>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Disponibilidad</label>
                                <?php if ($key->disponibilidad == 1) : ?>
                                    <h6 class="subtitle is-6 has-text-centered">Sin reservar</h6>
                                <?php elseif ($key->disponibilidad == 2) :  ?>
                                    <h6 class="subtitle is-6 has-text-centered">Reservado</h6>
                                <?php else : ?>
                                    <h6 class="subtitle is-6 has-text-centered">De baja</h6>
                                <?php endif; ?>
                            </div>



                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Municipio</label>
                                <?php foreach ($municipios as $keyMunicipio) : ?>

                                    <?php if ($key->idMunicipio == $keyMunicipio->idMunicipio) : ?>
                                        <h6 class="subtitle is-6 has-text-centered"><?= $keyMunicipio->municipio ?></h6>  
                                    <?php endif; ?>

                                <?php endforeach; ?>
                               
                            </div>


                            <div class="form-group col-md-6">
                                <label class="label has-text-centered">Direccion</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->direccion?></h6>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="label has-text-centered">Descripción del hospedaje</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $key->descripcion ?></h6>
                            </div>



                            <div class="form-group col-md-3">
                                <label class="label has-text-centered">Publicada por</label>
                                <h6 class="subtitle is-6 has-text-centered">@<?= session('username') ?></h6>
                            </div>


                            <div class="form-group col-md-3">
                                <label class="label has-text-centered">Publicada</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $key->date_update?></h6>
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

</section>

<?= $this->endSection() ?>