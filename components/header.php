<?php $request_uri = $_SERVER['REQUEST_URI']; ?>

<header class="header">
  <div class="header-inner">
    <div class="logo-wrap">
      <a href="/">
        <img src="/img/LFRT.png" alt="Running Train logo made by Kev" class="logo" />
      </a>

      <div>
        <p class="h1">Liveries for Running Train</p>
        <p>Download and share custom train liveries for RUNNING TRAIN | 走ル列車!</p>
      </div>
    </div>

    <button type="button" class="mobile-nav-toggle" id="mobileNavToggle" aria-controls="siteNav" aria-expanded="false"
      aria-label="Open menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M3 12H21M3 6H21M3 18H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </button>
  </div>

  <div class="mobile-nav-backdrop" id="mobileNavBackdrop" aria-hidden="true"></div>

  <nav class="main-nav" id="siteNav" aria-label="Main navigation">
    <button type="button" class="mobile-nav-close" id="mobileNavClose" aria-label="Close menu">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </button>

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
      <li>
        <a href="/credits.php" title="Credits" <?=$request_uri === '/credits.php' ? 'class="active"' : '' ?>>Credits</a>
      </li>
    </ul>
  </nav>
</header>