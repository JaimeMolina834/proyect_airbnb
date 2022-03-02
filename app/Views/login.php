
 <div class="container-fluid">
<div class="row justify-content-center ">
<form action = "<?php echo base_url('/login')?>" method="POST">
<br><br><br><br>

<img src="img/logo2.png" class="img-fluid" width="50px" height="50px" alt=""><br>
  <div class="form-group">
    <label for="exampleInputEmail1">Usuario</label>
    <input type="text" style="width : 325px"  class="form-control" id="usuario" placeholder="Usuario" required='campo requerido'>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" style="width : 325px" class="form-control" id="contraseña" placeholder="Contraseña" required='campo'>
  </div>

  <button type="submit" class="btn btn-primary">Entrar</button>

</form>

  </div>
</div>

