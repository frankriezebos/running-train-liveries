<?php
header('Content-Type: application/json');

// Basic CORS for local testing (remove/adjust for production)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST, OPTIONS");
  header("Access-Control-Allow-Headers: Content-Type");
  exit;
}
header("Access-Control-Allow-Origin: *");

$uploadsDir = __DIR__ . '/uploads/';
if (!is_dir($uploadsDir)) mkdir($uploadsDir, 0755, true);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Method not allowed']);
  exit;
}

// Expect form fields: file (required), thumbnail (optional), dir (optional), trainType, color, name
if (!isset($_FILES['file'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Texture or thumb file is probably too large']);
  exit;
}

// Simple validation
$file = $_FILES['file'];
if ($file['error'] !== UPLOAD_ERR_OK) { http_response_code(400); echo json_encode(['error'=>'Upload error']); exit; }
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mime = finfo_file($finfo, $file['tmp_name']);
finfo_close($finfo);
if ($mime !== 'image/jpeg' && $mime !== 'image/jpg' && $mime !== 'image/png') { http_response_code(400); echo json_encode(['error'=>'Only JPEG & PNG allowed']); exit; }
if ($file['size'] > 20*1024*1024) { http_response_code(400); echo json_encode(['error'=>'File too large']); exit; }

// safe filename
function safeName($name) {
  return preg_replace('/[^A-Za-z0-9._-]/', '_', $name);
}

$mainName = time() . '-' . safeName(basename($file['name']));
$mainPath = $uploadsDir . $mainName;
if (!move_uploaded_file($file['tmp_name'], $mainPath)) { http_response_code(500); echo json_encode(['error'=>'Move failed']); exit; }

// thumbnail
$thumbName = null;
if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
  $t = $_FILES['thumbnail'];
  $tfinfo = finfo_open(FILEINFO_MIME_TYPE);
  $tmime = finfo_file($tfinfo, $t['tmp_name']);
  finfo_close($tfinfo);
  if ($tmime === 'image/jpeg' || $tmime === 'image/jpg') {
    $thumbName = time() . '-thumb-' . safeName(basename($t['name']));
    move_uploaded_file($t['tmp_name'], $uploadsDir . $thumbName);
  }
}

// dir
$dirName = null;
if (isset($_FILES['dir']) && $_FILES['dir']['error'] === UPLOAD_ERR_OK) {
  $t = $_FILES['dir'];
  $tfinfo = finfo_open(FILEINFO_MIME_TYPE);
  $tmime = finfo_file($tfinfo, $t['tmp_name']);
  finfo_close($tfinfo);
  if ($tmime === 'image/png') {
    $dirName = time() . '-dir-' . safeName(basename($t['name']));
    move_uploaded_file($t['tmp_name'], $uploadsDir . $dirName);
  }
}

// metadata
$liveriesFile = __DIR__ . '/liveries.json';
$liveries = [];
if (file_exists($liveriesFile)) {
  $liveries = json_decode(file_get_contents($liveriesFile), true) ?: [];
}

$new = [
  'id' => round(microtime(true)*1000),
  'filename' => $mainName,
  'thumbnail' => $thumbName, // null if none
  'name' => isset($_POST['name']) ? substr(trim($_POST['name']),0,100) : null,
  'trainType' => isset($_POST['trainType']) ? $_POST['trainType'] : null,
  'color' => isset($_POST['color']) ? substr(trim($_POST['color']),0,200) : null,
  'dir' => $dirName, // null if none
  'uploadedAt' => gmdate('c'),
];

// basic validation of trainType/color
$validTrainTypes = ['1100 / 1500','KR5000 / KC1000','DC85'];
if (!$new['trainType'] || !in_array($new['trainType'], $validTrainTypes) || !$new['color']) {
  // cleanup files
  @unlink($uploadsDir . $mainName);
  if ($thumbName) @unlink($uploadsDir . $thumbName);
  if ($dirName) @unlink($uploadsDir . $dirName);
  http_response_code(400);
  echo json_encode(['error'=>'Train type and color required or invalid']);
  exit;
}

$liveries[] = $new;
file_put_contents($liveriesFile, json_encode($liveries, JSON_PRETTY_PRINT));

$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$publicMain = $scheme . '://' . $host . '/uploads/' . $mainName;
$publicThumb = $thumbName ? ($scheme . '://' . $host . '/uploads/' . $thumbName) : null;
$publicDir = $dirName ? ($scheme . '://' . $host . '/uploads/' . $dirName) : null;

echo json_encode(
  [
    'success'=>true, 
    'livery'=>$new, 
    'url'=>$publicMain, 
    'thumbUrl'=>$publicThumb, 
    'dirUrl'=>$publicDir
  ]
);