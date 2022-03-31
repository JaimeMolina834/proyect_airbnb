<?=$this->extend('auth/main')?>

<?=$this->section('title')?>
Hazte Anfitrión
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
          <div class="col-12 col-sm-7 col-md-6 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">

    <h1 class="title">Registrate para ser anfitrión</h1>
    <h2 class="subtitle">
        Llena los siguientes datos para poder ser anfitrión.
    </h2>

    <form action="<?=base_url('auth/registrar-anfitrion')?>" method="POST">
    <!-- PRIMERA FILA -->
    <div class="form-group">
        <div class="row">

    <!-- primera columna -->
    <div class="col-md-4">
            <label class="label">Nombres</label>
            <div class="control">
                <input name='nombre' value='<?=old('nombre')?>' class="input" type="text"
                    placeholder="Ej: Melvin Marvin">
            </div>
            <p class="is-danger help"><?=session('errors.nombre')?></p>
    </div>

    <!-- segunda columna -->
        <div class="col-md-4">
            <label class="label">Apellidos</label>
            <div class="control">
                <input name='apellido' value='<?=old('apellido')?>' class="input" type="text"
                    placeholder="Ej: Quintanilla Saldivar">
            </div>
            <p class="is-danger help"><?=session('errors.apellido')?></p>
        </div>


    <!-- tercera columna -->    
        <div class="col-md-4">
            <label class="label">Correo Electronico</label>
            <div class="control has-icons-left has-icons-right">
                <input name='email' value='<?=old('email')?>' class="input" type="" placeholder="email@gmail.com"
                    value="">
                <span class="icon is-small is-left">
                    <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                    <i class="fas fa-exclamation-triangle"></i>
                </span>
            </div>
            <p class="is-danger help"><?=session('errors.email')?></p>
        </div>
</div>
</div>

    <!-- SEGUNDA FILA -->
    <div class="form-group">
        <div class="row">

    <!-- primera columna -->
        <div class="col-md-4">      
            <label class="label">Número de telefono</label>
            <div class="control">
                <input name='numeroTelefono' value='<?=old('numeroTelefono')?>' class="input" type="text"
                    placeholder="75757575">
            </div>
            <p class="is-danger help"><?=session('errors.numeroTelefono')?></p>
        </div>

    <!-- segunda columna -->
        <div class="col-md-4">
            <label class="label">Contraseña</label>
            <div class="control">
                <input name='password' class="input" type="text" placeholder="Contraseña">
            </div>
            <p class="is-danger help"><?=session('errors.password')?></p>
        </div>

    <!-- tercera columna -->
        <div class="col-md-4">
            <label class="label">Confirma tu contraseña</label>
            <div class="control">
                <input name='c-password' class="input" type="text" placeholder="Repite contraseña">
            </div>
        </div>
</div>
</div>

        <div class="field">
            <label class="label">Descripcion</label>
            <div class="control">
                <textarea class="textarea" name='descripcion' placeholder="Una breve descripción de ti"
                    rows="5"><?=old('descripcion')?></textarea>
            </div>
            <p class="is-danger help"><?=session('errors.descripcion')?></p>
        </div>
    
    <!-- TERCERA FILA -->
        <div class="form-group">
        <div class="row">

    <!-- primera columna -->
        <div class="col-md-4">
            <label class="label">Cuenta de banco</label>
            <div class="control">
                <input name='cuentaBanco' value='<?=old('cuentaBanco')?>' class="input" type="text"
                    placeholder="ej: 00000000000-00">
            </div>
            <p class="is-danger help"><?=session('errors.cuentaBanco')?></p>
        </div>

    <!-- segunda columna -->    
        <div class="col-md-4">
            <label class="label">Banco</label>
            <div class="control">
                <input name='banco' value='<?=old('banco')?>' class="input" type="text" placeholder="ej: Agricola">
            </div>
            <p class="is-danger help"><?=session('errors.banco')?></p>
        </div>
</div>
</div>
    
<!-- CUARTA FILA -->
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
    
    <!-- sunda columna -->
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

        <div class="text-center mt-3">
            <div class="control">
                <button class="button is-primary">Registrarse</button>
            </div>
        </div>
    </form>

    </div>
</div>
</div>
</div>
</div>
</section>
<br>
<?=$this->endSection()?>