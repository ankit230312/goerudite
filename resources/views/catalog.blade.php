@extends('layouts.app')

@section('title', 'Shop | Digital Textbooks for Schools & Publishers')
@section('description', 'GoErudite provides secure, compliant e-book services for schools, distributors, and publishers across India. Manage and distribute digital textbooks with ease.')
@section('keywords', 'GoErudite e-book services, digital textbooks India, school e-books platform, publisher e-book distribution, CBSE ICSE digital books, LMS integration')

@section('content')

@php
    // ---------------- PAGINATION SETTINGS ----------------
    $productsPerPage = 8;
    $totalProducts   = 48; // change later to count from DB
    $totalPages      = ceil($totalProducts / $productsPerPage);

    // Current page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, min($page, $totalPages));

    // Offset
    $start = ($page - 1) * $productsPerPage;
@endphp

    <div class="products-grid">
        @php
        for ($i = $start; $i < min($start + $productsPerPage, $totalProducts); $i++):
        
            
        endfor; 
        @php
    </div>

 <div class="shop-container">
    <!-- Sidebar Filters -->
    <aside class="sidebar-filters">
        <div class="filter-header">
            <h3>FILTERS</h3>
            <a href="#" class="clear-all">Clear All</a>
        </div>

        <!-- Target Exams -->
        <div class="filter-section">
            <h4>🎯 Target Exams</h4>
            <div class="filter-options-grid">
                <div class="filter-option">
                    <input type="checkbox" id="ukg">
                    <label for="ukg">UKG/ State PK</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="defence">
                    <label for="defence">Defence</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="banking">
                    <label for="banking">Banking SSC</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="teaching">
                    <label for="teaching">Teaching</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="ssc">
                    <label for="ssc">SSC</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="othergovt">
                    <label for="othergovt">Other Govt Exams</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="railway">
                    <label for="railway">Railway</label>
                </div>
            </div>
        </div>

        <!-- Academic Level -->
        <div class="filter-section">
            <h4>Academic Level</h4>
            <div class="filter-options-grid">
                <div class="filter-option">
                    <input type="checkbox" id="preprimary">
                    <label for="preprimary">Pre-Primary</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="middle">
                    <label for="middle">Middle (4-8)</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="primary">
                    <label for="primary">Primary (1-3)</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="secondary">
                    <label for="secondary">Secondary (9-10)</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="upersecondary">
                    <label for="upersecondary">Upper Secondary (11-12)</label>
                </div>
            </div>
        </div>

        <!-- Subject -->
        <div class="filter-section">
            <h4>Subject</h4>
            <div class="filter-options-grid">
                <div class="filter-option">
                    <input type="checkbox" id="mathematics">
                    <label for="mathematics">Mathematics</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="evscce">
                    <label for="evscce">EVS/CCE</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="science">
                    <label for="science">Science</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="reasoning">
                    <label for="reasoning">Reasoning</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="english">
                    <label for="english">English</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="aptitude">
                    <label for="aptitude">Aptitude</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="hindi">
                    <label for="hindi">Hindi</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="othersubj">
                    <label for="othersubj">Other Subject</label>
                </div>
            </div>
        </div>

        <!-- Education Board -->
        <div class="filter-section">
            <h4>Education Board</h4>
            <div class="filter-options-grid">
                <div class="filter-option">
                    <input type="checkbox" id="cbse">
                    <label for="cbse">CBSE</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="icse">
                    <label for="icse">ICSE</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="stateboard">
                    <label for="stateboard">State Board</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="international">
                    <label for="international">International</label>
                </div>
            </div>
        </div>

        <!-- Medium -->
        <div class="filter-section">
            <h4>Medium</h4>
            <div class="filter-options-grid">
                <div class="filter-option">
                    <input type="checkbox" id="english-med">
                    <label for="english-med">English</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="hindi-med">
                    <label for="hindi-med">Hindi</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="regional">
                    <label for="regional">Regional</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="othermed">
                    <label for="othermed">Other Medium</label>
                </div>
            </div>
        </div>

        <!-- Session -->
        <div class="filter-section">
            <h4>Session</h4>
            <div class="filter-options-grid">
                <div class="filter-option">
                    <input type="checkbox" id="session2024">
                    <label for="session2024">2024-25</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="session2025">
                    <label for="session2025">2025-26</label>
                </div>
                <div class="filter-option">
                    <input type="checkbox" id="session2023">
                    <label for="session2023">2023-24</label>
                </div>
            </div>
            <div class="session-badges">
                <span class="session-badge new">NEW</span>
                <span class="session-badge new">NEW</span>
            </div>
        </div>

        <!-- Price Range -->
        <div class="filter-section">
            <h4>Price Range (MRP)</h4>
            <div class="price-range-display">
                <span>TO</span>
                <span>UP TO ₹5000</span>
            </div>
        </div>

        <!-- Important Tip -->
        <div class="important-tip">
            <strong>Grow Your Business</strong>
            List your business in TS easy (3 min) to 10,000+ schools. Final price subject to seller rules. Platform does not influence commercial terms.
        </div>

        <!-- Verified Publisher Toggle -->
        <div class="verified-publisher-toggle">
            <label for="verified-toggle">Verified Publishers</label>
            <div class="toggle-switch active" onclick="this.classList.toggle('active')">
                <input type="checkbox" id="verified-toggle" style="display: none;" checked>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="shop-main">
        <!-- Header -->
        <div class="shop-header">
            <div class="search-sort-bar">
                <div class="search-box">
                    <input type="text" placeholder="Search for books, publishers, or ISBNs...">
                </div>
                <select class="sort-dropdown">
                    <option>Sort by Price: Low to High</option>
                    <option>Sort by Price: High to Low</option>
                    <option>Sort by Rating</option>
                    <option>Sort by Newest</option>
                </select>
                <select class="view-dropdown">
                    <option>Grid View</option>
                    <option>List View</option>
                </select>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            <?php
            for ($i = $start; $i < min($start + $productsPerPage, $totalProducts); $i++):
            ?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="images/mathematics.avif" alt="Mathematics World">
                        <div class="wishlist-icon">♡</div>
                        <div class="class-badge">Class 10</div>
                    </div>

                    <div class="product-info">
                        <a href="detail-page.php" class="text-decoration-none"><h3>Mathematics World</h3></a>
                        <div class="product-meta">
                            <span class="meta-badge cbse">CBSE</span>
                            <span class="meta-badge">English</span>
                            <span class="rating">★★★★☆ 4.5</span>
                        </div>
                    </div>

                    <div class="product-pricing">
                        <div class="prices">
                            <span class="mrp">MRP ₹500</span>
                            <span class="selling-price">₹385</span>
                            <span class="discount">23% OFF</span>
                        </div>
                        <button class="add-to-cart">Add to RFQ</button>
                    </div>
                </div>
            <?php endfor; ?>
            </div>

            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>" class="page-link">« Prev</a>
                <?php endif; ?>

                <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                    <a href="?page=<?= $p ?>" 
                    class="page-link <?= ($p == $page) ? 'active' : '' ?>">
                    <?= $p ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?= $page + 1 ?>" class="page-link">Next »</a>
                <?php endif; ?>
            </div>

    </main>
