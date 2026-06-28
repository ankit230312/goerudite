@extends('layouts.app')

@section('title', 'Contact Us | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India. Manage and distribute digital textbooks with ease.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book distribution, CBSE ICSE digital books, LMS integration')

@section('content')

<style>
    /* =========================
CONTACT HERO
========================= */

.contact-hero-section {
    position: relative;
    padding: 70px 0;
    background: linear-gradient(135deg,#07152d,#0d1b38);
    overflow: hidden;
}

.contact-hero-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('https://i.postimg.cc/4y2Js4xn/contact-us.jpg') center/cover;
    opacity: 0.12;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg,rgba(3,7,18,.95),rgba(5,13,35,.82));
}

.contact-hero-content {
    position: relative;
    z-index: 2;
}

.contact-hero-content h1 {
    font-size: 64px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 10px;
}

.contact-hero-content h1 span {
    color: #f36522;
}

.hero-line {
    width: 80px;
    height: 4px;
    background: #f36522;
    border-radius: 30px;
    margin-bottom: 25px;
}

.contact-hero-content p {
    color: rgba(255,255,255,.85);
    line-height: 1.9;
    font-size: 17px;
    margin-bottom: 18px;
}

.hero-support-image img {
    width: 100%;
    max-width: 360px;
}

.hero-info-box {
    display: flex;
    align-items: center;
    gap: 18px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.08);
    padding: 22px;
    border-radius: 16px;
    margin-top: 30px;
}

.info-icon i {
    font-size: 30px;
    color: #fff;
}

.info-text {
    color: rgba(255,255,255,.82);
    line-height: 1.7;
    font-size: 15px;
}

/* =========================
MAIN SECTION
========================= */

.contact-main-section {
    background: #f5f7fb;
    padding: 60px 0;
}

/* SIDEBAR */

.contact-sidebar {
    background: #fff;
    border-radius: 18px;
    padding: 35px 30px;
    height: 100%;
    box-shadow: 0 5px 25px rgba(0,0,0,.04);
}

.contact-sidebar h3 {
    font-size: 32px;
    font-weight: 700;
    color: #14213d;
    margin-bottom: 18px;
}

.contact-sidebar p {
    color: #5f6472;
    line-height: 1.8;
    margin-bottom: 20px;
}

.support-item {
    display: flex;
    gap: 18px;
    padding: 22px 0;
    border-bottom: 1px solid #edf1f7;
}

.support-icon {
    min-width: 58px;
    height: 58px;
    border-radius: 14px;
    background: #f7f9fc;
    display: flex;
    align-items: center;
    justify-content: center;
}

.support-icon i {
    font-size: 24px;
    color: #3157b7;
}

.support-item h5 {
    font-size: 18px;
    font-weight: 700;
    color: #14213d;
    margin-bottom: 5px;
}

.support-item p {
    margin: 0;
    color: #5f6472;
}

/* FORM */

.contact-form-wrapper {
    background: #fff;
    border-radius: 18px;
    padding: 40px;
    box-shadow: 0 5px 25px rgba(0,0,0,.04);
}

.contact-form-wrapper h2 {
    font-size: 42px;
    font-weight: 800;
    color: #14213d;
    margin-bottom: 10px;
}

.contact-form-wrapper p {
    color: #5f6472;
    margin-bottom: 30px;
}

.contact-form-wrapper label {
    font-weight: 600;
    margin-bottom: 10px;
    color: #14213d;
}

.contact-form-wrapper .form-control {
    height: 54px;
    border-radius: 12px;
    border: 1px solid #e4e7ec;
    padding: 14px 16px;
    box-shadow: none;
}

.contact-form-wrapper textarea.form-control {
    height: auto;
}

.contact-form-wrapper .form-control:focus {
    border-color: #f36522;
    box-shadow: 0 0 0 3px rgba(243,101,34,.08);
}

/* ROLE GRID */

.role-grid {
    display: grid;
    grid-template-columns: repeat(5,1fr);
    gap: 14px;
}

.role-card {
    cursor: pointer;
}

.role-card input {
    display: none;
}

.role-inner {
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 20px 12px;
    text-align: center;
    transition: .3s;
    height: 100%;
    background: #fff;
}

.role-inner i {
    display: block;
    font-size: 28px;
    color: #3157b7;
    margin-bottom: 12px;
}

.role-inner span {
    font-size: 14px;
    font-weight: 600;
    color: #14213d;
    line-height: 1.5;
}

.role-card input:checked + .role-inner {
    border-color: #f36522;
    background: rgba(243,101,34,.06);
}

