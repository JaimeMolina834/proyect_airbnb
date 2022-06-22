<?=$this->extend('usuario/main')?>

<?=$this->section('title')?>
Perfil de usuario
<?=$this->endSection()?>

<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<?=$this->endSection()?>

<?=$this->section('content')?>

<!-- PERFIL USUARIO -->
<div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2"><br><br>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">Perfil</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <br><br><br>
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-sm-4">
                                <img class="img-thumbnail"
                                    src="https://cdn2.iconfinder.com/data/icons/website-icons/512/User_Avatar-512.png"
                                    alt="">
                            </div>
                            <div class="col-8">
                                <div class="form-group row">

                                    <div class="col-xs-8">
                                        <label for="nombres">
                                            <h5>Nombres</h5>
                                        </label>
                                        <input type="text" class="form-control" value="Juan Anthonio">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-xs-8">
                                        <label for="telefono">
                                            <h5>Telefono</h5>
                                        </label>
                                        <input type="text" class="form-control" value="78675654">
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-xs-8">
                                        <label for="email">
                                            <h5>Email</h5>
                                        </label>
                                        <input type="email" class="form-control" value="juananthonio@gmail.com">
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