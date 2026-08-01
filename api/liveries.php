<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$liveriesFile = __DIR__ . '/../liveries.json';

function respondWithError($statusCode, $message) {
    http_response_code($statusCode);
    echo json_encode(['error' => $message]);
    exit;
}

function readLiveries($filePath) {
    if (!file_exists($filePath)) {
        return [];
    }

    $decoded = json_decode(file_get_contents($filePath), true);
    return is_array($decoded) ? $decoded : [];
}

function normalizeLiveryCounters(&$livery) {
    $livery['likes'] = isset($livery['likes']) ? (int) $livery['likes'] : 0;
    $livery['downloads'] = isset($livery['downloads']) ? (int) $livery['downloads'] : 0;
}

function saveLiveriesWithLock($filePath, $liveries) {
    $fp = fopen($filePath, 'c+');
    if (!$fp) {
        return false;
    }

    if (!flock($fp, LOCK_EX)) {
        fclose($fp);
        return false;
    }

    ftruncate($fp, 0);
    rewind($fp);
    $encoded = json_encode($liveries, JSON_PRETTY_PRINT);
    $ok = $encoded !== false && fwrite($fp, $encoded) !== false;
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);

    return $ok;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payload = json_decode(file_get_contents('php://input'), true);
    if (!is_array($payload)) {
        $payload = $_POST;
    }

    $action = isset($payload['action']) ? strtolower(trim((string) $payload['action'])) : '';
    $id = isset($payload['id']) ? trim((string) $payload['id']) : '';

    if ($action !== 'like' && $action !== 'download') {
        respondWithError(400, 'Invalid action');
    }

    if ($id === '') {
        respondWithError(400, 'Missing id');
    }

    $liveries = readLiveries($liveriesFile);
    $found = false;

    foreach ($liveries as &$livery) {
        if (!isset($livery['id'])) {
            continue;
        }

        if ((string) $livery['id'] !== $id) {
            continue;
        }

        normalizeLiveryCounters($livery);
        if ($action === 'like') {
            $livery['likes'] += 1;
        } else {
            $livery['downloads'] += 1;
        }

        $found = true;
        $updated = $livery;
        break;
    }
    unset($livery);

    if (!$found) {
        respondWithError(404, 'Livery not found');
    }

    if (!saveLiveriesWithLock($liveriesFile, $liveries)) {
        respondWithError(500, 'Failed to save counters');
    }

    echo json_encode([
        'success' => true,
        'livery' => $updated,
    ]);
    exit;
}

$liveries = readLiveries($liveriesFile);

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

if (isset($_GET['name']) && $_GET['name'] !== '') {
    $name = strtolower($_GET['name']);

    $liveries = array_filter($liveries, function ($item) use ($name) {
        return isset($item['name']) &&
               strpos(strtolower($item['name']), $name) !== false;
    });

    $liveries = array_values($liveries);
}

// optional: map filenames to full URLs
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
foreach ($liveries as &$l) {
    normalizeLiveryCounters($l);
  $l['fileUrl'] = $scheme . '://' . $host . '/uploads/' . $l['filename'];
  $l['thumbUrl'] = $l['thumbnail'] ? ($scheme . '://' . $host . '/uploads/' . $l['thumbnail']) : null;
  $l['dirUrl'] = $l['dir'] ? ($scheme . '://' . $host . '/uploads/' . $l['dir']) : null;
}
echo json_encode($liveries);