/* BUTTON */

.submit-btn-contact {
    border: none;
    background: #f36522;
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    border-radius: 12px;
    padding: 15px 34px;
    transition: .3s;
}

.submit-btn-contact:hover {
    background: #db581d;
}

.form-note {
    margin-top: 25px;
    text-align: center;
    color: #6b7280;
    font-size: 14px;
    line-height: 1.8;
}

.form-note i {
    color: #3157b7;
    margin-right: 5px;
}

/* MAP */

.map-wrapper {
    background: #fff;
    padding: 30px;
    border-radius: 18px;
    margin-top: 40px;
    box-shadow: 0 5px 25px rgba(0,0,0,.04);
}

.map-heading h3 {
    font-size: 30px;
    font-weight: 700;
    color: #14213d;
}

.map-heading p {
    color: #5f6472;
    margin-bottom: 25px;
}

.map-wrapper iframe {
    border-radius: 16px;
}

/* BOTTOM NOTE */

.bottom-note {
    margin-top: 30px;
    background: #fff;
    border-radius: 16px;
    padding: 22px;
    display: flex;
    gap: 16px;
    align-items: flex-start;
    box-shadow: 0 5px 25px rgba(0,0,0,.04);
    color: #4b5563;
    line-height: 1.8;
}

.note-icon i {
    font-size: 28px;
    color: #3157b7;
}

/* =========================
RESPONSIVE
========================= */

@media(max-width:1199px){

    .role-grid{
        grid-template-columns: repeat(3,1fr);
    }

    .contact-hero-content h1{
        font-size:52px;
    }
}

@media(max-width:991px){

    .contact-hero-section{
        padding:60px 0;
        text-align:center;
    }

    .hero-line{
        margin:auto auto 25px;
    }

    .hero-support-image{
        margin-top:40px;
    }

    .role-grid{
        grid-template-columns: repeat(2,1fr);
    }

    .contact-form-wrapper{
        padding:30px;
    }
}

@media(max-width:767px){

    .contact-hero-content h1{
        font-size:40px;
    }

    .contact-hero-content p{
        font-size:15px;
    }

    .hero-info-box{
        flex-direction:column;
        text-align:center;
    }

    .contact-sidebar,
    .contact-form-wrapper,
    .map-wrapper{
        padding:25px 20px;
    }

    .contact-form-wrapper h2{
        font-size:32px;
    }

    .role-grid{
        grid-template-columns: 1fr;
    }

    .bottom-note{
        flex-direction:column;
    }
}

@media(max-width:480px){

    .contact-hero-content h1{
        font-size:32px;
    }

    .contact-sidebar h3{
        font-size:26px;
    }

    .contact-form-wrapper h2{
        font-size:28px;
    }

    .submit-btn-contact{
        width:100%;
    }
}
</style>

    <!-- =========================
CONTACT HERO SECTION
========================= -->
<section class="contact-hero-section">
    <div class="hero-overlay"></div>

    <div class="container position-relative">

        <div class="row align-items-center">

            <!-- LEFT CONTENT -->
            <div class="col-lg-7">

                <div class="contact-hero-content">

                    <h1>
                        Contact <span>GoErudite</span>
                    </h1>

                    <div class="hero-line"></div>

                    <p>
                        Connect with GoErudite for platform guidance, account verification,
                        workflow assistance, and operational support across the education
                        supply ecosystem.
                    </p>

                    <p>
                        Our team supports schools, distributors, retailers, and publishers
                        with onboarding, role verification, RFQ workflows, approval visibility,
                        and platform navigation.
                    </p>

                    <!-- INFO BOX -->
                    <div class="hero-info-box">

                        <div class="info-icon">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <div class="info-text">
                            GoErudite operates solely as a technology facilitation platform
                            and does not participate in commercial negotiations, payments,
                            logistics, or textbook transactions.
                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT IMAGE -->
            <div class="col-lg-5 text-center">

                <div class="hero-support-image">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80" alt="Support">
                </div>

            </div>

        </div>
    </div>
</section>

