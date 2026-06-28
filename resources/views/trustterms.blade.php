@extends('layouts.app')

@section('title', 'Trust, Privacy, Support & Platform Terms — GoErudite')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India.')
@section('keywords', 'Trust, Privacy, Support')

@section('content')


<style>
/* ── ROOT ── */
:root {
  --orange: #f36522;
  --orange-lt: #fff4ee;
  --navy: #0f1c35;
  --navy2: #1e3358;
  --bg: #f4f6fb;
  --white: #ffffff;
  --border: #e5e9f0;
  --text: #1f2937;
  --sub: #4b5563;
  --muted: #6b7280;
  --radius: 14px;
  --shadow: 0 2px 14px rgba(15,28,53,.07);
}



/* ── PAGE WRAPPER ── */
.page-wrap { max-width: 900px; margin: 0 auto; padding: 32px 16px 60px; }

/* ══════════════════════════════
   HERO / PAGE TITLE AREA
══════════════════════════════ */
.page-title-block {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  background: linear-gradient(130deg, #0b1630 0%, #112045 45%, #1a2e63 75%, #1e3878 100%);
  gap: 24px;
  padding: 50px 0 15px;
  border-bottom: 1px solid var(--border);
  margin-bottom: 32px;
}
.page-title-block .title-left { flex: 1; }
.page-title-block h1 {
  font-size: clamp(26px, 4vw, 40px);
  font-weight: 800;
  color: #fff;
  line-height: 1.2;
  margin-bottom: 14px;
  margin: 20px;
}
.page-title-block h1 span { color: var(--orange); }
.page-title-block p {
  font-size: 14px;
  color: #fff;
  line-height: 1.75;
  max-width: 540px;
  margin: 20px;
}
.page-title-img {
  flex-shrink: 0;
  width: 300px;
  height: 200px;
  background: linear-gradient(135deg, var(--navy), var(--navy2));
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 44px;
  margin: 20px;
}

/* ══════════════════════════════
   SECTION BLOCK
══════════════════════════════ */
.doc-block {
  background: var(--white);
  border: 1px solid var(--border);
  border-radius: 18px;
  overflow: hidden;
  margin-bottom: 28px;
  box-shadow: var(--shadow);
}

/* Section header row */
.doc-block-header {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 16px 22px;
  background: linear-gradient(to right, var(--navy), var(--navy2));
}
.doc-block-num {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: var(--orange);
  color: var(--white);
  font-size: 15px;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}
.doc-block-header h2 {
  font-size: 17px;
  font-weight: 700;
  color: var(--white);
  margin: 0;
}
.doc-block-body { padding: 22px; }

/* Section intro text */
.section-intro {
  font-size: 13.5px;
  color: var(--sub);
  line-height: 1.7;
  margin-bottom: 20px;
}

/* ══════════════════════════════
   SECTION 1 — TRUST
══════════════════════════════ */
.trust-grid-top {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
  margin-bottom: 16px;
}
.trust-grid-bottom {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}
.trust-card {
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 18px;
  background: var(--bg);
  transition: border-color .25s, transform .25s, box-shadow .25s;
}
.trust-card:hover {
  border-color: var(--orange);
  transform: translateY(-3px);
  box-shadow: 0 8px 24px rgba(243,101,34,.1);
  background: var(--white);
}
.tc-icon {
  font-size: 22px;
  color: var(--orange);
  margin-bottom: 10px;
  display: block;
}
.trust-card h4 {
  font-size: 13px;
  font-weight: 700;
  color: var(--navy);
  margin-bottom: 8px;
  line-height: 1.35;
}
.trust-card p {
  font-size: 12px;
  color: var(--sub);
  line-height: 1.65;
}

/* ══════════════════════════════
   SECTION 2 + 3 — SIDE BY SIDE
══════════════════════════════ */
.split-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 28px;
  margin-bottom: 28px;
}

