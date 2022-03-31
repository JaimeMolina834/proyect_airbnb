<?=$this->extend('usuario/main')?>

<?=$this->section('title')?>
Hazte anfitrión
<?=$this->endSection()?>

<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<?=$this->endSection()?>

<?=$this->section('content')?>

<section>
    <!-- Contenedor -->
<div class="container mt-5 pt-5">
        <div class="row">
          <div class="col-md-6 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">

        <h1 class="title">Hazte anfitrión!</h1>
        <h2 class="subtitle">
            Llena los siguientes datos para hacerte anfitrión
        </h2>
        <form action="<?=base_url('usuario/registrarAnfitrion')?>" method="POST">
            <div class="field">
                <label class="label">Descripcion</label>
                <div class="control">
                    <textarea class="textarea" name='descripcion' placeholder="Una breve descripción de ti"
                        rows="5"><?=old('descripcion')?></textarea>
                </div>
                <p class="is-danger help"><?=session('errors.descripcion')?></p>
            </div>

            <div class="field">
                <label class="label">Cuenta de banco</label>
                <div class="control">
                    <input name='cuentaBanco' value='<?=old('cuentaBanco')?>' class="input" type="text"
                        placeholder="ej: 00000000000-00">
                </div>
                <p class="is-danger help"><?=session('errors.cuentaBanco')?></p>
            </div>

            <div class="field">
                <label class="label">Banco</label>
                <div class="control">
                    <input name='banco' value='<?=old('banco')?>' class="input" type="text" placeholder="ej: Agricola">
                </div>
                <p class="is-danger help"><?=session('errors.banco')?></p>
            </div>
        <!-- PRIMERA FILA -->
    <div class="form-group">
        <div class="row">

        <!-- primera columna -->
            <div class="col-md-4">
                <label class="label">Selecciona un idioma</label>
                <div class="control select is-link">
                    <select name='idiomaPrimario'>
                        <option>Elije un idioma</option>
                        <?php foreach($idiomas as $key): ?>
                        <option value="<?=$key->idioma ?>"
                            <?php if($key->idIdioma == old('idiomaPrimario')): ?>selected<?php endif;?>>
                            <?=$key->idioma?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.idiomaPrimario')?></p>
            </div>
        
        <!-- segunda columna -->    
            <div class="col-md-4">
                <label class="label">Idioma secundario</label>
                <div class="control select is-link">
                    <select name='idiomaSecundario'>
                        <option>Elije un idioma</option>
                        <?php foreach($idiomas as $key): ?>
                        <option value="<?=$key->idioma ?>"
                            <?php if($key->idIdioma == old('idiomaSecundario')): ?>selected<?php endif;?>>
                            <?=$key->idioma?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        <!-- tercera columna -->
            <div class="col-md-4">
                <label class="label">Idioma extra</label>
                <div class="control select is-link">
                    <select name='idiomaExtra'>
                        <option>Elije un idioma</option>
                        <?php foreach($idiomas as $key): ?>
                        <option value="<?=$key->idioma ?>"
                            <?php if($key->idIdioma == old('idiomaExtra')): ?>selected<?php endif;?>>
                            <?=$key->idioma?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
    </div>
</div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="btn btn-primary">Enviar</button>
                </div>
            </div>
        </form>
        </div>
</div>
</div>
</div>
</div>
</section>
<br><br>
<?=$this->endSection()?>