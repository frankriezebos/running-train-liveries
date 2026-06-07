<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Discover - Liveries for Running Train</title>
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
      <nav class="main-nav">
        <ul>
          <li><a href="/" title="Discover liveries" class="active">Discover liveries</a></li>
          <li><a href="upload-livery.php" title="Upload livery">Upload livery</a></li>
          <li><a href="how-to-install.php" title="How to install">How to install</a></li>
        </ul>
      </nav>
    </header>

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
          <label for="filterName">Author name</label>
          <input type="text" id="filterName" placeholder="Search author name..." />
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

    <?php include('components/footer.php'); ?>
  </div>

  <script src="js/server.js"></script>
  <script src="js/load-liveries.js"></script>
</body>

</html>