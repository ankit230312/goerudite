@extends('layouts.app')

@section('title', 'Pricing | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India.')
@section('keywords', 'GoErudite pricing, subscription plans, digital textbooks India')

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
  --amber    : #f59e0b;
  --amber-lt : #fef9e7;
  --red      : #dc2626;
  --red-lt   : #fdeaea;
  --white    : #ffffff;
  --light    : #f5f7fb;
  --border   : #e5e9f0;
  --text     : #1f2937;
  --sub      : #4b5563;
  --muted    : #6b7280;
  --shadow   : 0 2px 16px rgba(15,28,53,.08);
  --radius   : 14px;
}

.pricing-page * { box-sizing: border-box; margin: 0; padding: 0; }
.pricing-page {
  font-family: 'Inter', sans-serif;
  background: var(--light);
  color: var(--text);
}

/* ══════════════════════════════
   HERO
══════════════════════════════ */
.p-hero {
  position: relative;
  min-height: 650px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 80px 20px;
  background:
    linear-gradient(rgba(12,18,32,.76), rgba(12,18,32,.76)),
    url('https://i.postimg.cc/02rWdqwH/calculator.jpg')
    center / cover no-repeat;
  overflow: hidden;
}
.p-hero-content { position: relative; z-index: 2; max-width: 640px; }
.p-hero h1 {
  font-size: clamp(28px, 4.5vw, 52px);
  font-weight: 800;
  color: var(--white);
  line-height: 1.15;
  margin-bottom: 16px;
}
.p-hero h1 span { color: var(--orange); display: block; }
.p-hero p {
  font-size: clamp(14px, 1.5vw, 16px);
  color: rgba(255,255,255,.75);
  line-height: 1.75;
  margin-bottom: 32px;
}
.btn-hero-orange {
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
}
.btn-hero-orange:hover {
  background: #d9551a;
  color: var(--white);
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(243,101,34,.45);
}

/* ══════════════════════════════
   PRICING CARDS SECTION
══════════════════════════════ */
.pricing-section {
  padding: 60px 0 40px;
  background: var(--white);
}
.pricing-wrap {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 20px;
}
.pricing-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  align-items: stretch;
}

/* Individual pricing card */
.p-card {
  background: var(--white);
  border: 1.5px solid var(--border);
  border-radius: 20px;
  padding: 28px 22px;
  display: flex;
  flex-direction: column;
  gap: 0;
  position: relative;
  transition: box-shadow .3s, transform .3s;
}
.p-card:hover {
  box-shadow: 0 16px 48px rgba(15,28,53,.12);
  transform: translateY(-4px);
}

/* Popular badge */
.popular-badge {
  position: absolute;
  top: -13px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--orange);
  color: var(--white);
  font-size: 10px;
  font-weight: 800;
  padding: 4px 16px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 1px;
  white-space: nowrap;
}

/* Card icon */
.p-card-icon {
  width: 60px;
  height: 60px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  margin: 0 auto 16px;
}
.pi-green  { background: var(--green-lt); }
.pi-orange { background: var(--orange-lt); }
.pi-blue   { background: var(--blue-lt); }
.pi-purple { background: var(--purple-lt); }

/* Card plan name */
.p-plan-name {
  text-align: center;
  font-size: 16px;
  font-weight: 800;
  margin-bottom: 4px;
}
.p-plan-name.green  { color: var(--green); }
.p-plan-name.orange { color: var(--orange); }
.p-plan-name.blue   { color: var(--blue); }
.p-plan-name.purple { color: var(--purple); }

.p-plan-for {
  text-align: center;
  font-size: 12px;
  color: var(--muted);
  line-height: 1.5;
  margin-bottom: 18px;
}

/* Price */
.p-price {
  text-align: center;
  margin-bottom: 6px;
}
.p-price .amount {
  font-size: 32px;
  font-weight: 800;
  line-height: 1;
}
.p-price .amount.green  { color: var(--green); }
.p-price .amount.orange { color: var(--orange); }
.p-price .amount.blue   { color: var(--blue); }
.p-price .amount.purple { color: var(--purple); }
.p-price .period {
  font-size: 12px;
  color: var(--muted);
  display: block;
  margin-top: 3px;
}

.p-divider {
  border: none;
  border-top: 1px solid var(--border);
  margin: 18px 0;
}

