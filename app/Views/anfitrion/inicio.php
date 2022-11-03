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
        <!------------------------------Inicio de Body-------------------------->

        <div class="row">
            <div class="form-row">
                <?php foreach ($servicios as $key) : ?>
                <div class="col-3"><br>
                    <div class="card">
                        <div class="card" style="width: 22rem;">

                            <!------------------------------Inicio de carousel -------------------------->


                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="rounded carousel-inner">
                                    <?php $i = 1;?>
                                    <?php foreach ($imagenes as $imagen) : ?>
                                    <?php if($imagen->idServicio == $key->idServicio):?>
                                    <?php if ($i == 3) : ?>
                                    <div class="carousel-item active">
                                        <img src="<?= $imagen->url ?>" alt="First slide">
                                    </div>
                                    <?php else : ?>
                                    <div class="carousel-item">
                                        <img src="<?= $imagen->url ?>" alt="First slide">
                                    </div>
                                    <?php endif;
                                                $i++; ?>
                                    <?php endif;?>
                                    <?php endforeach; ?>

                                </div>
                            </div>

                            <div class="card-content">
                                <div class="media-content">

                                    <p class="title is-4"><?= $key->nombre ?></p>
                                    <p class="subtitle is-6">@<?= session('username') ?></p>
                                </div>

                                <div class="content">
                                    <br>

                                    <?php foreach ($municipios as $keyMunicipio) : ?>

                                    <?php if ($key->idMunicipio == $keyMunicipio->idMunicipio) : ?>
                                    <p>Municipio-<?= $keyMunicipio->municipio ?></p>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <small class="text-muted">
                                        <time><?= $key->date_create->humanize(); ?></time><br><br>
                                    </small>


                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <a href="<?= base_url(route_to('verServicio')) ?>?id=<?= password_hash($key->idServicio, PASSWORD_DEFAULT) ?>"
                                                    class="btn btn-primary">Ver</a>
                                            </div>

                                            <div class="col-md-4">

                                                <a href="#Modal<?= $key->idServicio ?>" data-backdrop="false"
                                                    data-toggle="modal" class="btn btn-info">Preview</a>
                                            </div>

                                            <div class="col-md-1">

                                                <a href="<?=base_url(route_to('actualizarServicio'))?>?id=<?= password_hash($key->idServicio,PASSWORD_DEFAULT)?>"
                                                    class="btn btn-success">Actualizar</a>
                                                <br><br>
                                            </div>

                                            <!--<a href="#" class="btn btn-danger">Dar de baja</a>-->

                                            <?php if($key->estatus == 1): ?>
                                            <a href="<?=base_url(route_to('darBajaServicio'))?>?id=<?= password_hash($key->idServicio,PASSWORD_DEFAULT)?>"
                                                class="btn btn-danger">Dar de
                                                baja</a>
                                            <?php else : ?>
                                            <a href="<?=base_url(route_to('darAltaServicio'))?>?id=<?= password_hash($key->idServicio,PASSWORD_DEFAULT)?>"
                                                class="btn btn-secondary">Dar de
                                                alta</a>
                                            <?php endif;?>

                                        </div>
                                    </div>
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
    <div class="modal" id="Modal<?= $key->idServicio ?>" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="title"><?= $key->nombre ?></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group col-md-12">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="rounded carousel-inner" style="width: 50%; margin: 0 auto">
                                <?php $i = 1;?>
                                <?php foreach ($imagenes as $imagen) : ?>
                                <?php if($imagen->idServicio == $key->idServicio):?>
                                <?php if ($i == 3) : ?>
                                <div class="carousel-item active">
                                    <img src="<?= $imagen->url ?>" alt="First slide">
                                </div>
                                <?php else : ?>
                                <div class="carousel-item">
                                    <img src="<?= $imagen->url ?>" alt="First slide">
                                </div>
                                <?php endif;
                                                $i++; ?>
                                <?php endif;?>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                    <form class="form-row" action="#" method="POST">


                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Tarifa/Dia</label>
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
                            <h6 class="subtitle is-6 has-text-centered"><?= $keyTipoHospedaje->tipoHospedaje ?>
                            </h6>
                            <?php endif; ?>

                            <?php endforeach; ?>
                        </div>


                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Municipio</label>
                            <?php foreach ($municipios as $keyMunicipio) : ?>

                            <?php if ($key->idMunicipio == $keyMunicipio->idMunicipio) : ?>
                            <h6 class="subtitle is-6 has-text-centered"><?= $keyMunicipio->municipio ?></h6><br>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Direccion</label>
                            <h6 class="subtitle is-6 has-text-centered"><?= $key->direccion ?></h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Publicada por</label>
                            <h6 class="subtitle is-6 has-text-centered">@<?= session('username') ?></h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Publicada</label>
                            <h6 class="subtitle is-6 has-text-centered"><?= $key->date_update->humanize(); ?>
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

</section>

<?= $this->endSection() ?>