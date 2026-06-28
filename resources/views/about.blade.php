@extends('layouts.app')

@section('title', 'About Us | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India. Manage and distribute digital textbooks with ease.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book distribution, CBSE ICSE digital books, LMS integration')

@section('content')

<style>

.about-goerudite-section{
    position: relative;
    padding: 90px 0;
    background:
    linear-gradient(rgba(7,16,36,0.92), rgba(7,16,36,0.92)),
    url('https://i.postimg.cc/qqYqzZqW/about-us.jpg');
    background-size: cover;
    background-position: center;
    overflow: hidden;
}

.about-goerudite-wrapper{
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 60px;
}

.about-left-content{
    flex: 1;
    max-width: 600px;
    animation: fadeUp 1s ease;
}

.about-title{
    font-size: 56px;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
    line-height: 1.2;
}

.about-title span{
    color: #f36522;
}

.title-line{
    width: 75px;
    height: 4px;
    background: #f36522;
    border-radius: 30px;
    margin-bottom: 30px;
}

.about-description{
    color: rgba(255,255,255,0.82);
    font-size: 17px;
    line-height: 1.9;
    margin-bottom: 20px;
}

.about-btn{
    display: inline-flex;
    align-items: center;
    gap: 12px;
    background: #f36522;
    color: #fff;
    padding: 14px 30px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    margin-top: 15px;
    transition: 0.4s ease;
    box-shadow: 0 10px 30px rgba(243,101,34,0.3);
}

.about-btn:hover{
    transform: translateY(-4px);
    background: #ff7d3d;
    color: #fff;
}

.about-right-grid{
    flex: 1;
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 22px;
    animation: fadeUp 1.2s ease;
}

.feature-box{
    position: relative;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    padding: 20px 15px;
    text-align: center;
    transition: 0.4s ease;
    overflow: hidden;
}

.feature-box::before{
    content:'';
    position:absolute;
    inset:0;
    background: linear-gradient(135deg, rgba(243,101,34,0.08), transparent);
    opacity:0;
    transition:0.4s;
}

.feature-box:hover::before{
    opacity:1;
}

.feature-box:hover{
    transform: translateY(-8px);
    border-color: rgba(243,101,34,0.4);
    box-shadow: 0 15px 35px rgba(0,0,0,0.25);
}

.feature-icon{
    width: 72px;
    height: 72px;
    margin: auto auto 18px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    transition: 0.4s;
}

.feature-box:hover .feature-icon{
    transform: scale(1.08) rotate(3deg);
}

.feature-icon.orange{
    background: rgba(243,101,34,0.15);
    color: #f36522;
}

.feature-icon.green{
    background: rgba(34,197,94,0.14);
    color: #22c55e;
}

.feature-icon.blue{
    background: rgba(59,130,246,0.14);
    color: #3b82f6;
}

.feature-icon.purple{
    background: rgba(168,85,247,0.14);
    color: #a855f7;
}

.feature-box h4{
    color: #fff;
    font-size: 18px;
    font-weight: 700;
    line-height: 1.6;
    margin: 0;
}

/* Animation */

@keyframes fadeUp{
    from{
        opacity:0;
        transform: translateY(40px);
    }
    to{
        opacity:1;
        transform: translateY(0);
    }
}

/* =========================
Responsive
========================= */

@media(max-width:1199px){

    .about-title{
        font-size: 48px;
    }

}

@media(max-width:991px){

    .about-goerudite-wrapper{
        flex-direction: column;
    }

    .about-left-content{
        max-width: 100%;
        text-align: center;
    }

    .title-line{
        margin: 0 auto 25px;
    }

    .about-right-grid{
        width: 100%;
    }

}

@media(max-width:767px){

    .about-goerudite-section{
        padding: 70px 0;
    }

    .about-title{
        font-size: 36px;
    }

    .about-description{
        font-size: 15px;
        line-height: 1.8;
    }

    .about-right-grid{
        grid-template-columns: 1fr;
    }

    .feature-box{
        padding: 25px 20px;
    }

}

</style>


