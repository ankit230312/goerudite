@extends('layouts.app')

@section('title', 'Pricing | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India. Manage and distribute digital textbooks with ease.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book distribution, CBSE ICSE digital books, LMS integration')

@section('content')

    <!-- Hero Section -->
     <section class="hero-section-school" style="background: linear-gradient(rgba(12, 18, 32, 0.75),rgba(12, 18, 32, 0.75)),url('https://i.postimg.cc/02rWdqwH/calculator.jpg'); background-size: cover;  background-position: center;
        background-repeat: no-repeat;"> 
        <div class="hero-content-school">
            <h1 class="hero-title-school">
                Transparent Pricing
            </h1>

            <p class="hero-description-school">
                Choose a plan that fits your role in the education supply chain.
            </p>

            <div class="hero-buttons">
                <a href="login.php" class="btn btn-getstarted" style="background-color: #f36522;">Get Started</a>
            </div>
        </div>
    </section>

    <section class="pricing-section">
        <div class="container">
            <div class="row g-4">

            <!-- Discovery Plan -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card text-center">
                <h6 class="plan-title">Discovery Plan</h6>
                <p class="plan-for">For Schools & Public Users</p>

                <div class="price free">Free <span>/ Forever</span></div>
                <p class="price-note">Explore catalogs and verify academic details</p>

                <ul class="feature-list">
                    <li class="yes">Access to public book catalogs</li>
                    <li class="yes">ISBN & session verification</li>
                    <li class="yes">Publisher profile viewing</li>
                    <li class="yes">Basic academic filters</li>
                    <li class="no">No ordering access</li>
                    <li class="no">No AI features</li>
                    <li class="no">No audit logs</li>
                </ul>

                <div style="text-align: center; margin-top: 2rem;">
                    <a href="#" class="btn btn-orange">Get Started</a>
                </div>
                </div>
            </div>

            <!-- Retailer Basic -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card popular text-center">
                <span class="popular-badge">MOST POPULAR</span>

                <h6 class="plan-title">Retailer Basic</h6>
                <p class="plan-for">For Bookshops</p>

                <div class="price" style="color: #f97316">₹1000 <span>/ month</span></div>
                <p class="price-note">Essential POS & inventory tools</p>

                <ul class="feature-list">
                    <li class="yes">Offline-ready POS system</li>
                    <li class="yes">Inventory management</li>
                    <li class="yes">Customer ledger (udhaar)</li>
                    <li class="yes">Daily sales reports</li>
                    <li class="yes">Up to 3 users</li>
                    <li class="yes">Ordering access</li>
                    <li class="no">No AI access</li>
                    <li class="no">No audit logs</li>
                </ul>

                <div style="text-align: center;">
                    <a href="#" class="btn btn-orange">Get Started</a>
                </div>
                </div>
            </div>

            <!-- Distributor Pro -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card text-center">
                <h6 class="plan-title">Distributor Pro</h6>
                <p class="plan-for">For Distributors</p>

                <div class="price" style="color: #f97316">₹2,499 <span>/ month</span></div>
                <p class="price-note">Warehouse & logistics control</p>

                <ul class="feature-list">
                    <li class="yes">Unlimited order handling</li>
                    <li class="yes">Warehouse bin & stock mgmt</li>
                    <li class="yes">ASN & dispatch tools</li>
                    <li class="yes">Returns management</li>
                    <li class="yes">Basic academic filters</li>
                    <li class="yes">Up to 10 users</li>
                </ul>

                <div style="text-align: center; margin-top: 5rem;">
                    <a href="#" class="btn btn-orange">Get Started</a>
                </div>
                </div>
            </div>

            <!-- Enterprise -->
            <div class="col-md-6 col-lg-3">
                <div class="pricing-card text-center">
                <h6 class="plan-title">Enterprise</h6>
                <p class="plan-for">For Publishers & Large Chains</p>

                <div class="price" style="color: #f97316">₹5000 <span>/ month</span></div>
                <p class="price-note">Advanced analytics & integrations</p>

                <ul class="feature-list">
                    <li class="yes">ISBN-based catalog mgmt</li>
                    <li class="yes">Public & private catalogs</li>
                    <li class="yes">AI demand forecasting</li>
                    <li class="yes">Publisher profile viewing</li>
                    <li class="yes">Regional heatmaps</li>
                    <li class="yes">Dedicated account manager</li>
                </ul>

                <div style="text-align: center; margin-top: 5rem;">
                    <a href="#" class="btn btn-orange">Get Started</a>
                </div>
                </div>
            </div>

            </div>
        </div>
    </section>

    <!-- Additional Info -->
    <section class="enterprise-billing-section">
        <div class="container">
            
            <div class="billing-header text-center">
            <h6 class="billing-tag">Enterprise & B2B Billing</h6>
            <p class="billing-intro">
                For schools and large distribution networks, GoErudite offers custom credit terms,
                invoice-based billing, and dedicated settlement windows.
            </p>
            </div>

            <div class="billing-list">

            <div class="billing-item">
                <span class="billing-number">1</span>
                <div>
                <h5>Pricing & Subscription Scope</h5>
                <p>
                    All prices on GoErudite are subscription fees for software access only.
                    The platform does not control textbook pricing, discounts, margins, or
                    commercial terms between users.
                </p>
                </div>
            </div>

            <div class="billing-item">
                <span class="billing-number">2</span>
                <div>
                <h5>Free Trial, Billing & Taxes</h5>
                <p>
                    All new users receive a one-month free trial. Subscriptions are billed
                    after the trial unless cancelled. Prices exclude GST and applicable taxes.
                </p>
                </div>
            </div>

            <div class="billing-item">
                <span class="billing-number">3</span>
                <div>
                <h5>Features, Access & Enterprise Plans</h5>
                <p>
                    Plan features represent maximum capabilities and may vary by role,
                    verification, and compliance status. Enterprise pricing is governed
                    by written agreements.
                </p>
                </div>
            </div>

            <div class="billing-item">
                <span class="billing-number">4</span>
                <div>
                <h5>No Commercial Liability</h5>
                <p>
                    GoErudite is not liable for pricing disputes, payment delays, revenue loss,
                    or business interruptions. All commercial transactions occur directly
                    between registered users.
                </p>
                </div>
            </div>

            <div class="billing-item">
                <span class="billing-number">5</span>
                <div>
                <h5>Market Positioning & Legal Clarity</h5>
                <p>
                    GoErudite pricing aligns with Indian SaaS standards. Enterprise plans start
                    from ₹5,000/month (annual billing) with custom scope-based pricing.
                </p>
                </div>
            </div>

            </div>

            <div class="billing-footer text-center">
            <p class="billing-note">
                GoErudite provides software access only. Subscription fees are independent
                of commercial transactions conducted on the platform.
            </p>
            <a href="#" class="billing-cta">Talk to our sales team</a>
            </div>

        </div>
    </section>


@endsection

@push('scripts')
<script>
const testimonialSwiper = new Swiper('.testimonial-slider', {
    slidesPerView: 1,
    loop: true,
    autoplay: { delay: 5000 },
    breakpoints: {
        768: { slidesPerView: 2 },
        992: { slidesPerView: 3 },
    }
});
</script>
@endpush