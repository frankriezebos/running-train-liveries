# Running Train Liveries

A simple web application where users can upload and filter custom train liveries for the Running Train game.

[Go to the webpage](https://running-train-liveries.gamer.free)

## Features

- 📤 **Upload** .jpg liveries with train type and color information
- 🔍 **Filter** by train type (1100, 1500, KC5000, DC85) and color
- 💾 **Local storage** with JSON metadata

## Usage

### Uploading a Livery

1. Select the train type from the dropdown (1100, 1500, KC5000, or DC85)
2. Enter a color or description (e.g., "Red and White", "Blue Classic")
3. Choose a .jpg file to upload
4. Optionally upload your thumb .jpg file
5. Optionally enter your name
6. Click "Upload Livery"

### Filtering Liveries

- Use the **Train Type** filter to show only liveries for a specific train
- Use the **Color/Description** filter to search by text
- Click **Clear Filters** to reset all filters

## File Structure

```
running-train-liveries/
├── server.js           # Express backend server
├── package.json        # Node.js dependencies
├── public/
│   └── index.html      # Frontend HTML/CSS/JS
├── uploads/            # Uploaded livery images (auto-created)
├── liveries.json       # Metadata for all uploads (auto-created)
└── README.md           # This file
```

## Technical Details

- **Backend**: PHP
- **Frontend**: Vanilla HTML/CSS/JavaScript
- **Storage**: Local file system with JSON metadata
- **Max file size**: 10MB per upload
- **Supported formats**: .jpg, .jpeg only
- **Local development**: Nodejs & PHP

## Local development usage

- npm install
- php -S localhost:8000 router.php

## Notes

- Files are stored on the local server
- Metadata is saved in `liveries.json`
- Uploads are stored in the `uploads/` directory

Enjoy sharing your Running Train liveries! 🚂