/* Feature list */
.p-feat-list {
  list-style: none;
  padding: 0;
  display: flex;
  flex-direction: column;
  gap: 9px;
  flex: 1;
  margin-bottom: 24px;
}
.p-feat-list li {
  display: flex;
  align-items: flex-start;
  gap: 9px;
  font-size: 13px;
  color: var(--sub);
  line-height: 1.5;
}
.p-feat-list li i {
  font-size: 14px;
  flex-shrink: 0;
  margin-top: 1px;
}
.p-feat-list li i.yes  { color: var(--green); }
.p-feat-list li i.no   { color: #d1d5db; }

/* CTA buttons */
.btn-plan {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  font-size: 14px;
  font-weight: 700;
  padding: 12px 20px;
  border-radius: 30px;
  text-decoration: none;
  transition: all .25s;
  width: 100%;
  border: 2px solid transparent;
}
.btn-plan.green   { background: var(--green); color: var(--white); }
.btn-plan.green:hover  { background: #155a38; color: var(--white); }
.btn-plan.orange  { background: var(--orange); color: var(--white); }
.btn-plan.orange:hover { background: #d9551a; color: var(--white); }
.btn-plan.blue    { background: var(--blue); color: var(--white); }
.btn-plan.blue:hover   { background: #1a4fc4; color: var(--white); }
.btn-plan.purple  { background: var(--purple); color: var(--white); }
.btn-plan.purple:hover { background: #532fa0; color: var(--white); }

/* "Always Free for Schools" note */
.always-free-note {
  text-align: center;
  margin-top: 20px;
  font-size: 13px;
  color: var(--green);
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

/* ══════════════════════════════
   COMMERCIAL RESPONSIBILITY BOX
══════════════════════════════ */
.comm-resp-section {
  background: var(--white);
  padding: 0 0 48px;
}
.comm-resp-box {
  max-width: 1120px;
  margin: 0 auto;
  padding: 0 20px;
}
.comm-resp-card {
  background: var(--light);
  border: 1px solid var(--border);
  border-radius: 18px;
  overflow: hidden;
}
.comm-resp-header {
  background: linear-gradient(to right, var(--navy), var(--navy2));
  padding: 16px 28px;
  text-align: center;
}
.comm-resp-header h3 {
  font-size: 16px;
  font-weight: 700;
  color: var(--white);
  margin: 0;
}
.comm-resp-cols {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 0;
}
.comm-col {
  padding: 24px 22px;
  display: flex;
  align-items: flex-start;
  gap: 14px;
  border-right: 1px solid var(--border);
}
.comm-col:last-child { border-right: none; }
.comm-col-icon {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  flex-shrink: 0;
}
.cc-blue   { background: var(--blue-lt); color: var(--blue); }
.cc-red    { background: var(--red-lt); color: var(--red); }
.cc-green  { background: var(--green-lt); color: var(--green); }
.comm-col-text h5 { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 6px; }
.comm-col-text p  { font-size: 12.5px; color: var(--sub); line-height: 1.65; }

.secure-note {
  text-align: center;
  padding: 16px;
  font-size: 12.5px;
  color: var(--muted);
  border-top: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
}
.secure-note i { color: var(--green); }

/* ══════════════════════════════
   BILLING SECTION
══════════════════════════════ */
.billing-section {
  padding: 64px 0;
  background: var(--light);
}
.billing-wrap {
  max-width: 900px;
  margin: 0 auto;
  padding: 0 20px;
}
.billing-section-title {
  text-align: center;
  font-size: clamp(24px, 3.5vw, 38px);
  font-weight: 800;
  color: var(--navy);
  margin-bottom: 10px;
  line-height: 1.2;
}
.billing-section-sub {
  text-align: center;
  font-size: 14px;
  color: var(--sub);
  line-height: 1.7;
  max-width: 580px;
  margin: 0 auto 32px;
}

/* Notice banner */
.billing-notice {
  background: var(--blue-lt);
  border: 1px solid #c3d8fc;
  border-radius: 12px;
  padding: 16px 20px;
  display: flex;
  align-items: flex-start;
  gap: 12px;
  margin-bottom: 36px;
  font-size: 13.5px;
  color: var(--navy);
  line-height: 1.65;
}
.billing-notice i { color: var(--blue); font-size: 18px; flex-shrink: 0; margin-top: 2px; }
.billing-notice strong { color: var(--blue); }

/* Billing items */
.billing-items { display: flex; flex-direction: column; gap: 20px; }
.billing-item {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 24px;
  display: grid;
  grid-template-columns: 64px 1fr 120px;
  gap: 20px;
  align-items: center;
  transition: border-color .25s, box-shadow .25s, transform .25s;
}
.billing-item:hover {
  border-color: var(--orange);
  box-shadow: 0 8px 28px rgba(243,101,34,.09);
  transform: translateY(-2px);
}
.billing-item-icon {
  width: 56px;
  height: 56px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  flex-shrink: 0;
}
.bi-green  { background: var(--green-lt); color: var(--green); }
.bi-blue   { background: var(--blue-lt); color: var(--blue); }
.bi-purple { background: var(--purple-lt); color: var(--purple); }
.bi-amber  { background: var(--amber-lt); color: var(--amber); }
.bi-red    { background: var(--red-lt); color: var(--red); }
.bi-navy   { background: #e6ebf5; color: var(--navy); }

.billing-item-num {
  width: 26px;
  height: 26px;
  border-radius: 50%;
  background: var(--orange);
  color: var(--white);
  font-size: 12px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 8px;
  flex-shrink: 0;
}
.billing-item-body {}
.billing-item-body h4 {
  font-size: 16px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 6px;
}
.billing-item-body p {
  font-size: 13px;
  color: var(--sub);
  line-height: 1.65;
  margin-bottom: 8px;
}
.billing-item-body .highlight {
  font-size: 12.5px;
  color: var(--orange);
  font-weight: 600;
  line-height: 1.5;
}

/* Liability tags grid */
.liability-tags {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin: 10px 0;
}
.liability-tag {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  background: var(--red-lt);
  border: 1px solid #fcd4d1;
  border-radius: 20px;
  padding: 4px 12px;
  font-size: 11.5px;
  color: var(--red);
  font-weight: 600;
}
.liability-tag i { font-size: 11px; }

/* Illus on right of billing item */
.billing-item-illus {
  width: 100px;
  height: 80px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 44px;
  flex-shrink: 0;
  background: var(--light);
  border: 1px solid var(--border);
}

/* Legal ack banner */
.legal-ack {
  background: linear-gradient(135deg, var(--navy), var(--navy2));
  border-radius: 16px;
  padding: 28px 30px;
  margin-top: 32px;
  display: flex;
  align-items: flex-start;
  gap: 18px;
}
.legal-ack-icon {
  width: 52px;
  height: 52px;
  border-radius: 13px;
  background: rgba(243,101,34,.2);
  border: 1px solid rgba(243,101,34,.3);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--orange);
  font-size: 24px;
  flex-shrink: 0;
}
.legal-ack-text p {
  font-size: 14px;
  color: rgba(255,255,255,.82);
  line-height: 1.75;
  font-weight: 500;
  margin: 0;
}
.legal-ack-text strong { color: var(--white); }

/* Trust badges row */
.trust-row {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 20px;
  margin-top: 36px;
}
.trust-badge {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 14px;
  padding: 20px 16px;
  text-align: center;
  transition: all .25s;
}
.trust-badge:hover {
  border-color: var(--orange);
  box-shadow: 0 6px 20px rgba(243,101,34,.1);
  transform: translateY(-2px);
}
.trust-badge-icon {
  width: 44px;
  height: 44px;
  border-radius: 11px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 20px;
  margin: 0 auto 12px;
}
.trust-badge h5 {
  font-size: 13px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 4px;
}
.trust-badge p {
  font-size: 11.5px;
  color: var(--muted);
  line-height: 1.5;
}

/* Footer CTA row */
.pricing-footer-note {
  text-align: center;
  padding: 20px;
  font-size: 12.5px;
  color: var(--muted);
  border-top: 1px solid var(--border);
  margin-top: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
  flex-wrap: wrap;
}
.pricing-footer-note a {
  color: var(--orange);
  font-weight: 700;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.pricing-footer-note a:hover { text-decoration: underline; }

/* ══════════════════════════════
   RESPONSIVE
══════════════════════════════ */
@media (max-width: 1024px) {
  .pricing-grid { grid-template-columns: repeat(2, 1fr); }
  .trust-row { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 768px) {
  .comm-resp-cols { grid-template-columns: 1fr; }
  .comm-col { border-right: none; border-bottom: 1px solid var(--border); }
  .comm-col:last-child { border-bottom: none; }
  .billing-item { grid-template-columns: 56px 1fr; }
  .billing-item-illus { display: none; }
  .legal-ack { flex-direction: column; }
}
@media (max-width: 600px) {
  .pricing-grid { grid-template-columns: 1fr; }
  .trust-row { grid-template-columns: 1fr 1fr; }
  .p-hero { padding: 60px 16px; }
  .billing-wrap, .pricing-wrap, .comm-resp-box { padding: 0 14px; }
  .billing-item { padding: 18px; grid-template-columns: 48px 1fr; gap: 14px; }
}
@media (max-width: 400px) {
  .trust-row { grid-template-columns: 1fr; }
}

</style>

<div class="pricing-page">

  {{-- ══════════ HERO ══════════ --}}
  <section class="p-hero">
    <div class="p-hero-content">
      <h1>Transparent Platform <span>Subscription Plans</span></h1>
      <p>Choose a role-based software access plan designed for academic sourcing, RFQ workflows, catalog visibility, and operational control.</p>
      <a href="{{ url('/contact') }}" class="btn-hero-orange">Contact Us &nbsp;→</a>
    </div>
  </section>

  {{-- ══════════ PRICING CARDS ══════════ --}}
  <section class="pricing-section">
    <div class="pricing-wrap">
      <div class="pricing-grid">

        {{-- Academic Access --}}
        <div class="p-card">
          <div class="p-card-icon pi-green">🏫</div>
          <div class="p-plan-name green">Academic Access</div>
          <div class="p-plan-for">For Schools &amp;<br>Academic Institutions</div>
          <div class="p-price">
            <span class="amount green">Free</span>
            <span class="period">Forever</span>
          </div>
          <hr class="p-divider">
          <ul class="p-feat-list">
            <li><i class="bi bi-check-circle-fill yes"></i> Create academic RFQs</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Board, class, and session filters</li>
            <li><i class="bi bi-check-circle-fill yes"></i> View verified catalog listings</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Compare supplier responses</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Role-based approval workflows</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Audit logs &amp; activity tracking</li>
          </ul>
          <a href="{{ url('/login') }}" class="btn-plan green">Start Free &nbsp;→</a>
        </div>

        {{-- Retailer Access --}}
        <div class="p-card" style="border-color: var(--orange);">
          <span class="popular-badge">Most Popular</span>
          <div class="p-card-icon pi-orange">🏪</div>
          <div class="p-plan-name orange">Retailer Access</div>
          <div class="p-plan-for">For Retail<br>Supply Partners</div>
          <div class="p-price">
            <span class="amount orange">₹999</span>
            <span class="period">/ month</span>
          </div>
          <hr class="p-divider">
          <ul class="p-feat-list">
            <li><i class="bi bi-check-circle-fill yes"></i> Access relevant institutional RFQs</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Submit quotations</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Inventory visibility tools</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Response tracking</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Approval notifications</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Email &amp; chat support</li>
          </ul>
          <a href="{{ url('/login') }}" class="btn-plan orange">Choose Plan &nbsp;→</a>
        </div>

        {{-- Distributor Access --}}
        <div class="p-card">
          <div class="p-card-icon pi-blue">🚛</div>
          <div class="p-plan-name blue">Distributor Access</div>
          <div class="p-plan-for">For Distribution<br>Partners</div>
          <div class="p-price">
            <span class="amount blue">₹2,499</span>
            <span class="period">/ month</span>
          </div>
          <hr class="p-divider">
          <ul class="p-feat-list">
            <li><i class="bi bi-check-circle-fill yes"></i> Institutional RFQ participation</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Quote submission workflows</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Response analytics</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Team access controls</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Priority support</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Bulk user management (Up to 10 users)</li>
          </ul>
          <a href="{{ url('/login') }}" class="btn-plan blue">Choose Plan &nbsp;→</a>
        </div>

        {{-- Publisher Access --}}
        <div class="p-card">
          <div class="p-card-icon pi-purple">📘</div>
          <div class="p-plan-name purple">Publisher Access</div>
          <div class="p-plan-for">For Publishers &amp;<br>Academic Brands</div>
          <div class="p-price">
            <span class="amount purple">Custom</span>
            <span class="period">Pricing</span>
          </div>
          <hr class="p-divider">
          <ul class="p-feat-list">
            <li><i class="bi bi-check-circle-fill yes"></i> Catalog visibility</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Institutional demand insights</li>
            <li><i class="bi bi-check-circle-fill yes"></i> ISBN and title showcase</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Academic discovery tools</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Dedicated onboarding support</li>
            <li><i class="bi bi-check-circle-fill yes"></i> Account manager support</li>
          </ul>
          <a href="{{ url('/contact') }}" class="btn-plan purple">Contact Sales &nbsp;→</a>
        </div>

      </div>

      <p class="always-free-note"><i class="bi bi-shield-fill-check"></i> Always Free for Schools</p>
    </div>
  </section>

  {{-- ══════════ COMMERCIAL RESPONSIBILITY ══════════ --}}
  <section class="comm-resp-section">
    <div class="comm-resp-box">
      <div class="comm-resp-card">
        <div class="comm-resp-header">
          <h3>Subscription &amp; Commercial Responsibility</h3>
        </div>
        <div class="comm-resp-cols">
          <div class="comm-col">
            <div class="comm-col-icon cc-blue"><i class="bi bi-display"></i></div>
            <div class="comm-col-text">
              <h5>Software Access Only</h5>
              <p>GoErudite subscription fees apply only to software access, workflow tools, and platform visibility.</p>
            </div>
          </div>
          <div class="comm-col">
            <div class="comm-col-icon cc-red"><i class="bi bi-slash-circle"></i></div>
            <div class="comm-col-text">
              <h5>No Commercial Participation</h5>
              <p>The platform does not participate in textbook pricing, negotiations, payments, transportation, commissions, or commercial settlements.</p>
            </div>
          </div>
          <div class="comm-col">
            <div class="comm-col-icon cc-green"><i class="bi bi-people-fill"></i></div>
            <div class="comm-col-text">
              <h5>Independent Transactions</h5>
              <p>All commercial discussions and final transactions are independently managed by approved users outside the platform.</p>
            </div>
          </div>
        </div>
        <div class="secure-note">
          <i class="bi bi-shield-fill-check"></i>
          Secure. Role-based. Accountable. Built for Academic Integrity.
        </div>
      </div>
    </div>
  </section>

  {{-- ══════════ BILLING SECTION ══════════ --}}
  <section class="billing-section">
    <div class="billing-wrap">

      <h2 class="billing-section-title">Subscription, Billing &amp; Platform Responsibility</h2>
      <p class="billing-section-sub">GoErudite provides software access, workflow tools, catalog visibility, and communication infrastructure for verified education stakeholders.</p>

      <div class="billing-notice">
        <i class="bi bi-shield-fill-check"></i>
        <span>Subscription fees apply <strong>only for platform access and software usage.</strong> These fees do not include textbook pricing, inventory ownership, logistics services, commissions, transportation charges, or commercial guarantees.</span>
      </div>

      <div class="billing-items">

        {{-- 1 --}}
        <div class="billing-item">
          <div>
            <div class="billing-item-icon bi-green"><i class="bi bi-display"></i></div>
          </div>
          <div class="billing-item-body">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
              <div class="billing-item-num">1</div>
              <h4>Subscription Scope</h4>
            </div>
            <p>GoErudite subscription plans provide access to platform features including RFQ workflows, catalog visibility, notifications, audit logs, and role-based operational tools.</p>
            <div class="highlight">Subscription fees are charged only for software access and platform services.</div>
          </div>
          <div class="billing-item-illus">🖥️</div>
        </div>

        {{-- 2 --}}
        <div class="billing-item">
          <div>
            <div class="billing-item-icon bi-blue"><i class="bi bi-handshake"></i></div>
          </div>
          <div class="billing-item-body">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
              <div class="billing-item-num">2</div>
              <h4>Independent Commercial Transactions</h4>
            </div>
            <p>GoErudite does not participate in textbook sales, purchase negotiations, discounts, commissions, payment settlements, transportation arrangements, or product delivery commitments.</p>
            <div class="highlight">All commercial discussions and final transactions occur directly between approved users outside the platform.</div>
          </div>
          <div class="billing-item-illus">🤝</div>
        </div>

        {{-- 3 --}}
        <div class="billing-item">
          <div>
            <div class="billing-item-icon bi-purple"><i class="bi bi-person-lock"></i></div>
          </div>
          <div class="billing-item-body">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
              <div class="billing-item-num">3</div>
              <h4>Contact Access &amp; Approval Control</h4>
            </div>
            <p>Institutional contact information is released only after manual approval by the school or authorized institution.</p>
            <div class="highlight">GoErudite does not force, recommend, or guarantee any vendor selection or commercial outcome.</div>
          </div>
          <div class="billing-item-illus">🏛️</div>
        </div>

        {{-- 4 --}}
        <div class="billing-item">
          <div>
            <div class="billing-item-icon bi-amber"><i class="bi bi-receipt"></i></div>
          </div>
          <div class="billing-item-body">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
              <div class="billing-item-num">4</div>
              <h4>Refunds, Billing &amp; Service Access</h4>
            </div>
            <p>Subscription fees are related to software access, platform usage, and digital services only.</p>
            <div class="highlight">Unless required by applicable law or explicitly stated in a written agreement, subscription payments are non-refundable after service activation.</div>
          </div>
          <div class="billing-item-illus">💳</div>
        </div>

        {{-- 5 --}}
        <div class="billing-item">
          <div>
            <div class="billing-item-icon bi-red"><i class="bi bi-exclamation-triangle-fill"></i></div>
          </div>
          <div class="billing-item-body">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
              <div class="billing-item-num">5</div>
              <h4>Limitation of Platform Liability</h4>
            </div>
            <p style="margin-bottom:10px;">GoErudite shall not be liable for:</p>
            <div class="liability-tags">
              <span class="liability-tag"><i class="bi bi-x"></i> Pricing disputes</span>
              <span class="liability-tag"><i class="bi bi-x"></i> Payment delays or defaults</span>
              <span class="liability-tag"><i class="bi bi-x"></i> Delivery failures</span>
              <span class="liability-tag"><i class="bi bi-x"></i> Product quality disputes</span>
              <span class="liability-tag"><i class="bi bi-x"></i> Inventory mismatches</span>
              <span class="liability-tag"><i class="bi bi-x"></i> Business losses</span>
              <span class="liability-tag"><i class="bi bi-x"></i> Vendor misconduct</span>
              <span class="liability-tag"><i class="bi bi-x"></i> Institutional procurement decisions</span>
            </div>
            <div class="highlight" style="margin-top:10px;">All platform actions remain under the control and responsibility of registered users.</div>
          </div>
          <div class="billing-item-illus">⚖️</div>
        </div>

        {{-- 6 --}}
        <div class="billing-item">
          <div>
            <div class="billing-item-icon bi-navy"><i class="bi bi-shield-lock-fill"></i></div>
          </div>
          <div class="billing-item-body">
            <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
              <div class="billing-item-num">6</div>
              <h4>Right to Suspend or Restrict Access</h4>
            </div>
            <p>GoErudite reserves the right to suspend, restrict, verify, or terminate platform access if misuse, false information, suspicious activity, policy violations, or compliance concerns are detected.</p>
          </div>
          <div class="billing-item-illus">🔐</div>
        </div>

      </div>

      {{-- Legal Acknowledgement --}}
      <div class="legal-ack">
        <div class="legal-ack-icon"><i class="bi bi-file-earmark-check-fill"></i></div>
        <div class="legal-ack-text">
          <p>By subscribing, users acknowledge that <strong>GoErudite operates solely as a technology facilitation platform</strong> and not as a seller, buyer, distributor, logistics provider, payment processor, or commercial guarantor.</p>
        </div>
      </div>

      {{-- Trust badges --}}
      <div class="trust-row">
        <div class="trust-badge">
          <div class="trust-badge-icon bi-green"><i class="bi bi-shield-fill-check"></i></div>
          <h5>Secure &amp; Compliant</h5>
          <p>Role-based access and data protection</p>
        </div>
        <div class="trust-badge">
          <div class="trust-badge-icon bi-blue"><i class="bi bi-eye-fill"></i></div>
          <h5>Transparent</h5>
          <p>No hidden charges. Clear and upfront pricing.</p>
        </div>
        <div class="trust-badge">
          <div class="trust-badge-icon bi-purple"><i class="bi bi-person-fill-gear"></i></div>
          <h5>User Controlled</h5>
          <p>You decide, approve and transact.</p>
        </div>
        <div class="trust-badge">
          <div class="trust-badge-icon bi-amber"><i class="bi bi-headset"></i></div>
          <h5>Need Help?</h5>
          <p>Our team is here to support you.</p>
        </div>
      </div>

      <div class="pricing-footer-note">
        GoErudite provides software access only. Subscription fees are independent of commercial transactions conducted on the platform.
        &nbsp; <a href="{{ url('/contact') }}"><i class="bi bi-envelope-fill"></i> Talk to our sales team</a>
      </div>

    </div>
  </section>

</div>{{-- /pricing-page --}}

@endsection

@push('scripts')
<script>
/* Smooth scroll */
document.querySelectorAll('a[href^="#"]').forEach(function(a) {
  a.addEventListener('click', function(e) {
    var t = document.querySelector(this.getAttribute('href'));
    if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
  });
});
</script>
@endpush