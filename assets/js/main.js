document.addEventListener('DOMContentLoaded', () => {
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
});


// WhatsApp Order Direct Redirection
document.addEventListener('DOMContentLoaded', () => {
    const phoneNumber = "966559848021"; // Your WhatsApp Number

    const orderButtons = document.querySelectorAll('.btn-order-whatsapp');
    orderButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productPrice = button.getAttribute('data-product-price');

            // Format WhatsApp Message dynamically
            const message = `Hello Eng. Khaled,\nI would like to request/inquire about the following tool:\n\n📌 *Tool Name:* ${productName}\n🆔 *Tool ID:* ${productId}\n💰 *Price:* ${productPrice}\n\nPlease provide me with details regarding payment and delivery.`;

            const encodedMessage = encodeURIComponent(message);
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

            // Open WhatsApp in a new tab
            window.open(whatsappUrl, '_blank');
        });
    });
});



document.addEventListener('DOMContentLoaded', () => {
    const phoneNumber = "966559848021";
    const orderButtons = document.querySelectorAll('.btn-order-whatsapp');

    orderButtons.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productPrice = button.getAttribute('data-product-price');

            // Log WhatsApp Order
            try {
                const formData = new FormData();
                formData.append('product_id', productId);
                formData.append('product_name', productName);
                formData.append('price', productPrice);

                fetch(base_url_js + '/api/whatsapp_logger.php', {
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
});
