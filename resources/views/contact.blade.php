@extends('layouts.app')

@section('title', 'Contact Us | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India. Manage and distribute digital textbooks with ease.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book distribution, CBSE ICSE digital books, LMS integration')

@section('content')

    <!-- Contact Banner -->
    <section class="hero-section-school" style="background: linear-gradient(rgba(12, 18, 32, 0.75),rgba(12, 18, 32, 0.75)),url('https://i.postimg.cc/4y2Js4xn/contact-us.jpg'); background-size: cover;  background-position: center;
        background-repeat: no-repeat;"> 
        <div class="hero-content-school">
            <h1 class="hero-title-school">
               Contact Us
            </h1>
            <p class="hero-description-school">
                We’re here to support schools, distributors, publishers, and education partners in managing their operations more efficiently and with complete clarity. Whether you need assistance with on boarding, 
                platform features, pricing plans, or compliance-related queries, the GoErudite team is ready to help. Reach out to us for product demonstrations, account support, partnership discussions, or technical 
                guidance. Our goal is to ensure that every user understands the platform, uses it responsibly, and benefits from a transparent, structured, and reliable education supply ecosystem.
            </p>
        </div>
    </section>

    <!-- Contact Info + Form -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">

            <!-- LEFT -->
            <div class="contact-info animate-left border p-3">
                <h2 class="text-dark">Get in Touch</h2>
                <p>
                Have questions about the platform, pricing, or need a custom demo?
                Our team is ready to assist you.
                </p>

                <div class="info-item">
                <span class="icon">📍</span>
                <div>
                    <strong class="text-dark">Headquarters</strong>
                    <p>Shadipur, Delhi West Patel Nagar<br>PIN Code – 110008</p>
                </div>
                </div>

                <div class="info-item">
                <span class="icon">📞</span>
                <div>
                    <strong class="text-dark">Phone</strong>
                    <p>+91 8586032007<br>Mon–Fri, 9am – 6pm IST</p>
                </div>
                </div>

                <div class="info-item">
                <span class="icon">✉️</span>
                <div>
                    <strong class="text-dark">Email</strong>
                    <p>support@goerudite.com</p>
                </div>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="contact-form-card animate-right">
                <h3 class="text-dark">Send us a message</h3>

                <form>
                <div class="form-row">
                    <input type="text" placeholder="First Name" required>
                    <input type="text" placeholder="Last Name" required>
                </div>

                <input type="email" placeholder="Email Address" required>

                <select required>
                    <option value="">I am a</option>
                    <option>School Administrator</option>
                    <option>Distributor</option>
                    <option>Retailer</option>
                    <option>Publisher</option>
                    <option>Other</option>
                </select>

                <textarea placeholder="Message" rows="4" required></textarea>

                <button type="submit">
                    ✈️ Send Message
                </button>
                </form>
            </div>

            </div>
        </div>
    </section>



    <!-- Map Section -->
    <section class="map-section animate-fade-in">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14736.838046804005!2d75.8577271!3d22.7195683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3963027cc6a011cf%3A0x9b054b022cb35c!2sIndore%2C%20Madhya%20Pradesh!5e0!3m2!1sen!2sin!4v1709980000000" 
            width="100%" 
            height="350" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </section>


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const formMessage = document.getElementById('formMessage');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!validateForm()) return;

                const submitBtn = form.querySelector('.submit-btn');
                const btnText = submitBtn.querySelector('.btn-text');
                const btnLoader = submitBtn.querySelector('.btn-loader');

                submitBtn.classList.add('loading');
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline';

                const formData = new FormData(form);

                fetch('process_contact.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        formMessage.textContent = 'Message sent successfully!';
                        formMessage.className = 'form-message success';
                        form.reset();
                    } else {
                        formMessage.textContent = data.message || 'An error occurred.';
                        formMessage.className = 'form-message error';
                    }
                })
                .catch(error => {
                    formMessage.textContent = 'An error occurred. Please try again.';
                    formMessage.className = 'form-message error';
                })
                .finally(() => {
                    submitBtn.classList.remove('loading');
                    btnText.style.display = 'inline';
                    btnLoader.style.display = 'none';
                });
            });
        }

        function validateForm() {
            const inputs = form.querySelectorAll('.form-control');
            let isValid = true;

            inputs.forEach(input => {
                const errorMsg = input.parentElement.querySelector('.error-msg');
                if (!input.value.trim()) {
                    errorMsg.textContent = 'This field is required';
                    isValid = false;
                } else if (input.type === 'email' && !isValidEmail(input.value)) {
                    errorMsg.textContent = 'Please enter a valid email';
                    isValid = false;
                } else {
                    errorMsg.textContent = '';
                }
            });

            return isValid;
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
    });
</script>
@endpush