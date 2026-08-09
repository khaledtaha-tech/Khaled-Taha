<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$is_https = (
    (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) === 'on') ||
    (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && strtolower($_SERVER['HTTP_X_FORWARDED_PROTO']) === 'https') ||
    (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)
);

$protocol = $is_https ? "https" : "http";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$script_name = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$base_path = ($script_name === '/' || $script_name === '.') ? '' : $script_name;
$base_url = rtrim($protocol . "://" . $host . $base_path, '/');

define('APP_URL', $base_url);

function base_url($path = '') {
    return rtrim(APP_URL, '/') . '/' . ltrim($path, '/');
}

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

function get_lang() {
    return $_SESSION['lang'];
}

function is_rtl() {
    return get_lang() === 'ar';
}

function __($key) {
    static $dictionary = null;
    if ($dictionary === null) {
        $lang = get_lang();
        $file = __DIR__ . '/../../languages/' . $lang . '.json';
        if (file_exists($file)) {
            $json = file_get_contents($file);
            $dictionary = json_decode($json, true) ?? [];
        } else {
            $dictionary = [];
        }
    }
    return $dictionary[$key] ?? $key;
}
