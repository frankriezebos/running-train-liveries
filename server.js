const express = require("express");
const multer = require("multer");
const cors = require("cors");
const path = require("path");
const fs = require("fs");

const app = express();
const PORT = 3000;

// Middleware
app.use(cors());
app.use(express.json());
app.use(express.static("public"));
app.use("/uploads", express.static("uploads"));

// Create uploads directory if it doesn't exist
const uploadsDir = path.join(__dirname, "uploads");
if (!fs.existsSync(uploadsDir)) {
  fs.mkdirSync(uploadsDir);
}

// Multer configuration
const storage = multer.diskStorage({
  destination: (req, file, cb) => {
    cb(null, uploadsDir);
  },
  filename: (req, file, cb) => {
    const uniqueSuffix = Date.now() + "-" + Math.round(Math.random() * 1e9);
    cb(null, uniqueSuffix + path.extname(file.originalname));
  },
});

const fileFilter = (req, file, cb) => {
  const allowedMimes = ["image/jpeg"];
  if (allowedMimes.includes(file.mimetype)) {
    cb(null, true);
  } else {
    cb(new Error("Only .jpg files are allowed"));
  }
};

const upload = multer({
  storage,
  fileFilter,
  limits: { fileSize: 10 * 1024 * 1024 },
});

// Metadata file
const metadataFile = path.join(__dirname, "liveries.json");

// Load or initialize liveries data
function loadLiveries() {
  if (fs.existsSync(metadataFile)) {
    const data = fs.readFileSync(metadataFile, "utf8");
    return JSON.parse(data);
  }
  return [];
}

function saveLiveries(liveries) {
  fs.writeFileSync(metadataFile, JSON.stringify(liveries, null, 2));
}

// Upload livery
app.post(
  "/api/upload",
  upload.fields([
    { name: "file", maxCount: 1 },
    { name: "thumbnail", maxCount: 1 },
  ]),
  (req, res) => {
    if (!req.files || !req.files.file) {
      return res.status(400).json({ error: "No file uploaded" });
    }

    const { trainType, color, name } = req.body;

    if (!trainType || !color) {
      if (req.files.file) fs.unlinkSync(req.files.file[0].path);
      if (req.files.thumbnail) fs.unlinkSync(req.files.thumbnail[0].path);
      return res
        .status(400)
        .json({ error: "Train type and color are required" });
    }

    const validTrainTypes = ["1100", "1500", "KC5000", "DC85"];
    if (!validTrainTypes.includes(trainType)) {
      if (req.files.file) fs.unlinkSync(req.files.file[0].path);
      if (req.files.thumbnail) fs.unlinkSync(req.files.thumbnail[0].path);
      return res.status(400).json({ error: "Invalid train type" });
    }

    const livery = {
      id: Date.now(),
      filename: req.files.file[0].filename,
      thumbnail: req.files.thumbnail ? req.files.thumbnail[0].filename : null,
      name,
      trainType,
      color,
      uploadedAt: new Date().toISOString(),
    };

    const liveries = loadLiveries();
    liveries.push(livery);
    saveLiveries(liveries);

    res.json({ success: true, livery });
  },
);

// Get filtered liveries
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
