<?php

// Endpoint الرسمي لـ Turso عبر HTTP REST API
define('TURSO_DB_URL', 'https://portfoliodb-khaled0.aws-ap-south-1.turso.io');
define('TURSO_AUTH_TOKEN', 'eyJhbGciOiJFZERTQSIsInR5cCI6IkpXVCJ9.eyJhIjoicnciLCJpYXQiOjE3ODY0NzMzMTEsImlkIjoiMDE5ZmYyMTgtOTMwMS03NTcxLTliNmYtYjk4ZTQ4NDM2YTU2Iiwia2lkIjoiaUVvUkhyUUFYMHg5blMzZzJJdkRqTlNHR0pjTS1Bcm1ZUHVFaXptMF9WMCIsInJpZCI6Ijg1YzUyYmNiLTVmNDktNGFlNy04Y2FlLTVlMGNlMGY3YzI0YyJ9.4m4G6YQQxiz-8OeBbfN-gQzdRhJ-ct3OqAIvrgU1NTVxgmtl9JM0naMv4sdHYYtnXu4jYX6QYGCZLjfwXFMECw');

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
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // لتفادي أي مشاكل في شهادات SSL بين Render و Turso
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . TURSO_AUTH_TOKEN,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        error_log('Turso cURL Error: ' . curl_error($ch));
    }
    
    curl_close($ch);

    return json_decode($response, true);
}

// إنشاء الجداول تلقائياً في حالة عدم وجودها
function init_turso_tables() {
    $sql_inquiries = "CREATE TABLE IF NOT EXISTS inquiries (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        date TEXT,
        name TEXT,
        company TEXT,
        email TEXT,
        inquiry_type TEXT,
        message TEXT
    );";

    $sql_software = "CREATE TABLE IF NOT EXISTS software (
        id TEXT PRIMARY KEY,
        tag_en TEXT,
        title_en TEXT,
        desc_en TEXT,
        price TEXT,
        version TEXT
    );";

    $sql_experiences = "CREATE TABLE IF NOT EXISTS experiences (
        id TEXT PRIMARY KEY,
        period TEXT,
        title TEXT,
        desc TEXT
    );";

    turso_query($sql_inquiries);
    turso_query($sql_software);
    turso_query($sql_experiences);
}

init_turso_tables();
