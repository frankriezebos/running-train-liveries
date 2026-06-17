<?php $request_uri = $_SERVER['REQUEST_URI']; ?>

<header class="header">
  <p class="h1">Liveries for Running Train</p>
  <p>Download and share custom train liveries for RUNNING TRAIN | 走ル列車!</p>
  <nav class="main-nav">
    <ul>
      <li>
        <a href="/" title="Discover liveries" <?=$request_uri === '/' ? 'class="active"' : '' ?>>Discover liveries</a>
      </li>
      <li>
        <a href="/upload-livery.php" title="Upload livery"
          <?=$request_uri === '/upload-livery.php' ? 'class="active"' : '' ?>>Upload livery</a>
      </li>
      <li>
        <a href="/how-to-install.php" title="How to install"
          <?=$request_uri === '/how-to-install.php' ? 'class="active"' : '' ?>>How to install</a>
      </li>
      <li>
        <a href="/more-reskins.php" title="More reskins"
          <?=$request_uri === '/more-reskins.php' ? 'class="active"' : '' ?>>More reskins</a>
      </li>
    </ul>
  </nav>
</header>