<?=$this->extend('anfitrion/main')?>

<?=$this->section('title')?>
Perfil
<?=$this->endSection()?>

<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<?=$this->endSection()?>

<?=$this->section('content')?>

<!-- PERFIL ANFITRION -->
<div class="container">
    <?php if(session('msg')):?>
    <article class="message is-<?=session('msg.type')?>">
        <div class="message-body">
            <?=session('msg.body')?>
        </div>
    </article>
    <?php endif; ?>
    <div class="d-flex justify-content-between">
        <span>

        </span>
        <span>
            <a class="btn btn-primary" href="<?=base_url(route_to('actualizarPerfil'))?>">Actualizar datos</a><br><br>
        </span>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4"><br><br>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                        aria-controls="home" aria-selected="true">Perfil</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <br>
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-row">
                        <div class="col-5 justify-content-center mx-auto">
                            <?php if(file_exists("C:/laragon/www/proyect_airbnb/public".$usuario->foto)): ?>
                            <img class="img-thumbnail" src="<?=$usuario->foto?>" alt="">
                            <?php else: ?>
                            <img class="img-thumbnail" src="/img/perfiles/default.jpg" alt="">
                            <?php endif; ?>
                        </div>

                        <div class="form-group row">
                            <div class="col-12">
                                <label for="nombres">
                                    <h5>Nombres</h5>
                                </label>
                                <input disabled type="text" class="form-control"
                                    value="<?=$usuario->nombre?> <?=$usuario->apellido?>">
                            </div>

                            <div class="col-12">
                                <label for="email">
                                    <h5>Email</h5>
                                </label>
                                <input disabled type="email" class="form-control" value="<?=$usuario->email?>">
                            </div>

                            <div class="col-12">
                                <label for="telefono">
                                    <h5>Telefono</h5>
                                </label>
                                <input disabled type="text" class="form-control" value="<?=$usuario->numeroTelefono?>">
                            </div>


                            <div class="col-6">
                                <label for="cuenta de banco">
                                    <h5>Cuenta de banco</h5>
                                </label>
                                <input disabled type="text" class="form-control" value="<?=$anfitrion->cuentaBanco?>">
                            </div>

                            <div class="col-6">
                                <label for="cuenta de banco">
                                    <h5>Banco</h5>
                                </label>
                                <input disabled type="text" class="form-control" value="<?=$anfitrion->banco?>">
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?=$this->endSection()?>