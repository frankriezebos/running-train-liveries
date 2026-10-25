<?php
session_start();

$captchaLeft = random_int(2, 9);
$captchaRight = random_int(1, 9);
$_SESSION['uploadCaptchaAnswer'] = (string) ($captchaLeft + $captchaRight);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload - Liveries for Running Train</title>
  <meta name="description" content="Share your custom train livery for Running Train. Upload your design here!" />
  <meta robots="index, follow" />
  <meta name="keywords" content="Running Train, train liveries, custom textures, game mods, train skins" />
  <meta property="og:title" content="Upload - Liveries for Running Train" />
  <meta property="og:description"
    content="Share your custom train livery for Running Train. Upload your design here!" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/responsive.css" />
</head>

<body>
  <div class="container">
    <?php include('components/header.php'); ?>

    <div class="section upload-section">
      <h1 class="h2">Upload turned off temporarily</h1>
      <p>Due to a PHP2Shell vurnerability regarding multipart POST-requests, the upload form is temporarily turned off
        until PHP has
        been patched.
        <br />
        This is out of precaution to prevent the website getting hacked and user uploads getting removed.
        <br />
        Our apologies and thank you for your understanding!
      </p>
    </div>

    <?php include('components/footer.php'); ?>
  </div>

  <script src="js/server.js"></script>
  <script src="js/upload.js"></script>
</body>

</html>