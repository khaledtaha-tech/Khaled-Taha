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

        $stmt = ['sql' => $query];
        if (!empty($args)) {
            $stmt['args'] = $args;
        }

        $body = json_encode([
            'requests' => [
                ['type' => 'execute', 'stmt' => $stmt],
                ['type' => 'close']
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . TURSO_AUTH_TOKEN,
                'Content-Type: application/json'
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body
        ]);

        $response = curl_exec($ch);
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

if (!function_exists('ensure_turso_setup')) {
    function ensure_turso_setup() {
        $url = rtrim(TURSO_DB_URL, '/') . '/v2/pipeline';
        $body = json_encode([
            'requests' => [
                ['type' => 'execute', 'stmt' => ['sql' => "CREATE TABLE IF NOT EXISTS inquiries (id INTEGER PRIMARY KEY AUTOINCREMENT, date TEXT, name TEXT, company TEXT, email TEXT, inquiry_type TEXT, message TEXT);"]],
                ['type' => 'execute', 'stmt' => ['sql' => "CREATE TABLE IF NOT EXISTS software (id TEXT PRIMARY KEY, tag_en TEXT, title_en TEXT, desc_en TEXT, price TEXT, version TEXT);"]],
                ['type' => 'execute', 'stmt' => ['sql' => "CREATE TABLE IF NOT EXISTS experiences (id TEXT PRIMARY KEY, period TEXT, title TEXT, \"desc\" TEXT);"]],
                ['type' => 'execute', 'stmt' => ['sql' => "INSERT OR REPLACE INTO software (id, tag_en, title_en, desc_en, price, version) VALUES ('SW-101', 'Extrusion Tool', 'Pipe Weight Calculator', 'Instant weight and cost estimation based on pipe dimensions, material density, and PHR calcium carbonate ratio.', '$49.00', 'v2.1');"]],
                ['type' => 'execute', 'stmt' => ['sql' => "INSERT OR REPLACE INTO software (id, tag_en, title_en, desc_en, price, version) VALUES ('SW-102', 'Operations', 'OEE & Scrap Dashboard', 'Complete production tracking tool to measure machine efficiency, shift output, downtime, and scrap percentages.', '$99.00', 'v1.4');"]],
                ['type' => 'execute', 'stmt' => ['sql' => "INSERT OR REPLACE INTO software (id, tag_en, title_en, desc_en, price, version) VALUES ('SW-103', 'Planning', 'Labor & Machine Allocator', 'Smart planning spreadsheet system to balance daily workloads, technician shifts, and operational capacities.', '$79.00', 'v3.0');"]],
                ['type' => 'execute', 'stmt' => ['sql' => "INSERT OR REPLACE INTO experiences (id, period, title, \"desc\") VALUES ('EXP-1', 'Jan 2025 - Present', 'Manufacturing Manager - Salem Balhamer Holding', 'Overseeing operational management, factory workflow optimization, machine allocation, and quality systems across production lines.');"]],
                ['type' => 'execute', 'stmt' => ['sql' => "INSERT OR REPLACE INTO experiences (id, period, title, \"desc\") VALUES ('EXP-2', '2020 - Dec 2024', 'Production Manager - Saudi Industries for Pipes (SIP)', 'Managed high-capacity extrusion lines for uPVC and HDPE pipes, optimized compounding formulas, and achieved up to 35% reduction in scrap rates.');"]],
                ['type' => 'execute', 'stmt' => ['sql' => "INSERT OR REPLACE INTO experiences (id, period, title, \"desc\") VALUES ('EXP-3', '2015 - 2020', 'Plastic Extrusion & Technical Specialist', 'Formulated rigid PVC additives, optimized blown film extruders, performed melt flow index calibrations, and streamlined plant-wide maintenance protocols.');"]],
                ['type' => 'execute', 'stmt' => ['sql' => "INSERT OR REPLACE INTO experiences (id, period, title, \"desc\") VALUES ('EXP-4', '2007 - 2015', 'Production Supervisor & Process Engineer', 'Managed shift schedules, performed raw material quality testing, controlled compounding ratios, and supervised extruder die setup for precision profiles.');"]],
                ['type' => 'close']
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 3,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . TURSO_AUTH_TOKEN,
                'Content-Type: application/json'
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body
        ]);

        curl_exec($ch);
        curl_close($ch);
    }
}
