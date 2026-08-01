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
      const uploadedA = new Date(a.uploadedAt).getTime();
      const uploadedB = new Date(b.uploadedAt).getTime();
      const likesA = Number(a.likes || 0);
      const likesB = Number(b.likes || 0);
      const downloadsA = Number(a.downloads || 0);
      const downloadsB = Number(b.downloads || 0);

      switch (sortOrder) {
        case "most_liked":
          return (
            likesB - likesA || downloadsB - downloadsA || uploadedB - uploadedA
          );
        case "most_downloaded":
          return (
            downloadsB - downloadsA || likesB - likesA || uploadedB - uploadedA
          );
        case "oldest":
          return uploadedA - uploadedB;
        case "newest":
        default:
          return uploadedB - uploadedA;
      }
    });

    renderGallery(liveries);
  } catch (error) {
    console.error("Error loading liveries:", error);
  }
}

async function incrementCounter(id, action) {
  const response = await fetch(`${API_URL}/api/liveries`, {
    method: "POST",
    keepalive: true,
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id, action }),
  });

  if (!response.ok) {
    throw new Error(`Failed to update ${action} counter`);
  }

  return response.json();
}

function hasCookieConsent() {
  return Boolean(
    window.liveryCookieUtils &&
    typeof window.liveryCookieUtils.hasCookieConsent === "function" &&
    window.liveryCookieUtils.hasCookieConsent(),
  );
}

function likedCookieName(id) {
  return `livery_liked_${id}`;
}

function hasLikedLivery(id) {
  if (!window.liveryCookieUtils) {
    return false;
  }

  return window.liveryCookieUtils.getCookieValue(likedCookieName(id)) === "1";
}

function rememberLikedLivery(id) {
  if (!window.liveryCookieUtils) {
    return;
  }

  window.liveryCookieUtils.setCookie(
    likedCookieName(id),
    "1",
    60 * 60 * 24 * 365,
  );
}

document.getElementById("sortOrder").addEventListener("change", loadLiveries);
window.addEventListener("liveryCookieConsentGranted", loadLiveries);

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
      .map((livery) => {
        const liked = hasLikedLivery(livery.id);
        const consentGiven = hasCookieConsent();
        const likeDisabled = liked || !consentGiven;
        const likeButtonTitle = consentGiven
          ? liked
            ? "You already liked this livery"
            : "Like this livery"
          : "Please agree to cookies to thumbs up";

        return `
          <div class="livery-card">
            <img src="${API_URL}/uploads/${livery.name ? `${livery.name}/` : ""}${livery.thumbnail ? livery.thumbnail : livery.filename}" alt="${livery.color}" class="livery-image">
            <div class="livery-info">
              <h4>${livery.color}</h4>
              <div class="livery-stats">
                <span class="likes-group">Likes: <strong data-like-count="${livery.id}">${Number(livery.likes || 0)}</strong> <button class="like-icon-btn ${liked ? "is-liked" : ""}" type="button" data-like-id="${livery.id}" title="${likeButtonTitle}" aria-label="${likeButtonTitle}" ${likeDisabled ? "disabled" : ""}><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M9 22H5a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h4v12zm2-12V6.5A2.5 2.5 0 0 1 13.5 4a2.5 2.5 0 0 1 2.45 3l-.67 3H21a2 2 0 0 1 2 2.18l-1 8A2 2 0 0 1 20 22h-9z"/></svg></button></span>
                <span>Downloads: <strong data-download-count="${livery.id}">${Number(livery.downloads || 0)}</strong></span>
              </div>
              <div class="livery-details">
                ${livery.name ? `<p><strong>Creator:</strong> ${livery.name}</p>` : ""}
                <p><strong>Train type:</strong> ${livery.trainType}</p>
                <p><strong>Uploaded:</strong> ${new Date(livery.uploadedAt).toLocaleString()}</p>
              </div>
              <p class="download-label"><strong>Download:</strong></p>
              <div class="download-btns">
                <a class="btn download-btn js-download-link" data-download-id="${livery.id}" title="Download livery" href="${API_URL}/uploads/${livery.name ? `${livery.name}/` : ""}${livery.filename}" download>Texture</a>
                ${livery.thumbnail ? `<a class="btn download-btn js-download-link" data-download-id="${livery.id}" title="Download thumb" href="${API_URL}/uploads/${livery.name ? `${livery.name}/` : ""}${livery.thumbnail}" download>Thumb</a>` : ""}
                ${livery.dir ? `<a class="btn download-btn js-download-link" data-download-id="${livery.id}" title="Download dir" href="${API_URL}/uploads/${livery.name ? `${livery.name}/` : ""}${livery.dir}" download>Dir</a>` : ""}
              </div>
            </div>
          </div>
        `;
      })
      .join("") +
    "</div>";

  container.querySelectorAll("[data-like-id]").forEach((button) => {
    button.addEventListener("click", async () => {
      if (button.disabled) {
        return;
      }

      button.disabled = true;

      try {
        const id = button.getAttribute("data-like-id");
        if (!id || hasLikedLivery(id) || !hasCookieConsent()) {
          return;
        }

        const data = await incrementCounter(id, "like");
        const likeEl = container.querySelector(`[data-like-count="${id}"]`);
        if (likeEl && data?.livery) {
          likeEl.textContent = String(Number(data.livery.likes || 0));
        }

        rememberLikedLivery(id);
        button.classList.add("is-liked");
        button.title = "You already liked this livery";
        button.setAttribute("aria-label", "You already liked this livery");
        button.disabled = true;
      } catch (error) {
        console.error("Error liking livery:", error);
      } finally {
        if (!button.classList.contains("is-liked")) {
          button.disabled = false;
        }
      }
    });
  });

  container.querySelectorAll(".js-download-link").forEach((link) => {
    link.addEventListener("click", async () => {
      const id = link.getAttribute("data-download-id");
      if (!id) {
        return;
      }

      try {
        const data = await incrementCounter(id, "download");
        const downloadEl = container.querySelector(
          `[data-download-count="${id}"]`,
        );
        if (downloadEl && data?.livery) {
          downloadEl.textContent = String(Number(data.livery.downloads || 0));
        }
      } catch (error) {
        console.error("Error updating download counter:", error);
      }
    });
  });
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
