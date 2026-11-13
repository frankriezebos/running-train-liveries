(() => {
  const consentCookieName = "livery_cookie_consent";
  const consentMaxAge = 60 * 60 * 24 * 365;

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
    return getCookieValue(consentCookieName) === "1";
  }

  window.liveryCookieUtils = {
    getCookieValue,
    setCookie,
    hasCookieConsent,
    consentCookieName,
  };

  function initCookieConsent() {
    const banner = document.getElementById("cookieBanner");
    const status = document.getElementById("cookie-status");

    function updateDisplay() {
      const choice = getCookieValue(consentCookieName);
      if (banner) {
        banner.classList.toggle("is-visible", choice !== "1" && choice !== "0");
      }
      if (status) {
        status.textContent = hasCookieConsent() ? "Accepted" : "Not Accepted";
      }
    }

    function saveChoice(choice) {
      setCookie(consentCookieName, choice, consentMaxAge);
      updateDisplay();
      if (getCookieValue(consentCookieName) !== choice) {
        const message = "Unable to save your cookie preference. Please check your browser settings.";
        if (status) {
          status.textContent = message;
        }
        const bannerMessage = banner && banner.querySelector("p");
        if (bannerMessage) {
          bannerMessage.textContent = message;
        }
        console.error(message);
        return;
      }
      if (choice === "1") {
        window.dispatchEvent(new Event("liveryCookieConsentGranted"));
      }
    }

    const bannerAgreeButton = document.getElementById("cookieAgreeBtn");
    const agreeButton = document.getElementById("agreeCookies");
    const disagreeButton = document.getElementById("cookieDisagreeBtn");

    if (bannerAgreeButton) {
      bannerAgreeButton.addEventListener("click", () => saveChoice("1"));
    }
    if (agreeButton) {
      agreeButton.addEventListener("click", () => saveChoice("1"));
      agreeButton.disabled = false;
    }
    if (disagreeButton) {
      disagreeButton.addEventListener("click", () => saveChoice("0"));
      disagreeButton.disabled = false;
    }

    updateDisplay();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initCookieConsent);
  } else {
    initCookieConsent();
  }
})();
