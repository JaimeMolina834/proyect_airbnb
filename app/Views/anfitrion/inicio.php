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

                                <!------------------------------Inicio de carousel -------------------------->


                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="rounded carousel-inner">
                                        <?php foreach ($imagenes as $imagen) : ?>
                                            <?php
                                            $modelImagenes = model('ImagenesModel');

                                            $imagen = $modelImagenes->where('idServicio', $key->idServicio)->findColumn('url');
                                            $contarImagen = count($imagen);
                                            $i = 1;
                                            ?>
                                            <?php foreach ($imagen as $keyImagen) : ?>
                                                <?php if ($contarImagen == $i) : ?>
                                                    <div class="carousel-item active">
                                                        <img src="<?= $keyImagen ?>" alt="First slide">
                                                    </div>
                                                <?php else : ?>
                                                    <div class="carousel-item">
                                                        <img src="<?= $keyImagen ?>" alt="First slide">
                                                    </div>
                                                <?php endif;
                                                $i++; ?>
                                            <?php endforeach;
                                            break; ?>
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
                                        <p><?= $key->descripcion ?></p>

                                        <?php foreach ($municipios as $keyMunicipio) : ?>

                                            <?php if ($key->idMunicipio == $keyMunicipio->idMunicipio) : ?>
                                                <p>Municipio-<?= $keyMunicipio->municipio ?></p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                        <time><?= $key->date_update->humanize(); ?></time><br>

                                        <div class="form-group">
                                            <div class="row">

                                            <div class="col-md-3">
                                             <a href="<?= base_url(route_to('verServicio'))?>?id=<?= password_hash($key->idServicio, PASSWORD_DEFAULT) ?>" class="btn btn-primary">Ver</a>
                                            </div>

                                            <div class="col-md-4">
                                            
                                            <a href="#Modal<?= $key->idServicio?>" data-backdrop="false" data-toggle="modal" class="btn btn-info">Preview</a>
                                            </div>


                                            <div class="col-md-1">
                                                
                                                <a href="#" class="btn btn-success">Actualizar</a>
                                                <br><br>
                                            </div>

                                         
                                           
                                            <a href="#" class="btn btn-danger">Dar de baja</a>
                                                
                                             
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
        <div class="modal" id="Modal<?= $key->idServicio ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
                                    <?php foreach ($imagenes as $imagen) : ?>
                                        <?php
                                        $modelImagenes = model('ImagenesModel');

                                        $imagen = $modelImagenes->where('idServicio', $key->idServicio)->findColumn('url');
                                        $contarImagen = count($imagen);
                                        $i = 1;
                                        ?>
                                        <?php foreach ($imagen as $keyImagen) : ?>
                                            <?php if ($contarImagen == $i) : ?>
                                                <div class="carousel-item active">
                                                    <img src="<?= $keyImagen ?>" alt="First slide">
                                                </div>
                                            <?php else : ?>
                                                <div class="carousel-item">
                                                    <img src="<?= $keyImagen ?>" alt="First slide">
                                                </div>
                                            <?php endif;
                                            $i++; ?>
                                        <?php endforeach;
                                        break; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                        <form class="form-row" action="#" method="POST">


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
                                        <h6 class="subtitle is-6 has-text-centered"><?= $keyTipoHospedaje->tipoHospedaje ?>
                                        </h6>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Disponibilidad</label>
                                <?php if ($key->disponibilidad == 0) : ?>
                                    <h6 class="subtitle is-6 has-text-centered">Sin reservar</h6>
                                <?php elseif ($key->disponibilidad == 1) :  ?>
                                    <h6 class="subtitle is-6 has-text-centered">Reservado</h6>

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
                                <h6 class="subtitle is-6 has-text-centered"><?= $key->direccion ?></h6>
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