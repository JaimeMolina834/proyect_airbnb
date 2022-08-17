<?=$this->extend('auth/main')?>

<?=$this->section('title')?>
Registro
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

                        <h1 class="title">Registrate</h1>
                        <h2 class="subtitle">
                            Llena los siguientes datos para poder ingresar.
                        </h2>

                        <form action="<?=base_url('auth/registrar')?>" method="POST" enctype="multipart/form-data">
                            <!-- primera fila -->
                            <div class="form-group">
                                <div class="row">
                                    <!-- AGREGAR FOTO -->
                                    <div class="field">
                                        <label class="label">Agrega una foto</label>
                                        <div class="text-left">
                                            <img id="imagenPrevisualizacion" width="150" height="50"
                                                src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                                class="avatar img-thumbnail rounded-circle" alt="avatar">
                                            <h6></h6>
                                            <input id="seleccionArchivos" type="file" name="imagen"
                                                class="text-left left-block file-upload">
                                            <p class="is-danger help"><?=session('errorImg.imagen')?></p>
                                        </div>
                                    </div>

                                    <!-- primera columna -->
                                    <div class="col-md-6">
                                        <label class="label">Nombres</label>
                                        <div class="control">
                                            <input name='nombre' value='<?=old('nombre')?>' class="input" type="text"
                                                placeholder="Ej: Melvin Marvin">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.nombre')?></p>
                                    </div>

                                    <!-- segunda columna -->
                                    <div class="col-md-6">
                                        <label class="label">Apellidos</label>
                                        <div class="control">
                                            <input name='apellido' value='<?=old('apellido')?>' class="input"
                                                type="text" placeholder="Ej: Quintanilla Saldivar">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.apellido')?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- segunda fila -->
                            <div class="form-group">
                                <div class="row">

                                    <!-- primera columna -->
                                    <div class="col-md-6">
                                        <label class="label">Correo Electronico</label>
                                        <div class="control has-icons-left has-icons-right">
                                            <input name='email' value='<?=old('email')?>' class="input" type=""
                                                placeholder="email@gmail.com" value="">
                                            <span class="icon is-small is-left">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <p class="is-danger help"><?=session('errors.email')?></p>
                                    </div>

                                    <!-- segunda columna -->
                                    <div class="col-md-6">
                                        <label class="label">Número de telefono</label>
                                        <div class="control">
                                            <input name='numeroTelefono' value='<?=old('numeroTelefono')?>'
                                                class="input" type="text" placeholder="75757575" maxlength="8"/>
                                        </div>
                                        <p class="is-danger help"><?=session('errors.numeroTelefono')?></p>
                                    </div>
                                </div>
                            </div>

                            <!-- tercera fila -->
                            <div class="form-group">
                                <div class="row">

                                    <!-- primera columna -->
                                    <div class="col-md-6">
                                        <label class="label">Contraseña</label>
                                        <div class="control">
                                            <input name='password' class="input" type="password"
                                                placeholder="Contraseña">
                                        </div>
                                        <p class="is-danger help"><?=session('errors.password')?></p>
                                    </div>

                                    <!-- segunda columna -->
                                    <div class="col-md-6">
                                        <label class="label">Confirma tu contraseña</label>
                                        <div class="control">
                                            <input name='c-password' class="input" type="password"
                                                placeholder="Repite contraseña">
                                        </div>
                                    </div>

                                    <!-- boton registro -->

                                    <div class="text-center mt-6">
                                        <div class="control">
                                            <button class="btn btn-primary">Confirmar</button>
                                        </div>
                                    </div>
                                </div>
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