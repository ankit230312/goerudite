@extends('layouts.app')

@section('title', 'GoErudite E-Book Services | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform')

@section('content')

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">
            India’s Most <span class="gradient-text">Compliant</span><br>
            Education Supply Platform
        </h1>

        <p class="hero-description">
            A rule-driven education supply network connecting schools,
            distributors, and publishers with complete compliance.
        </p>

        <a href="{{ url('/shop') }}" class="btn btn-getstarted" style="background:#f36522">
            Explore Shop →
        </a>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-container">
        <div class="stat-item">
            <i class="fa-solid fa-school" style="color: #f36522; font-size: 2.5rem;"></i>
            <div class="stat-number">500+</div>
            <div class="stat-label">Partner Schools</div>
        </div>

        <div class="stat-item">
            <i class="fa-solid fa-book" style="color: #f36522; font-size: 2.5rem;"></i>
            <div class="stat-number">120+</div>
            <div class="stat-label">Verified Publishers</div>
        </div>

        <div class="stat-item">
            <i class="fa-regular fa-circle-check" style="color: #f36522; font-size: 2.5rem;"></i>
            <div class="stat-number">100%</div>
            <div class="stat-label">Academic Sessions</div>
        </div>

        <div class="stat-item">
                <i class="fa-solid fa-globe" style="color: #f36522; font-size: 2.5rem;"></i>
            <div class="stat-number">15+</div>
            <div class="stat-label">States Covered</div>
        </div>
    </div>     
</section>

<!-- Ecosystem Section -->
<section class="trending-section mt-3">
    <div class="container">

        <!-- Header -->
        <div class="trending-header">
        <div>
            <h2 class="trending-title">
            <span class="trend-icon">📈</span> Trending <span>Now</span>
            </h2>
            <p class="trending-subtitle">
            Most ordered textbooks for the 2024–25 session.
            </p>
        </div>
        <a href="shop.php" class="view-all"><i class="bi bi-bag"></i> View All →</a>
        </div>

        <!-- Auto Scroll -->
        <div class="trending-slider">
        <div class="trending-track">

            <!-- CARD 1 -->
            <div class="book-card">
            <span class="class-tag">Class 10</span>
            <img src="https://picsum.photos/300/420?random=1" alt="Book">
            <div class="book-body">
                <span class="badge">CBSE</span>
                <h4 class="text-dark">Mathematics World</h4>
                <div class="book-meta">
                    <p class="publisher text-dark">EduPress</p>
                    <p class="price">MRP: ₹450</p>
                </div>
                <hr>
                    <p class="publisher text-dark"><b>Description:-</b>
                        Team Examcart's Examcart Competitive Maths Shortcuts Secrets 
                        Textbook: This book serves as a helping hand for government 
                        exams, offering short tips and tricks to solve questions within the 
                        allotted time.
                    </p>
            </div>
            </div>

            <!-- CARD 2 -->
            <div class="book-card">
            <span class="class-tag">Class 9</span>
            <img src="https://picsum.photos/300/420?random=2" alt="Book">
            <div class="book-body">
                <span class="badge">ICSE</span>
                <h4 class="text-dark">Science Explorer</h4>
                <div class="book-meta">
                    <p class="publisher text-dark">BrightBooks</p>
                    <p class="price">MRP: ₹420</p>
                </div>
                <hr>
                    <p class="publisher text-dark"><b>Description:-</b>
                        Team Examcart's Examcart Competitive Maths Shortcuts Secrets 
                        Textbook: This book serves as a helping hand for government 
                        exams, offering short tips and tricks to solve questions within the 
                        allotted time.
                    </p>
            </div>
            </div>

            <!-- CARD 3 -->
            <div class="book-card">
            <span class="class-tag">Class 8</span>
            <img src="https://picsum.photos/300/420?random=1" alt="Book">
            <div class="book-body">
                <span class="badge">CBSE</span>
                <h4 class="text-dark">English Grammar</h4>
                <div class="book-meta">
                    <p class="publisher text-dark">BrightBooks</p>
                    <p class="price">MRP: ₹420</p>
                </div>
                <hr>
                    <p class="publisher text-dark"><b>Description:-</b>
                        Team Examcart's Examcart Competitive Maths Shortcuts Secrets 
                        Textbook: This book serves as a helping hand for government 
                        exams, offering short tips and tricks to solve questions within the 
                        allotted time.
                    </p>
            </div>
            </div>

            <!-- CARD 4 -->
            <div class="book-card">
            <span class="class-tag">Class 12</span>
            <img src="https://picsum.photos/300/420?random=4" alt="Book">
            <div class="book-body">
                <span class="badge">CBSE</span>
                <h4 class="text-dark">Physics Core</h4>
                <div class="book-meta">
                    <p class="publisher text-dark">BrightBooks</p>
                    <p class="price">MRP: ₹420</p>
                </div>
                <hr>
                    <p class="publisher text-dark"><b>Description:-</b>
                        Team Examcart's Examcart Competitive Maths Shortcuts Secrets 
                        Textbook: This book serves as a helping hand for government 
                        exams, offering short tips and tricks to solve questions within the 
                        allotted time.
                    </p>
            </div>
            </div>

            <!-- DUPLICATES FOR LOOP -->
            <div class="book-card">
            <span class="class-tag">Class 10</span>
            <img src="https://picsum.photos/300/420?random=1" alt="Book">
            <div class="book-body">
                <span class="badge">CBSE</span>
                <h4 class="text-dark">Mathematics World</h4>
                <div class="book-meta">
                    <p class="publisher text-dark">BrightBooks</p>
                    <p class="price">MRP: ₹420</p>
                </div>
                <hr>
                    <p class="publisher text-dark"><b>Description:-</b>
                        Team Examcart's Examcart Competitive Maths Shortcuts Secrets 
                        Textbook: This book serves as a helping hand for government 
                        exams, offering short tips and tricks to solve questions within the 
                        allotted time.
                    </p>
            </div>
            </div>

            <div class="book-card">
            <span class="class-tag">Class 9</span>
            <img src="https://picsum.photos/300/420?random=4" alt="Book">
            <div class="book-body">
                <span class="badge">ICSE</span>
                <h4 class="text-dark">Science Explorer</h4>
                <div class="book-meta">
                    <p class="publisher text-dark">BrightBooks</p>
                    <p class="price">MRP: ₹420</p>
                </div>
                <hr>
                    <p class="publisher text-dark"><b>Description:-</b>
                        Team Examcart's Examcart Competitive Maths Shortcuts Secrets 
                        Textbook: This book serves as a helping hand for government 
                        exams, offering short tips and tricks to solve questions within the 
                        allotted time.
                    </p>
            </div>
            </div>

        </div>
        </div>

    </div>
