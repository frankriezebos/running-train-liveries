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
  <mata property="og:title" content="Liveries for Running Train" />
  <mata property="og:description"
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
        have to remove the site. Happy designing and playing!
      </p>

      <a href="mailto:frank_rdam@live.nl" title="Contact me">Contact me for any questions or issues</a>
    </footer>
  </div>

  <script src="js/script.js"></script>
</body>

</html>