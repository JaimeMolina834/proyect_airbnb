<?=$this->extend('anfitrion/main')?>

<?=$this->section('title')?>
Actualizar perfil
<?=$this->endSection()?>

<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<?=$this->endSection()?>

<?=$this->section('content')?>
<section>
    <!-- Contenedor -->
    <div class="container-fluid mt-5 pt-5">
        <?php if(session('msg')):?>
        <article class="message is-<?=session('msg.type')?>">
            <div class="message-body">
                <?=session('msg.body')?>
            </div>
        </article>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <div class="card-body">

                        <h1 class="title">Actualizar</h1>
                        <h2 class="subtitle">Modifique los campos que desea actualizar.</h2>

                        <form action="<?=base_url('anfitrion/ActualizarPerfil')?>" method="POST"
                            enctype="multipart/form-data">
                            <!-- PRIMERA FILA -->
                            <div class="form-group">
                                <div class="row">

                                    <!-- primera columna -->
                                    <div class="col-md-4">
                                        <label class="label">Nombres</label>
                                        <div class="control">
                                            <input name='nombre'
                                                value='<?php if(old('nombre')!=null):?><?=old('nombre')?><?php else:?><?=$usuario[0]->nombre?><?php endif;?>'
                                                class="input" type="text" placeholder="Ej: Melvin Marvin">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.nombre')?></p>
                                    </div>

                                    <!-- segunda columna -->
                                    <div class="col-md-4">
                                        <label class="label">Apellidos</label>
                                        <div class="control">
                                            <input name='apellido'
                                                value='<?php if(old('apellido')!=null):?><?=old('apellido')?><?php else:?><?=$usuario[0]->apellido?><?php endif;?>'
                                                class="input" type="text" placeholder="Ej: Quintanilla Saldivar">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.apellido')?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- SEGUNDA FILA -->
                            <div class="form-group">
                                <div class="row">

                                    <!-- primera columna -->
                                    <div class="col">
                                        <label class="label">Correo Electronico</label>
                                        <div class="control has-icons-left has-icons-right">
                                            <input name='email'
                                                value='<?php if(old('email')!=null):?><?=old('email')?><?php else:?><?=$usuario[0]->email?><?php endif;?>'
                                                class="input" type="" placeholder="email@gmail.com" value="">
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <p class="is-danger help"><?=session('errors.email')?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- TERCERA FILA -->
                            <div class="form-group">
                                <div class="row">

                                    <!-- primera columna -->
                                    <div class="col-md-4">
                                        <label class="label">Número de telefono</label>
                                        <div class="control">
                                            <input name='numeroTelefono'
                                                value='<?php if(old('numeroTelefono')!=null):?><?=old('numeroTelefono')?><?php else:?><?=$usuario[0]->numeroTelefono?><?php endif;?>'
                                                class="input" type="text" placeholder="75757575" maxlength="8">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.numeroTelefono')?></p>
                                    </div>

                                    <!-- segunda columna -->
                                    <div class="col-md-4">
                                        <label class="label">Contraseña anterior</label>
                                        <div class="control">
                                            <input name='passwordAnterior' class="input" type="password"
                                                placeholder="Contraseña">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.passwordAnterior')?></p>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="label">Contraseña nueva</label>
                                        <div class="control">
                                            <input name='password' class="input" type="password"
                                                placeholder="Contraseña">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.password')?></p>
                                    </div>

                                    <!-- tercera columna -->
                                    <div class="col-md-4">
                                        <label class="label">Confirma tu contraseña</label>
                                        <div class="control">
                                            <input name='c-password' class="input" type="password"
                                                placeholder="Repite contraseña">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Descripcion</label>
                                <div class="control">
                                    <textarea class="textarea" name='descripcion'
                                        placeholder="Una breve descripción de ti"
                                        rows="5"><?php if(old('descripcion')!=null):?><?=old('descripcion')?><?php else:?><?=$anfitrion[0]->descripcion?><?php endif;?></textarea>
                                </div>
                                <p class="is-danger help"><?=session('errors.descripcion')?></p>
                            </div>

                            <!-- CUARTA FILA -->
                            <div class="form-group">
                                <div class="row">

                                    <!-- primera columna -->
                                    <div class="col-md-4">
                                        <label class="label">Cuenta de banco</label>
                                        <div class="control">
                                            <input name='cuentaBanco'
                                                value='<?php if(old('cuentaBanco')!=null):?><?=old('cuentaBanco')?><?php else:?><?=$anfitrion[0]->cuentaBanco?><?php endif;?>'
                                                class="input" type="number" placeholder="ej: 00000000000-00">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.cuentaBanco')?></p>
                                    </div>

                                    <!-- segunda columna -->
                                    <div class="col-md-4">
                                        <label class="label">Banco</label>
                                        <div class="control">
                                            <input name='banco'
                                                value='<?php if(old('banco')):?><?=old('banco')?><?php else:?><?=$anfitrion[0]->banco?><?php endif;?>'
                                                class="input" type="text" placeholder="ej: Agricola">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.banco')?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- QUINTA FILA -->
                            <div class="form-group">
                                <div class="row">

                                    <!-- primera columna -->
                                    <div class="col-md-4">
                                        <label class="label">Selecciona un idioma</label>
                                        <div class="control select is-link">
                                            <select name='idiomaPrimario'>
                                                <?php if(old('idiomaPrimario')!= null):?>
                                                <?php foreach($idiomas as $key): ?>
                                                <?php if($key->idIdioma != $idiomaSecundario && $key->idIdioma != $idiomaExtra): ?>
                                                <option value="<?=$key->idIdioma ?>"
                                                    <?php if($key->idIdioma == old('idiomaPrimario')): ?>selected<?php endif;?>>
                                                    <?=$key->idioma?></option>
                                                <?php endif;?>
                                                <?php endforeach; ?>
                                                <?php else:?>
                                                <?php foreach($idiomas as $key): ?>
                                                <?php if($key->idIdioma != $idiomaSecundario && $key->idIdioma != $idiomaExtra): ?>
                                                <option value="<?=$key->idIdioma ?>"
                                                    <?php if($key->idIdioma == $anfitrion[0]->idiomaPrimario): ?>selected<?php endif;?>>
                                                    <?=$key->idioma?></option>
                                                <?php endif;?>
                                                <?php endforeach; ?>
                                                <?php endif;?>
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
                                                <?php if(old('idiomaSecundario')!=null):?>
                                                <?php foreach($idiomas as $key): ?>
                                                <?php if($key->idIdioma != $idiomaPrimario && $key->idIdioma != $idiomaExtra): ?>
                                                <option value="<?=$key->idIdioma ?>"
                                                    <?php if($key->idIdioma == old('idiomaSecundario')): ?>selected<?php endif;?>>
                                                    <?=$key->idioma?></option>
                                                <?php endif;?>
                                                <?php endforeach; ?>
                                                <?php else: ?>
                                                <?php foreach($idiomas as $key): ?>
                                                <?php if($key->idIdioma != $idiomaPrimario && $key->idIdioma != $idiomaExtra): ?>
                                                <option value="<?=$key->idIdioma ?>"
                                                    <?php if($key->idIdioma == $anfitrion[0]->idiomaSecundario): ?>selected<?php endif;?>>
                                                    <?=$key->idioma?></option>
                                                <?php endif;?>
                                                <?php endforeach; ?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <p class="is-danger help"><?=session('errors.idiomaSecundario')?></p>
                                    </div>

                                    <!-- tercera columna -->
                                    <div class="col-md-4">
                                        <label class="label">Idioma extra</label>
                                        <div class="control select is-link">
                                            <select name='idiomaExtra'>
                                                <option>Elije un idioma</option>
                                                <?php if(old('idiomaExtra')!=null):?>
                                                <?php foreach($idiomas as $key): ?>
                                                <?php if($key->idIdioma != $idiomaPrimario && $key->idIdioma != $idiomaSecundario): ?>
                                                <option value="<?=$key->idIdioma ?>"
                                                    <?php if($key->idIdioma == old('idiomaExtra')): ?>selected<?php endif;?>>
                                                    <?=$key->idioma?></option>
                                                <?php endif;?>
                                                <?php endforeach; ?>
                                                <?php else:?>
                                                <?php foreach($idiomas as $key): ?>
                                                <?php if($key->idIdioma != $idiomaPrimario && $key->idIdioma != $idiomaSecundario): ?>
                                                <option value="<?=$key->idIdioma ?>"
                                                    <?php if($key->idIdioma == $anfitrion[0]->idiomaExtra): ?>selected<?php endif;?>>
                                                    <?=$key->idioma?></option>
                                                <?php endif;?>
                                                <?php endforeach; ?>
                                                <?php endif;?>
                                            </select>
                                        </div>
                                        <p class="is-danger help"><?=session('errors.idiomaExtra')?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-6">
                                <div class="control">
                                    <button class="button is-primary">Actualizar</button>
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