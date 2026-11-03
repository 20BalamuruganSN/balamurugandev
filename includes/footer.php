<?php
// includes/footer.php
?>

    <!-- WhatsApp Float -->
    <a href="https://wa.me/919384902854?text=Hi%20Bala,%20I'm%20interested%20in%20your%20services." target="_blank" class="whatsapp-float" title="Chat on WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Subscription / Contact Modal -->
    <div id="subscriptionModal" class="modal-overlay">
        <div class="modal-content">
            <button class="btn-close" onclick="closeSubscriptionModal()">&times;</button>
            <h2 class="text-2xl font-extrabold text-slate-900 mb-2">Let's Work Together</h2>
            <p class="text-sm text-slate-500 mb-6">Fill out the form and I'll get back to you via WhatsApp or Email.</p>
            
            <form id="subscriptionForm" onsubmit="handleFormSubmit(event)">
                <input type="text" id="subName" class="form-input" placeholder="Your Name" required>
                <input type="email" id="subEmail" class="form-input" placeholder="Your Email" required>
                <input type="tel" id="subPhone" class="form-input" placeholder="Your Phone Number" required>
                
                <p class="text-sm font-bold text-slate-700 mt-4 mb-2">I'm interested in:</p>
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="plan" value="CRM Subscription (₹1500/mo)" checked>
                        <div>
                            <strong class="text-slate-800">Work Smart CRM</strong>
                            <p class="text-xs text-slate-500">₹1500/month subscription</p>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="plan" value="Website Development">
                        <div>
                            <strong class="text-slate-800">Website Development</strong>
                            <p class="text-xs text-slate-500">Custom web applications</p>
                        </div>
                    </label>
                    <label class="radio-option">
                        <input type="radio" name="plan" value="Android Development">
                        <div>
                            <strong class="text-slate-800">Android Development</strong>
                            <p class="text-xs text-slate-500">React Native mobile apps</p>
                        </div>
                    </label>
                </div>

                <button type="submit" class="btn-submit mt-4" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> Send Request
                </button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById("navbar");
        window.addEventListener("scroll", () => {
            navbar.classList.toggle("scrolled", window.scrollY > 30);
        });

        // Mobile menu toggle
        const menuButton = document.getElementById("menuButton");
        const mobileMenu = document.getElementById("mobileMenu");
        menuButton.addEventListener("click", () => mobileMenu.classList.toggle("hidden"));
        document.querySelectorAll("#mobileMenu a").forEach(link => {
            link.addEventListener("click", () => mobileMenu.classList.add("hidden"));
        });

        // Scroll reveal animations
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("active");
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll(".reveal").forEach(el => revealObserver.observe(el));

        // Modal Logic
        function openSubscriptionModal() {
            document.getElementById('subscriptionModal').classList.add('active');
        }

        function closeSubscriptionModal() {
            document.getElementById('subscriptionModal').classList.remove('active');
        }

        // Notification System
        function showNotification(message, type = 'success') {
            const notif = document.createElement('div');
            notif.className = `notification ${type}`;
            notif.innerHTML = message;
            document.body.appendChild(notif);
            setTimeout(() => notif.classList.add('show'), 100);
            setTimeout(() => {
                notif.classList.remove('show');
                setTimeout(() => notif.remove(), 300);
            }, 4000);
        }

        // Handle Form Submit (Ajax to PHP)
        async function handleFormSubmit(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            btn.disabled = true;

            const formData = {
                name: document.getElementById('subName').value,
                email: document.getElementById('subEmail').value,
                phone: document.getElementById('subPhone').value,
                plan: document.querySelector('input[name="plan"]:checked').value
            };

            try {
                const response = await fetch('/api/contact.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showNotification('✅ Request sent! Check your WhatsApp shortly.', 'success');
                    closeSubscriptionModal();
                    document.getElementById('subscriptionForm').reset();
                } else {
                    throw new Error(result.message || 'Failed to send');
                }
            } catch (error) {
                console.error('Error:', error);
                // WhatsApp Fallback if email fails
                const msg = `Hi Bala, I'm interested in *${formData.plan}*.\n\nName: ${formData.name}\nEmail: ${formData.email}\nPhone: ${formData.phone}`;
                window.open(`https://wa.me/919384902854?text=${encodeURIComponent(msg)}`, '_blank');
                showNotification('Opening WhatsApp to complete request...', 'success');
                closeSubscriptionModal();
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        }
    </script>
</body>
</html>