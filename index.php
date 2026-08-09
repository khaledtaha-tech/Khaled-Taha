<?php require_once __DIR__ . '/views/layouts/header.php'; ?>

<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center gy-5">
            <div class="col-lg-7">
                <span class="text-uppercase hero-subtitle mb-2 d-block"><?php echo __('welcome_tag'); ?></span>
                <h1 class="display-3 fw-extrabold text-white mb-2"><?php echo __('hero_name'); ?></h1>
                <h3 class="h4 mb-3"><span class="text-gradient"><?php echo __('hero_title'); ?></span></h3>
                <p class="fs-6 mb-4 text-light fw-medium"><?php echo __('hero_subtitle'); ?></p>
                <p class="lead text-secondary mb-5 fs-6" style="max-width: 620px;">
                    <?php echo __('hero_desc'); ?>
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#experience" class="btn-custom-primary"><?php echo __('btn_projects'); ?></a>
                    <a href="#software" class="btn-custom-outline"><?php echo __('btn_software'); ?></a>
                    <a href="https://wa.me/966559848021" target="_blank" class="btn-custom-whatsapp"><i class="fab fa-whatsapp me-1"></i> <?php echo __('btn_contact'); ?></a>
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <div class="profile-avatar-placeholder">
                    <i class="fa-solid fa-user-tie text-secondary fs-1 mb-2"></i>
                    <span class="text-muted small">Khaled Taha</span>
                    <div class="badge-experience">
                        <span class="fs-5">19+</span> <span><?php echo __('years_exp'); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section-padding bg-section-alt">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title"><?php echo __('about_title'); ?></h2>
            <p class="section-desc mx-auto" style="max-width: 700px;"><?php echo __('about_desc'); ?></p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card-custom text-center">
                    <div class="card-icon mx-auto"><i class="fa-solid fa-industry"></i></div>
                    <h5><?php echo __('about_card1_title'); ?></h5>
                    <p><?php echo __('about_card1_desc'); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom text-center">
                    <div class="card-icon mx-auto"><i class="fa-solid fa-flask"></i></div>
                    <h5><?php echo __('about_card2_title'); ?></h5>
                    <p><?php echo __('about_card2_desc'); ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom text-center">
                    <div class="card-icon mx-auto"><i class="fa-solid fa-laptop-code"></i></div>
                    <h5><?php echo __('about_card3_title'); ?></h5>
                    <p><?php echo __('about_card3_desc'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section id="experience" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title"><?php echo __('exp_title'); ?></h2>
            <p class="section-desc"><?php echo __('exp_subtitle'); ?></p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date"><?php echo __('exp_job1_date'); ?></span>
                            <h5><?php echo __('exp_job1_title'); ?></h5>
                            <p class="text-muted"><?php echo __('exp_job1_desc'); ?></p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date"><?php echo __('exp_job2_date'); ?></span>
                            <h5><?php echo __('exp_job2_title'); ?></h5>
                            <p class="text-muted"><?php echo __('exp_job2_desc'); ?></p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date"><?php echo __('exp_job3_date'); ?></span>
                            <h5><?php echo __('exp_job3_title'); ?></h5>
                            <p class="text-muted"><?php echo __('exp_job3_desc'); ?></p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date"><?php echo __('exp_job4_date'); ?></span>
                            <h5><?php echo __('exp_job4_title'); ?></h5>
                            <p class="text-muted"><?php echo __('exp_job4_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technical Products Section -->
<section id="products" class="section-padding bg-section-alt">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title"><?php echo __('products_title'); ?></h2>
            <p class="section-desc"><?php echo __('products_subtitle'); ?></p>
        </div>
        <div class="row g-3">
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_1'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_2'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_3'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_4'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_5'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_6'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_7'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_8'); ?></span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span><?php echo __('prod_9'); ?></span></div></div>
        </div>
    </div>
</section>

<!-- Software Store Section -->
<section id="software" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title"><?php echo __('software_title'); ?></h2>
            <p class="section-desc"><?php echo __('software_subtitle'); ?></p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="software-card">
                    <div>
                        <span class="tag-badge mb-2 d-inline-block"><?php echo __('soft_tag1'); ?></span>
                        <h5 class="text-white fw-bold"><?php echo __('soft_title1'); ?></h5>
                        <p class="text-muted small mb-4"><?php echo __('soft_desc1'); ?></p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="software-price">$49.00</span>
                            <span class="badge bg-secondary">v2.1</span>
                        </div>
                        <a href="#contact" class="btn btn-custom-outline w-100"><?php echo __('btn_request_tool'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="software-card">
                    <div>
                        <span class="tag-badge mb-2 d-inline-block"><?php echo __('soft_tag2'); ?></span>
                        <h5 class="text-white fw-bold"><?php echo __('soft_title2'); ?></h5>
                        <p class="text-muted small mb-4"><?php echo __('soft_desc2'); ?></p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="software-price">$99.00</span>
                            <span class="badge bg-secondary">v1.4</span>
                        </div>
                        <a href="#contact" class="btn btn-custom-outline w-100"><?php echo __('btn_request_tool'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="software-card">
                    <div>
                        <span class="tag-badge mb-2 d-inline-block"><?php echo __('soft_tag3'); ?></span>
                        <h5 class="text-white fw-bold"><?php echo __('soft_title3'); ?></h5>
                        <p class="text-muted small mb-4"><?php echo __('soft_desc3'); ?></p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="software-price">$79.00</span>
                            <span class="badge bg-secondary">v3.0</span>
                        </div>
                        <a href="#contact" class="btn btn-custom-outline w-100"><?php echo __('btn_request_tool'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section-padding bg-section-alt">
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-5">
                <h2 class="section-title mb-3"><?php echo __('contact_title'); ?></h2>
                <p class="section-desc mb-4"><?php echo __('contact_desc'); ?></p>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="card-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <span class="text-muted small d-block"><?php echo __('contact_label_whatsapp'); ?></span>
                        <span class="text-white fw-bold fs-5">+966 55 984 8021</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="card-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <span class="text-muted small d-block"><?php echo __('contact_label_email'); ?></span>
                        <span class="text-white fw-bold fs-6">khaled.taha.pro@gmail.com</span>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="card-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <span class="text-muted small d-block"><?php echo __('contact_label_location'); ?></span>
                        <span class="text-white fw-bold fs-6"><?php echo __('contact_location_val'); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="contact-card-wrapper">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom"><?php echo __('form_name_label'); ?></label>
                                <input type="text" class="form-control form-control-custom" placeholder="<?php echo __('form_name_placeholder'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom"><?php echo __('form_company_label'); ?></label>
                                <input type="text" class="form-control form-control-custom" placeholder="<?php echo __('form_company_placeholder'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom"><?php echo __('form_email_label'); ?></label>
                                <input type="email" class="form-control form-control-custom" placeholder="<?php echo __('form_email_placeholder'); ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom"><?php echo __('form_inquiry_label'); ?></label>
                                <select class="form-select form-control-custom form-select-custom">
                                    <option selected disabled><?php echo __('form_inquiry_select'); ?></option>
                                    <option value="software"><?php echo __('form_opt_software'); ?></option>
                                    <option value="consultation"><?php echo __('form_opt_consultation'); ?></option>
                                    <option value="pvc_formula"><?php echo __('form_opt_pvc'); ?></option>
                                    <option value="other"><?php echo __('form_opt_other'); ?></option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-custom"><?php echo __('form_message_label'); ?></label>
                                <textarea class="form-control form-control-custom" rows="4" placeholder="<?php echo __('form_message_placeholder'); ?>"></textarea>
                            </div>
                            <div class="col-md-12 pt-2">
                                <button type="button" class="btn btn-custom-primary w-100 py-3 fs-6"><?php echo __('form_btn_send'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/views/layouts/footer.php'; ?>
