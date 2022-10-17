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

        <?php //dd($anfitrion); ?>

        <!-- Gallery 
        <div class="row">
            <div class="col-md-5">
                <?php foreach ($imagenes as $key) : ?>
                <img src="<?=$key->url?>" class="w-100 shadow-1-strong rounded mb-4" alt="Yosemite National Park" />

            </div>
            <div class="col-md-3">
                <?php endforeach; ?>
            </div>
        </div>  -->



        <!-- Gallery -->
        <div class="row ">
        <div class="col-md-12" >
            <div class="control">
                <label><strong>Nombre del servicio </strong></label>
                <label><?= $servicio[0]->nombre ?></label>
                <!-- imgagenes -->
                <div class="row">
                    <div class="col-md-5">
                        <?php foreach ($imagenes as $key) : ?>
                        <img src="<?=$key->url?>" class="w-100 shadow-1-strong rounded mb-2"
                            alt="" />
                    </div>
                    <div class="col-md-3">
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- fin Imagenes -->
                
                <label><strong>Anfitrion </strong></label>
                <label><?= $usuario[0]->username ?></label>
                <br>
                <label><strong>Localizacion del servicio </strong></label>
                <label><?= $pais[0]->pais .', '. $departamento[0]->departamento .', '. $municipio[0]->municipio ?></label>
                <br>
                <label><strong>Direccion del servicio </strong></label>
                <label><?= $servicio[0]->direccion ?></label>
                <br>
                <label><strong>Descripcion del servicio </strong></label>
                <label><?= $servicio[0]->descripcion ?></label>
                <br>
                <hr>

                <label class="label">Cantidad de huespedes</label>
                <label><strong>Adultos </strong></label>
                <label><?= $huespedes[0]->adulto ?></label>
                <br>
                <label><strong>Menores de edad </strong></label>
                <label><?= $huespedes[0]->menores ?></label>
                <br>
                <label><strong>Bebes </strong></label>
                <label><?= $huespedes[0]->bebes ?></label>
                <br>
                <label><strong>Mascotas </strong></label>
                <label><?= $huespedes[0]->mascotas ?></label>
                <br>
                <hr>

                <label><strong>Precio del servicio </strong></label>
                <label><?= $tarifa[0]->precio ?></label>
                <br>
                <label><strong>Descuento del servicio </strong></label>
                <label><?= $tarifa[0]->descuento ?></label>
                <br>
                <hr>

                <label><strong>Nombre del anfitrion </strong></label>
                <label><?= $usuario[0]->nombre .' '. $usuario[0]->apellido ?></label>
                <br>
                <label><strong>Email </strong></label>
                <label><?= $usuario[0]->email ?></label>
                <br>
                <label><strong>Numero de telefono </strong></label>
                <label><?= $usuario[0]->numeroTelefono ?></label>
                <br>
                <hr>
                
                <label><strong>Puntuacion </strong></label>
                <label><?= $anfitrion[0]->puntuacion ?></label>
                <br>
                <label><strong>Total puntuacion </strong></label>
                <label><?= $anfitrion[0]->totalPuntuacion ?></label>
                <br>
                <label><strong>Tipo de hospedaje </strong></label>
                <label><?= $tipoHospedaje[0]->tipoHospedaje ?></label>
                <br>
                <label><strong>Idioma del anfitrion </strong></label>
                <label><?= $idiomaPrimario[0]->idioma ?></label>
                <?php if($idiomaSecundario != null): ?>
                <br>
                <label><strong>Idioma secundario del anfitrion </strong></label>
                <label><?= $idiomaSecundario[0]->idioma ?></label>
                <?php endif; ?>
                <?php if($idiomaExtra != null): ?>
                <br>
                <label><strong>Idioma extra del anfitrion </strong></label>
                <label><?= $idiomaExtra[0]->idioma ?></label>
                <?php endif; ?>
                <br>
                <hr>
                
                <label class="label">Sub servicios</label>
                <?php foreach ($subServicio as $key) : ?>
                <label><?= $key->subServicio ?></label>
                <?php endforeach; ?>
                <hr>

                <label class="label">Politicas de cancelacion</label>
                <?php foreach ($politicaCancelacion as $key) : ?>
                <label><?= $key->politicaCancelacion ?></label>
                <br>
                <?php endforeach; ?>
                <hr>
                
                <label class="label">Reglas de servicio</label>
                <?php foreach ($reglaServicio as $key) : ?>
                <label><?= $key->reglaServicio ?></label>
                <br>    
                <?php endforeach; ?>
                <hr>
                <label class="label">Salud y seguridad</label>
                <?php foreach ($saludSeguridad as $key) : ?>
                <label><?= $key->saludSeguridad ?></label>
                <br>
                <?php endforeach; ?>
            </div>
        </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>