@extends('layouts.app')

@section('title', 'Our Solutions | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>

/* ══════════════════════════════
   ROOT
══════════════════════════════ */
:root {
  --orange   : #f36522;
  --orange-lt: #fff4ee;
  --navy     : #0c1220;
  --navy2    : #1a2a4a;
  --green    : #1d7a4b;
  --green-lt : #e6f7ee;
  --purple   : #6c3fcf;
  --purple-lt: #f0eafc;
  --blue     : #2563eb;
  --blue-lt  : #e8f0fd;
  --white    : #ffffff;
  --light    : #f5f7fb;
  --border   : #e5e9f0;
  --text     : #1f2937;
  --sub      : #4b5563;
  --muted    : #6b7280;
  --shadow   : 0 2px 16px rgba(15,28,53,.08);
  --radius   : 14px;
}

.solutions-page * { box-sizing: border-box; margin: 0; padding: 0; }
.solutions-page {
  font-family: 'Inter', sans-serif;
  background: var(--light);
  color: var(--text);
}

/* ══════════════════════════════
   GLOBAL HERO
══════════════════════════════ */
.global-hero {
  position: relative;
  min-height: 640px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 80px 20px;
  background:
    linear-gradient(rgba(12,18,32,.75), rgba(12,18,32,.75)),
    url('https://images.unsplash.com/photo-1553413077-190dd305871c?w=1400&q=80')
    center / cover no-repeat;
  overflow: hidden;
}
.global-hero::after {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(180deg, transparent 60%, rgba(12,18,32,.4) 100%);
  pointer-events: none;
}
.global-hero-content { position: relative; z-index: 2; max-width: 660px; }
.global-hero h1 {
  font-size: clamp(28px, 4.5vw, 52px);
  font-weight: 800;
  color: var(--white);
  line-height: 1.15;
  margin-bottom: 18px;
}
.global-hero h1 span { color: var(--orange); }
.global-hero p {
  font-size: clamp(14px, 1.5vw, 16px);
  color: rgba(255,255,255,.78);
  line-height: 1.75;
  margin-bottom: 30px;
}
.btn-hero {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: var(--orange);
  color: var(--white);
  font-size: 15px;
  font-weight: 700;
  padding: 13px 32px;
  border-radius: 40px;
  text-decoration: none;
  transition: background .25s, transform .2s, box-shadow .25s;
  border: none;
  cursor: pointer;
}
.btn-hero:hover {
  background: #d9551a;
  color: var(--white);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(243,101,34,.45);
}

/* ══════════════════════════════
   STAKEHOLDER SECTION WRAPPER
══════════════════════════════ */
.stakeholder-section {
  padding: 60px 0;
  background: var(--white);
  border-bottom: 1px solid var(--border);
}
.stakeholder-section:nth-child(odd) { background: var(--light); }

.container-sol {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 24px;
}

/* ══════════════════════════════
   SPLIT LAYOUT (image left, content right)
══════════════════════════════ */
.sol-split {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 48px;
  align-items: flex-start;
}
.sol-split.reverse { grid-template-columns: 1fr 300px; }
.sol-split.reverse .sol-left  { order: 2; }
.sol-split.reverse .sol-right { order: 1; }

/* Left panel */
.sol-left { display: flex; flex-direction: column; align-items: flex-start; gap: 20px; }
.sol-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  border-radius: 30px;
  padding: 6px 16px;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}
