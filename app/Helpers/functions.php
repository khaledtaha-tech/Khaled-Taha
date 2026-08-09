<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$script_name = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$base_url = rtrim($protocol . "://" . $host . $script_name, '/');

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
        'nav_home' => 'الرئيسية',
        'nav_about' => 'نبذة عني',
        'nav_experience' => 'الخبرات',
        'nav_products' => 'المنتجات الفنية',
        'nav_software' => 'متجر البرامج',
        'nav_contact' => 'التواصل',
        'welcome_tag' => 'مرحباً بكم في موقعي المهني',
        'hero_name' => 'خالد طه',
        'hero_title' => 'مدير الإنتاج والعمليات الفنية',
        'hero_subtitle' => 'أخصائي بثق البلاستيك | تطوير المصانع والحلول الرقمية للإنتاج',
        'hero_desc' => 'خبرة أكثر من 19 عاماً في إدارة الإنتاج والعمليات الفنية لصناعة البلاستيك والبثق، تطوير خلطات الـ PVC، رفع الإنتاجية، خفض الفاقد، وتطوير برمجيات هندسية مخصصة للمصانع.',
        'btn_projects' => 'استعراض المشروعات',
        'btn_software' => 'متجر البرامج',
        'btn_contact' => 'تواصل معي',
        'years_exp' => 'عام خبرة',
        'about_title' => 'نبذة عني',
        'about_desc' => 'قائد عمليات متأصل في صناعة البلاستيك والبثق، تحسين استهلاك المواد الخام، وبناء برمجيات إدارية وفنية مخصصة للمصانع.',
        'footer_rights' => 'جميع الحقوق محفوظة.'
    ]
];

function __($key) {
    global $translations;
    $lang = get_lang();
    return $translations[$lang][$key] ?? $key;
}