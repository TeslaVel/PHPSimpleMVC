<?php
ob_start();
?>
<div class="col-md-6 mx-auto">
  <div class="card">
    <div class="card-header">Sign Up</div>
    <div class="card-body">
      <form action="/<?php echo URL::getAppPath(); ?>/session/register" method="post">
        <div class="form-group">
          <label for="first_name">First Name</label>
          <input type="text" class="form-control" id="first_name" name="session[first_name]" aria-describedby="nombreHelp" placeholder="Ingresa tu nombre completo">
        </div>
        <div class="form-group">
          <label for="last_name">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="session[last_name]" aria-describedby="nombreHelp" placeholder="Ingresa tu nombre completo">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="session[email]" aria-describedby="emailHelp" placeholder="Ingresa tu correo electrónico">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="session[password]" placeholder="Ingresa tu contraseña">
        </div>
        <div class="d-flex justify-content-center">
          <button type="submit" class="btn btn-success mx-2 self-left">Register</button>
          <a class="btn btn-primary mx-2"
            href="/<?php echo URL::getAppPath(); ?>/session/signin">
            Sign In
          </a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
?>
