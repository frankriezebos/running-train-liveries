<?php
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
if (preg_match('/^\.env(?:$|\.)/i', basename(rawurldecode($path)))) {
  http_response_code(403);
  exit('Forbidden');
}
if ($path === '/api/liveries') {
  require __DIR__ . '/api/liveries.php';
  return;
}
return false; // serve static files normally
