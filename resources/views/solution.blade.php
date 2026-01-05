@extends('layouts.app')

@section('title', 'Our Solutions | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India. Manage and distribute digital textbooks with ease.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book distribution, CBSE ICSE digital books, LMS integration')

@section('content')

    <!-- Hero Section -->
    <section class="hero-section-school">
        <div class="hero-content-school">
            <h1 class="hero-title-school">
                Build Accurate Textbook Lists for Your School
            </h1>

            <p class="hero-description-school">
                Simplify textbook procurement with session-based catalogs, AI-assisted bulk ordering, and complete audit trails designed for academic accuracy.
            </p>

            <div class="hero-buttons">
                <a href="login.php" class="btn btn-getstarted" style="background-color: #f36522;">Register as a School</a>
            </div>
        </div>
    </section>

    <section class="overview-section">
        <div class="container">

            <!-- Heading -->
            <h2 class="overview-title">Overview</h2>
            <p class="overview-desc">
            Schools can register on GoErudite by defining their board, state, and medium. Role-based access for Clerks, Storekeepers, and Principals 
            ensures structured approvals, transparency, and accountability at every step.
            </p>

            <!-- Key Features Badge -->


                <div class="key-feature-pill bg-primary">
                <span class="key-feature-icon bg-primary">
                    🏛️
                </span>
                <span class="key-feature-text">Key Features</span>
                </div>

            <!-- Feature Cards -->
            <div class="features-grid">

            <div class="feature-card">
                <h4>AI-Assisted Bulk Ordering</h4>
                <p>
                Student-count-based textbook suggestions with confidence indicators.
                </p>
            </div>

            <div class="feature-card">
                <h4>RFQ & Quote Comparison</h4>
                <p>
                Post requirements and compare distributor quotes by price and availability.
                </p>
            </div>

            <div class="feature-card">
                <h4>Approval Workflows</h4>
                <p>
                Multi-level, role-based approvals for accuracy and accountability.
                </p>
            </div>

            <div class="feature-card">
                <h4>Delivery Verification & Returns</h4>
                <p>
                Digital GRNs, damage uploads, and automated return handling.
                </p>
            </div>

            </div>
        </div>
    </section>

    <section class="hero-section-school" style="background: linear-gradient(rgba(12, 18, 32, 0.75),rgba(12, 18, 32, 0.75)),url('https://i.postimg.cc/SRM8ZV78/warehouse.avif'); background-size: cover;  background-position: center;
        background-repeat: no-repeat;"> 
        <div class="hero-content-school">
            <h1 class="hero-title-school">
                Warehouse & Dispatch Tools Built for Education
            </h1>

            <p class="hero-description-school">
                Streamline warehouse operations with education-specific tools for ASNs, bin management, and partial dispatch control
            </p>

            <div class="hero-buttons">
                <a href="login.php" class="btn btn-getstarted" style="background-color: #f36522;">Register as a Distributors</a>
            </div>
        </div>
    </section>

    <section class="overview-section">
      <div class="container">

        <!-- Heading -->
        <h2 class="overview-title">Overview</h2>
        <p class="overview-desc">
         GoErudite enables distributors to manage inbound and outbound book movements with precision. From ASNs to dispatches, every step is 
         structured, traceable, and designed to handle real-world education supply scenarios
        </p>

        <!-- Key Features Badge -->


        <div class="key-feature-pill bg-success">
          <span class="key-feature-icon bg-success">
            🏛️
          </span>
          <span class="key-feature-text">Key Features</span>
        </div>

        <!-- Feature Cards -->
        <div class="features-grid">

          <div class="feature-card">
            <h4>ASN & GRN Management</h4>
            <p>
              Track invoices, received quantities, and damaged or short shipments.
            </p>
          </div>

          <div class="feature-card">
            <h4>Warehouse Management</h4>
            <p>
              Rack and bin-level stock control with full movement tracking.
            </p>
          </div>

          <div class="feature-card">
            <h4>Smart Dispatch Control</h4>
            <p>
              Mandatory picklists, partial dispatch handling, and courier tracking.
            </p>
          </div>

          <div class="feature-card">
            <h4>Returns & Approvals</h4>
            <p>
              Category-based returns with structured approval workflows.
            </p>
          </div>

        </div>
      </div>
    </section>

    <section class="hero-section-school" style="background: linear-gradient(rgba(12, 18, 32, 0.75),rgba(12, 18, 32, 0.75)),url('https://i.postimg.cc/MpK0w0WK/for-retailers.avif'); background-size: cover;  background-position: center;
        background-repeat: no-repeat;"> 
        <div class="hero-content-school">
            <h1 class="hero-title-school">
                A Simple POS & Inventory for Every Bookshop
            </h1>

            <p class="hero-description-school">
                Modern billing with offline support and built-in customer ledgers
            </p>

            <div class="hero-buttons">
                <a href="login.php" class="btn btn-getstarted" style="background-color: #f36522;">Register as a Retailer</a>
            </div>
        </div>
    </section>

    <section class="overview-section">
      <div class="container">

        <!-- Heading -->
        <h2 class="overview-title">Overview</h2>
        <p class="overview-desc">
         GoErudite offers a fast, easy-to-use POS system designed for bookshops, with offline billing and real-time inventory control.
        </p>

        <!-- Key Features Badge -->


        <div class="key-feature-pill">
          <span class="key-feature-icon">
            🏛️
          </span>
          <span class="key-feature-text">Key Features</span>
        </div>

        <!-- Feature Cards -->
        <div class="features-grid">

          <div class="feature-card">
            <h4>POS with Scanner</h4>
            <p>
              Quick billing, invoice printing, and multiple payment options.
            </p>
          </div>

          <div class="feature-card">
            <h4>Offline-First POS</h4>
            <p>
              Sales saved locally and auto synced when the network is available.
            </p>
          </div>

          <div class="feature-card">
            <h4>Smart Inventory</h4>
            <p>
              Opening stock, sales tracking, and low-stock alerts.
            </p>
          </div>

          <div class="feature-card">
            <h4>Customer Ledger</h4>
            <p>
              Track credit sales (udhaar), due dates, and statements.
            </p>
          </div>

        </div>
      </div>
    </section>

    <section class="publisher-cta">
      <div class="container">
        <div class="publisher-cta-content">
          <h2>Control Your Catalog & Plan Batches</h2>

          <p>
            GoErudite helps publishers manage ISBN-based catalogs with strict session
            controls and price stability. AI-powered insights support smarter batch
            planning by highlighting demand trends and dead stock.
          </p>

          <a href="#" class="cta-btn">Register as a Publisher</a>
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