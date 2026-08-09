<footer class="footer-upgraded">
        <div class="container">
            <div class="row g-4 mb-5">
                <div class="col-lg-4">
                    <a class="navbar-brand fw-bold fs-3 d-block mb-3" href="<?php echo base_url(); ?>">Khaled<span class="text-gradient">.Taha</span></a>
                    <p class="text-muted fs-6 mb-4" style="max-width: 320px;">
                        <?php echo __('footer_desc'); ?>
                    </p>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/966559848021" target="_blank" class="social-icon-btn"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://linkedin.com" target="_blank" class="social-icon-btn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="mailto:eng.khaledabdelraheem@gmail.com" class="social-icon-btn"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <h6 class="text-white fw-bold mb-3"><?php echo __('footer_quick_links'); ?></h6>
                    <a href="#home" class="footer-link"><?php echo __('nav_home'); ?></a>
                    <a href="#about" class="footer-link"><?php echo __('nav_about'); ?></a>
                    <a href="#experience" class="footer-link"><?php echo __('nav_experience'); ?></a>
                    <a href="#products" class="footer-link"><?php echo __('nav_products'); ?></a>
                    <a href="#software" class="footer-link"><?php echo __('nav_software'); ?></a>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h6 class="text-white fw-bold mb-3"><?php echo __('footer_core_expertise'); ?></h6>
                    <span class="footer-link"><?php echo __('footer_exp1'); ?></span>
                    <span class="footer-link"><?php echo __('footer_exp2'); ?></span>
                    <span class="footer-link"><?php echo __('footer_exp3'); ?></span>
                    <span class="footer-link"><?php echo __('footer_exp4'); ?></span>
                    <span class="footer-link"><?php echo __('footer_exp5'); ?></span>
                </div>

                <div class="col-lg-3 col-md-4">
                    <h6 class="text-white fw-bold mb-3"><?php echo __('footer_contact_info'); ?></h6>
                    <p class="text-muted fs-6 mb-2"><i class="fa-solid fa-location-dot text-primary me-2"></i> <?php echo __('contact_location_val'); ?></p>
                    <p class="text-muted fs-6 mb-2"><i class="fa-solid fa-phone text-primary me-2"></i> +966 55 984 8021</p>
                    <p class="text-muted fs-6 mb-0"><i class="fa-solid fa-envelope text-primary me-2"></i> khaled.taha.pro@gmail.com</p>
                </div>
            </div>

            <hr style="border-color: rgba(255,255,255,0.08);">

            <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 text-muted small">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> Khaled Taha. <?php echo __('footer_rights'); ?></p>
                <p class="mb-0">Built with Native PHP & Modern CSS</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>
</html>
