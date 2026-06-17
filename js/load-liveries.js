// Load liveries
async function loadLiveries() {
  const trainFilter = document.getElementById("filterTrain").value;
  const colorFilter = document.getElementById("filterColor").value;
  const nameFilter = document.getElementById("filterName").value;
  const sortOrder = document.getElementById("sortOrder").value;

  let url = `${API_URL}/api/liveries?`;
  if (trainFilter) url += `trainType=${trainFilter}&`;
  if (colorFilter) url += `color=${encodeURIComponent(colorFilter)}&`;
  if (nameFilter) url += `name=${encodeURIComponent(nameFilter)}`;

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

document.getElementById("sortOrder").addEventListener("change", loadLiveries);

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
              <h4>${livery.color}</h4>
              <div class="livery-details">
                ${livery.name ? `<p><strong>Creator:</strong> ${livery.name}</p>` : ""}
                <p><strong>Train type:</strong> ${livery.trainType}</p>
                <p><strong>Uploaded:</strong> ${new Date(livery.uploadedAt).toLocaleString()}</p>
              </div>
              <p class="download-label"><strong>Download:</strong></p>
              <div class="download-btns">
                <a class="btn download-btn" title="Download livery" href="${API_URL}/uploads/${livery.filename}" download>Texture</a>
                ${livery.thumbnail ? `<a class="btn download-btn" title="Download thumb" href="${API_URL}/uploads/${livery.thumbnail}" download>Thumb</a>` : ""}
                ${livery.dir ? `<a class="btn download-btn" title="Download dir" href="${API_URL}/uploads/${livery.dir}" download>Dir</a>` : ""}
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
document.getElementById("filterTrain").addEventListener("change", loadLiveries);
document.getElementById("filterColor").addEventListener("input", loadLiveries);
document.getElementById("filterName").addEventListener("input", loadLiveries);

document.getElementById("clearFilters").addEventListener("click", () => {
  document.getElementById("filterTrain").value = "";
  document.getElementById("filterColor").value = "";
  document.getElementById("filterName").value = "";
  loadLiveries();
});

// Initial load
loadLiveries();
