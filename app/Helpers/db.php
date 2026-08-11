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
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2); // زمن الاتصال الأقصى 2 ثانية فقط
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);        // زمن تنفيذ الاستعلام الأقصى 3 ثواني
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . TURSO_AUTH_TOKEN,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            curl_close($ch);
            return null; // منع تعليق الصفحة في حالة فشل الشبكة
        }
        
        curl_close($ch);

        return $response ? json_decode($response, true) : null;
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
