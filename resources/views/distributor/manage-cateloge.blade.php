@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-md-7">
                <div class="d-flex align-items-center gap-3">
                    <div class="catalogue-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div>
                        <h1 class="h3 fw-bold mb-1">Manage Catalogue</h1>
                        <p class="text-muted mb-0">Active Session</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5 text-end">
                <button class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#baseDetailsModal">
                    <i class="fas fa-plus"></i> ADD CATALOGUE
                </button>
                <a href="#" class="common-btn">RAISE CLASS-WISE RFQ</a>
            </div>
        </div>

<!-- Catalogue Slider Section -->
        <div class="catalogue-slider-section mb-5">
            <div id="catalogueCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Slide Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#catalogueCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#catalogueCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#catalogueCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>

                <!-- Slide Content -->
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="catalogue-card-horizontal">
                            <div class="card-horizontal-wrapper">
                                <div class="card-image-section">
                                    <img src="https://dummyimage.com/400x900/000/fff" alt="Mathematics World" class="img-fluid">
                                    <button class="btn btn-sm btn-read-sample mt-2">
                                        <i class="fas fa-book"></i> Read Sample
                                    </button>
                                </div>
                                <div class="card-content-section">
                                    <div class="card-header-row">
                                        <div>
                                            <span class="badge bg-dark me-2">CBSE</span>
                                            <span class="badge bg-light text-dark">Class 10</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-1">Mathematics World</h5>
                                    <p class="text-muted mb-2" style="font-size: 13px;">EduPress</p>
                                    <div class="rating-section mb-3">
                                        <i class="fas fa-star text-warning"></i>
                                        <span class="small fw-bold">4.5</span>
                                        <span class="small text-muted">Rating & Reviews</span>
                                    </div>

                                    <div class="catalogue-details-grid">
                                        <div class="detail-row">
                                            <span class="detail-label">Medium</span>
                                            <span class="detail-value">English, Hindi</span>
                                            <span class="detail-label">Session</span>
                                            <span class="detail-value">2025-2026</span>
                                            <span class="detail-label">ISBN-13</span>
                                            <span class="detail-value">••••••••••</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Print Length</span>
                                            <span class="detail-value">168 Pages</span>
                                            <span class="detail-label">Published On</span>
                                            <span class="detail-value">12 Jan 2028</span>
                                            <span class="detail-label">ISBN-10</span>
                                            <span class="detail-value">••••••••••</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Dimensions</span>
                                            <span class="detail-value">24 x 17.6 cm</span>
                                            <span class="detail-label">Volume/Part</span>
                                            <span class="detail-value">Part 1</span>
                                        </div>
                                    </div>

                                    <div class="mt-3 pt-3 border-top">
                                        <p class="small text-muted mb-2"><strong>Description:</strong> Comprehensive mathematics textbook designed for class 10 students covering all major topics with practical examples aligned with key academic standards.</p>
                                    </div>
                                </div>
                                <div class="card-price-section">
                                    <div class="price-box">
                                        <span class="price-label">MRP</span>
                                        <span class="price-value">₹450</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="catalogue-card-horizontal">
                            <div class="card-horizontal-wrapper">
                                <div class="card-image-section">
                                    <img src="https://dummyimage.com/400x900/000/fff" alt="English Literature" class="img-fluid">
                                    <button class="btn btn-sm btn-read-sample mt-2">
                                        <i class="fas fa-book"></i> Read Sample
                                    </button>
                                </div>
                                <div class="card-content-section">
                                    <div class="card-header-row">
                                        <div>
                                            <span class="badge bg-dark me-2">ICSE</span>
                                            <span class="badge bg-light text-dark">Class 10</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-1">English Literature</h5>
                                    <p class="text-muted mb-2" style="font-size: 13px;">EduPress</p>
                                    <div class="rating-section mb-3">
                                        <i class="fas fa-star text-warning"></i>
                                        <span class="small fw-bold">4.7</span>
                                        <span class="small text-muted">Rating & Reviews</span>
                                    </div>

                                    <div class="catalogue-details-grid">
                                        <div class="detail-row">
                                            <span class="detail-label">Medium</span>
                                            <span class="detail-value">English</span>
                                            <span class="detail-label">Session</span>
                                            <span class="detail-value">2025-2026</span>
                                            <span class="detail-label">ISBN-13</span>
                                            <span class="detail-value">••••••••••</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Print Length</span>
                                            <span class="detail-value">224 Pages</span>
                                            <span class="detail-label">Published On</span>
                                            <span class="detail-value">15 Feb 2027</span>
                                            <span class="detail-label">ISBN-10</span>
                                            <span class="detail-value">••••••••••</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Dimensions</span>
                                            <span class="detail-value">24 x 17.6 cm</span>
                                            <span class="detail-label">Volume/Part</span>
                                            <span class="detail-value">Part 1</span>
                                        </div>
                                    </div>

                                    <div class="mt-3 pt-3 border-top">
                                        <p class="small text-muted mb-2"><strong>Description:</strong> Comprehensive collection of English literature featuring classic and contemporary works suitable for class 10 students.</p>
                                    </div>
                                </div>
                                <div class="card-price-section">
                                    <div class="price-box">
                                        <span class="price-label">MRP</span>
                                        <span class="price-value">₹550</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div class="catalogue-card-horizontal">
                            <div class="card-horizontal-wrapper">
                                <div class="card-image-section">
                                    <img src="https://dummyimage.com/400x900/000/fff" alt="Science Fundamentals" class="img-fluid">
                                    <button class="btn btn-sm btn-read-sample mt-2">
                                        <i class="fas fa-book"></i> Read Sample
                                    </button>
                                </div>
                                <div class="card-content-section">
                                    <div class="card-header-row">
                                        <div>
                                            <span class="badge bg-dark me-2">NCERT</span>
                                            <span class="badge bg-light text-dark">Class 8</span>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-1">Science Fundamentals</h5>
                                    <p class="text-muted mb-2" style="font-size: 13px;">EduPress</p>
                                    <div class="rating-section mb-3">
                                        <i class="fas fa-star text-warning"></i>
                                        <span class="small fw-bold">4.8</span>
                                        <span class="small text-muted">Rating & Reviews</span>
                                    </div>

                                    <div class="catalogue-details-grid">
                                        <div class="detail-row">
                                            <span class="detail-label">Medium</span>
                                            <span class="detail-value">English, Hindi</span>
                                            <span class="detail-label">Session</span>
                                            <span class="detail-value">2025-2026</span>
                                            <span class="detail-label">ISBN-13</span>
                                            <span class="detail-value">••••••••••</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Print Length</span>
                                            <span class="detail-value">256 Pages</span>
                                            <span class="detail-label">Published On</span>
                                            <span class="detail-value">20 Mar 2027</span>
                                            <span class="detail-label">ISBN-10</span>
                                            <span class="detail-value">••••••••••</span>
                                        </div>
                                        <div class="detail-row">
                                            <span class="detail-label">Dimensions</span>
                                            <span class="detail-value">24 x 17.6 cm</span>
                                            <span class="detail-label">Volume/Part</span>
                                            <span class="detail-value">Part 1</span>
                                        </div>
                                    </div>

                                    <div class="mt-3 pt-3 border-top">
                                        <p class="small text-muted mb-2"><strong>Description:</strong> Interactive science textbook covering physics, chemistry, and biology with engaging diagrams and experiments.</p>
                                    </div>
                                </div>
                                <div class="card-price-section">
                                    <div class="price-box">
                                        <span class="price-label">MRP</span>
                                        <span class="price-value">₹650</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Navigation Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#catalogueCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#catalogueCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- ProTip Section -->
        <div class="row">
            <div class="col-12">
                <div class="proto-tip-section p-4 mb-4">
                    <div class="d-flex align-items-start gap-3">
                        <div class="pro-tip-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold text-danger mb-1">ProTip for Schools</h6>
                            <p class="mb-0 text-dark">Update class-wise student counts to auto-calculate RFQ quantities
                                with a 2% buffer.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>






        <!-- Base Details Modal -->
        <div class="modal fade" id="baseDetailsModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-bottom">
                        <h5 class="modal-title fw-bold">BASE DETAILS</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Catalogue Title</label>
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Enter catalogue title">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Publisher / Brand Name</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Publisher name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Academic Session</label>
                                <input type="text" class="form-control form-control-sm" placeholder="2025-26">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Applicable Board</label>
                                <select class="form-select form-select-sm">
                                    <option>CBSE</option>
                                    <option>ICSE</option>
                                    <option>State Board</option>
                                    <option>IB</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Medium</label>
                                <select class="form-select form-select-sm">
                                    <option>English</option>
                                    <option>Hindi</option>
                                    <option>Regional</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Print Length</label>
                                <input type="number" class="form-control form-control-sm" placeholder="Pages">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Published On</label>
                                <input type="date" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">ISBN-13</label>
                                <input type="text" class="form-control form-control-sm" placeholder="ISBN-13">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">ISBN-10</label>
                                <input type="text" class="form-control form-control-sm" placeholder="ISBN-10">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Reading Age</label>
                                <input type="text" class="form-control form-control-sm" placeholder="10+">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Dimensions</label>
                                <input type="text" class="form-control form-control-sm" placeholder="L x W x H">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Volume/Part Numbers</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Part 1, Part 2">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">MRP</label>
                                <input type="number" class="form-control form-control-sm" placeholder="450">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Category</label>
                                <select class="form-select form-select-sm">
                                    <option>Fiction</option>
                                    <option>Non-Fiction</option>
                                    <option>Textbook</option>
                                    <option>Reference</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Cover Uploaded</label>
                                <div class="input-group input-group-sm">
                                    <input type="file" class="form-control" id="coverUpload" accept="image/*">
                                    <span class="input-group-text">JPG Format</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-bold small">Sample Uploaded</label>
                                <div class="input-group input-group-sm">
                                    <input type="file" class="form-control" id="sampleUpload"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <span class="input-group-text">PDF / JPG Format</span>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small">Description</label>
                            <textarea class="form-control" rows="4" placeholder="Enter detailed description of the catalogue..."></textarea>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirmCatalogue">
                            <label class="form-check-label" for="confirmCatalogue">
                                I confirm that the uploaded catalogue is accurate, updated, and authorized for sharing on
                                the platform.
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger">Save Catalogue</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Catalogue Modal -->
        <div class="modal fade" id="editCatalogueModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Catalogue</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Update the catalogue details as needed.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Update Catalogue</button>
                    </div>
                </div>
            </div>
        </div>



@endsection
