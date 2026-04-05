@extends('layouts.app')

@section('title', 'Shop | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers
    across India. Manage and distribute digital textbooks with ease.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book
    distribution, CBSE ICSE digital books, LMS integration')

@section('content')



    <div class="book-wrapper">

        <!-- LEFT SIDE -->
        <div class="book-left">
            <img src="https://dummyimage.com/400x600/000/fff" alt="Book Cover">

            <button class="btn-orange">Read Sample</button>

            <div class="logo-upload"></div>

            <div class="publisher-box">
                <div class="row">
                    <div class="col-md-6 leftArea">
                        <h3>EduPress</h3>
                        <p><small>Publication</small></p>
                    </div>
                    <div class="col-md-6 rightArea">
                         <button class="follow-btn">Follow</button>
                          <p><small>📍 New Delhi</small></p>
                    </div>
                </div>





                <div class="about-box">
                    <strong>About</strong>
                    <p style="font-size:14px;">
                        I am a Business Advisor helping entrepreneurs and professionals achieve financial freedom through
                        strategic planning and a growth mindset.
                    </p>
                </div>

                <div class="footer-buttons">
                    <button class="btn-call">CALL NOW</button>
                    <button class="btn-inquiry">INQUIRIES</button>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="book-right">
            <span style="background:#f7c7a3; padding:4px 10px; border-radius:6px;">CBSE</span>
            <span style="float:right; background:#e5e5e5; padding:4px 10px; border-radius:6px;">Class 10</span>

            <h1 class="heading-book-right">Mathematics World</h1>
            <h5 style="color:#f15a24;">EduPress</h3>

            ⭐ 4.5 Rating & Reviews

            <div class="book-meta">
                <div class="row">
                    <div class="col-md-4"><strong>Medium</strong>
                        <br> <span>English, Hindi</span>
                    </div>
                    <div class="col-md-4"><strong>Session</strong>
                        <br> <span>2025-2026</span>
                    </div>
                    <div class="col-md-4"><strong>ISBN-13</strong>
                        <br> <span>xxxxxxxxxxxx</span>
                    </div>
                    <div class="col-md-4"><strong>Print Length</strong>
                        <br> <span>108 Pages</span>
                    </div>
                    <div class="col-md-4"><strong>Published On</strong>
                        <br> <span>12 Jan 2026</span>
                    </div>
                    <div class="col-md-4"><strong>ISBN-10</strong>
                        <br> <span>xxxxxxxxx</span>
                    </div>
                    <div class="col-md-4"><strong>Reading age</strong>
                        <br> <span>5 - 10 years</span>
                    </div>
                    <div class="col-md-4"><strong>Dimensions</strong>
                        <br> <span>24 x 17 x 2.4 cm</span>
                    </div>
                    <div class="col-md-4"><strong>Volume / Part Number</strong>
                        <br> <span>xxxxxx</span>
                    </div>
                </div>

            </div>

            <div class="price">MRP: ₹450</div>

            <div class="description">
                This book is designed to deliver clear concepts, structured learning,
                and practical understanding aligned with the latest academic standards.
                Each chapter is carefully organized with easy explanations, examples,
                and practice content to support effective learning.
            </div>

            <div class="action-buttons">
                <button class="btn-grey">Add to Cart</button>
                <input type="number" value="1">
                <button class="btn-grey">Create RFQ</button>
            </div>

            <div class="rating-sec">
                <h2>Rating & Reviews</h2>
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p>Reviews and Ratings show here</p>
            </div>
        </div>

    </div>

@endsection
