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
<div class="container mt-5 pt-5">
        <div class="row">
          <div class="col-md-6 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">

    <h1 class="title">Registrate</h1>
    <h2 class="subtitle">
        Llena los siguientes datos para poder ingresar.
    </h2>

    <form action="<?=base_url('auth/registrar')?>" method="POST">
    <!-- primera fila -->
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
        </div>
        </div>

    <!-- segunda fila -->
<div class="form-group">
    <div class="row">

    <!-- primera columna -->
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
            
    <!-- segunda columna -->
        <div class="col-md-4">
            <label class="label">Número de telefono</label>
            <div class="control">
                <input name='numeroTelefono' value='<?=old('numeroTelefono')?>' class="input" type="text"
                    placeholder="75757575">
            </div>
            <p class="is-danger help"><?=session('errors.numeroTelefono')?></p>
        </div>
    </div>
</div>

    <!-- tercera fila -->
<div class="form-group">
    <div class="row">

    <!-- primera columna -->
        <div class="col-md-4">
            <label class="label">Contraseña</label>
            <div class="control">
                <input name='password' class="input" type="text" placeholder="Contraseña">
            </div>
            <p class="is-danger help"><?=session('errors.password')?></p>
        </div>
    
    <!-- segunda columna -->
        <div class="col-md-4">
            <label class="label">Confirma tu contraseña</label>
            <div class="control">
                <input name='c-password' class="input" type="text" placeholder="Repite contraseña">
            </div>
        </div>
  
    <!-- boton registro -->
    <div class="col-md-4"><br>
        <div class="text-center mt-3">
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