<section class="about-goerudite-section">
    <div class="container">
        <div class="about-goerudite-wrapper">

            <!-- Left Content -->
            <div class="about-left-content">

                <span class="about-badge"></span>

                <h2 class="about-title">
                    About <span>GoErudite</span>
                </h2>

                <div class="title-line"></div>

                <p class="about-description">
                    GoErudite is a role-based education supply platform built to help schools,
                    distributors, retailers, and publishers manage academic sourcing through
                    structured RFQ workflows, verified participation, and institution-controlled approvals.
                </p>

                <p class="about-description">
                    We provide digital infrastructure for academic procurement, catalog visibility,
                    communication workflows, and audit-ready operational records. GoErudite operates
                    solely as a technology facilitation platform and does not sell, purchase,
                    transport, price, or process payments for textbooks or academic products.
                </p>

                <a href="login.php" class="about-btn">
                    Explore Platform
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

            <!-- Right Feature Grid -->
            <div class="about-right-grid">

                <div class="feature-box">
                    <div class="feature-icon orange">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <h4>School-Controlled Workflows</h4>
                </div>

                <div class="feature-box">
                    <div class="feature-icon green">
                       <i class="fa-solid fa-shield"></i>
                    </div>
                    <h4>Verified Participation</h4>
                </div>

                <div class="feature-box">
                    <div class="feature-icon blue">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <h4>Secure & Private Access</h4>
                </div>

                <div class="feature-box">
                    <div class="feature-icon purple">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h4>Audit-Ready Records</h4>
                </div>

                <div class="feature-box">
                    <div class="feature-icon orange">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h4>Role-Based Platform</h4>
                </div>

                <div class="feature-box">
                    <div class="feature-icon blue">
                        <i class="fa-solid fa-chart-column"></i>
                    </div>
                    <h4>Transparency in Communication</h4>
                </div>

            </div>

        </div>
    </div>
