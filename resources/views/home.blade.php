@extends('layouts.app')

@section('title', 'GoErudite E-Book Services | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform')

@section('content')

<style>
:root {
  --orange: #f36522;
  --orange-dark: #d9551a;
  --navy: #0f1c35;
  --navy2: #162040;
  --teal: #1a7fa0;
  --green: #2e9b6e;
  --purple: #7c4dce;
  --blue: #2563eb;
  --light-bg: #f8f9fb;
  --border: #e4e8ef;
  --text: #1e2636;
  --muted: #6b7a99;
  --white: #ffffff;
}

/* ── HERO ── */
.hero-section {
  background: linear-gradient(rgba(12, 18, 32, 0.75),rgba(12, 18, 32, 0.75)),url('https://i.postimg.cc/FHffjnzF/Solution-Image.jpg');
  min-height: 100vh;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  padding: 80px 0 70px;
  position: relative;
  overflow: hidden;
}
.hero-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/svg%3E");
}
.hero-blob-1 { position: absolute; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, rgba(243,101,34,.18) 0%, transparent 70%); top: -80px; right: -60px; pointer-events: none; }
.hero-blob-2 { position: absolute; width: 300px; height: 300px; border-radius: 50%; background: radial-gradient(circle, rgba(26,127,160,.15) 0%, transparent 70%); bottom: -60px; left: -40px; pointer-events: none; }
.hero-title { font-family: 'Sora', sans-serif; font-size: clamp(30px, 4.5vw, 44px); font-weight: 800; color: var(--white); line-height: 1.12; margin-bottom: 20px; }
.hero-title .hl { color: var(--orange); }
.hero-desc { font-size: 16px; color: rgba(255,255,255,.72); line-height: 1.75; max-width: 560px; margin-bottom: 32px; }
.hero-features {
    display: flex;
    gap: 12px;
    margin-bottom: 36px;
    align-items: center;
    flex-wrap: nowrap;
}
.hero-feat { display: flex; align-items: flex-start; gap: 10px; background: rgba(255,255,255,.07); border: 1px solid rgba(255,255,255,.1); border-radius: 10px; padding: 12px 16px; min-width: 170px; flex: 1; }
.hero-feat-icon { font-size: 22px; flex-shrink: 0; }
.hero-feat-text { font-size: 12px; color: rgba(255,255,255,.75); line-height: 1.4; font-weight: 500; }
.hero-feat-text strong { display: block; color: var(--white); font-size: 13px; margin-bottom: 2px; }
.btn-orange { background: var(--orange); color: var(--white); padding: 14px 32px; border-radius: 8px; font-weight: 700; font-size: 15px; text-decoration: none; border: none; cursor: pointer; transition: all .25s; display: inline-block; }
.btn-orange:hover { background: var(--orange-dark); color: var(--white); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(243,101,34,.4); }
.hero-disclaimer { font-size: 12px; color: #fff; margin-top: 16px; display: flex; align-items: center; gap: 6px; }


    /* ── CTA ── */
.cta-section { background: var(--orange); padding: 0; overflow: hidden; }
.cta-inner { display: flex; align-items: stretch; min-height: 300px; }
.cta-img-side { width: 280px; flex-shrink: 0; position: relative; overflow: hidden; background: rgba(0,0,0,.12); }
.cta-img-side img { width: 100%; height: 100%; object-fit: fit; object-position: top center; }
.cta-content-side { flex: 1; padding: 56px 48px; display: flex; flex-direction: column; justify-content: center; }
.cta-title { font-family: 'Sora', sans-serif; font-size: clamp(22px, 3vw, 38px); font-weight: 800; color: var(--white); margin-bottom: 10px; line-height: 1.2; }
.cta-sub { font-size: 15px; color: rgba(255,255,255,.8); margin-bottom: 28px; }
.cta-right-features { display: flex; flex-direction: column; gap: 14px; }
.cta-feat { display: flex; align-items: center; gap: 12px; }
.cta-feat-icon { width: 36px; height: 36px; border-radius: 50%; background: rgba(255,255,255,.2); display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
.cta-feat-text strong { display: block; font-size: 13px; color: var(--white); font-weight: 700; }
.cta-feat-text span { font-size: 12px; color: rgba(255,255,255,.75); }
.btn-white { background: var(--white); color: var(--orange); padding: 13px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; text-decoration: none; transition: all .2s; display: inline-block; }
.btn-white:hover { background: var(--navy); color: var(--white); }
.btn-white-outline { background: transparent; color: var(--white); border: 2px solid rgba(255,255,255,.6); padding: 12px 28px; border-radius: 8px; font-weight: 700; font-size: 14px; text-decoration: none; transition: all .2s; display: inline-block; }
.btn-white-outline:hover { background: rgba(255,255,255,.15); border-color: var(--white); color: var(--white); }
.cta-disclaimer { font-size: 11.5px; color: rgba(255,255,255,.55); margin-top: 16px; }

/* ── ECOSYSTEM SECTION ── */
.ecosystem-section { padding: 64px 0; background: var(--white); }
.col-title { font-family: 'Sora', sans-serif; font-size: 20px; font-weight: 800; color: var(--navy); margin-bottom: 6px; }
.col-sub { font-size: 13px; color: var(--muted); margin-bottom: 24px; line-height: 1.6; }
.divider-orange { width: 40px; height: 3px; background: var(--orange); border-radius: 2px; margin: 0 auto 20px; }

/* Ecosystem cards */
.eco-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.eco-card { background: var(--light-bg); border: 1px solid var(--border); border-radius: 14px; padding: 18px 16px; transition: all .25s; }
.eco-card:hover { border-color: var(--orange); box-shadow: 0 6px 24px rgba(243,101,34,.12); transform: translateY(-3px); }
.eco-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 10px; }
.eco-icon.blue { background: #e8f0fd; }
.eco-icon.green { background: #e6f7ee; }
.eco-icon.purple { background: #f0eafc; }
.eco-icon.orange { background: #fff0e8; }
.eco-card h4 { font-size: 14px; font-weight: 700; color: var(--navy); margin-bottom: 4px; }
.eco-card p { font-size: 12px; color: var(--muted); line-height: 1.5; margin-bottom: 8px; }
.eco-card a { font-size: 12px; font-weight: 700; color: var(--orange); text-decoration: none; }

/* Workflow steps */
.workflow-steps { display: flex; flex-direction: column; gap: 16px; }
.workflow-step { display: flex; align-items: flex-start; gap: 14px; }
.step-num { width: 32px; height: 32px; border-radius: 50%; background: var(--orange); color: var(--white); font-size: 13px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.step-icon-box { width: 44px; height: 44px; border-radius: 12px; background: var(--light-bg); display: flex; align-items: center; justify-content: center; font-size: 22px; flex-shrink: 0; border: 1px solid var(--border); }
.step-content h5 { font-size: 14px; font-weight: 700; color: var(--navy); margin-bottom: 4px; }
.step-content p { font-size: 12.5px; color: var(--muted); line-height: 1.55; margin: 0; }

/* Why GoErudite info cards */
.info-card { display: flex; align-items: flex-start; gap: 14px; background: var(--light-bg); border: 1px solid var(--border); border-radius: 12px; padding: 16px; margin-bottom: 14px; transition: all .2s; }
.info-card:hover { border-color: var(--orange); background: var(--white); }
.info-icon { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; flex-shrink: 0; }
.info-icon.green { background: #e6f7ee; }
.info-icon.orange { background: #fff0e8; }
.info-icon.blue { background: #e8f0fd; }
.info-icon.purple { background: #f0eafc; }
.info-content h5 { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 4px; }
.info-content p { font-size: 12px; color: var(--muted); line-height: 1.55; margin: 0; }

/* Platform features */
.feature-row { display: flex; align-items: center; justify-content: space-between; padding: 14px 0; border-bottom: 1px solid var(--border); cursor: default; transition: background .2s; border-radius: 8px; padding-left: 10px; padding-right: 10px; }
.feature-row:hover { background: var(--light-bg); }
.feature-row:last-child { border-bottom: none; }
.feat-left { display: flex; align-items: center; gap: 12px; }
.feat-icon-circle { width: 38px; height: 38px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
.feat-icon-circle.blue { background: #e8f0fd; }
.feat-icon-circle.green { background: #e6f7ee; }
.feat-icon-circle.orange { background: #fff0e8; }
.feat-icon-circle.teal { background: #e0f5fb; }
.feat-icon-circle.purple { background: #f0eafc; }
.feat-icon-circle.navy { background: #e6ebf5; }
.feat-label { font-size: 13px; font-weight: 600; color: var(--navy); line-height: 1.3; }
.feat-arrow { color: var(--muted); font-size: 14px; }
/* =========================
   FEATURED CATALOG
========================= */

.featured-catalog-section {
    background: #fafafa;
    overflow: hidden;
}

/* TOP */

.catalog-top {
    display: flex;
    justify-content: space-between;
    gap: 40px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.catalog-left {
    flex: 1;
    min-width: 280px;
}

.catalog-right {
    width: 400px;
}

.ad-badge {
    display: inline-block;
    background: #ffe7dc;
    color: #ff6b2c;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 15px;
}

.catalog-title {
    font-size: 42px;
    font-weight: 800;
    color: #111827;
    margin-bottom: 15px;
}

.catalog-subtitle {
    color: #6b7280;
    line-height: 1.7;
    max-width: 700px;
}

/* FEATURES */

.catalog-features {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 25px;
}

.feature-item {
    background: #000;
    border: 1px solid #eee;
    padding: 12px 16px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 600;
}

.feature-item i {
    color: #ff6b2c;
    font-size: 18px;
}

/* RIGHT */

.explore-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border: 2px solid #ff6b2c;
    color: #ff6b2c;
    padding: 14px 24px;
    border-radius: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: .3s;
    margin-bottom: 20px;
}

.explore-btn:hover {
    background: #ff6b2c;
    color: #fff;
}

.catalog-note {
    background: #fff7f3;
    border-radius: 16px;
    padding: 10px;
    color: #555;
}

.catalog-note h6 {
    font-size: 15px;
    margin-bottom: 10px;
    font-weight: 700;
}

/* SLIDER */

.catalog-slider {
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 40px;
}

.catalog-track {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px;
    scrollbar-width: none;
}

.catalog-track::-webkit-scrollbar {
    display: none;
}

/* CARD */

.book-card {
    min-width: 350px;
    max-width: 200px;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    transition: .3s;
    flex-shrink: 0;
}

.book-card:hover {
    transform: translateY(-6px);
}

.book-card img {
    width: 100%;
    height: 320px;
    object-fit: cover;
}

.class-tag {
    position: absolute;
    top: 14px;
    left: 14px;
    background: #ff6b2c;
    color: #fff;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 700;
    z-index: 2;
}

.book-body {
    padding: 20px;
}

.book-body h4 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 12px;
    color: #333;
}

.publisher {
    color: #555;
    font-size: 14px;
    margin-bottom: 16px;
}

.price-label {
    color: #777;
    margin-bottom: 5px;
    font-size: 14px;
}

.price {
    color: #ff6b2c;
    font-weight: 800;
    margin-bottom: 15px;
}

.desc {
    color: #666;
    font-size: 14px;
    line-height: 1.7;
}

/* SLIDER BUTTONS */

.slider-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: none;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    position: absolute;
    z-index: 5;
    cursor: pointer;
}

.prev-btn {
    left: -20px;
}

.next-btn {
    right: -20px;
}

/* BOTTOM */

.bottom-info {
    background: #ff6b35;
    border-radius: 20px;
    padding: 25px;
    display: flex;
    justify-content: space-between;
    gap: 30px;
    flex-wrap: wrap;
}

.important-note {
    flex: 1;
    min-width: 280px;
}

.important-note h6 {
    font-weight: 700;
    margin-bottom: 12px;
}

.bottom-icons {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.info-box {
    min-width: 140px;
    text-align: center;
}

.info-box i {
    display: block;
    font-size: 24px;
    color: #ff6b2c;
    margin-bottom: 10px;
}

.info-box span {
    display: inline-block;
    padding: 10px 18px;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    background: linear-gradient(135deg, #f36522, #ff8c42);
    border: 1px solid rgba(255,255,255,0.3);
    border-radius: 30px;
    letter-spacing: 0.5px;
    box-shadow: 0 6px 18px rgba(243, 101, 34, 0.25);
    backdrop-filter: blur(8px);
    transition: all 0.4s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

/* Hover Effect */
.info-box span:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 10px 25px rgba(243, 101, 34, 0.4);
    background: linear-gradient(135deg, #ff8c42, #f36522);
}

/* Shine Animation */
.info-box span::before {
    content: "";
    position: absolute;
    top: 0;
    left: -75%;
    width: 50%;
    height: 100%;
    background: rgba(255,255,255,0.25);
    transform: skewX(-25deg);
    transition: 0.6s;
}

.info-box span:hover::before {
    left: 130%;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 991px) {

    .catalog-title {
        font-size: 34px;
    }

    .catalog-right {
        width: 100%;
    }

    .slider-btn {
        display: none;
    }
}

@media (max-width: 768px) {

    .catalog-title {
        font-size: 28px;
    }

    .catalog-subtitle {
        font-size: 14px;
    }

    .book-card {
        min-width: 240px;
        max-width: 240px;
    }

    .book-card img {
        height: 280px;
    }

    .bottom-icons {
        width: 100%;
        justify-content: space-between;
    }
}

@media (max-width: 576px) {

    .catalog-title {
        font-size: 24px;
    }

    .feature-item {
        width: 100%;
    }

    .book-card {
        min-width: 85%;
        max-width: 85%;
    }

    .bottom-icons {
        flex-direction: column;
        gap: 15px;
    }

    .info-box {
        width: 100%;
    }
}

/* stats-section css */

.stats-section{
    padding:-10px 20px;
    background:linear-gradient(135deg,#f8fafc,#eef4ff);
    position:relative;
    overflow:hidden;
}

.stats-section::before{
    content:'';
    position:absolute;
    width:350px;
    height:350px;
    background:rgba(243,101,34,.08);
    border-radius:50%;
    top:-120px;
    right:-120px;
}

.stats-container{
    max-width:900px;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:10px;
    position:relative;
    z-index:2;
}

.stat-item{
    background:#fff;
    border-radius:24px;
    padding:5px 5px;
    text-align:center;
    border:1px solid #ff6b2c;
    position:relative;
    overflow:hidden;
    transition:all .4s ease;
    box-shadow:0 8px 25px rgba(15,28,53,.06);
}

.stat-item::before{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(135deg,rgba(243,101,34,.08),transparent);
    opacity:0;
    transition:.4s;
}

.stat-item:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 45px rgba(15,28,53,.12);
    border-color:#f36522;
}

.stat-item:hover::before{
    opacity:1;
}

.stat-icon{
    width:58px;
    height:58px;
    margin:auto auto 2px;
    border-radius:50%;
    background:linear-gradient(135deg,#fff4ee,#ffe2d1);
    display:flex;
    align-items:center;
    justify-content:center;
    position:relative;
    animation:floatIcon 3s ease-in-out infinite;
}

.stat-icon i{
    color:#f36522;
    font-size:2rem;
    transition:.4s;
}

.stat-item:hover .stat-icon i{
    transform:scale(1.15) rotate(8deg);
}

.stat-number{
    font-size:2rem;
    font-weight:800;
    color:#0f1c35;
    /*margin-bottom:12px;*/
    line-height:1.2;
}

.stat-label{
    font-size:15px;
    line-height:1.7;
    color:#4b5563;
    font-weight:500;
}

@keyframes floatIcon{
    0%{
        transform:translateY(0px);
    }
    50%{
        transform:translateY(-8px);
    }
    100%{
        transform:translateY(0px);
    }
}

/* Tablet */

@media(max-width:991px){

    .stats-container{
        grid-template-columns:repeat(2,1fr);
    }

    .stat-number{
        font-size:2rem;
    }
}

/* Mobile */

@media(max-width:767px){

    .stats-section{
        padding:60px 15px;
    }

    .stats-container{
        grid-template-columns:1fr;
        gap:18px;
    }

    .stat-item{
        padding:28px 20px;
    }

    .stat-number{
        font-size:1.8rem;
    }

    .stat-label{
        font-size:14px;
    }

    .stat-icon{
        width:75px;
        height:75px;
    }

    .stat-icon i{
        font-size:2rem;
    }
}
</style>

<!-- Hero Section -->
<!--<section class="hero-section">-->
<!--    <div class="hero-content">-->
<!--        <h1 class="hero-title">-->
<!--            India’s Most <span class="gradient-text">Compliant</span><br>-->
<!--            Education Supply Platform-->
<!--        </h1>-->

<!--        <p class="hero-description">-->
<!--            A rule-driven education supply network connecting schools,-->
<!--            distributors, and publishers with complete compliance.-->
<!--        </p>-->

<!--        <a href="{{ url('/shop') }}" class="btn btn-getstarted" style="background:#f36522">-->
<!--            Explore Shop →-->
<!--        </a>-->
<!--    </div>-->
<!--</section>-->


<section class="hero-section" id="hero">
  <div class="hero-blob-1"></div>
  <div class="hero-blob-2"></div>
  <div class="container-xl position-relative" style="z-index:2;">
    <div class="text-center mx-auto" style="max-width:700px;"> 
      <h1 class="hero-title">
        India’s Structured <span class="hl">Education</span>
        Supply Chain Platform
      </h1>
      <p class="hero-desc mx-auto" style="max-width:560px;">
        GoErudite connects schools, distributors, retailers, and publishers through a role-based RFQ system designed for academic accuracy, controlled approvals, and transparent communication.
      </p>
      <div class="hero-features justify-content-center">
        <div class="hero-feat" style="min-width:250px;flex:0 1 200px;">
          <div class="hero-feat-icon">🏫</div>
          <div class="hero-feat-text"><strong>Schools raise requirements via RFQ</strong>Academic needs, clearly defined.</div>
        </div>
        <div class="hero-feat" style="min-width:250px;flex:0 1 200px;">
          <div class="hero-feat-icon">✅</div>
          <div class="hero-feat-text"><strong>Verified partners respond with quotes</strong>Distributors, retailers & publishers.</div>
        </div>
        <div class="hero-feat" style="min-width:250px;flex:0 1 200px;">
          <div class="hero-feat-icon">🔒</div>
          <div class="hero-feat-text"><strong>School approval controls access</strong>Contact details shared only after approval.</div>
        </div>
        <div class="hero-feat" style="min-width:250px;flex:0 1 200px;">
          <div class="hero-feat-icon">🤝</div>
          <div class="hero-feat-text"><strong>Deals happen outside the platform</strong>Payments, negotiations & deliveries are managed independently.</div>
        </div>
      </div>
      <a href="catalog" class="btn-orange">Explore Platform →</a>
      <p class="hero-disclaimer justify-content-center"><i class="bi bi-info-circle"></i> We act only as a technology facilitation platform. We do not sell, buy, or process payments.</p>
    </div>
  </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="stats-container">

        <div class="stat-item">
            <div class="stat-icon">
                <i class="fa-solid fa-school"></i>
            </div>

            <div class="stat-number counter" data-target="500">500+</div>

            <div class="stat-label">
                Academic Institutions <br> Connected
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon">
                <i class="fa-solid fa-book"></i>
            </div>

            <div class="stat-number counter" data-target="120">120+</div>

            <div class="stat-label">
                Verified Distributors, Retailers & Publishers
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon">
                <i class="fa-regular fa-circle-check"></i>
            </div>

            <div class="stat-number">
                Role-Based
            </div>

            <div class="stat-label">
                Operational <br> Workflows
            </div>
        </div>

        <div class="stat-item">
            <div class="stat-icon">
                <i class="fa-solid fa-globe"></i>
            </div>

            <div class="stat-number">
                Multi-State
            </div>

            <div class="stat-label">
                Academic <br> Network
            </div>
        </div>

    </div>
</section>

<!-- Ecosystem Section -->
<!-- =========================
     FEATURED ACADEMIC CATALOG
========================= -->
<section class="featured-catalog-section py-5">
    <div class="container">

        <!-- TOP HEADER -->
        <div class="catalog-top">

            <!-- LEFT CONTENT -->
            <div class="catalog-left">
                <span class="ad-badge">ADVERTISEMENT</span>

                <h2 class="catalog-title">
                    Featured Academic Catalog
                </h2>

                <p class="catalog-subtitle">
                   Explore textbooks and learning resources from verified publishers and supply partners. Information is provided for academic discovery and institutional reference only.
                </p>

                <!-- FEATURES -->
                <div class="catalog-features">
                    <div class="feature-item">
                        <i class="bi bi-patch-check"></i>
                        <span>Verified Partners</span>
                    </div>

                    <div class="feature-item">
                        <i class="bi bi-shield-check"></i>
                        <span>Quality Content</span>
                    </div>

                    <div class="feature-item">
                        <i class="bi bi-eye"></i>
                        <span>Academic Visibility</span>
                    </div>

                    <div class="feature-item">
                        <i class="bi bi-building"></i>
                        <span>Institution Focused</span>
                    </div>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="catalog-right">
                <a href="catalog" class="explore-btn">
                    Explore Catalog →
                </a>

                <div class="catalog-note">
                    <h6>
                        <i class="bi bi-info-circle"></i>
                        Catalog visibility on GoErudite is for academic discovery and institutional reference only.
                    </h6>

                    <p>
                        Pricing, availability, negotiations, payments, and order execution are handled independently by verified users after school approval.
                    </p>
                </div>
            </div>
        </div>

        <!-- BOOK SLIDER -->
        <div class="catalog-slider">

            <button class="slider-btn prev-btn">
                <i class="bi bi-chevron-left"></i>
            </button>

            <div class="catalog-track">

                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 9</span>

                    <img src="{{ asset('images/Science Explorer.jpg') }}" alt="Science Explorer">

                    <div class="book-body">

                        <h4>Science Explorer</h4>
                        <p class="desc">For the Curious Minds</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>Goerudite.in</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            Concept-based science content aligned with the academic curriculum.
                        </p>

                    </div>
                </div>

                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 8</span>

                    <img src="{{ asset('images/English Grammar.jpg') }}" alt="English Grammar">

                    <div class="book-body">

                        <h4>English Grammar</h4>
                        <p class="desc">Building Strong Foundations</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>Goerudite.in</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            Language learning content designed
                            for clarity and application.
                        </p>

                    </div>
                </div>

                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 12</span>

                    <img src="{{ asset('images/Physics Core.jpg') }}" alt="Physics Core">

                    <div class="book-body">

                        <h4>Physics Core</h4>
                        <p class="desc">Concepts | Numericals | Applications</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>BrightBooks</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            In-depth textbook for advanced concepts
                            and exam preparation.
                        </p>

                    </div>
                </div>

                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 10</span>

                    <img src="{{ asset('images/Mathematics World.jpg') }}" alt="Mathematics World">

                    <div class="book-body">

                        <h4>Mathematics World</h4>
                        <p class="desc">Think | Practice | Excel</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>BrightBooks</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            Structured mathematics content for
                            better understanding and performance.
                        </p>

                    </div>
                </div>
                
                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 9</span>

                    <img src="{{ asset('images/Science Explorer.jpg') }}" alt="Science Explorer">

                    <div class="book-body">

                        <h4>Science Explorer</h4>
                        <p class="desc">For the Curious Minds</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>Goerudite.in</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            Concept-based science content aligned with the academic curriculum.
                        </p>

                    </div>
                </div>

                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 8</span>

                    <img src="{{ asset('images/English Grammar.jpg') }}" alt="English Grammar">

                    <div class="book-body">

                        <h4>English Grammar</h4>
                        <p class="desc">Building Strong Foundations</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>Goerudite.in</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            Language learning content designed
                            for clarity and application.
                        </p>

                    </div>
                </div>

                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 12</span>

                    <img src="{{ asset('images/Physics Core.jpg') }}" alt="Physics Core">

                    <div class="book-body">

                        <h4>Physics Core</h4>
                        <p class="desc">Concepts | Numericals | Applications</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>BrightBooks</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            In-depth textbook for advanced concepts
                            and exam preparation.
                        </p>

                    </div>
                </div>

                <!-- CARD -->
                <div class="book-card">
                    <span class="class-tag">Class 10</span>

                    <img src="{{ asset('images/Mathematics World.jpg') }}" alt="Mathematics World">

                    <div class="book-body">

                        <h4>Mathematics World</h4>
                        <p class="desc">Think | Practice | Excel</p>
                        <div class="publisher">
                            <i class="bi bi-person-circle"></i>
                            Publisher:
                            <strong>BrightBooks</strong>
                        </div>

                        <p class="price-label">Academic Reference Price</p>

                        <h3 class="price">₹420*</h3>

                        <p class="desc">
                            Structured mathematics content for
                            better understanding and performance.
                        </p>

                    </div>
                </div>

            </div>

            <button class="slider-btn next-btn">
                <i class="bi bi-chevron-right"></i>
            </button>

        </div>

        <!-- BOTTOM INFO -->
        <div class="bottom-info">

            <div class="important-note">
                <h6>
                    <i class="bi bi-exclamation-circle"></i>
                    Important Note
                </h6>

                <p>
                    Displayed prices are publisher reference prices. Final quotations, negotiations, discounts, payment terms, and order execution occur only after institutional approval. GoErudite acts solely as a technology facilitation platform.
                </p>
            </div>

            <div class="bottom-icons">
                <div class="info-box">
                    <i class="bi bi-lock"></i>
                    <span>Secure & Private Information</span>
                </div>

                <div class="info-box">
                    <i class="bi bi-building-check"></i>
                    <span>School Approval Required</span>
                </div>

                <div class="info-box">
                    <i class="bi bi-shield-check"></i>
                    <span>100% Role-Based Access</span>
                </div>

                <div class="info-box">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Transparent Workflows</span>
                </div>

            </div>
        </div>

    </div>
</section>
<!-- End Section -->

<!-- ECOSYSTEM + WHY + PLATFORM -->
<section class="ecosystem-section" id="ecosystem">
  <div class="container-xl">
    <div class="row g-4 g-lg-5">

      <!-- Column 1: Ecosystem -->
      <div class="col-lg-4 reveal">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="bi bi-people-fill" style="color:var(--orange);font-size:18px;"></i>
          <span class="col-title">Education Supply <span style="color:var(--orange);">Ecosystem</span></span>
        </div>
        <p class="col-sub">A role-based workflow built for schools, distributors, retailers, and publishers.</p>
        <div class="divider-orange"></div>

        <div class="workflow-steps">
          <div class="workflow-step">
            <div class="step-icon-box">🏫</div>
            <div class="step-content">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span class="step-num">01</span><h5 class="mb-0">School RFQ Creation</h5></div>
              <p>Schools create structured textbook requirements using board, class, medium, subject, and session filters.</p>
            </div>
          </div>
          <div class="workflow-step">
            <div class="step-icon-box">📋</div>
            <div class="step-content">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span class="step-num">02</span><h5 class="mb-0">Verified Vendor Responses</h5></div>
              <p>Distributors, retailers, and publishers review RFQs and submit quotations based on stock, pricing, and availability.</p>
            </div>
          </div>
          <div class="workflow-step">
            <div class="step-icon-box">🔑</div>
            <div class="step-content">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span class="step-num">03</span><h5 class="mb-0">School Approval Access</h5></div>
              <p>School contact details remain protected until the institution manually approves a selected response.</p>
            </div>
          </div>
          <div class="workflow-step">
            <div class="step-icon-box">🤝</div>
            <div class="step-content">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;"><span class="step-num">04</span><h5 class="mb-0">Independent Deal Execution</h5></div>
              <p>Pricing discussions, payment settlements, and supply commitments happen directly between approved users outside the platform.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Column 2: Why GoErudite -->
      <div class="col-lg-4 reveal reveal-delay-1">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="bi bi-shield-fill-check" style="color:var(--orange);font-size:18px;"></i>
          <span class="col-title">Why <span style="color:var(--orange);">GoErudite?</span></span>
        </div>
        <p class="col-sub">Built for structured academic procurement, operational transparency, and institution-led decision-making.</p>
        <div class="divider-orange"></div>

        <div class="info-card">
          <div class="info-icon green">🔒</div>
          <div class="info-content">
            <h5>Session-Locked RFQ Workflows</h5>
            <p>Academic requirements remain structured by session, board, class, and institutional rules.</p>
          </div>
        </div>
        <div class="info-card">
          <div class="info-icon orange">📋</div>
          <div class="info-content">
            <h5>Audit-Ready Activity Logs</h5>
            <p>Every RFQ, quotation, approval, and communication is securely time-stamped for accountability.</p>
          </div>
        </div>
        <div class="info-card">
          <div class="info-icon blue">👥</div>
          <div class="info-content">
            <h5>Controlled Contact Visibility</h5>
            <p>Institution contact details are released only after manual approval from the school.</p>
          </div>
        </div>
        <div class="info-card">
          <div class="info-icon purple">🏫</div>
          <div class="info-content">
            <h5>GoErudite is a technology facilitation platform only.</h5>
            <p>We do not sell, purchase, transport, or process payments. Commercial deals are handled independently outside the platform after school approval.</p>
          </div>
        </div>

        <!--<div style="background:var(--light-bg);border:1px solid var(--border);border-radius:12px;padding:14px 16px;margin-top:10px;font-size:12px;color:var(--muted);line-height:1.6;">-->
        <!--  <i class="bi bi-shield-check" style="color:var(--orange);"></i> <strong style="color:var(--navy);">GoErudite</strong> is a technology facilitation platform only. We do not sell, purchase, transport, or process payments. Commercial deals are handled independently outside the platform after school approval.-->
        <!--</div>-->
      </div>

      <!-- Column 3: Platform Features -->
      <div class="col-lg-4 reveal reveal-delay-2">
        <div class="d-flex align-items-center gap-2 mb-1">
          <i class="bi bi-laptop" style="color:var(--orange);font-size:18px;"></i>
          <span class="col-title">Platform <span style="color:var(--orange);">Features</span></span>
        </div>
        <p class="col-sub">Designed to support secure academic sourcing and verified participation.</p>
        <div class="divider-orange"></div>

        <div class="feature-row">
          <div class="feat-left">
            <div class="feat-icon-circle blue"><i class="bi bi-person-badge" style="color:var(--blue);"></i></div>
            <span class="feat-label">Role-based registration and verification</span>
          </div>
          <i class="bi bi-chevron-right feat-arrow"></i>
        </div>
        <div class="feature-row">
          <div class="feat-left">
            <div class="feat-icon-circle green"><i class="bi bi-funnel-fill" style="color:var(--green);"></i></div>
            <span class="feat-label">Board, class, medium, and session filters</span>
          </div>
          <i class="bi bi-chevron-right feat-arrow"></i>
        </div>
        <div class="feature-row">
          <div class="feat-left">
            <div class="feat-icon-circle orange"><i class="bi bi-file-earmark-text-fill" style="color:var(--orange);"></i></div>
            <span class="feat-label">RFQ creation and quotation comparison</span>
          </div>
          <i class="bi bi-chevron-right feat-arrow"></i>
        </div>
        <div class="feature-row">
          <div class="feat-left">
            <div class="feat-icon-circle teal"><i class="bi bi-check2-circle" style="color:var(--teal);"></i></div>
            <span class="feat-label">Controlled approval workflows</span>
          </div>
          <i class="bi bi-chevron-right feat-arrow"></i>
        </div>
        <div class="feature-row">
          <div class="feat-left">
            <div class="feat-icon-circle purple"><i class="bi bi-bell-fill" style="color:var(--purple);"></i></div>
            <span class="feat-label">Secure notification and update center</span>
          </div>
          <i class="bi bi-chevron-right feat-arrow"></i>
        </div>
        <div class="feature-row">
          <div class="feat-left">
            <div class="feat-icon-circle navy"><i class="bi bi-lock-fill" style="color:#1a3a6e;"></i></div>
            <span class="feat-label">Privacy-protected institutional access</span>
          </div>
          <i class="bi bi-chevron-right feat-arrow"></i>
        </div>

        <div style="background:linear-gradient(135deg,var(--navy),#1a3a6e);border-radius:14px;padding:20px;margin-top:20px;text-align:center;">
          <div style="font-size:28px;margin-bottom:8px;">🛡️</div>
          <div style="font-size:14px;font-weight:700;color:var(--white);margin-bottom:6px;">Secure. Transparent. Accountable.</div>
          <div style="font-size:12px;color:rgba(255,255,255,.6);line-height:1.6;">Every action is role-based, time-stamped, and built for academic integrity.</div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Security Section -->
<!--<section class="ecosystem-main">-->
<!--    <div class="container">-->
<!--        <div class="row g-4">-->

        <!-- Ecosystem -->
<!--        <div class="col-lg-4">-->
<!--            <h3 class="column-title text-center">Ecosystem</h3>-->
<!--            <p class="column-subtitle text-center">A Solution for Every Stakeholder</p>-->
<!--            <div class="eco-grid">-->
<!--                <div class="eco-card">-->
<!--                    <div class="eco-icon blue">-->
<!--                    <span>🏫</span>-->
<!--                    </div>-->
<!--                    <h4>School</h4>-->
<!--                    <p>Build accurate book lists & verify deliveries.</p>-->
<!--                    <a href="#">Learn More <span>→</span></a>-->
<!--                </div>-->

<!--                <div class="eco-card">-->
<!--                    <div class="eco-icon green">-->
<!--                    <span>🚚</span>-->
<!--                    </div>-->
<!--                    <h4>Distributor</h4>-->
<!--                    <p>Manage warehouse, ASN, and Partial Dispatch.</p>-->
<!--                    <a href="#">Learn More <span>→</span></a>-->
<!--                </div>-->

<!--                <div class="eco-card">-->
<!--                    <div class="eco-icon purple">-->
<!--                    <span>🧾</span>-->
<!--                    </div>-->
<!--                    <h4>Retailer</h4>-->
<!--                    <p>POS for billing and Inventory Management.</p>-->
<!--                    <a href="#">Learn More <span>→</span></a>-->
<!--                </div>-->

<!--                <div class="eco-card">-->
<!--                    <div class="eco-icon orange">-->
<!--                    <span>📘</span>-->
<!--                    </div>-->
<!--                    <h4>Publisher</h4>-->
<!--                    <p>Control catalog, pricing & get AI insights.</p>-->
<!--                    <a href="#">Learn More <span>→</span></a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!-- Why GoErudite -->
<!--        <div class="col-lg-4">-->
<!--            <h3 class="column-title text-center">Why GoErudite?</h3>-->
<!--            <p class="column-subtitle text-center">-->
<!--            Generic ecommerce platforms fail in education. <br>-->
<!--            GoErudite is built on strict academic rules to <br> ensure compliance and trust.-->
<!--            </p>-->

<!--            <div class="info-wrapper">-->
<!--                <div class="info-card">-->
<!--                    <div class="info-icon green">💰</div>-->
<!--                    <div class="info-content">-->
<!--                    <h5>Session-Locked Pricing</h5>-->
<!--                    <p>-->
<!--                        Prices are frozen for the academic year. Publishers cannot change-->
<!--                        MRP mid-session, protecting schools from budget spikes.-->
<!--                    </p>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="info-card">-->
<!--                    <div class="info-icon orange">📋</div>-->
<!--                    <div class="info-content">-->
<!--                    <h5>Audit-Ready Workflows</h5>-->
<!--                    <p>-->
<!--                        Every order, approval, and return is logged with an immutable audit-->
<!--                        trail. "Who, When, What" is always recorded for legal safety.-->
<!--                    </p>-->
<!--                    </div>-->
<!--                </div>-->

<!--                <div class="info-card">-->
<!--                    <div class="info-icon blue">👥</div>-->
<!--                    <div class="info-content">-->
<!--                    <h5>Board Compliance</h5>-->
<!--                    <p>-->
<!--                        Books are tagged by Board (CBSE/ICSE) and Medium. The system prevents-->
<!--                        ordering mismatched materials for a school's profile.-->
<!--                    </p>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

        <!-- Ebook Services -->
<!--        <div class="col-lg-4">-->
<!--            <h3 class="column-title text-center">Our E-Book Services</h3>-->
<!--            <p class="column-subtitle text-center">-->
<!--            Empowering students, schools, and educators <br> with digital learning solutions.-->
<!--            </p>-->
<!--            <ul class="ebook-list">-->
<!--                <li class="info-card">Access thousands of e-books anytime, anywhere</li>-->
<!--                <li class="info-card">Interactive quizzes, notes & multimedia</li>-->
<!--                <li class="info-card">Secure cloud-based access & enrollment</li>-->
<!--                <li class="info-card">Track reading progress & engagement</li>-->
<!--                <li class="info-card">100% genuine books from verified publishers</li>-->
<!--                <li class="info-card">Easy returns for damaged or wrong syllabus</li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</section>-->
<!-- End Security Section -->

<!-- Client Testimonial Section -->
<section class="testimonial-section">
  <div class="container">

    <!-- Heading -->
    <div class="testimonial-header">
      <h2>Trusted by Education Supply Partners</h2>
      <p>Hear from schools, distributors, and publishers using structured workflows through GoErudite.</p>
    </div>

    <!-- Cards -->
    <div class="testimonial-grid">

      <div class="testimonial-card">
        <p>
         “GoErudite helped our institution organize textbook planning, compare verified responses, and maintain approval control without operational confusion.”
        </p>
        <div class="author">
          <div>
            <h5>Sachin Patel</h5>
            <!--<span>Principal, Greenfield School</span>-->
          </div>
          <img src="{{ asset('images/kid image-1.jpeg') }}" alt="Client">
        </div>
      </div>

      <div class="testimonial-card">
        <p>
          “The RFQ workflow helped us receive institution-led requirements with better clarity, faster response planning, and structured communication.”
        </p>
        <div class="author">
          <div>
            <h5>Suraj Patel</h5>
            <!--<span>Operations Head, EduDistrib</span>-->
          </div>
          <img src="{{ asset('images/kid image-1.jpeg') }}" alt="Client">
        </div>
      </div>

      <div class="testimonial-card">
        <p>
          “GoErudite improved our academic catalog visibility and helped us connect with verified institutional requirements more efficiently.”
        </p>
        <div class="author">
          <div>
            <h5>Raju Routh</h5>
            <!--<span>Publisher, LearnBooks</span>-->
          </div>
          <img src="{{ asset('images/kid image-1.jpeg') }}" alt="Client">
        </div>
      </div>

    </div>
  </div>
</section>

<!-- End Client Testimonial Section -->
<!-- CTA -->
<!--<section class="cta-section">-->
<!--  <div class="cta-inner">-->
<!--    <div class="cta-img-side">-->
<!--      <img src="{{ asset('images/Join GOErudite Girl.png') }}" alt="Join GoErudite">-->
<!--    </div>-->
<!--    <div class="cta-content-side flex-lg-row d-flex flex-column flex-lg-row gap-4">-->
<!--      <div class="flex-1" style="flex:1;">-->
<!--        <h2 class="cta-title">One Platform. Structured Academic Connections.</h2>-->
<!--        <p class="cta-sub">Built for schools to raise verified requirements and for supply partners to respond through controlled RFQ workflows.</p>-->
<!--        <div class="d-flex gap-3 flex-wrap">-->
<!--          <a href="login" class="btn-white">Join GoErudite →</a>-->
<!--          <a href="catalog" class="btn-white-outline">Explore Catalog →</a>-->
<!--        </div>-->
<!--        <p class="cta-disclaimer">GoErudite operates only as a technology facilitation platform. Pricing discussions, payments, and final commercial agreements are independently handled by approved users.</p>-->
<!--      </div>-->
<!--      <div class="d-none d-xl-flex flex-column justify-content-center gap-3" style="min-width:240px;">-->
<!--        <div class="cta-feat">-->
<!--          <div class="cta-feat-icon"><i class="bi bi-shield-fill-check"></i></div>-->
<!--          <div class="cta-feat-text"><strong>Secure &amp; Verified</strong><span>Verified institutions and partners only</span></div>-->
<!--        </div>-->
<!--        <div class="cta-feat">-->
<!--          <div class="cta-feat-icon"><i class="bi bi-lock-fill"></i></div>-->
<!--          <div class="cta-feat-text"><strong>Controlled Access</strong><span>Contact details shared after approval</span></div>-->
<!--        </div>-->
<!--        <div class="cta-feat">-->
<!--          <div class="cta-feat-icon"><i class="bi bi-clipboard2-check-fill"></i></div>-->
<!--          <div class="cta-feat-text"><strong>Transparent Workflows</strong><span>Every action is tracked and recorded</span></div>-->
<!--        </div>-->
<!--        <div class="cta-feat">-->
<!--          <div class="cta-feat-icon"><i class="bi bi-mortarboard-fill"></i></div>-->
<!--          <div class="cta-feat-text"><strong>Built for Education</strong><span>Focused on academic procurement</span></div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->



 <!--CTA -->
<section class="cta-section py-5">
    <div class="container">
        <div class="row align-items-center">

            <!-- Left Image -->
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <div class="cta-image">
                    <img src="{{ asset('images/Join GOErudite Girl.png') }}" 
                         alt="GoErudite CTA" 
                         class="img-fluid">
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-md-6">
                <div class="cta-content text-center text-md-start">
                    <h2>One Platform. One Compliant Network.</h2>
                    <p>
                        Built for schools, distributors, and publishers across India.
                    </p>

                    <div class="cta-buttons d-flex flex-wrap gap-3 justify-content-center justify-content-md-start">
                        <a href="#" class="btn btn-primary">
                            Join GoErudite
                        </a>

                        <a href="shop.php" class="btn btn-secondary">
                            Shop Now
                        </a>
                    </div>
                </div>
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
<script>
    const track = document.querySelector('.catalog-track');
    const nextBtn = document.querySelector('.next-btn');
    const prevBtn = document.querySelector('.prev-btn');

    nextBtn.addEventListener('click', () => {
        track.scrollBy({
            left: 320,
            behavior: 'smooth'
        });
    });

    prevBtn.addEventListener('click', () => {
        track.scrollBy({
            left: -320,
            behavior: 'smooth'
        });
    });
    
    
    /* Counter Animation */

const counters = document.querySelectorAll('.counter');

const speed = 100;

counters.forEach(counter => {

    const animate = () => {

        const value = +counter.getAttribute('data-target');
        const data = +counter.innerText.replace('+','');

        const time = value / speed;

        if(data < value){
            counter.innerText = Math.ceil(data + time) + '+';
            setTimeout(animate,20);
        }else{
            counter.innerText = value + '+';
        }
    };

    animate();
});
</script>
@endpush
