<?php

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
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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

// Check row count for table
function get_table_count($table) {
    $res = turso_query("SELECT COUNT(*) as count FROM {$table};");
    if (isset($res['results'][0]['response']['result']['rows'][0][0]['value'])) {
        return (int)$res['results'][0]['response']['result']['rows'][0][0]['value'];
    }
    return 0;
}

// Auto Init Tables & Seed Initial Complete Data
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

    // Seed Software if table empty
    if (get_table_count('software') === 0) {
        $software_seed = [
            ['SW-101', 'Extrusion Tool', 'Pipe Weight Calculator', 'Instant weight and cost estimation based on pipe dimensions, material density, and PHR calcium carbonate ratio.', '$49.00', 'v2.1'],
            ['SW-102', 'Operations', 'OEE & Scrap Dashboard', 'Complete production tracking tool to measure machine efficiency, shift output, downtime, and scrap percentages.', '$99.00', 'v1.4'],
            ['SW-103', 'Planning', 'Labor & Machine Allocator', 'Smart planning spreadsheet system to balance daily workloads, technician shifts, and operational capacities.', '$79.00', 'v3.0']
        ];
        foreach ($software_seed as $item) {
            turso_query("INSERT INTO software (id, tag_en, title_en, desc_en, price, version) VALUES (?, ?, ?, ?, ?, ?);", $item);
        }
    }

    // Seed Full Experiences if table empty
    if (get_table_count('experiences') === 0) {
        $exp_seed = [
            ['EXP-1', 'Jan 2025 - Present', 'Manufacturing Manager - Salem Balhamer Holding', 'Overseeing operational management, factory workflow optimization, machine allocation, and quality systems across production lines.'],
            ['EXP-2', '2020 - Dec 2024', 'Production Manager - Saudi Industries for Pipes (SIP)', 'Managed high-capacity extrusion lines for uPVC and HDPE pipes, optimized compounding formulas, and achieved up to 35% reduction in scrap rates.'],
            ['EXP-3', '2015 - 2020', 'Plastic Extrusion & Technical Specialist', 'Formulated rigid PVC additives, optimized blown film extruders, performed melt flow index calibrations, and streamlined plant-wide maintenance protocols.'],
            ['EXP-4', '2007 - 2015', 'Production Supervisor & Process Engineer', 'Managed shift schedules, performed raw material quality testing, controlled compounding ratios, and supervised extruder die setup for precision profiles.']
        ];
        foreach ($exp_seed as $exp) {
            turso_query("INSERT INTO experiences (id, period, title, desc) VALUES (?, ?, ?, ?);", $exp);
        }
    }
}

init_turso_tables();
