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

        <div class="col-md-6">
            <?php foreach ($imagenes as $key) : ?>
            <img src="<?=$key->url?>" width="100" height="100">
            <?php endforeach; ?>
            <div class="control">
                <label><strong>Nombre del servicio </strong></label>
                <label><?= $servicio[0]->nombre ?></label>
                <br>
                <label><strong>Descripcion del servicio </strong></label>
                <label><?= $servicio[0]->descripcion ?></label>
                <br>
                <label><strong>Direccion del servicio </strong></label>
                <label><?= $servicio[0]->direccion ?></label>
                <br>
                <label><strong>Precio del servicio </strong></label>
                <label><?= $tarifa[0]->precio ?></label>
                <br>
                <label><strong>Descuento del servicio </strong></label>
                <label><?= $tarifa[0]->descuento ?></label>
                <br>
                <label><strong>Anfitrion </strong></label>
                <label><?= $usuario[0]->username ?></label>
                <br>
                <label><strong>Nombre del anfitrion </strong></label>
                <label><?= $usuario[0]->nombre .' '. $usuario[0]->apellido ?></label>
                <br>
                <label><strong>Email </strong></label>
                <label><?= $usuario[0]->email ?></label>
                <br>
                <label><strong>Numero de telefono </strong></label>
                <label><?= $usuario[0]->numeroTelefono ?></label>
                <br>
                <label><strong>Localizacion del servicio </strong></label>
                <label><?= $pais[0]->pais .', '. $departamento[0]->departamento .', '. $municipio[0]->municipio ?></label>
                <br>
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
                <br><br>
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
                <br><br>
                <label class="label">Sub servicios</label>
                <?php foreach ($subServicio as $key) : ?>
                <label><?= $key->subServicio ?></label>
                <br>
                <?php endforeach; ?>
                <br><br>
                <label class="label">Politicas de cancelacion</label>
                <?php foreach ($politicaCancelacion as $key) : ?>
                <label><?= $key->politicaCancelacion ?></label>
                <br>
                <?php endforeach; ?>
                <br><br>
                <label class="label">Reglas de servicio</label>
                <?php foreach ($reglaServicio as $key) : ?>
                <label><?= $key->reglaServicio ?></label>
                <br>
                <?php endforeach; ?>
                <br><br>
                <label class="label">Salud y seguridad</label>
                <?php foreach ($saludSeguridad as $key) : ?>
                <label><?= $key->saludSeguridad ?></label>
                <br>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>