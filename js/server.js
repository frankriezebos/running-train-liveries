const API_URL = window.location.origin;

// Live reload - check for server restarts and refresh page
let lastServerCheck = Date.now();
setInterval(async () => {
  try {
    const response = await fetch(`${API_URL}/api/liveries?_t=${Date.now()}`, {
      cache: "no-store",
    });
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
