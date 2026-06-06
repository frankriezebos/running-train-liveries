# Running Train Liveries

A simple web application where users can upload and filter custom train liveries for the Running Train game.

## Features

- 📤 **Upload** .jpg liveries with train type and color information
- 🔍 **Filter** by train type (1100, 1500, KC5000, DC85) and color
- 🗑️ **Delete** liveries
- 🎨 **Beautiful UI** with responsive design
- 💾 **Local storage** with JSON metadata

## Setup & Installation

### Prerequisites
- Node.js (v14 or higher)
- npm

### Installation

1. Clone or navigate to the project directory:
```bash
cd running-train-liveries
```

2. Install dependencies:
```bash
npm install
```

3. Start the server:
```bash
npm start
```

4. Open your browser and go to:
```
http://localhost:3000
```

## Usage

### Uploading a Livery
1. Select the train type from the dropdown (1100, 1500, KC5000, or DC85)
2. Enter a color or description (e.g., "Red and White", "Blue Classic")
3. Choose a .jpg file to upload
4. Click "Upload Livery"

### Filtering Liveries
- Use the **Train Type** filter to show only liveries for a specific train
- Use the **Color/Description** filter to search by text
- Click **Clear Filters** to reset all filters

### Deleting a Livery
- Click the "Delete" button on any livery card to remove it

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

- **Backend**: Express.js with Multer for file uploads
- **Frontend**: Vanilla HTML/CSS/JavaScript
- **Storage**: Local file system with JSON metadata
- **Max file size**: 10MB per upload
- **Supported formats**: .jpg, .jpeg only

## Notes

- This is designed for local/private use
- Files are stored on the local server
- Metadata is saved in `liveries.json`
- Uploads are stored in the `uploads/` directory

Enjoy sharing your Running Train liveries! 🚂
