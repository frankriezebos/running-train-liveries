// Upload form handler
document.getElementById("uploadForm").addEventListener("submit", async (e) => {
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
    const jsonStart = text.indexOf("{");
    const result = JSON.parse(text.substring(jsonStart));

    if (result.success) {
      msg.textContent =
        "Upload successful! 🎉 You can see it on home (Discover liveries)";
      msg.className = "message success";
    } else if (result.error) {
      msg.textContent = result.error || "Upload failed";
      msg.className = "message error";
    } else {
      msg.textContent = "uploading.. please wait..";
      msg.className = "message warning";
    }
  } catch (error) {
    msg.textContent = "Upload failed: " + error.message;
    msg.className = "message error";
  }
});
