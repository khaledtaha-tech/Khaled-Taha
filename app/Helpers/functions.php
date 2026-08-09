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

$translations = [
    'en' => [
        'nav_home' => 'Home',
        'nav_about' => 'About',
        'nav_experience' => 'Experience',
        'nav_products' => 'Technical Products',
        'nav_software' => 'Software Store',
        'nav_contact' => 'Contact',
        'welcome_tag' => 'Welcome to my professional portfolio',
        'hero_name' => 'Khaled Taha',
        'hero_title' => 'Production & Technical Operations Manager',
        'hero_subtitle' => 'Plastic Extrusion Specialist | Factory Improvement & Digital Solutions',
        'hero_desc' => '19+ years of experience in plastic extrusion, PVC compounding, process optimization, and industrial software development.',
        'btn_projects' => 'View Projects',
        'btn_software' => 'Software Store',
        'btn_contact' => 'Contact Me',
        'years_exp' => 'Years Exp.',
        'about_title' => 'About Me',
        'about_desc' => 'Operations leader specialized in plastic manufacturing, raw material optimization, and building practical management software.',
        'footer_rights' => 'All rights reserved.'
    ],
    'ar' => [
        'nav_home' => 'Home',
        'nav_about' => 'About',
        'nav_experience' => 'Experience',
        'nav_products' => 'Technical Products',
        'nav_software' => 'Software Store',
        'nav_contact' => 'Contact',
        'welcome_tag' => 'Welcome to my professional portfolio',
        'hero_name' => 'Khaled Taha',
        'hero_title' => 'Production & Technical Operations Manager',
        'hero_subtitle' => 'Plastic Extrusion Specialist | Factory Improvement & Digital Solutions',
        'hero_desc' => '19+ years of experience in plastic extrusion, PVC compounding, process optimization, and industrial software development.',
        'btn_projects' => 'View Projects',
        'btn_software' => 'Software Store',
        'btn_contact' => 'Contact Me',
        'years_exp' => 'Years Exp.',
        'about_title' => 'About Me',
        'about_desc' => 'Operations leader specialized in plastic manufacturing, raw material optimization, and building practical management software.',
        'footer_rights' => 'All rights reserved.'
    ]
];

function __($key) {
    global $translations;
    $lang = get_lang();
    return $translations[$lang][$key] ?? $key;
}
