@extends('layouts.app')

@section('title', 'Returns, Support & FAQ')

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f5f6fa;
        font-family: Arial, sans-serif;
        color: #1f2937;
    }

    .faq-page {
        width: 100%;
        overflow: hidden;
    }

    /* HERO SECTION */

    .hero-section {
        background: linear-gradient(130deg, #0b1630 0%, #112045 45%, #1a2e63 75%, #1e3878 100%);
        background-size: cover;
        background-position: center;
        padding: 70px 20px;
        color: #fff;
        position: relative;
    }
    
    .hero-section::before {
      content: '';
      position: absolute; inset: 0;
      background-image: radial-gradient(rgba(255,255,255,.07) 1px, transparent 1px);
      background-size: 26px 26px;
      pointer-events: none;
    }
    .hero-section::after {
      content: '';
      position: absolute; inset: 0;
      background:
        radial-gradient(ellipse at 80% 25%, rgba(37,99,235,.2) 0%, transparent 55%),
        radial-gradient(ellipse at 15% 85%, rgba(243,101,34,.08) 0%, transparent 50%);
      pointer-events: none;
    }

    .hero-container {
        max-width: 1350px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 40px;
    }

    .hero-content {
        width: 60%;
    }

    .hero-content h1 {
        font-size: 52px;
        line-height: 1.2;
        font-weight: 800;
        margin-bottom: 20px;
    }

    .hero-content h1 span {
        color: #f97316;
    }

    .hero-content p {
        font-size: 18px;
        line-height: 1.8;
        color: #d1d5db;
        max-width: 850px;
    }

    .hero-image {
        width: 40%;
        text-align: right;
    }

    .hero-image img {
        max-width: 100%;
        height: auto;
    }

    /* COMMON SECTION */

    .section-wrapper {
        max-width: 1350px;
        margin: 25px auto;
        padding: 0 20px;
    }

    .section-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 22px 25px;
        border-bottom: 1px solid #f0f0f0;
        background: #fafafa;
    }

    .section-number {
        width: 42px;
        height: 42px;
        background: #16a34a;
        color: #fff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 18px;
    }

    .section-header h2 {
        font-size: 30px;
        margin-bottom: 5px;
    }

    .section-header p {
        color: #6b7280;
        font-size: 15px;
    }

    /* GRID */

    .policy-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 0;
    }

    .policy-item {
        padding: 30px 20px;
        border-right: 1px solid #f0f0f0;
        border-bottom: 1px solid #f0f0f0;
        text-align: center;
    }

    .policy-item:last-child {
        border-right: none;
    }

    .icon-box {
        width: 75px;
        height: 75px;
        border-radius: 50%;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto auto 20px;
        font-size: 34px;
    }

    .policy-item h4 {
        font-size: 21px;
        margin-bottom: 15px;
        color: #111827;
        font-weight: 700;
    }

    .policy-item p {
        font-size: 15px;
        line-height: 1.8;
        color: #4b5563;
    }

    .policy-item ul {
        padding-left: 18px;
        margin-top: 10px;
        text-align: left;
    }

    .policy-item ul li {
        margin-bottom: 8px;
        font-size: 14px;
        color: #4b5563;
    }

    /* FAQ GRID */

    .faq-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        padding: 30px;
    }

    .faq-item {
        display: flex;
        gap: 15px;
        align-items: flex-start;
    }

    .faq-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: #fff7ed;
        color: #f97316;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        flex-shrink: 0;
    }

    .faq-content h4 {
        font-size: 18px;
        margin-bottom: 8px;
        font-weight: 700;
        color: #111827;
    }

    .faq-content p {
        color: #4b5563;
        line-height: 1.7;
        font-size: 15px;
    }

    /* FINAL NOTE */

    .final-note {
        background: #fff7ed;
        border: 1px solid #fed7aa;
        border-radius: 14px;
        padding: 25px;
        margin: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .final-note h3 {
        color: #c2410c;
        margin-bottom: 10px;
        font-size: 24px;
    }

    .final-note p {
        line-height: 1.8;
        color: #444;
        font-size: 15px;
    }

    .final-note img {
        width: 120px;
    }

    /* RESPONSIVE */

    @media(max-width:1200px) {

        .policy-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-content h1 {
            font-size: 42px;
        }
    }

    @media(max-width:992px) {

        .hero-container {
            flex-direction: column;
            text-align: center;
        }

        .hero-content,
        .hero-image {
            width: 100%;
        }

        .faq-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .hero-content h1 {
            font-size: 38px;
        }
    }

    @media(max-width:768px) {

        .policy-grid,
        .faq-grid {
            grid-template-columns: 1fr;
        }

        .policy-item {
            border-right: none;
        }

        .hero-content h1 {
            font-size: 30px;
        }

        .section-header h2 {
            font-size: 24px;
        }

        .faq-item {
            flex-direction: column;
        }

        .final-note {
            flex-direction: column;
            text-align: center;
        }
    }

    @media(max-width:576px) {

        .hero-section {
            padding: 50px 15px;
        }

        .hero-content h1 {
            font-size: 26px;
        }

        .hero-content p {
            font-size: 15px;
        }

        .section-header {
            padding: 18px;
        }

        .policy-item,
        .faq-grid {
            padding: 20px;
        }

        .section-wrapper {
            padding: 0 10px;
        }
    }
</style>


<div class="faq-page">

    <!-- HERO -->

    <section class="hero-section">

        <div class="hero-container">

            <div class="hero-content">

                <h1>
                    Returns, Support, Account Access &
                    <span>Frequently Asked Questions</span>
                </h1>

                <p>
                    GoErudite supports structured academic workflows through
                    verified participation, secure communication,
                    role-based approvals, and accountable platform operations.
                </p>

            </div>

            <div class="hero-image">
                <img src="{{ asset('images/return-support.png') }}" alt="Support">
            </div>

        </div>

    </section>


    <!-- RETURN POLICY -->

    <div class="section-wrapper">

        <div class="section-card">

            <div class="section-header">

                <div class="section-number">5</div>

                <div>
                    <h2>Return, Dispute & Resolution Policy</h2>
                    <p>
                        Platform participation policies and institutional workflow guidelines.
                    </p>
                </div>

            </div>

            <div class="policy-grid">

                <div class="policy-item">

                    <div class="icon-box">🛡</div>

                    <h4>Platform Role Clarification</h4>

                    <p>
                        GoErudite operates solely as a technology facilitation
                        platform for academic sourcing workflows.
                    </p>

                </div>

                <div class="policy-item">

                    <div class="icon-box">📄</div>

                    <h4>Return Request Documentation</h4>

                    <p>
                        If a return or shortage is claimed,
                        institutions should maintain supporting documents.
                    </p>

                    <ul>
                        <li>Purchase invoices</li>
                        <li>Delivery challans</li>
                        <li>Product images</li>
                        <li>Stock discrepancy reports</li>
                    </ul>

                </div>

                <div class="policy-item">

                    <div class="icon-box">🤝</div>

                    <h4>Approval-Based Resolution</h4>

                    <p>
                        Institutional approval remains central
                        to procurement discussions and decisions.
                    </p>

                </div>

                <div class="policy-item">

                    <div class="icon-box">₹</div>

                    <h4>No Platform Refund Guarantee</h4>

                    <p>
                        GoErudite does not process or guarantee refunds,
                        compensation, or replacements.
                    </p>

                </div>

                <div class="policy-item">

                    <div class="icon-box">⚠</div>

                    <h4>Dispute Monitoring</h4>

                    <p>
                        Misrepresentation or policy abuse may
                        result in temporary restrictions or suspension.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- LOGIN SECTION -->

    <div class="section-wrapper">

        <div class="section-card">

            <div class="section-header">

                <div class="section-number" style="background:#2563eb;">
                    6
                </div>

                <div>
                    <h2>Login & Registration</h2>

                    <p>
                        Secure account access for verified academic stakeholders.
                    </p>
                </div>

            </div>

            <div class="policy-grid">

                <div class="policy-item">

                    <div class="icon-box">👥</div>

                    <h4>Choose Your Role</h4>

                    <p>
                        Register as a School, Distributor,
                        Retailer or Publisher.
                    </p>

                </div>

                <div class="policy-item">

                    <div class="icon-box">🪪</div>

                    <h4>Verification Notice</h4>

                    <p>
                        Users may be asked to verify
                        organization identity and credentials.
                    </p>

                </div>

                <div class="policy-item">

                    <div class="icon-box">🔒</div>

                    <h4>Account Security</h4>

                    <p>
                        Users are responsible for secure passwords
                        and confidential login access.
                    </p>

                </div>

                <div class="policy-item">

                    <div class="icon-box">📑</div>

                    <h4>Terms Acceptance</h4>

                    <p>
                        By registering, users confirm
                        agreement with platform rules and policies.
                    </p>

                </div>

                <div class="policy-item">

                    <div class="icon-box">🔐</div>

                    <h4>Privacy Consent</h4>

                    <p>
                        Information is processed securely
                        for academic operational requirements.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- FAQ SECTION -->

    <div class="section-wrapper">

        <div class="section-card">

            <div class="section-header">

                <div class="section-number" style="background:#f97316;">
                    7
                </div>

                <div>
                    <h2>Frequently Asked Questions</h2>
                    <p>
                        Common questions about academic workflows and platform operations.
                    </p>
                </div>

            </div>

            <div class="faq-grid">

                <div class="faq-item">
                    <div class="faq-icon">🛒</div>

                    <div class="faq-content">
                        <h4>What is GoErudite?</h4>

                        <p>
                            A role-based education supply platform
                            connecting schools, distributors and publishers.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">📚</div>

                    <div class="faq-content">
                        <h4>Does GoErudite sell textbooks directly?</h4>

                        <p>
                            No. The platform does not purchase,
                            stock or deliver textbooks.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">⚙</div>

                    <div class="faq-content">
                        <h4>How does RFQ process work?</h4>

                        <p>
                            Schools create academic RFQs and
                            verified partners submit quotations.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">👤</div>

                    <div class="faq-content">
                        <h4>Who can access school contact information?</h4>

                        <p>
                            Contact details remain hidden until
                            access permissions are approved.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">📖</div>

                    <div class="faq-content">
                        <h4>Can publishers list catalogs?</h4>

                        <p>
                            Yes. Publishers can upload
                            academic catalogs and ISBN-based titles.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">💳</div>

                    <div class="faq-content">
                        <h4>Does GoErudite handle payments?</h4>

                        <p>
                            No. Financial transactions occur
                            directly between approved users.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">🚚</div>

                    <div class="faq-content">
                        <h4>Does GoErudite manage logistics?</h4>

                        <p>
                            No. Logistics and delivery responsibilities
                            remain with participating users.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">🤖</div>

                    <div class="faq-content">
                        <h4>Can AI make purchasing decisions?</h4>

                        <p>
                            No. AI provides insights only.
                            Final decisions remain under human control.
                        </p>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-icon">🔐</div>

                    <div class="faq-content">
                        <h4>Is my business data secure?</h4>

                        <p>
                            Yes. GoErudite uses role-based permissions,
                            secure workflows and monitored access.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- FINAL NOTE -->

    <div class="final-note">

        <div>

            <h3>Final Legal Notice</h3>

            <p>
                GoErudite operates solely as a technology facilitation platform.
                The platform does not act as a seller, buyer, distributor,
                logistics provider, payment processor, or commercial guarantor.
            </p>

        </div>

        <img src="{{ asset('images/legal-icon.png') }}" alt="Legal">

    </div>

</div>

@endsection