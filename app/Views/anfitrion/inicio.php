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
                <?php foreach ($servicios as $key):?>
                    <div class="col-3"><br>
                        <div class="card">
                            <div class="card" style="width: 22rem;">
                                <img src="<?= $key->foto ?>" class="card-img-top">
                                <div class="card-content">
                                    <div class="media-content">

                                        <p class="title is-4"><?= $key->nombre ?></p>
                                        <p class="subtitle is-6">@<?=session('username')?></p>
                                    </div>
                                
                                    <div class="content">
                                        <br>
                                        <p><?= $key->descripcion ?></p>

                                        <?php foreach ($municipios as $k):?>
                                        <?php if($key->idMunicipio == $k->idMunicipio ): ?>
                                        <p><?= $k->municipio?></p>
                                        <?php endif;?>
                                        
                                        <?php endforeach; ?>
                                     
                                        <time><?=$key->date_update?></time><br>
                                        <a href="" class="btn btn-primary">Ir</a>
                                        

                                        <a href="#Modal" data-toggle="modal" class="btn btn-primary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>
        </div>

    </div>



    <div class="modal bd-example-modal-lg" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="title">Cabañas de madera</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-row" action="#" method="POST">
                        <div class="form-group col-md-12">

                            <img class="mx-auto d-block" src="https://media.istockphoto.com/photos/log-cabin-in-the-forest-picture-id93463536?k=20&m=93463536&s=612x612&w=0&h=u9SV0-O19ShiawpRi6vnsVgdXdYpDKcB56G0DB0Gt7o=">
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Tarifa</label>
                            <h6 class="subtitle is-6 has-text-centered">$75.00</h6>
                        </div>


                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Tipo de Hospedaje</label>
                            <h6 class="subtitle is-6 has-text-centered">Cabañas</h6>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Disponibilidad</label>
                            <h6 class="subtitle is-6 has-text-centered">Sin reservar</h6>
                        </div>



                        <div class="form-group col-md-4">
                            <label class="label has-text-centered">Municipio</label>
                            <h6 class="subtitle is-6 has-text-centered">Apaneca</h6>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Direccion</label>
                            <h6 class="subtitle is-6 has-text-centered">Av. Norte</h6>
                        </div>


                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Descripción del hospedaje</label>
                            <h6 class="subtitle is-6 has-text-centered">Cabaña super comoda</h6>
                        </div>



                        <div class="form-group col-md-3">
                            <label class="label has-text-centered">Publicada por</label>
                            <h6 class="subtitle is-6 has-text-centered">@Anfitrion-Bryan</h6>
                        </div>


                        <div class="form-group col-md-3">
                            <label class="label has-text-centered">Publicada</label>
                            <h6 class="subtitle is-6 has-text-centered">Hace 1 minuto</h6>
                        </div>


                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>