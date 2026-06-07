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
- **Sort** by Newest or Oldest

## File Structure

```
running-train-liveries/
├── api
│   └── liveries.php    # Backend PHP for adding liveries to liveries.json
├── css
│   └── style.css       # Frontend CSS
├── js
│   └── script.css      # Frontend JS
├── uploads/            # Uploaded livery images (auto-created)
├── index.php           # Frontend HTML
├── liveries.json       # Metadata for all uploads (auto-created)
├── router.php          # Required for local development
└── README.md           # This file
```

## Technical Details

- **Backend**: PHP
- **Frontend**: Vanilla HTML/CSS/JavaScript
- **Storage**: Local file system with JSON metadata
- **Max file size**: 10MB per upload
- **Supported formats**: .jpg, .jpeg only
- **Local development**: Nodejs & PHP
- **Free hosting**: InfinityFree

## Local development usage

- First make sure you have npm and php installed on your system
- php -S localhost:8000 router.php

## Notes

- Files are stored on the local server
- Metadata is saved in `liveries.json`
- Uploads are stored in the `uploads/` directory

## Disclaimer

- I'm not affiliated with the game developer of Running Train, Novatetsu Games.
- I've requested permission for this site to the developer on X. I'm awaiting approval. If he would decline, I'd have to remove this site.
- I'm not responsible for any misuse of the uploaded content.

Enjoy sharing your Running Train liveries! 🚂