/* Privacy list items */
.privacy-list { display: flex; flex-direction: column; gap: 14px; }
.privacy-item { display: flex; align-items: flex-start; gap: 12px; }
.privacy-icon {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: var(--orange-lt);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--orange);
  font-size: 16px;
  flex-shrink: 0;
}
.privacy-icon.green  { background: #e6f7ee; color: #1a8a4a; }
.privacy-icon.blue   { background: #e8f0fd; color: #2563eb; }
.privacy-icon.teal   { background: #e0f5fb; color: #0d8cad; }
.privacy-icon.purple { background: #f0eafc; color: #7c4dce; }
.privacy-icon.red    { background: #fdeaea; color: #d63031; }
.privacy-item-title { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 4px; }
.privacy-item-text  { font-size: 12px; color: var(--sub); line-height: 1.6; }

/* Help center rows */
.help-list { display: flex; flex-direction: column; gap: 12px; }
.help-row { display: flex; align-items: flex-start; gap: 12px; }
.help-icon-box {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: var(--orange);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  color: var(--white);
  flex-shrink: 0;
}
.help-row-label { font-size: 12px; font-weight: 700; color: var(--orange); margin-bottom: 4px; text-transform: uppercase; letter-spacing: .5px; }
.help-row-title { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 6px; }
.help-bullets { padding: 0; list-style: none; }
.help-bullets li {
  font-size: 12px;
  color: var(--sub);
  padding-left: 14px;
  position: relative;
  margin-bottom: 4px;
  line-height: 1.5;
}
.help-bullets li::before {
  content: '•';
  position: absolute;
  left: 0;
  color: var(--orange);
  font-weight: 700;
}

/* ══════════════════════════════
   SECTION 4 — TERMS
══════════════════════════════ */
.terms-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
  margin-bottom: 20px;
}
.term-card {
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 18px;
  background: var(--bg);
  transition: all .25s;
}
.term-card:hover {
  border-color: var(--orange);
  transform: translateY(-3px);
  box-shadow: 0 8px 22px rgba(243,101,34,.1);
  background: var(--white);
}
.term-icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  background: var(--orange-lt);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--orange);
  font-size: 18px;
  margin-bottom: 12px;
}
.term-card h4 { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 8px; line-height: 1.35; }
.term-card p, .term-card ul { font-size: 12px; color: var(--sub); line-height: 1.65; }
.term-bullets { list-style: none; padding: 0; }
.term-bullets li { padding-left: 14px; position: relative; margin-bottom: 4px; font-size: 12px; color: var(--sub); }
.term-bullets li::before { content: '•'; position: absolute; left: 0; color: var(--orange); font-weight: 700; }

/* Legal acknowledgement */
.legal-banner {
  background: linear-gradient(135deg, var(--navy), var(--navy2));
  border-radius: var(--radius);
  padding: 22px;
  display: flex;
  align-items: flex-start;
  gap: 16px;
}
.legal-icon {
  width: 48px;
  height: 48px;
  border-radius: 12px;
  background: rgba(243,101,34,.2);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--orange);
  font-size: 22px;
  flex-shrink: 0;
}
.legal-text h4 { font-size: 15px; font-weight: 700; color: var(--white); margin-bottom: 8px; }
.legal-text p { font-size: 13px; color: rgba(255,255,255,.7); line-height: 1.7; }

/* ══════════════════════════════
   RESPONSIVE
══════════════════════════════ */
@media (max-width: 768px) {
  .page-title-block { flex-direction: column; }
  .page-title-img { width: 64px; height: 64px; font-size: 30px; }
  .trust-grid-top  { grid-template-columns: repeat(2, 1fr); }
  .trust-grid-bottom { grid-template-columns: repeat(2, 1fr); }
  .split-row { grid-template-columns: 1fr; }
  .terms-grid { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 480px) {
  .trust-grid-top { grid-template-columns: 1fr; }
  .trust-grid-bottom { grid-template-columns: 1fr; }
  .terms-grid { grid-template-columns: 1fr; }
  .legal-banner { flex-direction: column; }
  .doc-block-body { padding: 16px; }
  .doc-block-header { padding: 14px 16px; }
}
</style>
</head>
<body>
<div class="page-wrap">

  <!-- ══ PAGE TITLE ══ -->
  <div class="page-title-block">
    <div class="title-left">
      <h1>Trust, Privacy, Support &amp; <span>Platform Terms</span></h1>
      <p>GoErudite is designed to support structured academic sourcing through verified participation, controlled approvals, secure communication, and accountable digital workflows.</p>
    </div>
    <div class="page-title-img">🛡️</div>
  </div>

  <!-- ══ SECTION 1 — TRUST ══ -->
  <div class="doc-block">
    <div class="doc-block-header">
      <div class="doc-block-num">1</div>
      <h2>Built on Trust, Transparency &amp; Platform Safety</h2>
    </div>
    <div class="doc-block-body">

      <!-- Row 1: 4 cards -->
      <div class="trust-grid-top">

        <div class="trust-card">
          <i class="bi bi-bell-fill tc-icon"></i>
          <h4>Notification Center</h4>
          <p>All critical platform activities—including RFQ creation, quotation submissions, approval updates, and account notifications—are securely delivered through the GoErudite notification system.<br><br>Every notification is time-stamped to support transparency and operational accountability.</p>
        </div>

        <div class="trust-card">
          <i class="bi bi-file-earmark-lock-fill tc-icon"></i>
          <h4>RFQ Security</h4>
          <p>Academic requirements created by schools remain visible only to verified and authorized supply partners.<br><br>Role-based access controls help protect RFQ data from unauthorized visibility, misuse, or non-compliant participation.</p>
        </div>

        <div class="trust-card">
          <i class="bi bi-eye-slash-fill tc-icon"></i>
          <h4>Contact Privacy</h4>
          <p>Institutional contact details, authorized buyer information, and communication records remain protected until manual approval is completed by the institution.<br><br>No supply partner receives direct contact access without approval.</p>
        </div>

        <div class="trust-card">
          <i class="bi bi-clipboard2-check-fill tc-icon"></i>
          <h4>Audit Logs &amp; Activity Records</h4>
          <p>Every RFQ, quotation, approval, profile update, and communication event is securely recorded through platform audit logs.<br><br>These records support transparency, accountability, and internal operational review.</p>
        </div>

      </div>

      <!-- Row 2: 3 cards -->
      <div class="trust-grid-bottom">

        <div class="trust-card">
          <i class="bi bi-person-check-fill tc-icon"></i>
          <h4>Human Approval System</h4>
          <p>GoErudite does not automatically approve suppliers, quotations, or commercial outcomes.<br><br>All final decisions remain under the control of verified institutions and registered users.</p>
        </div>

        <div class="trust-card">
          <i class="bi bi-cpu-fill tc-icon"></i>
          <h4>AI Advisory Notice</h4>
          <p>Any AI-powered recommendations, analytics, or demand visibility tools available on GoErudite are advisory in nature only.<br><br>AI tools do not make academic, financial, procurement, or commercial decisions on behalf of users.</p>
        </div>

        <div class="trust-card">
          <i class="bi bi-shield-exclamation tc-icon"></i>
          <h4>Platform Safety</h4>
          <p>GoErudite continuously monitors suspicious activity, false information, unauthorized behavior, and compliance risks.<br><br>Accounts may be reviewed, restricted, or suspended when misuse is detected.</p>
        </div>

      </div>
    </div>
  </div>

  <!-- ══ SECTION 2 + 3 SIDE BY SIDE ══ -->
  <div class="split-row">

    <!-- PRIVACY POLICY -->
    <div class="doc-block" style="margin-bottom:0;">
      <div class="doc-block-header">
        <div class="doc-block-num">2</div>
        <h2>Privacy Policy</h2>
      </div>
      <div class="doc-block-body">
        <p class="section-intro">Institutional and operational data is handled through controlled access systems designed for privacy, verification, and platform security.</p>
        <div class="privacy-list">

          <div class="privacy-item">
            <div class="privacy-icon blue"><i class="bi bi-database-fill"></i></div>
            <div>
              <div class="privacy-item-title">Data Collection</div>
              <div class="privacy-item-text">GoErudite may collect operational data including business profile information, institution registration details, contact information, login credentials, RFQ activity records, communication history, and catalog participation records. This data supports platform operations, verification, and account security.</div>
            </div>
          </div>

          <div class="privacy-item">
            <div class="privacy-icon green"><i class="bi bi-person-badge-fill"></i></div>
            <div>
              <div class="privacy-item-title">User Verification</div>
              <div class="privacy-item-text">To maintain trust and platform integrity, users may be asked to verify organization identity, business registration details, authorized contact ownership, and role eligibility. Incomplete or unverifiable accounts may receive limited access.</div>
            </div>
          </div>

          <div class="privacy-item">
            <div class="privacy-icon"><i class="bi bi-eye-slash-fill"></i></div>
            <div>
              <div class="privacy-item-title">Contact Visibility Rules</div>
              <div class="privacy-item-text">Institutional contact details remain hidden until authorized approval is completed. GoErudite does not publicly expose sensitive user contact information.</div>
            </div>
          </div>

          <div class="privacy-item">
            <div class="privacy-icon teal"><i class="bi bi-hdd-fill"></i></div>
            <div>
              <div class="privacy-item-title">Data Storage &amp; Protection</div>
              <div class="privacy-item-text">Platform data is managed through secure digital infrastructure using encrypted communication layers, access controls, and role-based permissions.</div>
            </div>
          </div>

          <div class="privacy-item">
            <div class="privacy-icon purple"><i class="bi bi-share-fill"></i></div>
            <div>
              <div class="privacy-item-title">Third-Party Access</div>
              <div class="privacy-item-text">GoErudite does not sell, rent, or commercially share user data with unauthorized third parties. Access may only be granted when legally required or operationally necessary.</div>
            </div>
          </div>

          <div class="privacy-item">
            <div class="privacy-icon red"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div>
              <div class="privacy-item-title">Security Disclaimer</div>
              <div class="privacy-item-text">While GoErudite maintains security controls, users remain responsible for password protection, device safety, and authorized account usage.</div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- HELP CENTER -->
    <div class="doc-block" style="margin-bottom:0;">
      <div class="doc-block-header">
        <div class="doc-block-num">3</div>
        <h2>Help Center</h2>
      </div>
      <div class="doc-block-body">
        <p class="section-intro">Operational support designed for schools, distributors, retailers, and publishers using structured academic workflows.</p>
        <div class="help-list">

          <div class="help-row">
            <div class="help-icon-box">🏫</div>
            <div>
              <div class="help-row-label">For Schools</div>
              <ul class="help-bullets">
                <li>Manage with confidence</li>
                <li>Create academic RFQs</li>
                <li>Apply board and session filters</li>
                <li>Review verified supplier responses</li>
                <li>Approve selected supply partners</li>
              </ul>
            </div>
          </div>

          <div class="help-row">
            <div class="help-icon-box">🚚</div>
            <div>
              <div class="help-row-label">For Distributors</div>
              <ul class="help-bullets">
                <li>Respond with clarity</li>
                <li>Access verified institutional RFQs</li>
                <li>Submit quotations and availability</li>
                <li>Monitor approval updates</li>
                <li>Track communication history</li>
              </ul>
            </div>
          </div>

          <div class="help-row">
            <div class="help-icon-box">🏪</div>
            <div>
              <div class="help-row-label">For Retailers</div>
              <ul class="help-bullets">
                <li>Participate with visibility</li>
                <li>Access relevant institutional opportunities</li>
                <li>Submit inventory-based responses</li>
                <li>Manage quotation activity</li>
                <li>Receive approval notifications</li>
              </ul>
            </div>
          </div>

          <div class="help-row">
            <div class="help-icon-box">📘</div>
            <div>
              <div class="help-row-label">For Publishers</div>
              <ul class="help-bullets">
                <li>Showcase with control</li>
                <li>Upload academic catalogs</li>
                <li>Manage academic visibility</li>
                <li>Participate in verified demand workflows</li>
                <li>Track institutional engagement</li>
              </ul>
            </div>
          </div>

          <div class="help-row">
            <div class="help-icon-box" style="background:#1e3358;">🔑</div>
            <div>
              <div class="help-row-label">Login &amp; Account Support</div>
              <ul class="help-bullets">
                <li>Registration access</li>
                <li>Login issues</li>
                <li>Password recovery</li>
                <li>Profile verification</li>
                <li>Account restrictions</li>
              </ul>
            </div>
          </div>

          <div class="help-row">
            <div class="help-icon-box" style="background:#1a8a4a;">✅</div>
            <div>
              <div class="help-row-label">Approval Workflow Support</div>
              <ul class="help-bullets">
                <li>Stay informed about RFQ response approvals</li>
                <li>Contact access release</li>
                <li>Vendor selection workflows</li>
                <li>Role-based operational permissions</li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div><!-- /split-row -->

  <!-- ══ SECTION 4 — TERMS ══ -->
  <div class="doc-block">
    <div class="doc-block-header">
      <div class="doc-block-num">4</div>
      <h2>Terms &amp; Conditions</h2>
    </div>
    <div class="doc-block-body">
      <p class="section-intro">By accessing GoErudite, users agree to operate responsibly within platform rules, verification systems, and role-based workflows.</p>

      <div class="terms-grid">

        <div class="term-card">
          <div class="term-icon"><i class="bi bi-laptop-fill"></i></div>
          <h4>Platform Usage Rules</h4>
          <p>Users may access GoErudite only for legitimate academic, operational, or business participation related to education supply workflows.</p>
        </div>

        <div class="term-card">
          <div class="term-icon"><i class="bi bi-person-fill-gear"></i></div>
          <h4>User Responsibility</h4>
          <p>Registered users are responsible for:</p>
          <ul class="term-bullets">
            <li>Accurate business information</li>
            <li>Genuine quotations</li>
            <li>Lawful communication</li>
            <li>Authorized account usage</li>
            <li>Independent commercial decisions</li>
          </ul>
        </div>

        <div class="term-card" style="border-color:#fcd4d1; background:#fef3f2;">
          <div class="term-icon" style="background:#fdeaea; color:#d63031;"><i class="bi bi-x-circle-fill"></i></div>
          <h4 style="color:#c0392b;">Prohibited Activities</h4>
          <ul class="term-bullets">
            <li>Submit false quotations</li>
            <li>Misrepresent inventory, pricing, or identity</li>
            <li>Access unauthorized contacts</li>
            <li>Share misleading data</li>
            <li>Abuse platform communication systems</li>
          </ul>
        </div>

        <div class="term-card">
          <div class="term-icon"><i class="bi bi-handshake-fill"></i></div>
          <h4>Independent Commercial Dealings</h4>
          <p>All pricing discussions, negotiations, payment settlements, logistics commitments, and commercial agreements occur directly between approved users outside the platform. GoErudite does not participate in commercial transactions.</p>
        </div>

        <div class="term-card">
          <div class="term-icon" style="background:#fdeaea; color:#d63031;"><i class="bi bi-shield-slash-fill"></i></div>
          <h4>No Platform Liability</h4>
          <ul class="term-bullets">
            <li>Pricing disputes</li>
            <li>Payment failures</li>
            <li>Delivery delays</li>
            <li>Product quality claims</li>
            <li>Vendor misconduct</li>
            <li>Procurement losses</li>
          </ul>
        </div>

        <div class="term-card">
          <div class="term-icon"><i class="bi bi-person-lock"></i></div>
          <h4>Account Restriction Rights</h4>
          <p>GoErudite reserves the right to review, suspend, restrict, or permanently terminate access in cases of misuse, fraud, policy violations, or compliance concerns.</p>
        </div>

      </div>

      <!-- Legal Acknowledgement -->
      <div class="legal-banner">
        <div class="legal-icon"><i class="bi bi-file-earmark-check-fill"></i></div>
        <div class="legal-text">
          <h4>Legal Acknowledgement</h4>
          <p>By continuing to use GoErudite, users acknowledge that the platform operates solely as a technology facilitation system and not as a seller, buyer, distributor, logistics provider, payment processor, or commercial guarantor.</p>
        </div>
      </div>

    </div>
  </div>

</div><!-- /page-wrap -->
@endsection

@push('scripts')
<script>
/* Sidebar active scroll spy (if embedded in full layout) */
const sections = document.querySelectorAll('.doc-block[id]');
const navLinks  = document.querySelectorAll('.sidebar-link');
window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(s => { if (pageYOffset >= s.offsetTop - 150) current = s.id; });
  navLinks.forEach(l => {
    l.classList.remove('active');
    if (l.getAttribute('href') === '#' + current) l.classList.add('active');
  });
});
</script>
@endpush
