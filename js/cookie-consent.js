const LIVERY_COOKIE_CONSENT_NAME = "livery_cookie_consent";

function getCookieValue(name) {
  const encodedName = encodeURIComponent(name) + "=";
  const parts = document.cookie ? document.cookie.split(";") : [];

  for (const part of parts) {
    const trimmed = part.trim();
    if (trimmed.indexOf(encodedName) === 0) {
      return decodeURIComponent(trimmed.substring(encodedName.length));
    }
  }

  return null;
}

function setCookie(name, value, maxAgeSeconds) {
  document.cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}; path=/; max-age=${maxAgeSeconds}; samesite=lax`;
}

function hasCookieConsent() {
  return getCookieValue(LIVERY_COOKIE_CONSENT_NAME) === "1";
}

function initCookieBanner() {
  const banner = document.getElementById("cookieBanner");
  const agreeButton = document.getElementById("cookieAgreeBtn");

  if (!banner || !agreeButton) {
    return;
  }

  if (hasCookieConsent()) {
    banner.classList.remove("is-visible");
    return;
  }

  banner.classList.add("is-visible");

  agreeButton.addEventListener("click", () => {
    setCookie(LIVERY_COOKIE_CONSENT_NAME, "1", 60 * 60 * 24 * 365);
    banner.classList.remove("is-visible");
    window.dispatchEvent(new Event("liveryCookieConsentGranted"));
  });
}

window.liveryCookieUtils = {
  getCookieValue,
  setCookie,
  hasCookieConsent,
  consentCookieName: LIVERY_COOKIE_CONSENT_NAME,
};

if (document.readyState === "loading") {
  document.addEventListener("DOMContentLoaded", initCookieBanner);
} else {
  initCookieBanner();
}

// current cookie status display on cookies page
function updateCookieStatusDisplay() {
  const statusElement = document.getElementById("cookie-status");
  if (statusElement) {
    statusElement.textContent = hasCookieConsent()
      ? "Accepted"
      : "Not Accepted";
  }
}

window.addEventListener(
  "liveryCookieConsentGranted",
  updateCookieStatusDisplay,
);
document.addEventListener("DOMContentLoaded", updateCookieStatusDisplay);

// cookieDisagreeBtn button on cookies page
const disagreeButton = document.getElementById("cookieDisagreeBtn");
if (disagreeButton) {
  disagreeButton.addEventListener("click", () => {
    setCookie(LIVERY_COOKIE_CONSENT_NAME, "0", 60 * 60 * 24 * 365);
    const banner = document.getElementById("cookieBanner");
    if (banner) {
      banner.classList.remove("is-visible");
    }
    updateCookieStatusDisplay();
  });
}

// agreeCookies button on cookies page
const agreeCookiesButton = document.getElementById("agreeCookies");
if (agreeCookiesButton) {
  agreeCookiesButton.addEventListener("click", () => {
    setCookie(LIVERY_COOKIE_CONSENT_NAME, "1", 60 * 60 * 24 * 365);
    const banner = document.getElementById("cookieBanner");
    if (banner) {
      banner.classList.remove("is-visible");
    }
    updateCookieStatusDisplay();
  });
}
