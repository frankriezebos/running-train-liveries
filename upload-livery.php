<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload - Liveries for Running Train</title>
  <meta name="description"
    content="Share and discover custom train liveries for Running Train. Upload your designs, browse others, and download your favorites!" />
  <meta robots="index, follow" />
  <meta name="keywords" content="Running Train, train liveries, custom textures, game mods, train skins" />
  <meta property="og:title" content="Upload - Liveries for Running Train" />
  <meta property="og:description"
    content="Share and discover custom train liveries for Running Train. Upload your designs, browse others, and download your favorites!" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div class="container">
    <header class="header">
      <h1>Liveries for Running Train</h1>
      <p>Download and share custom train liveries</p>
      <nav class="main-nav">
        <ul>
          <li><a href="/" title="Discover liveries">Discover liveries</a></li>
          <li><a href="upload-livery.php" title="Upload livery" class="active">Upload livery</a></li>
          <li><a href="how-to-install.php" title="How to install">How to install</a></li>
        </ul>
      </nav>
    </header>

    <div class="section upload-section">
      <h2>Upload Your Livery</h2>
      <div class="notice">
        <p>
          <strong>Important:</strong> Please make sure your texture does not
          contain any copyrighted material like logos or trademarks. We don't
          want any trouble! :-)
        </p>
      </div>

      <form id="uploadForm" method="POST" action="upload.php" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group">
            <label for="trainType">Train Type *</label>
            <select id="trainType" name="trainType" required>
              <option value="">Select a train type</option>
              <option value="1100">1100</option>
              <option value="1500">1500</option>
              <option value="KC5000">KC5000</option>
              <option value="DC85">DC85</option>
            </select>
          </div>

          <div class="form-group">
            <label for="color">Color/Description *</label>
            <input type="text" id="color" name="color" placeholder="e.g., Red and White, Blue Classic" required />
          </div>

          <div class="form-group">
            <label for="name">Your Name (optional)</label>
            <input type="text" id="name" name="name" placeholder="e.g., John Doe (optional)" />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="file">Upload your .jpg texture file *</label>
            <input type="file" id="file" name="file" accept=".jpg,.jpeg" required />
          </div>

          <div class="form-group">
            <label for="thumb_file">Upload your .jpg thumbnail file (optional)</label>
            <input type="file" id="thumb_file" name="thumbnail" accept=".jpg,.jpeg" />
          </div>
        </div>

        <button type="submit">Upload Livery</button>
        <div id="uploadMessage" class="message"></div>
      </form>
    </div>

    <?php include('components/footer.php'); ?>
  </div>

  <script src="js/server.js"></script>
  <script src="js/upload.js"></script>
</body>

</html>