</section>

<!-- End Section -->
<!-- Security Section -->
<section class="ecosystem-main">
    <div class="container">
        <div class="row g-4">

        <!-- Ecosystem -->
        <div class="col-lg-4">
            <h3 class="column-title text-center">Ecosystem</h3>
            <p class="column-subtitle text-center">A Solution for Every Stakeholder</p>
            <div class="eco-grid">
                <div class="eco-card">
                    <div class="eco-icon blue">
                    <span>🏫</span>
                    </div>
                    <h4>School</h4>
                    <p>Build accurate book lists & verify deliveries.</p>
                    <a href="#">Learn More <span>→</span></a>
                </div>

                <div class="eco-card">
                    <div class="eco-icon green">
                    <span>🚚</span>
                    </div>
                    <h4>Distributor</h4>
                    <p>Manage warehouse, ASN, and Partial Dispatch.</p>
                    <a href="#">Learn More <span>→</span></a>
                </div>

                <div class="eco-card">
                    <div class="eco-icon purple">
                    <span>🧾</span>
                    </div>
                    <h4>Retailer</h4>
                    <p>POS for billing and Inventory Management.</p>
                    <a href="#">Learn More <span>→</span></a>
                </div>

                <div class="eco-card">
                    <div class="eco-icon orange">
                    <span>📘</span>
                    </div>
                    <h4>Publisher</h4>
                    <p>Control catalog, pricing & get AI insights.</p>
                    <a href="#">Learn More <span>→</span></a>
                </div>
            </div>
        </div>

        <!-- Why GoErudite -->
        <div class="col-lg-4">
            <h3 class="column-title text-center">Why GoErudite?</h3>
            <p class="column-subtitle text-center">
            Generic ecommerce platforms fail in education. <br>
            GoErudite is built on strict academic rules to <br> ensure compliance and trust.
            </p>

            <div class="info-wrapper">
                <div class="info-card">
                    <div class="info-icon green">💰</div>
                    <div class="info-content">
                    <h5>Session-Locked Pricing</h5>
                    <p>
                        Prices are frozen for the academic year. Publishers cannot change
                        MRP mid-session, protecting schools from budget spikes.
                    </p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon orange">📋</div>
                    <div class="info-content">
                    <h5>Audit-Ready Workflows</h5>
                    <p>
                        Every order, approval, and return is logged with an immutable audit
                        trail. "Who, When, What" is always recorded for legal safety.
                    </p>
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-icon blue">👥</div>
                    <div class="info-content">
                    <h5>Board Compliance</h5>
                    <p>
                        Books are tagged by Board (CBSE/ICSE) and Medium. The system prevents
                        ordering mismatched materials for a school's profile.
                    </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ebook Services -->
        <div class="col-lg-4">
            <h3 class="column-title text-center">Our E-Book Services</h3>
            <p class="column-subtitle text-center">
            Empowering students, schools, and educators <br> with digital learning solutions.
            </p>
            <ul class="ebook-list">
                <li class="info-card">Access thousands of e-books anytime, anywhere</li>
                <li class="info-card">Interactive quizzes, notes & multimedia</li>
                <li class="info-card">Secure cloud-based access & enrollment</li>
                <li class="info-card">Track reading progress & engagement</li>
                <li class="info-card">100% genuine books from verified publishers</li>
                <li class="info-card">Easy returns for damaged or wrong syllabus</li>
            </ul>
        </div>
    </div>
