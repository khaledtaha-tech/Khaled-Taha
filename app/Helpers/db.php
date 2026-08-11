<?php

define('TURSO_DB_URL', 'https://YOUR-DATABASE-NAME.turso.io');
define('TURSO_AUTH_TOKEN', 'YOUR_TURSO_AUTH_TOKEN');

function turso_query($query, $params = []) {
    $url = rtrim(TURSO_DB_URL, '/') . '/v2/pipeline';
    
    $args = [];
    foreach ($params as $param) {
        $args[] = ['type' => 'text', 'value' => (string)$param];
    }

    $body = json_encode([
        'requests' => [
            [
                'type' => 'execute',
                'stmt' => [
                    'sql' => $query,
                    'args' => $args
                ]
            ],
            ['type' => 'close']
        ]
    ]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . TURSO_AUTH_TOKEN,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