</div>


@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const formMessage = document.getElementById('formMessage');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!validateForm()) return;

                const submitBtn = form.querySelector('.submit-btn');
                const btnText = submitBtn.querySelector('.btn-text');
                const btnLoader = submitBtn.querySelector('.btn-loader');

                submitBtn.classList.add('loading');
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline';

                const formData = new FormData(form);

                fetch('process_contact.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        formMessage.textContent = 'Message sent successfully!';
                        formMessage.className = 'form-message success';
                        form.reset();
                    } else {
                        formMessage.textContent = data.message || 'An error occurred.';
                        formMessage.className = 'form-message error';
                    }
                })
                .catch(error => {
                    formMessage.textContent = 'An error occurred. Please try again.';
                    formMessage.className = 'form-message error';
                })
                .finally(() => {
                    submitBtn.classList.remove('loading');
                    btnText.style.display = 'inline';
                    btnLoader.style.display = 'none';
                });
            });
        }

        function validateForm() {
            const inputs = form.querySelectorAll('.form-control');
            let isValid = true;

            inputs.forEach(input => {
                const errorMsg = input.parentElement.querySelector('.error-msg');
                if (!input.value.trim()) {
                    errorMsg.textContent = 'This field is required';
                    isValid = false;
                } else if (input.type === 'email' && !isValidEmail(input.value)) {
                    errorMsg.textContent = 'Please enter a valid email';
                    isValid = false;
                } else {
                    errorMsg.textContent = '';
                }
            });

            return isValid;
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }
    });
</script>
@endpush