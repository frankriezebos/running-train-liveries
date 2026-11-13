<?php

function apisfulApiKey() {
    $key = getenv('APISFUL');
    if ($key === false) {
        $envFile = __DIR__ . '/../.env';
        $env = is_readable($envFile) ? @parse_ini_file($envFile, false, INI_SCANNER_RAW) : false;
        if ($env === false || !isset($env['APISFUL'])) {
            throw new RuntimeException('APISFUL is not configured.');
        }
        $key = $env['APISFUL'];
    }

    if (!is_string($key) || trim($key) === '' || strpbrk($key, "\r\n") !== false) {
        throw new RuntimeException('APISFUL contains an invalid API key.');
    }

    return trim($key);
}

function requestApisfulNews($apiKey, $page) {
    $url = 'https://api.apisful.com/v1/collections/news/?per_page=200&order_by=-created_at&page=' . $page;
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => "X-Api-Key: $apiKey\r\nAccept: application/json\r\n",
            'timeout' => 10,
            'ignore_errors' => true,
            'follow_location' => 0,
        ],
    ]);
    $body = @file_get_contents($url, false, $context);
    if ($body === false || !isset($http_response_header[0]) ||
        !preg_match('/^HTTP\/\S+ 200(?:\s|$)/', $http_response_header[0])) {
        throw new RuntimeException('Could not fetch news from Apisful.');
    }

    $response = json_decode($body, true);
    if (!is_array($response)) {
        throw new RuntimeException('Apisful returned invalid JSON.');
    }
    return $response;
}

function fetchNews($apiKey, $request = 'requestApisfulNews') {
    $news = [];
    $page = 1;
    do {
        $response = $request($apiKey, $page);
        if (!isset($response['results']) || !is_array($response['results']) ||
            !array_key_exists('next', $response) ||
            ($response['next'] !== null && (!is_string($response['next']) || $response['next'] === '')) ||
            ($response['next'] !== null && count($response['results']) === 0)) {
            throw new RuntimeException('Apisful returned an invalid news response.');
        }

        foreach ($response['results'] as $record) {
            if (!is_array($record) || !isset($record['title'], $record['description'], $record['created_at']) ||
                !is_string($record['title']) || !is_string($record['description']) ||
                !is_string($record['created_at']) || trim($record['created_at']) === '') {
                throw new RuntimeException('Apisful returned an invalid news record.');
            }
            try {
                $date = new DateTimeImmutable($record['created_at']);
            } catch (Exception $exception) {
                throw new RuntimeException('Apisful returned an invalid news date.', 0, $exception);
            }
            $news[] = [
                'title' => $record['title'],
                'description' => $record['description'],
                'date' => $date,
            ];
        }
        $page++;
    } while ($response['next'] !== null);

    usort($news, function ($first, $second) {
        return $second['date'] <=> $first['date'];
    });

    foreach ($news as &$item) {
        $item['date'] = $item['date']->setTimezone(new DateTimeZone('UTC'))->format('j F Y H:i') . ' UTC';
    }
    unset($item);

    return $news;
}