</section>


    <!-- Hero Section -->
     <!--<section class="about-hero" style="background: linear-gradient(rgba(12, 18, 32, 0.75),rgba(12, 18, 32, 0.75)),url('https://i.postimg.cc/qqYqzZqW/about-us.jpg'); background-size: cover;  background-position: center;-->
     <!--   background-repeat: no-repeat;"> -->
     <!--   <div class="container">-->
     <!--      <div class="hero-content fade-in-up">-->
     <!--           <h1 class="text-center">About GoErudite</h1>-->
     <!--           <p class="text-justify">GoErudite is a role-based education supply platform built to help schools, distributors, retailers, and publishers manage academic sourcing through structured RFQ workflows, verified participation, and institution-controlled approvals.-->
     <!--           </p>-->
     <!--           <p class="text-justify">We provide digital infrastructure for academic procurement, catalog visibility, communication workflows, and audit-ready operational records. GoErudite operates solely as a technology facilitation platform and does not sell, purchase, transport, price, or process payments for textbooks or academic products.</p>-->
     <!--       </div>-->

     <!--       <div class="hero-buttons">-->
     <!--           <a href="login.php" class="btn btn-getstarted" style="background-color: #f36522;">Explore Platform</a>-->
     <!--       </div>-->
     <!--   </div>-->
     <!--</section>-->
     
     

    <!-- Brand Story Section -->
    <section class="content-section">
        <div class="container">
            <div class="content-row">
                <div class="content-text fade-in-left">
                    <h2><span class="highlight">Brand</span> Story </h2>
                    <p>GoErudite was created after observing recurring operational gaps in academic textbook sourcing—unclear communication, syllabus mismatches, delayed quotations, unverified suppliers, and limited visibility across the education supply chain.</p>
                    <p>Our goal was to create a structured digital platform where schools can raise verified academic requirements and trusted supply partners can respond through accountable workflows.</p>
                    <p>By combining role-based access, academic filters, approval systems, and transparent communication, GoErudite helps institutions reduce operational confusion while maintaining decision control.</p>
                </div>
                <div class="content-image rotated-right fade-in-right">
                    <div class="image-wrapper">
                        <img src="{{ asset('images/Goru.png') }}" alt="Brand Story">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Value -->
    <section class="values-section" style="background: linear-gradient(rgba(12, 18, 32, 0.5),rgba(12, 18, 32, 0.5)),url('https://i.postimg.cc/xjyyZvh5/Our-Value.jpg'); background-size: cover;  background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <h2 class="values-title">Our Values</h2>
            <p>Built on Principles That Support Academic Trust</p>
            <div class="values-grid">
                <div class="value-card">
                    <h4>School-First Decision Making</h4>
                    <p>
                        Every workflow is designed to keep institutions in control of academic sourcing decisions
                    </p>
                </div>

                <div class="value-card">
                    <h4>Transparent Participation</h4>
                    <p>
                        Only verified stakeholders participate in RFQ workflows, catalog visibility, and communication systems.
                    </p>
                </div>

                <div class="value-card">
                    <h4>Privacy & Access Control</h4>
                    <p>
                        Institutional contact details remain protected until manual approval by the authorized school.
                    </p>
                </div>

                <div class="value-card">
                    <h4>Accountability Through Records</h4>
                    <p>
                        Every RFQ, quotation, approval, and communication event is securely time-stamped.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="content-section mt-5">
        <div class="container">
            <div class="content-row reverse">
                <div class="content-image rotated-left fade-in-left">
                    <div class="image-wrapper">
                        <img src="{{ asset('images/Our Vision.png') }}" alt="Vision">
                    </div>
                </div>
                <div class="content-text fade-in-right">
                    <h2>Our <span class="highlight">Vision</span></h2>
                     <p>Building a More Structured Education Supply Network</p>
                    <p>Our vision is to strengthen academic procurement across India by helping institutions access structured workflows, verified supply participation, and responsible communication. <br> We aim to support long-term trust between schools, distributors, retailers, and publishers while reducing operational friction in textbook sourcing.</p>
                </div>
            </div>
        </div>
    </section>

     <!-- Mission Section -->
    <section class="content-section">
        <div class="container">
            <div class="content-row">    
                <div class="content-text fade-in-left">
                    <h2>Our <span class="highlight">Mission</span></h2>
                    <p>Making Academic Procurement More Transparent</p>
                    <p>Our mission is to help educational institutions raise clear academic requirements and enable verified supply partners to respond through accountable digital workflows. <br>
                       GoErudite is designed to support transparency, operational discipline, privacy protection, and role-based decision-making across the education ecosystem.</p>
                </div>   
                <div class="content-image rotated-right fade-in-right">
                    <div class="image-wrapper">
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&q=80" alt="Mission">
                    </div>
                </div>             
            </div>
        </div>
    </section>

  
    <!-- Team Section -->
    <section class="content-section" style="background: #1F8F6E;">
        <div class="container">
            <div class="section-title-center fade-in-up">
                <h2>Meet the Team  <span class="highlight">Behind GoErudite</span></h2>
                <p>A team focused on building trusted digital infrastructure for India’s education supply ecosystem.</p>
            </div>
            <div class="team-grid">
                <div class="team-card fade-in-up" style="transition-delay: 0.1s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Ranjeet Singh</h3>
                    <!--<p class="team-role">Founder & CEO</p>-->
                </div>
                <div class="team-card fade-in-up" style="transition-delay: 0.2s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Ranjana Kumari</h3>
                    <!--<p class="team-role">Human Resources (HR)</p>-->
                </div>
                <div class="team-card fade-in-up" style="transition-delay: 0.3s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Goldi Kumari</h3>
                    <!--<p class="team-role">Team Leader</p>-->
                </div>
                <div class="team-card fade-in-up" style="transition-delay: 0.4s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Pooja Kumari</h3>
                    <!--<p class="team-role">Content Writer</p>-->
                </div>
            </div>
            
            <div class="team-grid">
                <div class="team-card fade-in-up" style="transition-delay: 0.1s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Ravi Prasad</h3>
                    <!--<p class="team-role">Technical Head - HOD</p>-->
                </div>
                <div class="team-card fade-in-up" style="transition-delay: 0.2s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Sachin Kumar</h3>
                    <!--<p class="team-role">Sales & Marketing</p>-->
                </div>
                <div class="team-card fade-in-up" style="transition-delay: 0.3s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Shubham Patel</h3>
                    <!--<p class="team-role">Office Administrative</p>-->
                </div>
                <div class="team-card fade-in-up" style="transition-delay: 0.4s">
                    <div class="team-avatar">
                        <img src="{{ asset('images/13.jpg') }}" alt="Team Member">
                    </div>
                    <h3 class="team-name">Sudhir Singh</h3>
                    <!--<p class="team-role">Graphic Designer (HOD)</p>-->
                </div>
            </div>
        </div>
    </section>
    
    <section class="publisher-cta">
      <div class="container">
        <div class="publisher-cta-content">
          <p>
            GoErudite acts solely as a technology facilitation platform. Pricing negotiations, payment settlements, logistics commitments, and commercial agreements are independently managed by approved users outside the platform.
          </p>
        </div>
      </div>
    </section>


@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, observerOptions);

        // Observe all animated elements
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.fade-in-left, .fade-in-right, .fade-in-up');
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>
@endpush