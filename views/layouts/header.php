<?php require_once __DIR__ . '/../../app/Helpers/functions.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo get_lang(); ?>" dir="<?php echo is_rtl() ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khaled Taha | Portfolio</title>
    <!-- Global JS Base URL Definition -->
    <script>
        const base_url_js = "<?php echo rtrim(base_url(), '/'); ?>";
    </script>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="<?php echo base_url(); ?>">Khaled<span class="text-gradient">.Taha</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home"><?php echo __('nav_home'); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#about"><?php echo __('nav_about'); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience"><?php echo __('nav_experience'); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#products"><?php echo __('nav_products'); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#software"><?php echo __('nav_software'); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact"><?php echo __('nav_contact'); ?></a></li>
                </ul>
                <?php if (get_lang() === 'ar'): ?>
                    <a href="?lang=en" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-globe me-1"></i> English</a>
                <?php else: ?>
                    <a href="?lang=ar" class="btn btn-sm btn-outline-light"><i class="fa-solid fa-globe me-1"></i> Arabic</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
