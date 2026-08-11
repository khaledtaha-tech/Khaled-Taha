document.addEventListener('DOMContentLoaded', () => {

    // 1. Scroll Reveal Animations (Intersection Observer)
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -80px 0px',
        threshold: 0.1
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const elementsToReveal = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
    elementsToReveal.forEach(element => revealObserver.observe(element));


    // 2. WhatsApp Order Direct Redirection & Logging
    const phoneNumber = "966559848021";
    const orderButtons = document.querySelectorAll('.btn-order-whatsapp');

    orderButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productPrice = button.getAttribute('data-product-price');

            // Log WhatsApp Order to API
            try {
                const formData = new FormData();
                formData.append('product_id', productId);
                formData.append('product_name', productName);
                formData.append('price', productPrice);

                const targetLogUrl = (typeof base_url_js !== 'undefined' ? base_url_js : '') + '/api/whatsapp_logger.php';
                fetch(targetLogUrl, {
                    method: 'POST',
                    body: formData
                });
            } catch (err) {
                console.error('Logging error:', err);
            }

            // Redirect to WhatsApp
            const message = `Hello Eng. Khaled,\nI would like to request/inquire about the following tool:\n\n📌 *Tool Name:* ${productName}\n🆔 *Tool ID:* ${productId}\n💰 *Price:* ${productPrice}\n\nPlease provide me with details regarding payment and delivery.`;
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        });
    });


    // 3. Contact Form AJAX Submission
    const contactForm = document.getElementById('mainContactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = contactForm.querySelector('button[type="submit"]');
            const alertBox = document.getElementById('formAlertResponse');

            submitBtn.disabled = true;
            const originalText = submitBtn.innerText;
            submitBtn.innerText = 'Sending...';

            const formData = new FormData(contactForm);
            const targetContactUrl = (typeof base_url_js !== 'undefined' ? base_url_js : '') + '/api/contact_handler.php';

            try {
                const response = await fetch(targetContactUrl, {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (alertBox) {
                    alertBox.classList.remove('d-none', 'alert-danger', 'alert-success');
                    if (result.success) {
                        alertBox.classList.add('alert-success');
                        alertBox.innerText = result.message;
                        contactForm.reset();
                    } else {
                        alertBox.classList.add('alert-danger');
                        alertBox.innerText = result.message;
                    }
                }
            } catch (err) {
                if (alertBox) {
                    alertBox.classList.remove('d-none', 'alert-success');
                    alertBox.classList.add('alert-danger');
                    alertBox.innerText = 'An error occurred while sending your message.';
                }
            } finally {
                submitBtn.disabled = false;
                submitBtn.innerText = originalText;
            }
        });
    }

});