</div>
</section>
<!-- End Security Section -->

<!-- Client Testimonial Section -->
<section class="testimonial-section">
  <div class="container">

    <!-- Heading -->
    <div class="testimonial-header">
      <h2>What Our Clients Say</h2>
      <p>Hear from schools, distributors, and publishers who trust GoErudite.</p>
    </div>

    <!-- Cards -->
    <div class="testimonial-grid">

      <div class="testimonial-card">
        <p>
          "GoErudite has transformed how our school manages e-books and classroom
          resources. It's simple, efficient, and reliable."
        </p>
        <div class="author">
          <div>
            <h5>Ranjeet Singh</h5>
            <span>Principal, Greenfield School</span>
          </div>
          <img src="{{ asset('images/kid image-1.jpeg') }}" alt="Client">
        </div>
      </div>

      <div class="testimonial-card">
        <p>
          "As a distributor, GoErudite's platform streamlined our logistics and
          inventory management like never before."
        </p>
        <div class="author">
          <div>
            <h5>Ranjana Kumari</h5>
            <span>Operations Head, EduDistrib</span>
          </div>
          <img src="{{ asset('images/kid image-1.jpeg') }}" alt="Client">
        </div>
      </div>

      <div class="testimonial-card">
        <p>
          "The analytics and reporting tools have helped us understand e-book
          usage patterns and improve student engagement."
        </p>
        <div class="author">
          <div>
            <h5>Ravi Prasad</h5>
            <span>Publisher, LearnBooks</span>
          </div>
          <img src="{{ asset('images/kid image-1.jpeg') }}" alt="Client">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- End Client Testimonial Section -->

<!-- CTA -->
<section class="cta-section">
    <div class="container cta-container">
        <!-- Left Image -->
        <div class="cta-image">
            <img src="{{ asset('images/Join GOErudite Girl.png') }}" alt="GoErudite CTA">
        </div>
        <!-- Right Content -->
        <div class="cta-content">
        <h2>One platform. One compliant network.</h2>
        <p>Built for schools, distributors, and publishers across India.</p>

            <div class="cta-buttons">
                <a href="#" class="btn btn-primary">Join GoErudite</a>
                <a href="shop.php" class="btn btn-secondary">Shop Now</a>
            </div>
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
