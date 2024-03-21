<nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="/<?php echo Config::getAppPath(); ?>">PHPSimpleMVC</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <?php
        if (Auth::check()) {
      ?>
        <li class="nav-item <?php echo Config::getCurrentPath() == 'posts' ? 'active' : ''; ?>">
          <a class="nav-link" href="/<?php echo Config::getAppPath(); ?>/posts">Posts</a>
        </li>
        <li class="nav-item <?php echo Config::getCurrentPath() == 'messages' ? 'active' : ''; ?>">
          <a class="nav-link" href="/<?php echo Config::getAppPath(); ?>/messages">Messages <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item <?php echo Config::getCurrentPath() == 'users' ? 'active' : ''; ?>">
          <a class="nav-link" href="/<?php echo Config::getAppPath(); ?>/users">Users</a>
        </li>
      <?php } ?>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
    </ul>
  </div>
  <span>
    <?php
      if (Auth::check()) {
    ?>
      <span class="text-white d-flex align-items-center mx-1">
       <span class="p-0">( <?php echo Auth::user()['first_name']; ?> )</span>
       <a class="nav-link text-white p-1" href="/<?php echo Config::getAppPath(); ?>/session/destroy">Sign Out</a>
      </span>
    <?php
      } else {
    ?>
      <a class="nav-link text-white" href="/<?php echo Config::getAppPath(); ?>/session/signin">Sing In</a>
    <?php
      }
    ?>
  </span>
</nav>