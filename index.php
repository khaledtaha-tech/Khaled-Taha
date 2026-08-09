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
                    <div class="card-icon mx-auto">
                        <i class="fa-solid fa-industry"></i>
                    </div>
                    <h5>Factory Management</h5>
                    <p>19+ years leading plastic extrusion plants, optimizing production capacity, labor allocation, and machine efficiency.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom text-center">
                    <div class="card-icon mx-auto">
                        <i class="fa-solid fa-flask"></i>
                    </div>
                    <h5>PVC Formulations</h5>
                    <p>Expert in uPVC, CPVC, and HDPE raw material compounding, cost reduction, and material density control.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-custom text-center">
                    <div class="card-icon mx-auto">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <h5>Manufacturing Software</h5>
                    <p>Developing custom algorithms and desktop/web tools for pipe weight calculation, OEE tracking, and inventory planning.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section id="experience" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Professional Experience</h2>
            <p class="section-desc">Track record in managing plastic manufacturing plants across Egypt and Saudi Arabia</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date">Jan 2025 - Present</span>
                            <h5>Manufacturing Manager - Salem Balhamer Holding</h5>
                            <p class="text-muted">Overseeing operational management, factory workflow optimization, machine allocation, and quality systems across production lines.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date">2020 - Dec 2024</span>
                            <h5>Production Manager - Saudi Industries for Pipes (SIP)</h5>
                            <p class="text-muted">Managed high-capacity extrusion lines for uPVC and HDPE pipes, optimized compounding formulas, and achieved up to 35% reduction in scrap rates.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date">2016 - 2020</span>
                            <h5>Technical Operations Specialist - Fabco Plastic & Wintek</h5>
                            <p class="text-muted">Led technical trials, die design modifications (400mm & 500mm pipe dies), and developed custom TDS and shift performance dashboards.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="card-custom">
                            <span class="timeline-date">2007 - 2016</span>
                            <h5>Production Engineer - Al-Manar & Al Rajhi Factory</h5>
                            <p class="text-muted">Hands-on management of twin & single screw extrusion lines, raw material compounding, and preventive maintenance coordination.</p>
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
            <h2 class="section-title">Technical Products & Processing</h2>
            <p class="section-desc">Extensive technical background in extruding and molding high-grade plastic components</p>
        </div>
        <div class="row g-3">
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>uPVC Pressure & Sewer Pipes</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>CPVC High Temp Pipes</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>HDPE PE80 & PE100 Pipes</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>PP Hot Water Pipe Systems</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>DWC Corrugated Pipes</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>Telecom Duct & Sub-Duct</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>Microduct & COD Systems</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>Electrical Conduit Pipes</span></div></div>
            <div class="col-md-4 col-sm-6"><div class="product-badge"><i class="fa-solid fa-circle-check"></i><span>PVC Injection Fittings</span></div></div>
        </div>
    </div>
</section>

<!-- Software Store Section -->
<section id="software" class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Engineering Software Store</h2>
            <p class="section-desc">Custom-built software tools designed specifically for pipe factories and manufacturing managers</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="software-card">
                    <div>
                        <span class="tag-badge mb-2 d-inline-block">Extrusion Tool</span>
                        <h5 class="text-white fw-bold">Pipe Weight Calculator</h5>
                        <p class="text-muted small mb-4">Instant weight and cost estimation based on pipe dimensions, material density, and PHR calcium carbonate ratio.</p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="software-price">$49.00</span>
                            <span class="badge bg-secondary">v2.1</span>
                        </div>
                        <a href="#contact" class="btn btn-custom-outline w-100">Request Tool</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="software-card">
                    <div>
                        <span class="tag-badge mb-2 d-inline-block">Operations</span>
                        <h5 class="text-white fw-bold">OEE & Scrap Dashboard</h5>
                        <p class="text-muted small mb-4">Complete production tracking tool to measure machine efficiency, shift output, downtime, and scrap percentages.</p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="software-price">$99.00</span>
                            <span class="badge bg-secondary">v1.4</span>
                        </div>
                        <a href="#contact" class="btn btn-custom-outline w-100">Request Tool</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="software-card">
                    <div>
                        <span class="tag-badge mb-2 d-inline-block">Planning</span>
                        <h5 class="text-white fw-bold">Labor & Machine Allocator</h5>
                        <p class="text-muted small mb-4">Smart planning spreadsheet system to balance daily workloads, technician shifts, and operational capacities.</p>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="software-price">$79.00</span>
                            <span class="badge bg-secondary">v3.0</span>
                        </div>
                        <a href="#contact" class="btn btn-custom-outline w-100">Request Tool</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<!-- Contact Section -->
<section id="contact" class="section-padding bg-section-alt">
    <div class="container">
        <div class="row gy-5 align-items-center">
            <div class="col-lg-5">
                <h2 class="section-title mb-3">Get in Touch</h2>
                <p class="section-desc mb-4">Available for factory consultations, PVC formulation reviews, operational improvements, or custom software licensing.</p>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="card-icon"><i class="fab fa-whatsapp"></i></div>
                    <div>
                        <span class="text-muted small d-block">WhatsApp / Mobile</span>
                        <span class="text-white fw-bold fs-5">+966 55 984 8021</span>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="card-icon"><i class="fa-solid fa-envelope"></i></div>
                    <div>
                        <span class="text-muted small d-block">Email Address</span>
                        <span class="text-white fw-bold fs-6">khaled.taha.pro@gmail.com</span>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="card-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <span class="text-muted small d-block">Location</span>
                        <span class="text-white fw-bold fs-6">Riyadh, Saudi Arabia</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-card-wrapper">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label-custom">Your Name</label>
                                <input type="text" class="form-control form-control-custom" placeholder="e.g. Eng. Ahmed">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Company / Factory Name</label>
                                <input type="text" class="form-control form-control-custom" placeholder="e.g. Plastic Co.">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Email Address</label>
                                <input type="email" class="form-control form-control-custom" placeholder="name@company.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom">Inquiry Type</label>
                                <select class="form-select form-control-custom form-select-custom">
                                    <option selected disabled>Select Service / Tool</option>
                                    <option value="software">Software Purchase Request</option>
                                    <option value="consultation">Factory Consultation</option>
                                    <option value="pvc_formula">PVC Formulation Review</option>
                                    <option value="other">General Inquiry</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label-custom">Message Details</label>
                                <textarea class="form-control form-control-custom" rows="4" placeholder="Write your requirements or details here..."></textarea>
                            </div>
                            <div class="col-md-12 pt-2">
                                <button type="button" class="btn btn-custom-primary w-100 py-3 fs-6">Send Request</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/views/layouts/footer.php'; ?>