<!-- =========================
CONTACT SECTION
========================= -->
<section class="contact-main-section">

    <div class="container">

        <div class="row g-4">

            <!-- LEFT SIDEBAR -->
            <div class="col-lg-4">

                <div class="contact-sidebar">

                    <h3>Platform Support Center</h3>

                    <p>
                        Need assistance with platform access, role verification,
                        workflow participation, or account-related activities?
                    </p>

                    <p>
                        Our support team helps verified stakeholders navigate
                        operational workflows with clarity and accountability.
                    </p>

                    <!-- ITEM -->
                    <div class="support-item">

                        <div class="support-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>

                        <div>
                            <h5>Office Location</h5>
                            <p>New Delhi, India</p>
                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="support-item">

                        <div class="support-icon">
                            <i class="fa-regular fa-clock"></i>
                        </div>

                        <div>
                            <h5>Support Hours</h5>
                            <p>Monday to Friday<br>9:00 AM – 6:00 PM IST</p>
                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="support-item">

                        <div class="support-icon">
                            <i class="fa-regular fa-envelope"></i>
                        </div>

                        <div>
                            <h5>Support Email</h5>
                            <p>support@goerudite.com</p>
                        </div>

                    </div>

                    <!-- ITEM -->
                    <div class="support-item border-0 pb-0">

                        <div class="support-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>

                        <div>
                            <h5>Business Support</h5>
                            <p>+91 85860 32007 </p>
                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT FORM -->
            <div class="col-lg-8">

                <div class="contact-form-wrapper">

                    <h2>Submit a Support Request</h2>

                    <p>
                        Share your platform-related query and our team will
                        review your request during business hours.
                    </p>

                    <form>

                        <!-- ROW -->
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>First Name *</label>
                                <input type="text" class="form-control" placeholder="Enter first name">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Last Name *</label>
                                <input type="text" class="form-control" placeholder="Enter last name">
                            </div>

                        </div>

                        <!-- EMAIL -->
                        <div class="mb-3">
                            <label>Business Email *</label>
                            <input type="email" class="form-control" placeholder="Enter business email address">
                        </div>

                        <!-- ROLE -->
                        <div class="mb-4">

                            <label class="d-block mb-3">
                                I represent *
                            </label>

                            <div class="role-grid">

                                <label class="role-card">
                                    <input type="radio" name="role">
                                    <div class="role-inner">
                                        <i class="fa-solid fa-school"></i>
                                        <span>School Administrator</span>
                                    </div>
                                </label>

                                <label class="role-card">
                                    <input type="radio" name="role">
                                    <div class="role-inner">
                                        <i class="fa-solid fa-truck"></i>
                                        <span>Distributor</span>
                                    </div>
                                </label>

                                <label class="role-card">
                                    <input type="radio" name="role">
                                    <div class="role-inner">
                                        <i class="fa-solid fa-store"></i>
                                        <span>Retailer</span>
                                    </div>
                                </label>

                                <label class="role-card">
                                    <input type="radio" name="role">
                                    <div class="role-inner">
                                        <i class="fa-solid fa-book-open"></i>
                                        <span>Publisher</span>
                                    </div>
                                </label>

                                <label class="role-card">
                                    <input type="radio" name="role">
                                    <div class="role-inner">
                                        <i class="fa-solid fa-user"></i>
                                        <span>Other User</span>
                                    </div>
                                </label>

                            </div>

                        </div>

                        <!-- MESSAGE -->
                        <div class="mb-4">
                            <label>Support Requirement *</label>
                            <textarea class="form-control" rows="5"
                                placeholder="Describe your platform query, verification request, workflow issue, or operational assistance needed."></textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="text-center">
                            <button type="submit" class="submit-btn-contact">
                                <i class="fa-solid fa-paper-plane"></i>
                                Submit Request
                            </button>
                        </div>

                        <!-- NOTE -->
                        <div class="form-note">
                            <i class="fa-solid fa-lock"></i>
                            Support submissions are reviewed during operational hours.
                            Response times may vary based on verification, compliance
                            review, and request complexity.
                        </div>

                    </form>

                </div>

            </div>

        </div>

        <!-- MAP -->
        <div class="map-wrapper">

            <div class="map-heading">
                <h3>Regional Support Presence</h3>
                <p>
                    Supporting education stakeholders across India through
                    structured digital operations.
                </p>
            </div>

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224346.4817712219!2d77.06889977170756!3d28.527280345774795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d047309fff4c1%3A0x5c63f5c68f6d7d6f!2sNew%20Delhi!5e0!3m2!1sen!2sin!4v1700000000000"
                width="100%"
                height="350"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>

        </div>

        <!-- FOOT NOTE -->
        <div class="bottom-note">

            <div class="note-icon">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <div>
                GoErudite support services are limited to platform access,
                operational guidance, verification, and workflow assistance.
                Commercial disputes, payments, delivery commitments, and
                procurement outcomes remain independently managed by approved users.
            </div>

        </div>

    </div>
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