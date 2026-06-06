const express = require("express");
const multer = require("multer");
const cors = require("cors");
const fs = require("fs");
const path = require("path");
const { put } = require("@vercel/blob");

const app = express();

app.use(cors());
app.use(express.json());

const upload = multer({
  storage: multer.memoryStorage(),
  fileFilter: (req, file, cb) => {
    const allowedMimes = ["image/jpeg"];
    if (allowedMimes.includes(file.mimetype)) cb(null, true);
    else cb(new Error("Only .jpg files are allowed"));
  },
  limits: { fileSize: 10 * 1024 * 1024 },
});

const metadataFile = process.env.VERCEL
  ? "/tmp/liveries.json"
  : path.join(__dirname, "../liveries.json");

function loadLiveries() {
  if (fs.existsSync(metadataFile)) {
    return JSON.parse(fs.readFileSync(metadataFile, "utf8"));
  }
  return [];
}

function saveLiveries(liveries) {
  fs.writeFileSync(metadataFile, JSON.stringify(liveries, null, 2));
}

app.post(
  "/api/upload",
  upload.fields([
    { name: "file", maxCount: 1 },
    { name: "thumbnail", maxCount: 1 },
  ]),
  async (req, res, next) => {
    try {
      if (!req.files || !req.files.file) {
        return res.status(400).json({ error: "No file uploaded" });
      }

      const { trainType, color, name } = req.body;

      if (!trainType || !color) {
        return res
          .status(400)
          .json({ error: "Train type and color are required" });
      }

      const validTrainTypes = ["1100", "1500", "KC5000", "DC85"];
      if (!validTrainTypes.includes(trainType)) {
        return res.status(400).json({ error: "Invalid train type" });
      }

      const file = req.files.file[0];
      const thumbnail = req.files.thumbnail ? req.files.thumbnail[0] : null;

      const fileBlob = await put(
        `liveries/${Date.now()}-${file.originalname}`,
        file.buffer,
        {
          access: "public",
          contentType: file.mimetype,
          token: process.env.BLOB_READ_WRITE_TOKEN,
        },
      );

      let thumbnailBlob = null;
      if (thumbnail) {
        thumbnailBlob = await put(
          `liveries/thumbnails/${Date.now()}-${thumbnail.originalname}`,
          thumbnail.buffer,
          {
            access: "public",
            contentType: thumbnail.mimetype,
            token: process.env.BLOB_READ_WRITE_TOKEN,
          },
        );
      }

      const livery = {
        id: Date.now(),
        fileUrl: fileBlob.url,
        thumbnailUrl: thumbnailBlob ? thumbnailBlob.url : null,
        name,
        trainType,
        color,
        uploadedAt: new Date().toISOString(),
      };

      const liveries = loadLiveries();
      liveries.push(livery);
      saveLiveries(liveries);

      res.json({ success: true, livery });
    } catch (err) {
      next(err);
    }
  },
);

app.get("/api/liveries", (req, res) => {
  const { trainType, color } = req.query;
  let liveries = loadLiveries();

  if (trainType) {
    liveries = liveries.filter((l) => l.trainType === trainType);
  }

  if (color) {
    liveries = liveries.filter((l) =>
      l.color.toLowerCase().includes(color.toLowerCase()),
    );
  }

  res.json(liveries);
});

app.use((req, res) => {
  res.status(404).json({ error: "Not found" });
});

app.use((err, req, res, next) => {
  console.error("Error:", err);

  if (err.code === "LIMIT_FILE_SIZE") {
    return res.status(413).json({ error: "File too large" });
  }
  if (err.message && err.message.includes("Only .jpg files")) {
    return res.status(400).json({ error: err.message });
  }

  res.status(500).json({ error: err.message || "Server error" });
});

module.exports = app;
