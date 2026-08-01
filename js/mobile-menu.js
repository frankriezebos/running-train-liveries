(function () {
  const body = document.body;
  const toggle = document.getElementById("mobileNavToggle");
  const closeBtn = document.getElementById("mobileNavClose");
  const backdrop = document.getElementById("mobileNavBackdrop");
  const nav = document.getElementById("siteNav");

  if (!toggle || !closeBtn || !backdrop || !nav) {
    return;
  }

  const setOpenState = (isOpen) => {
    body.classList.toggle("mobile-menu-open", isOpen);
    toggle.setAttribute("aria-expanded", String(isOpen));
  };

  const closeMenu = () => setOpenState(false);

  toggle.addEventListener("click", () => {
    const isOpen = body.classList.contains("mobile-menu-open");
    setOpenState(!isOpen);
  });

  closeBtn.addEventListener("click", closeMenu);
  backdrop.addEventListener("click", closeMenu);

  nav.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", closeMenu);
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeMenu();
    }
  });

  // Ensure menu starts closed after soft reloads and browser restores.
  closeMenu();
})();
