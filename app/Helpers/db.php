<?php

if (!defined('TURSO_DB_URL')) {
    define('TURSO_DB_URL', 'https://portfoliodb-khaled0.aws-ap-south-1.turso.io');
}

if (!defined('TURSO_AUTH_TOKEN')) {
    define('TURSO_AUTH_TOKEN', 'eyJhbGciOiJFZERTQSIsInR5cCI6IkpXVCJ9.eyJhIjoicnciLCJpYXQiOjE3ODY0NzMzMTEsImlkIjoiMDE5ZmYyMTgtOTMwMS03NTcxLTliNmYtYjk4ZTQ4NDM2YTU2Iiwia2lkIjoiaUVvUkhyUUFYMHg5blMzZzJJdkRqTlNHR0pjTS1Bcm1ZUHVFaXptMF9WMCIsInJpZCI6Ijg1YzUyYmNiLTVmNDktNGFlNy04Y2FlLTVlMGNlMGY3YzI0YyJ9.4m4G6YQQxiz-8OeBbfN-gQzdRhJ-ct3OqAIvrgU1NTVxgmtl9JM0naMv4sdHYYtnXu4jYX6QYGCZLjfwXFMECw');
}

if (!function_exists('turso_query')) {
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
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
}

if (!function_exists('get_turso_rows')) {
    function get_turso_rows($query, $params = []) {
        $res = turso_query($query, $params);
        $rows = [];
        if (isset($res['results'][0]['response']['result']['rows'])) {
            $raw_rows = $res['results'][0]['response']['result']['rows'];
            $cols = array_column($res['results'][0]['response']['result']['cols'], 'name');
            foreach ($raw_rows as $row) {
                $item = [];
                foreach ($row as $i => $val) {
                    $item[$cols[$i]] = $val['value'] ?? '';
                }
                $rows[] = $item;
            }
        }
        return $rows;
    }
}

// إنشاء الجداول دفعة واحدة في طلب واحد لتجنب البطء والتهنيج
if (!function_exists('init_turso_tables')) {
    function init_turso_tables() {
        $url = rtrim(TURSO_DB_URL, '/') . '/v2/pipeline';

        $body = json_encode([
            'requests' => [
                ['type' => 'execute', 'stmt' => ['sql' => "CREATE TABLE IF NOT EXISTS inquiries (id INTEGER PRIMARY KEY AUTOINCREMENT, date TEXT, name TEXT, company TEXT, email TEXT, inquiry_type TEXT, message TEXT);"]],
                ['type' => 'execute', 'stmt' => ['sql' => "CREATE TABLE IF NOT EXISTS software (id TEXT PRIMARY KEY, tag_en TEXT, title_en TEXT, desc_en TEXT, price TEXT, version TEXT);"]],
                ['type' => 'execute', 'stmt' => ['sql' => "CREATE TABLE IF NOT EXISTS experiences (id TEXT PRIMARY KEY, period TEXT, title TEXT, \"desc\" TEXT);"]],
                ['type' => 'close']
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 8);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . TURSO_AUTH_TOKEN,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        curl_exec($ch);
        curl_close($ch);
    }
}

init_turso_tables();
