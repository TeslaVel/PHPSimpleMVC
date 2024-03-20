<?php
ob_start();
?>
<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">Sign In</div>
        <div class="card-body">
          <form action="/<?php echo Config::getAppPath(); ?>/session/create" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="session[email]" aria-describedby="emailHelp" placeholder="Ingresa tu correo electrónico">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="session[password]" placeholder="Ingresa tu contraseña">
            </div>
            <div class="d-flex justify-content-center">
              <button type="submit" class="btn btn-primary mx-2">Log In</button>
              <a class="btn btn-success"
                href="/<?php echo Config::getAppPath(); ?>/session/signup">
                Sign Up
              </a>
            </div>
          </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
?>
