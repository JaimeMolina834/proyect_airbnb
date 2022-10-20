<?= $this->extend('anfitrion/main') ?>

<?= $this->section('title') ?>
Servicio
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section class='section'>
    <div class='container'>

        <!-- Gallery -->
        <div class="row ">
            <div class="form-row">
                <div class="card border-dark">

                    <div class="col-md-12">
                        <div class="h1 text-dark">
                            <?= $servicio[0]->nombre ?> - $<?= $tarifa[0]->precio ?><label class="h4">/Dia</label>

                            <?php if ($tarifa[0]->descuento > 0) : ?>
                                <div style="color:red;" class="h6">Descuento:<?= $tarifa[0]->descuento ?>%</div>

                            <?php endif; ?>

                        </div>

                        <p class="h2 text-warning">★★★★★</p>
                    </div>

                    <!-- imgagenes -->
                    <div class="row">
                        <div class="col-md-5 justify-content-center mx-auto">
                            <?php foreach ($imagenes as $key) : ?>
                                <img src="<?= $key->url ?>" class="w-100 shadow-1-strong rounded mb-2" alt="" />
                        </div>
                        <div class="col-md-3 justify-content-center mx-auto">
                        <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- fin Imagenes -->

                    <div class="col-md-12">
                        <label class="h2 text-dark">Anfitrion: </label> <label class="h3"><?= $usuario[0]->username ?></label>
                    </div>

                    <div class="col-md-12">
                        <label class="h2 text-dark">Tipo de Hospedaje: </label> <label class="h4"> <?= $tipoHospedaje[0]->tipoHospedaje ?></label>
                    </div>

                    <div class="col-md-12">
                        <label class="h2 text-dark">Ubicación: </label> <label class="h4"><?= $pais[0]->pais . ', ' . $departamento[0]->departamento . ', ' . $municipio[0]->municipio . ' - ' . $servicio[0]->direccion  ?></label>
                        <br><br>
                    </div>


                    <div class="col-md-12">
                        <label class="h5"><?= $servicio[0]->descripcion ?></label>
                        <hr>
                    </div>

                    <div class="col-md-12">
                        <div class="text-center">
                            <label class="h2">Cantidad de huespedes</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="col-md-10 text-center ">
                            <table class=" table table-hover">
                                <caption class="text-center">Recepción de Huespedes</caption>
                                <thead>
                                    <tr>
                                        <th scope="col-md-3">Adultos</th>
                                        <th scope="col-md-3">Menores de Edad</th>
                                        <th scope="col-md-3">Bebes</th>
                                        <th scope="col-md-3">Mascotas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $huespedes[0]->adulto ?></td>
                                        <td><?= $huespedes[0]->menores ?></td>
                                        <td><?= $huespedes[0]->bebes ?></td>
                                        <td><?= $huespedes[0]->mascotas ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <label></label>
                    <br>
                    <hr>

                    <div class="col-5 justify-content-center mx-auto">
                        <label class="h2 text-dark">Anfitrion: </label> <label class="h3"><?= $usuario[0]->username ?></label>

                        <?php if (file_exists("C:/laragon/www/proyect_airbnb/public" . $usuario[0]->foto)) : ?>
                            <img class="img-thumbnail" src="<?= $usuario[0]->foto ?>" alt="">
                            <label class="h6">Se registro hace <?= $anfitrion[0]->date_create->humanize(); ?></label>
                        <?php else : ?>
                            <img class="img-thumbnail" src="/img/perfiles/default.jpg"  alt="">
                            <label class="h6">Se registro hace <?= $anfitrion[0]->date_create->humanize(); ?></label>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex justify-content-center">
                        <div class="col-md-10 text-center ">
                            <table class=" table table-hover"><br>
                                <caption class="text-center">Datos del Anfitrion</caption>
                                <thead>
                                    <tr>
                                        <th scope="col-md-3">Nombre</th>
                                        <th scope="col-md-3">Apellido</th>
                                        <th scope="col-md-3">Email</th>
                                        <th scope="col-md-3">Numero de telefono </th>
                                        <th scope="col-md-3">Puntuacion</th>
                                        <th scope="col-md-3">Idioma Nativo</th>
                                        <?php if ($idiomaSecundario != null) : ?>
                                            <th scope="col-md-3">Idioma Secundario</th>
                                        <?php endif; ?>
                                        <?php if ($idiomaExtra != null) : ?>
                                            <th scope="col-md-3">Idioma Extra</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $usuario[0]->nombre ?></td>
                                        <td><?= $usuario[0]->apellido ?></td>
                                        <td><?= $usuario[0]->email ?></td>
                                        <td><?= $usuario[0]->numeroTelefono ?></td>
                                        <td><?= $anfitrion[0]->puntuacion ?></td>
                                        <td><?= $idiomaPrimario[0]->idioma ?></td>
                                        <?php if ($idiomaSecundario != null) : ?>
                                            <td><?= $idiomaSecundario[0]->idioma ?></td>
                                        <?php endif; ?>
                                        <?php if ($idiomaExtra != null) : ?>
                                            <td><?= $idiomaExtra[0]->idioma ?></td>
                                        <?php endif; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <label></label>
                    <br>
                    <hr>

                    <div class="col-5 justify-content-center mx-auto">
                        <label class="h2 text-dark">Lo que este lugar ofrece</label><br><br>
                        <div class="col-md-10 text-center ">
                            <div class="row ">
                                <?php foreach ($subServicio as $key) : ?>
                                    <li class="col-md-6"><?= $key->subServicio ?></li>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="col-5 justify-content-center mx-auto">
                        <label class="h2 text-dark">Lo que debes saber</label><br><br>
                        <div class="row">
                            <div class="col-6 border-right">

                                <label>Reglas de la casa</label>
                                <?php foreach ($reglaServicio as $key) : ?>
                                    <li class="col-md-12"><?= $key->reglaServicio ?></li>
                                <?php endforeach; ?>
                            </div>

                            <div class="col-6">
                                <label>Salud y seguridad</label>
                                <?php foreach ($saludSeguridad as $key) : ?>
                                    <li class="col-md-12"><?= $key->saludSeguridad ?></li>
                                <?php endforeach; ?>
                            </div>


                        </div><br>
                        <label class="label">Politicas de cancelacion</label>
                        <?php foreach ($politicaCancelacion as $key) : ?>
                            <li><?= $key->politicaCancelacion ?></li>
                        <?php endforeach; ?>
                        <br>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>