@extends('layouts.app')

@section('title', 'Shop | Digital Textbooks for Schools & Publishers')
@section('description',
    'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers
    across India. Manage and distribute digital textbooks with ease.')
@section('keywords',
    'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book
    distribution, CBSE ICSE digital books, LMS integration')

@section('content')

    <style>
        .book-details-page {
            display: grid;
            grid-template-columns: 300px 1fr 320px;
            gap: 24px;
            padding: 80px;
            background: #f8f9fb;
        }

        .book-sidebar,
        .book-main,
        .book-right-sidebar {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .book-cover-card,
        .publisher-card,
        .right-card,
        .book-main {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #ececec;
            padding: 20px;
            color: #000;
        }

        .book-cover-img {
            width: 100%;
            border-radius: 12px;
        }

        .preview-btn {
            width: 100%;
            border: none;
            background: #f36522;
            color: #fff;
            padding: 12px;
            border-radius: 10px;
            margin-top: 15px;
            font-weight: 600;
        }

        .sample-circle {
            width: 90px;
            height: 90px;
            border: 2px dashed #ddd;
            border-radius: 50%;
            margin: 20px auto 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #777;
        }

        .publisher-top {
            display: flex;
            justify-content: space-between;
            gap: 15px;
        }

        .publisher-top h3 {
            font-size: 28px;
            /*margin-bottom:0;*/
        }

        .publisher-follow button {
            background: #25a56a;
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
        }

        .publisher-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .publisher-actions a {
            flex: 1;
            text-align: center;
            background: #f36522;
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            font-size: 14px;
        }

        .book-tags {
            display: flex;
            gap: 10px;
            /*margin-bottom:10px;*/
        }

        .tag-orange,
        .tag-light {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
        }

        .tag-orange {
            background: #ffe3d5;
            color: #f36522;
        }

        .tag-light {
            background: #000;
            color: #fff;
        }

        .book-title {
            font-size: 42px;
            font-weight: 800;
            /*margin-bottom:10px;*/
        }

        .publisher-name {
            color: #666;
            /*margin-bottom:10px;*/
        }

        .publisher-name span {
            color: #f36522;
            font-weight: 700;
        }

        .book-rating {
            /*margin-bottom:25px;*/
            font-weight: 600;
            color: #000;
        }

        .book-info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
            /*margin-bottom:30px;*/
        }

        .info-item {
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 15px;
        }

        .info-item h6 {
            font-size: 13px;
            color: #888;
        }

        .info-item p {
            font-weight: 600;
            margin: 0;
        }

        .price-section span {
            color: #666;
        }

        .price-section h2 {
            font-size: 42px;
            color: #111;
            font-weight: 800;
        }

        /*.academic-overview{*/
        /*    margin-top:20px;*/
        /*}*/

        .rfq-box {
            margin-top: 25px;
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 20px;
            flex-wrap: wrap;
        }

        .qty-control {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: max-content;
        }

        .qty-control button {
            border: none;
            background: #f6f6f6;
            width: 40px;
            height: 40px;
        }

        .qty-control input {
            width: 60px;
            border: none;
            text-align: center;
        }

        .rfq-btn {
            background: #f36522;
            color: #fff;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 700;
        }

        .rfq-note {
            background: #fff7f2;
            border: 1px solid #ffd7c3;
            padding: 15px;
            border-radius: 12px;
            margin-top: 20px;
            color: #7b4d32;
        }

        .review-section {
            margin-top: 30px;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .review-left h2 {
            font-size: 42px;
            color: #f36522;
        }

        .review-card {
            background: #fafafa;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 12px;
        }

        .right-card h3 {
            /*margin-bottom:20px;*/
        }

        .right-card ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .right-card ul li {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            gap: 15px;
        }

        .desc-tag {
            display: inline-block;
            background: #f36522;
            color: #fff;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 12px;
            /*margin-bottom:12px;*/
        }

        .why-list li {
            justify-content: flex-start !important;
            gap: 10px;
        }

        .why-list li::before {
            content: "✔";
            color: #28a745;
        }

        .rating-big {
            font-size: 28px;
            font-weight: 700;
        }

        .rating-big span {
            display: block;
            font-size: 14px;
            color: #777;
        }

        .bar-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 14px;
        }

        .bar {
            flex: 1;
            height: 8px;
            background: #eee;
            border-radius: 30px;
            overflow: hidden;
        }

        .bar span {
            display: block;
            height: 100%;
            background: #f36522;
        }

        .write-review-btn {
            width: 100%;
            margin-top: 25px;
            border: 1px solid #f36522;
            background: #fff;
            color: #f36522;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
        }

        .platform-note {
            margin: 0 30px 30px;
            background: #fff7f0;
            border: 1px solid #ffe0d0;
            padding: 18px 24px;
            border-radius: 14px;
            color: #73492f;
            font-weight: 500;
        }

        /* RESPONSIVE */

        @media(max-width:1200px) {

            .book-details-page {
                grid-template-columns: 280px 1fr;
            }

            .book-right-sidebar {
                grid-column: 1/-1;
                display: grid;
                grid-template-columns: repeat(3, 1fr);
            }

        }

        @media(max-width:991px) {

            .book-details-page {
                grid-template-columns: 1fr;
            }

            .book-right-sidebar {
                grid-template-columns: 1fr;
            }

            .book-info-grid {
                grid-template-columns: repeat(2, 1fr);
            }

        }

        @media(max-width:767px) {

            .book-details-page {
                padding: 15px;
            }

            .book-title {
                font-size: 30px;
            }

            .book-info-grid {
                grid-template-columns: 1fr;
            }

            .publisher-top {
                flex-direction: column;
            }

            .rfq-box {
                flex-direction: column;
                align-items: stretch;
            }

            .rfq-btn {
                width: 100%;
            }

            .review-section {
                flex-direction: column;
            }

            .platform-note {
                margin: 15px;
            }

        }
    </style>

    <div class="book-details-page">

        <!-- LEFT SIDEBAR -->
        <aside class="book-sidebar">
            {{-- @dd($catalogue) --}}
            <div class="book-cover-card">
                <img src="{{ $catalogue->cover_file ? asset('storage/' . $catalogue->cover_file) : 'https://dummyimage.com/400x900/000/fff' }}"
                    alt="{{ $catalogue->catalogue_title }}" class="book-cover-img">

                <button class="preview-btn"
                    onclick="window.open('{{ asset('storage/' . $catalogue->sample_file) }}', '_blank')">
                    <i class="fa-solid fa-book-open"></i>
                    Preview Sample
                </button>

                <div class="sample-circle">
                    <span>Upload Logo</span>
                </div>
            </div>

            <!-- Publisher Card -->
            <div class="publisher-card">

                <div class="publisher-top">

                    <div>
                        <h3>EduPress</h3>
                        <p>Publication</p>
                    </div>

                    <div class="publisher-follow">
                        <button>Follow</button>
                        <small>📍 New Delhi</small>
                    </div>

                </div>

                <div class="publisher-about">
                    <h5>About</h5>

                    <p>
                        Business advisor helping entrepreneurs and professionals
                        achieve financial freedom through strategic planning
                        and growth-focused educational publishing.
                    </p>
                </div>

                <div class="publisher-actions">
                    <a href="#">VIEW PROFILE</a>
                    <a href="#">INQUIRIES</a>
                </div>

            </div>

        </aside>


        <main class="book-main">
            {{-- @dd($catalogue) --}}
            <div class="book-tags">
                <span class="tag-orange">{{ $catalogue->applicable_board }}</span>
                {{-- <span class="tag-light">Class 10</span> --}}
            </div>

            <h1 class="book-title">{{ $catalogue->catalogue_title }}</h1>

            <div class="publisher-name">
                Published by <span>{{ $catalogue->publisher_brand_name }}</span>
            </div>

            <div class="book-rating">
                ⭐ 4.5 &nbsp;
                <span>Verified Academic Feedback (124 Reviews)</span>
            </div>

            <!-- META GRID -->
            <div class="book-info-grid">

                <div class="info-item">
                    <h6>Academic Medium</h6>
                    <p>{{ $catalogue->medium }}</p>
                </div>

                <div class="info-item">
                    <h6>Academic Session</h6>
                    <p>{{ $catalogue->academic_session }}</p>
                </div>

                <div class="info-item">
                    <h6>ISBN-13</h6>
                    <p>{{ $catalogue->isbn_13 }}</p>
                </div>

                <div class="info-item">
                    <h6>Page Count</h6>
                    <p>{{ $catalogue->print_length }} Pages</p>
                </div>

                <div class="info-item">
                    <h6>Published On</h6>
                    <p>{{ $catalogue->published_on }}</p>
                </div>

                <div class="info-item">
                    <h6>Applicable Board</h6>
                    <p>{{ $catalogue->applicable_board }}</p>
                </div>

                <div class="info-item">
                    <h6>Recommended Age</h6>
                    <p>{{ $catalogue->reading_age }} Years</p>
                </div>

                <div class="info-item">
                    <h6>Content Type</h6>
                    <p>{{ $catalogue->category }}</p>
                </div>

                <div class="info-item">
                    <h6>Subject Category</h6>
                    <p>{{ $catalogue->sub_category }}</p>
                </div>

            </div>

            <!-- PRICE -->
            <div class="price-section">
                <span>Publisher Reference Price (MRP)</span>
                <h2>₹ {{ $catalogue->mrp }}</h2>
            </div>

            <!-- OVERVIEW -->
            <div class="academic-overview">
                <h4>Academic Overview</h4>

                <p>
                    This academic title is listed by a verified publishing partner and
                    designed to support curriculum-based learning, structured classroom usage,
                    and institution-led academic planning.
                </p>

                <p>
                    Schools are advised to review curriculum compatibility before initiating RFQ workflows.
                </p>
            </div>

            <!-- ACTION -->
            <div class="rfq-box">

                <div class="qty-box">
                    <label>Required Quantity</label>

                    <div class="qty-control">
                        <button>-</button>
                        <input type="number" value="1">
                        <button>+</button>
                    </div>
                </div>

                <button class="rfq-btn">
                    <i class="fa-solid fa-file-signature"></i>
                    Create Institutional RFQ
                </button>

            </div>

            <!-- NOTICE -->
            <div class="rfq-note">
                <i class="fa-solid fa-circle-info"></i>
                By creating an RFQ, schools can invite verified suppliers to provide quotations based on availability and
                academic suitability.
            </div>

            <!-- REVIEWS -->
            <div class="review-section">

                <div class="review-left">
                    <h2>4.5 ⭐⭐⭐⭐⭐</h2>
                    <p>Based on 124 Verified Reviews</p>
                </div>

                <div class="review-cards">

                    <div class="review-card">
                        <h6>Delhi Public School, Lucknow</h6>
                        <p>Excellent clarity of concepts and aligned with the CBSE curriculum.</p>
                    </div>

                    <div class="review-card">
                        <h6>St. Xavier’s School, Kolkata</h6>
                        <p>Well structured content and production quality suitable for institutions.</p>
                    </div>

                </div>

            </div>

        </main>

        <!-- RIGHT SIDEBAR -->
        <aside class="book-right-sidebar">

            <!-- QUICK DETAILS -->
            <div class="right-card">

                <h3>Quick Details</h3>

                <ul>
                    <li><span>Print Length</span> <strong>108 Pages</strong></li>
                    <li><span>Reading Age</span> <strong>5 - 10 years</strong></li>
                    <li><span>Dimensions</span> <strong>24 x 17 x 2.4 cm</strong></li>
                    <li><span>Volume / Part Number</span> <strong>XXXXXXX</strong></li>
                </ul>

            </div>

            <!-- WHY THIS BOOK -->
            <div class="right-card">

                <div class="desc-tag">Description</div>

                <h3>Why This Book?</h3>

                <ul class="why-list">
                    <li>Aligned with latest academic syllabus</li>
                    <li>Concept-based and easy to understand</li>
                    <li>Includes solved examples and practice sets</li>
                    <li>Supports classroom learning</li>
                    <li>Ideal for exams and assessments</li>
                </ul>

            </div>

            <!-- RATING -->
            <div class="right-card">

                <h3>Rating & Reviews</h3>

                <div class="rating-big">
                    4.5 ⭐⭐⭐⭐⭐
                    <span>(124 Reviews)</span>
                </div>

                <div class="rating-bars">

                    <div class="bar-row">
                        <label>5 ★</label>
                        <div class="bar"><span style="width:74%"></span></div>
                        <small>74%</small>
                    </div>

                    <div class="bar-row">
                        <label>4 ★</label>
                        <div class="bar"><span style="width:18%"></span></div>
                        <small>18%</small>
                    </div>

                    <div class="bar-row">
                        <label>3 ★</label>
                        <div class="bar"><span style="width:6%"></span></div>
                        <small>6%</small>
                    </div>

                    <div class="bar-row">
                        <label>2 ★</label>
                        <div class="bar"><span style="width:1%"></span></div>
                        <small>1%</small>
                    </div>

                </div>

                <button class="write-review-btn">
                    ✏ Write a Review
                </button>

            </div>

        </aside>

    </div>

    <!-- BOTTOM NOTE -->
    <div class="platform-note">
        <i class="fa-solid fa-shield-halved"></i>
        GoErudite provides catalog visibility and academic discovery tools only.
        The platform does not sell, purchase, stock, transport, price-negotiate,
        or process payments for listed academic products.
    </div>


@endsection
