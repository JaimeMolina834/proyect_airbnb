
 <div class="container ">
<div class="row justify-content-center ">
<form action = "<?php echo base_url('/login')?>" method="POST">
<br><br><br><br>
<h2>Login con CodeIgniter </h2><br>
  <div class="form-group">
    <label for="exampleInputEmail1">Usuario</label>
    <input type="text" style="width : 325px"  class="form-control" id="usuario" placeholder="Usuario" required=''>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" style="width : 325px" class="form-control" id="contraseña" placeholder="Contraseña" required=''>
  </div>

  <button type="submit" class="btn btn-primary">Entrar</button>

</form>

  </div>
</div>

