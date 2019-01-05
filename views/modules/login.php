
<div class="login-box">
  <div class="login-logo">

    <b>ALCON</b>SUPERMARKET

  </div>

  <div class="login-box-body">
    
    <p class="login-box-msg">Inicia sesion para comenzar</p>

    <!--Formulario-->
    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="loginUser" required>

        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="loginPassword" required>

        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>

      <div class="row">

        <div class="col-xs-5 pull-right">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>
        
      </div>

      <?php
      
        $login = new UserController();
        $login -> log_in();
      
      ?>

    </form>

  </div>

</div>


