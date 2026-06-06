<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

$liveriesFile = __DIR__ . '/../liveries.json';
$liveries = [];
if (file_exists($liveriesFile)) {
  $liveries = json_decode(file_get_contents($liveriesFile), true) ?: [];
}

if (isset($_GET['trainType']) && $_GET['trainType'] !== '') {
    $train = $_GET['trainType'];

    $liveries = array_filter($liveries, function ($item) use ($train) {
        return isset($item['trainType']) && $item['trainType'] === $train;
    });

    $liveries = array_values($liveries);
}

if (isset($_GET['color']) && $_GET['color'] !== '') {
    $color = strtolower($_GET['color']);

    $liveries = array_filter($liveries, function ($item) use ($color) {
        return isset($item['color']) &&
               strpos(strtolower($item['color']), $color) !== false;
    });

    $liveries = array_values($liveries);
}

// optional: map filenames to full URLs
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
foreach ($liveries as &$l) {
  $l['fileUrl'] = $scheme . '://' . $host . '/uploads/' . $l['filename'];
  $l['thumbUrl'] = $l['thumbnail'] ? ($scheme . '://' . $host . '/uploads/' . $l['thumbnail']) : null;
}
echo json_encode($liveries);