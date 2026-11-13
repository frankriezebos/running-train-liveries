<?php

function safeName($name) {
  return preg_replace('/[^A-Za-z0-9._-]/', '-', $name);
}

function liveryDirectory($livery, $uploadsDir) {
  if (isset($livery['uploadDirectory'])) {
    return $livery['uploadDirectory'];
  }

  $name = isset($livery['name']) ? safeName(basename($livery['name'])) : '';
  $directory = $name ? $name : '';
  $filename = $livery['filename'];
  if ($directory !== '' && is_file($uploadsDir . '/' . $directory . '/' . $filename)) {
    return $directory;
  }
  if (is_file($uploadsDir . '/' . $filename)) {
    return '';
  }

  // Older metadata may have a trimmed or truncated name unlike the upload directory.
  if (!is_dir($uploadsDir)) {
    error_log('Upload directory does not exist: ' . $uploadsDir);
    return $directory;
  }
  $entries = scandir($uploadsDir);
  if ($entries === false) {
    error_log('Unable to inspect upload directories: ' . $uploadsDir);
    return $directory;
  }
  $matches = [];
  foreach ($entries as $entry) {
    if ($entry !== '.' && $entry !== '..' && is_file($uploadsDir . '/' . $entry . '/' . $filename)) {
      $matches[] = $entry;
    }
  }
  if (count($matches) === 1) {
    return $matches[0];
  }
  if (count($matches) > 1) {
    error_log('Ambiguous upload directory for file: ' . $filename);
  } else {
    error_log('Upload file not found: ' . $filename);
  }
  return $directory;
}

function liveryFileUrl($baseUrl, $directory, $filename) {
  return $baseUrl . '/uploads/' .
    ($directory !== '' ? rawurlencode($directory) . '/' : '') .
    rawurlencode($filename);
}
