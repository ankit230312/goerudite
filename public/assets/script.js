   // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // login and signup form flip js 
        function flipForm() {
            const formContainer = document.getElementById('formContainer');
            formContainer.classList.toggle('flipped');
        }

        function togglePassword(icon) {
            const input = icon.previousElementSibling;
            if (input.type === 'password') {
                input.type = 'text';
                icon.textContent = '🙈';
            } else {
                input.type = 'password';
                icon.textContent = '👁️';
            }
        }

        // Handle form submissions
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('loginBtn');
            btn.classList.add('loading');
            
            // Simulate API call
            setTimeout(() => {
                btn.classList.remove('loading');
                showSuccessMessage('Login successful! Welcome back!');
            }, 2000);
        });

        document.getElementById('signupForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = document.getElementById('signupBtn');
            const passwords = this.querySelectorAll('input[type="password"]');
            
            if (passwords[0].value !== passwords[1].value) {
                alert('Passwords do not match!');
                return;
            }
            
            btn.classList.add('loading');
            
            // Simulate API call
            setTimeout(() => {
                btn.classList.remove('loading');
                showSuccessMessage('Account created successfully! Welcome!');
            }, 2000);
        });

        function showSuccessMessage(message) {
            const activeForm = document.querySelector('.form-side:not([style*="transform"])') || 
                             document.querySelector('.login-form');
            const existingMessage = activeForm.querySelector('.success-message');
            
            if (existingMessage) {
                existingMessage.remove();
            }
            
            const successDiv = document.createElement('div');
            successDiv.className = 'success-message';
            successDiv.textContent = message;
            
            const form = activeForm.querySelector('form');
            activeForm.insertBefore(successDiv, form);
            
            setTimeout(() => {
                successDiv.remove();
            }, 3000);
        }

        // Add input focus animations
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add floating animation to shapes on scroll/interaction
        document.addEventListener('mousemove', function(e) {
            const shapes = document.querySelectorAll('.shape');
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.01;
                const x = e.clientX * speed;
                const y = e.clientY * speed;
                shape.style.transform = `translate(${x}px, ${y}px)`;
            });
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                const focusedElement = document.activeElement;
                if (focusedElement.classList.contains('form-input')) {
                    focusedElement.style.borderColor = '#667eea';
                }
            }
        });

        