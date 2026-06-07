<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Liveries for Running Train</title>
  <meta name="description"
    content="Share and discover custom train liveries for Running Train. Upload your designs, browse others, and download your favorites!" />
  <meta robots="index, follow" />
  <meta name="keywords" content="Running Train, train liveries, custom textures, game mods, train skins" />
  <meta property="og:title" content="Liveries for Running Train" />
  <meta property="og:description"
    content="Share and discover custom train liveries for Running Train. Upload your designs, browse others, and download your favorites!" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div class="container">
    <header class="header">
      <h1>Liveries for Running Train</h1>
      <p>Download and share custom train liveries</p>
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

    <div class="section instructions-section">
      <h2>How to install?</h2>
      <div class="form-row">
        <div>
          <h3>Livery texture</h3>
          <p>
            Very easy! Just download the texture and place it in the
            appropriate folder for your train model within C:\Program Files
            (x86)\Steam\steamapps\common\RUNNING
            TRAIN\RunningTrain\Content\UGC\Textures. Optional: you can make a
            backup of the original empty blueprint files first. Rename the
            downloaded file to tex3.jpg or tex4.jpg and replace.
          </p>
        </div>

        <div>
          <h3>Thumbnail</h3>
          <p>
            Download the thumbnail and place it in the thumb folder for your
            train model. Optional: you can make a backup of the original
            files. Rename the downloaded file to thumb3.jpg or thumb4.jpg and
            replace.
          </p>
        </div>
      </div>
    </div>

    <div class="filter-section">
      <h3>🔍 Filter Liveries</h3>
      <div class="filter-row">
        <div class="form-group">
          <label for="filterTrain">Train Type</label>
          <select id="filterTrain">
            <option value="">All Trains</option>
            <option value="1100">1100</option>
            <option value="1500">1500</option>
            <option value="KC5000">KC5000</option>
            <option value="DC85">DC85</option>
          </select>
        </div>
        <div class="form-group">
          <label for="filterColor">Color/Description</label>
          <input type="text" id="filterColor" placeholder="Search colors..." />
        </div>
        <div class="form-group">
          <button type="button" id="clearFilters">Clear Filters</button>
        </div>
        <div class="form-group">
          <h3>Sort By</h3>
          <select id="sortOrder">
            <option value="newest">Newest</option>
            <option value="oldest">Oldest</option>
          </select>
        </div>
      </div>
    </div>

    <div id="galleryContainer" class="gallery-container"></div>

    <footer class="footer">
      <p>
        Made with ❤️ for the Running Train community. Share your designs and
        enjoy others' creativity!<br /><strong>Disclaimer:</strong> I am not
        affiliated with the game developers, just a fan sharing a passion for
        custom train liveries. Please respect copyright and avoid uploading
        any designs that contain logos or trademarks. All rights reserved to the respectful owners of the original game
        assets: Novatetsu Games. I've requested them for permission on X. Let's await his response! If they decline, I
        have to remove the site. I'm not responsible for any misuse of the uploaded content. Happy designing and
        playing!
      </p>

      <div class="footer-bottom">
        <a href="mailto:frank_rdam@live.nl" title="Contact me" class="footer-link"><svg width="20" height="16"
            viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M18 4L10 9L2 4V2L10 7L18 2M18 0H2C0.89 0 0 0.89 0 2V14C0 14.5304 0.210714 15.0391 0.585786 15.4142C0.960859 15.7893 1.46957 16 2 16H18C18.5304 16 19.0391 15.7893 19.4142 15.4142C19.7893 15.0391 20 14.5304 20 14V2C20 1.46957 19.7893 0.960859 19.4142 0.585786C19.0391 0.210714 18.5304 0 18 0Z"
              fill="white" />
          </svg>
          Contact me for any questions or
          issues</a>

        <a href="https://github.com/frankriezebos/running-train-liveries" title="Open source Git repo" target="_blank"
          class="footer-link"><svg width="20" height="20" viewBox="0 0 20 20" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 0C8.68678 0 7.38642 0.258658 6.17317 0.761205C4.95991 1.26375 3.85752 2.00035 2.92893 2.92893C1.05357 4.8043 0 7.34784 0 10C0 14.42 2.87 18.17 6.84 19.5C7.34 19.58 7.5 19.27 7.5 19V17.31C4.73 17.91 4.14 15.97 4.14 15.97C3.68 14.81 3.03 14.5 3.03 14.5C2.12 13.88 3.1 13.9 3.1 13.9C4.1 13.97 4.63 14.93 4.63 14.93C5.5 16.45 6.97 16 7.54 15.76C7.63 15.11 7.89 14.67 8.17 14.42C5.95 14.17 3.62 13.31 3.62 9.5C3.62 8.39 4 7.5 4.65 6.79C4.55 6.54 4.2 5.5 4.75 4.15C4.75 4.15 5.59 3.88 7.5 5.17C8.29 4.95 9.15 4.84 10 4.84C10.85 4.84 11.71 4.95 12.5 5.17C14.41 3.88 15.25 4.15 15.25 4.15C15.8 5.5 15.45 6.54 15.35 6.79C16 7.5 16.38 8.39 16.38 9.5C16.38 13.32 14.04 14.16 11.81 14.41C12.17 14.72 12.5 15.33 12.5 16.26V19C12.5 19.27 12.66 19.59 13.17 19.5C17.14 18.16 20 14.42 20 10C20 8.68678 19.7413 7.38642 19.2388 6.17317C18.7362 4.95991 17.9997 3.85752 17.0711 2.92893C16.1425 2.00035 15.0401 1.26375 13.8268 0.761205C12.6136 0.258658 11.3132 0 10 0Z"
              fill="white" />
          </svg>
          Open source Git
          repo</a>
      </div>
    </footer>
  </div>

  <script src=" js/script.js"></script>
</body>

</html>