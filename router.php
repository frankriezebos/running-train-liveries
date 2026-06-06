<?php
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
if ($path === '/api/liveries') {
  require __DIR__ . '/api/liveries.php';
  return;
}
return false; // serve static files normally