.sol-tag.school     { background: #e8f0fd; color: var(--blue); }
.sol-tag.distributor{ background: var(--green-lt); color: var(--green); }
.sol-tag.retailer   { background: var(--purple-lt); color: var(--purple); }
.sol-tag.publisher  { background: var(--orange-lt); color: var(--orange); }
.sol-tag i { font-size: 15px; }

.sol-illus {
  width: 100%;
  max-width: 110px;
  height: 110px;
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 90px;
  background: var(--light);
  border: 1px solid var(--border);
  position: relative;
  overflow: hidden;
}
.sol-illus img { width: 100%; height: 100%; object-fit: cover; border-radius: 18px; }

.sol-left h2 {
  font-size: clamp(20px, 2.5vw, 22px);
  font-weight: 800;
  color: var(--navy);
  line-height: 1.25;
}
.sol-left p {
  font-size: 14px;
  color: var(--sub);
  line-height: 1.75;
}

.btn-register {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  font-size: 13px;
  font-weight: 700;
  padding: 11px 22px;
  border-radius: 30px;
  text-decoration: none;
  transition: all .25s;
  cursor: pointer;
  border: 2px solid transparent;
}
.btn-register.school      { background: var(--blue); color: var(--white); }
.btn-register.school:hover{ background: #1a4fc4; }
.btn-register.distributor      { background: var(--green); color: var(--white); }
.btn-register.distributor:hover{ background: #155a38; }
.btn-register.retailer      { background: var(--purple); color: var(--white); }
.btn-register.retailer:hover{ background: #532fa0; }
.btn-register.publisher      { background: var(--orange); color: var(--white); }
.btn-register.publisher:hover{ background: #d9551a; }
.btn-register i { font-size: 14px; }

/* Right panel */
.sol-right {}
.sol-overview-label {
  font-size: 14px;
  font-weight: 700;
  color: var(--orange);
  margin-bottom: 6px;
  display: block;
}
.sol-overview-text {
  font-size: 13.5px;
  color: var(--sub);
  line-height: 1.7;
  margin-bottom: 24px;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--border);
}

/* Key features label */
.kf-label {
  text-align: center;
  font-size: 13px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 16px;
  letter-spacing: .5px;
}

/* Feature cards grid */
.feat-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 14px;
}
.feat-card {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 60px 14px;
  text-align: center;
  transition: border-color .25s, transform .25s, box-shadow .25s;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
}
.feat-card:hover {
  border-color: var(--orange);
  transform: translateY(-4px);
  box-shadow: 0 10px 28px rgba(243,101,34,.12);
}
.feat-icon-wrap {
  width: 52px;
  height: 52px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  flex-shrink: 0;
  transition: transform .2s;
}
.feat-card:hover .feat-icon-wrap { transform: scale(1.1); }

/* icon colour variants */
.fi-blue   { background: var(--blue-lt); color: var(--blue); }
.fi-green  { background: var(--green-lt); color: var(--green); }
.fi-orange { background: var(--orange-lt); color: var(--orange); }
.fi-purple { background: var(--purple-lt); color: var(--purple); }
.fi-teal   { background: #e0f5fb; color: #0d8cad; }
.fi-red    { background: #fdeaea; color: #d63031; }
.fi-navy   { background: #e6ebf5; color: var(--navy2); }

.feat-card h4 {
  font-size: 13px;
  font-weight: 700;
  color: var(--navy);
  line-height: 1.3;
  margin: 0;
}
.feat-card p {
  font-size: 12px;
  color: var(--sub);
  line-height: 1.6;
  margin: 0;
}

/* ══════════════════════════════
   PLATFORM DISCLAIMER FOOTER BAR
══════════════════════════════ */
.disclaimer-bar {
  background: var(--navy);
  padding: 20px 24px;
}
.disclaimer-inner {
  max-width: 1100px;
  margin: 0 auto;
  display: flex;
  align-items: flex-start;
  gap: 16px;
}
.disclaimer-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: rgba(243,101,34,.18);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--orange);
  font-size: 20px;
  flex-shrink: 0;
  margin-top: 2px;
}
.disclaimer-text strong {
  display: block;
  font-size: 14px;
  font-weight: 700;
  color: var(--white);
  margin-bottom: 4px;
}
.disclaimer-text span {
  font-size: 13px;
  color: rgba(255,255,255,.65);
  line-height: 1.65;
}

/* ══════════════════════════════
   RESPONSIVE — TABLET ≤ 900px
══════════════════════════════ */
@media (max-width: 900px) {
  .sol-split,
  .sol-split.reverse {
    grid-template-columns: 1fr;
  }
  .sol-split.reverse .sol-left,
  .sol-split.reverse .sol-right { order: unset; }
  .sol-illus { max-width: 100%; height: 180px; }
  .feat-grid { grid-template-columns: repeat(2, 1fr); }
}

/* ══════════════════════════════
   RESPONSIVE — MOBILE ≤ 600px
══════════════════════════════ */
@media (max-width: 600px) {
  .stakeholder-section { padding: 40px 0; }
  .container-sol { padding: 0 16px; }
  .sol-split { gap: 28px; }
  .feat-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
  .feat-card { padding: 14px 10px; }
  .global-hero { padding: 60px 16px; }
  .disclaimer-inner { flex-direction: column; }
}

@media (max-width: 420px) {
  .feat-grid { grid-template-columns: 1fr 1fr; }
  .feat-icon-wrap { width: 44px; height: 44px; font-size: 18px; }
}

</style>

<div class="solutions-page">

  {{-- ══════════ GLOBAL HERO ══════════ --}}
  <section class="global-hero">
    <div class="global-hero-content">
      <h1>Smart Solutions Built for<br><span>Academic</span> Procurement</h1>
      <p>Create textbook RFQs, receive verified supplier responses, control institutional approvals, and manage academic sourcing through one structured platform.</p>
      <a href="{{ url('/login') }}" class="btn-hero">Login &nbsp;→</a>
    </div>
  </section>

  {{-- ══════════ SCHOOLS ══════════ --}}
  <section class="stakeholder-section" id="schools">
    <div class="container-sol">
      <div class="sol-split">

        {{-- Left --}}
        <div class="sol-left">
          <span class="sol-tag school"><i class="bi bi-building"></i> For Schools</span>
          <div class="sol-illus">🏫</div>
          <h2>Build Accurate Academic Requirements for Your Institution</h2>
          <p>Create structured textbook requirements using board, class, medium, subject, and academic session filters. Compare verified supply responses while keeping institutional approvals fully under your control.</p>
          <a href="{{ url('/login') }}" class="btn-register school">Register as a School &nbsp;→</a>
        </div>

        {{-- Right --}}
        <div class="sol-right">
          <span class="sol-overview-label">Overview</span>
          <p class="sol-overview-text">Schools use GoErudite to create academic RFQs, review verified supply responses, and release contact access only after internal approval.</p>

          <div class="kf-label">Key Features</div>
          <div class="feat-grid">
            <div class="feat-card">
              <div class="feat-icon-wrap fi-blue"><i class="bi bi-file-earmark-plus-fill"></i></div>
              <h4>Academic RFQ Creation</h4>
              <p>Raise structured textbook requirements based on curriculum and session needs.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-green"><i class="bi bi-bar-chart-fill"></i></div>
              <h4>Quote Comparison</h4>
              <p>Compare verified distributor, retailer, and publisher responses in one workflow.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-purple"><i class="bi bi-shield-check"></i></div>
              <h4>Approval Control</h4>
              <p>Institution contact details remain protected until manual school approval.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-orange"><i class="bi bi-clipboard2-check-fill"></i></div>
              <h4>Audit Logs</h4>
              <p>Every RFQ, response, and approval event is securely time-stamped.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ══════════ DISTRIBUTORS ══════════ --}}
  <section class="stakeholder-section" id="distributors">
    <div class="container-sol">
      <div class="sol-split">

        {{-- Left --}}
        <div class="sol-left">
          <span class="sol-tag distributor"><i class="bi bi-truck"></i> For Distributors</span>
          <div class="sol-illus">🚛</div>
          <h2>Respond to Verified Institutional Requirements</h2>
          <p>Access school-approved academic demand and respond with stock availability, supply capability, and quotation details.</p>
          <a href="{{ url('/login') }}" class="btn-register distributor">Register as a Distributor &nbsp;→</a>
        </div>

        {{-- Right --}}
        <div class="sol-right">
          <span class="sol-overview-label">Overview</span>
          <p class="sol-overview-text">Distributors participate only in verified institutional RFQs and communicate through structured workflows.</p>

          <div class="kf-label">Key Features</div>
          <div class="feat-grid">
            <div class="feat-card">
              <div class="feat-icon-wrap fi-blue"><i class="bi bi-search"></i></div>
              <h4>RFQ Access</h4>
              <p>View institution requirements based on board, class, and region.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-green"><i class="bi bi-send-fill"></i></div>
              <h4>Quote Submission</h4>
              <p>Submit availability, pricing references, and fulfillment capability.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-teal"><i class="bi bi-graph-up-arrow"></i></div>
              <h4>Response Tracking</h4>
              <p>Track submitted quotations, approval status, and communication history.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-navy"><i class="bi bi-eye-fill"></i></div>
              <h4>Approval Visibility</h4>
              <p>School details become visible only after institutional approval.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ══════════ RETAILERS ══════════ --}}
  <section class="stakeholder-section" id="retailers">
    <div class="container-sol">
      <div class="sol-split">

        {{-- Left --}}
        <div class="sol-left">
          <span class="sol-tag retailer"><i class="bi bi-shop"></i> For Retailers</span>
          <div class="sol-illus">🏪</div>
          <h2>Participate in Institutional Supply Opportunities</h2>
          <p>Respond to academic RFQs with localized inventory support and institution-ready supply planning.</p>
          <a href="{{ url('/login') }}" class="btn-register retailer">Register as a Retailer &nbsp;→</a>
        </div>

        {{-- Right --}}
        <div class="sol-right">
          <span class="sol-overview-label">Overview</span>
          <p class="sol-overview-text">Retailers can respond to school requirements through structured quotation workflows.</p>

          <div class="kf-label">Key Features</div>
          <div class="feat-grid">
            <div class="feat-card">
              <div class="feat-icon-wrap fi-purple"><i class="bi bi-geo-alt-fill"></i></div>
              <h4>Requirement Matching</h4>
              <p>Receive relevant textbook RFQs based on academic filters.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-blue"><i class="bi bi-box-seam-fill"></i></div>
              <h4>Inventory Visibility</h4>
              <p>Respond using real stock availability and regional service capability.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-teal"><i class="bi bi-chat-dots-fill"></i></div>
              <h4>Communication Workflow</h4>
              <p>Manage response history and approval updates.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-navy"><i class="bi bi-lock-fill"></i></div>
              <h4>Secure Participation</h4>
              <p>Access institutional contact only after school approval.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ══════════ PUBLISHERS ══════════ --}}
  <section class="stakeholder-section" id="publishers">
    <div class="container-sol">
      <div class="sol-split">

        {{-- Left --}}
        <div class="sol-left">
          <span class="sol-tag publisher"><i class="bi bi-book-fill"></i> For Publishers</span>
          <div class="sol-illus">📚</div>
          <h2>Showcase Academic Catalogs to Verified Institutions</h2>
          <p>Increase catalog visibility and participate in institution-led textbook demand workflows.</p>
          <a href="{{ url('/login') }}" class="btn-register publisher">Register as a Publisher &nbsp;→</a>
        </div>

        {{-- Right --}}
        <div class="sol-right">
          <span class="sol-overview-label">Overview</span>
          <p class="sol-overview-text">Publishers can display academic catalogs and respond to verified institutional requirements.</p>

          <div class="kf-label">Key Features</div>
          <div class="feat-grid">
            <div class="feat-card">
              <div class="feat-icon-wrap fi-orange"><i class="bi bi-book-half"></i></div>
              <h4>Catalog Visibility</h4>
              <p>Showcase textbooks by board, class, and subject.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-blue"><i class="bi bi-bar-chart-line-fill"></i></div>
              <h4>Demand Insights</h4>
              <p>Understand academic requirement trends and demand patterns.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-green"><i class="bi bi-check2-circle"></i></div>
              <h4>Response Participation</h4>
              <p>Submit pricing references and availability to institutions.</p>
            </div>
            <div class="feat-card">
              <div class="feat-icon-wrap fi-purple"><i class="bi bi-shield-lock-fill"></i></div>
              <h4>Controlled Access</h4>
              <p>Institution contact is shared only after approval.</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ══════════ DISCLAIMER BAR ══════════ --}}
  <div class="disclaimer-bar">
    <div class="disclaimer-inner">
      <div class="disclaimer-icon"><i class="bi bi-shield-fill-check"></i></div>
      <div class="disclaimer-text">
        <strong>GoErudite operates solely as a technology facilitation platform.</strong>
        <span>Pricing negotiations, payments, logistics, and final commercial agreements are independently handled by approved users outside the platform.</span>
      </div>
    </div>
  </div>

</div>{{-- /solutions-page --}}

@endsection

@push('scripts')
<script>
/* Smooth scroll for any anchor links on this page */
document.querySelectorAll('a[href^="#"]').forEach(function(a) {
  a.addEventListener('click', function(e) {
    var target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});
</script>
@endpush