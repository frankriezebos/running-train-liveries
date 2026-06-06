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
  <link rel="stylesheet" href="style.css" />
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
        any designs that contain logos or trademarks. Rights reserved to
        Novatetsu Games and Steam. Happy designing and playing!
      </p>

      <a href="mailto:frank_rdam@live.nl" title="Contact me">Contact me for any questions or issues</a>
    </footer>
  </div>

  <script>
  const API_URL = window.location.origin;

  // Live reload - check for server restarts and refresh page
  let lastServerCheck = Date.now();
  setInterval(async () => {
    try {
      const response = await fetch(
        `${API_URL}/api/liveries?_t=${Date.now()}`, {
          cache: "no-store"
        },
      );
      const now = Date.now();
      // If server was down and is now back, reload
      //   if (now - lastServerCheck > 3000) {
      //     location.reload();
      //   }
      lastServerCheck = now;
    } catch (e) {
      // Server might be down, will reload when back
    }
  }, 1000);

  // Upload form handler
  document
    .getElementById("uploadForm")
    .addEventListener("submit", async (e) => {
      e.preventDefault();
      const form = e.currentTarget;
      const fd = new FormData(form);
      const msg = document.getElementById("uploadMessage");
      msg.textContent = "";

      try {
        const response = await fetch("upload.php", {
          method: "POST",
          body: fd,
        });

        const text = await response.text();

        // Extract JSON from the response (skip HTML error messages)
        const jsonStart = text.indexOf('{');
        const result = JSON.parse(text.substring(jsonStart));

        if (result.success) {
          msg.textContent = "Upload successful! 🎉 Please refresh page to see it below";
          msg.className = "message success";
        } else {
          msg.textContent = result.error || "Upload failed";
          msg.className = "message error";
        }
      } catch (error) {
        msg.textContent = "Upload failed: " + error.message;
        msg.className = "message error";
      }
    });

  // Load liveries
  async function loadLiveries() {
    const trainFilter = document.getElementById("filterTrain").value;
    const colorFilter = document.getElementById("filterColor").value;
    const sortOrder = document.getElementById("sortOrder").value;

    let url = `${API_URL}/api/liveries?`;
    if (trainFilter) url += `trainType=${trainFilter}&`;
    if (colorFilter) url += `color=${encodeURIComponent(colorFilter)}`;

    try {
      const response = await fetch(url);
      let liveries = await response.json();

      // ✅ SORT HERE
      liveries.sort((a, b) => {
        const diff = new Date(b.uploadedAt) - new Date(a.uploadedAt);
        return sortOrder === "newest" ? diff : -diff;
      });

      renderGallery(liveries);
    } catch (error) {
      console.error("Error loading liveries:", error);
    }
  }

  document
    .getElementById("sortOrder")
    .addEventListener("change", loadLiveries);

  // Render gallery
  function renderGallery(liveries) {
    const container = document.getElementById("galleryContainer");

    if (liveries.length === 0) {
      container.innerHTML =
        '<div class="empty-message">No liveries found. Be the first to upload!</div>';
      return;
    }

    container.innerHTML =
      '<div class="gallery">' +
      liveries
      .map(
        (livery) => `
          <div class="livery-card">
            <img src="${API_URL}/uploads/${livery.thumbnail ? livery.thumbnail : livery.filename}" alt="${livery.color}" class="livery-image">
            <div class="livery-info">
              <h4>${livery.trainType}</h4>
              <div class="livery-details">
                ${livery.name ? `<p><strong>Creator:</strong> ${livery.name}</p>` : ""}
                <p><strong>Color:</strong> ${livery.color}</p>
                <p><strong>Uploaded:</strong> ${new Date(livery.uploadedAt).toLocaleString()}</p>
              </div>
              <div class="download-btns">
                <a class="btn download-btn" title="Download livery" href="${API_URL}/uploads/${livery.filename}" download>Download livery</a>
                ${livery.thumbnail ? `<a class="btn download-btn" title="Download thumb" href="${API_URL}/uploads/${livery.thumbnail}" download>Download thumb</a>` : ""}
              </div>
            </div>
          </div>
        `,
      )
      .join("") +
      "</div>";
  }

  // Filter handlers
  document.getElementById("filterTrain").addEventListener("input", loadLiveries);
  document
    .getElementById("filterTrain")
    .addEventListener("change", loadLiveries);
  document
    .getElementById("filterColor")
    .addEventListener("input", loadLiveries);

  document.getElementById("clearFilters").addEventListener("click", () => {
    document.getElementById("filterTrain").value = "";
    document.getElementById("filterColor").value = "";
    loadLiveries();
  });

  // Initial load
  loadLiveries();
  </script>
</body>

</html>