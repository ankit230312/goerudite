@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid py-4">
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
                <a href="#" class="common-btn" data-bs-toggle="modal" data-bs-target="#classRfqModal">RAISE
                    RFQ</a>
            </div>
        </div>

        <div class="catalogue-slider-section mb-5">
            <div id="catalogueCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false"
                data-bs-wrap="false" data-bs-touch="true">
                <div class="carousel-indicators">
                    @forelse($catalogues as $index => $catalogue)

                        <button type="button" data-bs-target="#catalogueCarousel" data-bs-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}"></button>
                    @empty
                        <button type="button" data-bs-target="#catalogueCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    @endforelse
                </div>

                <div class="carousel-inner">
                    @forelse($catalogues as $index => $catalogue)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="catalogue-card-horizontal">
                                <div class="card-horizontal-wrapper">
                                    <div class="card-image-section">
                                        <img src="{{ $catalogue->cover_file ? asset('storage/' . $catalogue->cover_file) : 'https://dummyimage.com/400x900/000/fff' }}"
                                            alt="{{ $catalogue->catalogue_title }}" class="img-fluid">
                                        @if ($catalogue->sample_file)
                                            <a href="{{ asset('storage/' . $catalogue->sample_file) }}" target="_blank"
                                                class="btn btn-sm btn-read-sample mt-2">
                                                <i class="fas fa-book"></i> Read Sample
                                            </a>
                                        @endif
                                    </div>
                                    <div class="card-content-section">
                                        <div class="card-header-row">
                                            <div>
                                                <span class="badge bg-dark me-2">{{ $catalogue->applicable_board }}</span>
                                                <span
                                                    class="badge bg-light text-dark">{{ $catalogue->category ?: 'General' }}</span>
                                            </div>
                                            @php
                                                $catalogueData = [
                                                    'id' => $catalogue->id,
                                                    'catalogue_title' => $catalogue->catalogue_title,
                                                    'publisher_brand_name' => $catalogue->publisher_brand_name,
                                                    'academic_session' => $catalogue->academic_session,
                                                    'applicable_board' => $catalogue->applicable_board,
                                                    'medium' => $catalogue->medium,
                                                    'print_length' => $catalogue->print_length,
                                                    'published_on' => $catalogue->published_on
                                                        ? $catalogue->published_on->format('Y-m-d')
                                                        : null,
                                                    'isbn_13' => $catalogue->isbn_13,
                                                    'isbn_10' => $catalogue->isbn_10,
                                                    'reading_age' => $catalogue->reading_age,
                                                    'dimensions' => $catalogue->dimensions,
                                                    'volume_part_numbers' => $catalogue->volume_part_numbers,
                                                    'mrp' => $catalogue->mrp,
                                                    'category' => $catalogue->category,
                                                    'description' => $catalogue->description,
                                                    'confirmed' => (bool) $catalogue->confirmed,
                                                ];
                                            @endphp
                                            <button type="button"
                                                class="btn btn-sm btn-outline-secondary edit-catalogue-btn"
                                                data-catalogue='@json($catalogueData)'>
                                                <i class="fas fa-pen-to-square"></i>
                                            </button>
                                        </div>
                                        <h5 class="fw-bold mb-1">{{ $catalogue->catalogue_title }}</h5>
                                        <p class="text-muted mb-2" style="font-size: 13px;">
                                            {{ $catalogue->publisher_brand_name ?: '-' }}</p>

                                        <div class="catalogue-details-grid">
                                            <div class="detail-row">
                                                <span class="detail-label">Medium</span>

                                                <span class="detail-value">{{ $catalogue->mediumDetail->medium_name ?: '-' }}</span>
                                                <span class="detail-label">Session</span>
                                                <span class="detail-value">{{ $catalogue->academic_session ?: '-' }}</span>
                                                <span class="detail-label">ISBN-13</span>
                                                <span class="detail-value">{{ $catalogue->isbn_13 ?: '-' }}</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Print Length</span>
                                                <span class="detail-value">
                                                    {{ $catalogue->print_length ? $catalogue->print_length . ' Pages' : '-' }}
                                                </span>
                                                <span class="detail-label">Published On</span>
                                                <span class="detail-value">
                                                    {{ $catalogue->published_on ? $catalogue->published_on->format('d M Y') : '-' }}
                                                </span>
                                                <span class="detail-label">ISBN-10</span>
                                                <span class="detail-value">{{ $catalogue->isbn_10 ?: '-' }}</span>
                                            </div>
                                            <div class="detail-row">
                                                <span class="detail-label">Dimensions</span>
                                                <span class="detail-value">{{ $catalogue->dimensions ?: '-' }}</span>
                                                <span class="detail-label">Volume/Part</span>
                                                <span
                                                    class="detail-value">{{ $catalogue->volume_part_numbers ?: '-' }}</span>
                                            </div>
                                        </div>

                                        <div class="mt-3 pt-3 border-top">
                                            <p class="small text-muted mb-2">
                                                <strong>Description:</strong> {{ $catalogue->description ?: '-' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="card-price-section">
                                        <div class="price-box">
                                            <span class="price-label">MRP</span>
                                            <span class="price-value">₹{{ number_format($catalogue->mrp, 2) }}</span>
                                        </div>
                                        {{-- <div class="mt-2">
                                            <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#classRfqModal">Raise RFQ</a>
                                        </div> --}}
                                        <div class="mt-2">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger disdlt"
                                                data-id="{{ $catalogue->id }}">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="carousel-item active">
                            <div class="catalogue-card-horizontal">
                                <div class="card-horizontal-wrapper p-4">
                                    <h5 class="mb-0">No catalogue added yet. Click <strong>ADD CATALOGUE</strong> to
                                        create one.</h5>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <button id="prevCatalogueBtn" class="carousel-control-prev catalogue-nav-btn" type="button"
                    data-bs-target="#catalogueCarousel" data-bs-slide="prev">
                    <i class="fas fa-chevron-left" aria-hidden="true"></i>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button id="nextCatalogueBtn" class="carousel-control-next catalogue-nav-btn" type="button"
                    data-bs-target="#catalogueCarousel" data-bs-slide="next">
                    <i class="fas fa-chevron-right" aria-hidden="true"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <!-- RFQ modal copied from dashboard -->
        <div class="modal fade" id="classRfqModal" tabindex="-1" aria-labelledby="classRfqModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="classRfqModalLabel">Send RFQ (Nearby Publications)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card h-100 bg-white rounded shadow-sm">
                            <div class="card-header fw-bold">
                                🚀 Send RFQ (Nearby Publications)
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Send your requirement to verified nearby publishers for best pricing
                                    and
                                    faster delivery.</p>

                                <form>
                                    <div class="d-flex justify-content-between align-items-start mb-4">
                                        <div>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-user-circle fa-2x text-orange me-2"></i>
                                                <div>
                                                    <div class="fw-bold">PRINCIPAL</div>
                                                    <small class="text-success">School : VERIFIED</small>
                                                </div>
                                            </div>
                                            <a href="#" class="btn btn-sm btn-outline-primary mt-2">View Profile</a>
                                        </div>
                                        <div class="text-end">
                                            <div class="small text-muted">Nearby RFQ</div>
                                            <div class="d-flex gap-2">
                                                <select class="form-select form-select-sm">
                                                    <option>State</option>
                                                </select>
                                                <select class="form-select form-select-sm">
                                                    <option>City</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-light p-3 rounded mb-3">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Class">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Class Strength (Total Quantity)">
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control form-control-sm"
                                                    placeholder="Session">
                                            </div>
                                        </div>
                                        <div class="fw-bold mb-2">Class Books &amp; Materials</div>
                                        <div class="row gx-2 gy-2" id="bookRows">

                                            <!-- Row -->
                                            <div class="row mb-1 align-items-center book-row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Books Name / Subject">
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Preference">
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Medium">
                                                </div>

                                                <!-- Action buttons -->
                                                <div class="col-auto">
                                                    <button type="button" class="common-btn  add-row">
                                                        +
                                                    </button>
                                                    <button type="button"
                                                        class="btn btn-sm btn-danger remove-row d-none">
                                                        −
                                                    </button>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <div class="fw-bold text-success mb-2">Quotation Sent Received</div>
                                        <div class="border rounded p-4 text-center text-muted">
                                            PDF/ JPEG Format
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <input type="checkbox" id="confirmRfq" />
                                        <label for="confirmRfq" class="form-label ms-1">I confirm that this RFQ will be
                                            sent only
                                            to verified nearby publishers based on my selected location.</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Send Message
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        <div class="modal fade" id="baseDetailsModal" tabindex="-1">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <form id="catalogueForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="catalogue_id" id="catalogueId">
                        <div class="modal-header border-bottom">
                            <h5 class="modal-title fw-bold" id="catalogueModalTitle">BASE DETAILS</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Catalogue Title</label>
                                    <input type="text" class="form-control form-control-sm" name="catalogue_title"
                                        placeholder="Enter catalogue title" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Publisher / Brand Name</label>
                                    <input type="text" class="form-control form-control-sm"
                                        name="publisher_brand_name" placeholder="Publisher name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Academic Session</label>
                                    <select class="form-select form-select-sm" name="academic_session" required>
                                        <option value="">Select session</option>
                                        @foreach ($academicSessions as $session)
                                            <option value="{{ $session->name }}">{{ $session->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Applicable Board</label>
                                    <select class="form-select form-select-sm" name="applicable_board" id="applicable_board" required>
                                        <option value="">Select board</option>
                                        @foreach ($boards as $board)
                                            <option value="{{ $board->id }}">{{ $board->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div>
                                    <label>Medium of Instruction</label>
                                    <select name="medium" id="mediumSelect">
                                        <option value="">Select Medium</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Print Length</label>
                                    <input type="number" class="form-control form-control-sm" name="print_length"
                                        placeholder="Pages">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Published On</label>
                                    <input type="date" class="form-control form-control-sm" name="published_on">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">ISBN-13</label>
                                    <input type="text" class="form-control form-control-sm" name="isbn_13"
                                        placeholder="ISBN-13">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">ISBN-10</label>
                                    <input type="text" class="form-control form-control-sm" name="isbn_10"
                                        placeholder="ISBN-10">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Reading Age</label>
                                    <input type="text" class="form-control form-control-sm" name="reading_age"
                                        placeholder="10+">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Dimensions</label>
                                    <input type="text" class="form-control form-control-sm" name="dimensions"
                                        placeholder="L x W x H">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Volume/Part Numbers</label>
                                    <input type="text" class="form-control form-control-sm" name="volume_part_numbers"
                                        placeholder="Part 1, Part 2">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">MRP</label>
                                    <input type="number" class="form-control form-control-sm" name="mrp"
                                        placeholder="450" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Category</label>
                                    <select class="form-select form-select-sm" name="category">
                                        <option value="">Select category</option>
                                        <option value="Fiction">Fiction</option>
                                        <option value="Non-Fiction">Non-Fiction</option>
                                        <option value="Textbook">Textbook</option>
                                        <option value="Reference">Reference</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Cover Uploaded</label>
                                    <div class="input-group input-group-sm">
                                        <input type="file" class="form-control" name="cover_upload" accept="image/*">
                                        <span class="input-group-text">JPG/PNG</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold small">Sample Uploaded</label>
                                    <div class="input-group input-group-sm">
                                        <input type="file" class="form-control" name="sample_upload"
                                            accept=".pdf,.jpg,.jpeg,.png">
                                        <span class="input-group-text">PDF / JPG</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small">Description</label>
                                <textarea class="form-control" rows="4" name="description"
                                    placeholder="Enter detailed description of the catalogue..."></textarea>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="confirmCatalogue"
                                    name="confirm_catalogue" value="1">
                                <label class="form-check-label" for="confirmCatalogue">
                                    I confirm that the uploaded catalogue is accurate, updated, and authorized for sharing
                                    on
                                    the platform.
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer border-top">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger" id="catalogueSubmitBtn">Save Catalogue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function showToast(message, type = 'success') {
            const isSuccess = type === 'success';
            Toastify({
                text: message,
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: isSuccess ?
                    "linear-gradient(135deg, #ff7a18, #ffb347)" : "#ff4d4f"
            }).showToast();
        }
        document.addEventListener('DOMContentLoaded', function() {
            console.log('[manage-cateloge] DOMContentLoaded fired');
            const catalogueModalEl = document.getElementById('baseDetailsModal');
            const catalogueModalTitle = document.getElementById('catalogueModalTitle');
            const catalogueSubmitBtn = document.getElementById('catalogueSubmitBtn');
            const catalogueIdInput = document.getElementById('catalogueId');



            function setCatalogueFormMode(isEdit) {
                if (isEdit) {
                    catalogueModalTitle.textContent = 'EDIT CATALOGUE';
                    catalogueSubmitBtn.textContent = 'Update Catalogue';
                    catalogueSubmitBtn.classList.remove('btn-danger');
                    catalogueSubmitBtn.classList.add('btn-primary');
                } else {
                    catalogueModalTitle.textContent = 'BASE DETAILS';
                    catalogueSubmitBtn.textContent = 'Save Catalogue';
                    catalogueSubmitBtn.classList.remove('btn-primary');
                    catalogueSubmitBtn.classList.add('btn-danger');
                }
            }

            function setField(name, value) {
                const field = catalogueForm.querySelector(`[name="${name}"]`);
                if (!field) {
                    return;
                }

                if (field.type === 'checkbox') {
                    field.checked = !!value;
                    return;
                }

                field.value = value ?? '';
            }

            function resetCatalogueForm() {
                catalogueForm.reset();
                catalogueIdInput.value = '';
                setCatalogueFormMode(false);
            }

            function openEditCatalogue(catalogue) {
                setCatalogueFormMode(true);
                catalogueIdInput.value = catalogue.id || '';

                setField('catalogue_title', catalogue.catalogue_title);
                setField('publisher_brand_name', catalogue.publisher_brand_name);
                setField('academic_session', catalogue.academic_session);
                setField('applicable_board', catalogue.applicable_board);
                setField('medium', catalogue.medium);
                setField('print_length', catalogue.print_length);
                setField('published_on', catalogue.published_on);
                setField('isbn_13', catalogue.isbn_13);
                setField('isbn_10', catalogue.isbn_10);
                setField('reading_age', catalogue.reading_age);
                setField('dimensions', catalogue.dimensions);
                setField('volume_part_numbers', catalogue.volume_part_numbers);
                setField('mrp', catalogue.mrp);
                setField('category', catalogue.category);
                setField('description', catalogue.description);
                setField('confirm_catalogue', catalogue.confirmed);

                const modal = bootstrap.Modal.getOrCreateInstance(catalogueModalEl);
                modal.show();
            }

            document.querySelectorAll('.edit-catalogue-btn').forEach((btn) => {
                btn.addEventListener('click', function() {
                    try {
                        const raw = this.getAttribute('data-catalogue');
                        const catalogueData = JSON.parse(raw);
                        openEditCatalogue(catalogueData);
                    } catch (e) {
                        showToast('Unable to open edit form.', 'error');
                    }
                });
            });

            catalogueModalEl.addEventListener('hidden.bs.modal', function() {
                resetCatalogueForm();
            });

            catalogueForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);
                const isEdit = !!formData.get('catalogue_id');
                const submitUrl = isEdit ?
                    "{{ route('publisher.update_catalogue') }}" :
                    "{{ route('publisher.save_catalogue') }}";
                const successMessage = isEdit ?
                    'Catalogue updated successfully.' :
                    'Catalogue saved successfully.';

                fetch(submitUrl, {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status) {
                            const modal = bootstrap.Modal.getInstance(catalogueModalEl);
                            if (modal) {
                                modal.hide();
                            }

                            showToast(successMessage, 'success');
                            window.location.reload();
                            return;
                        }

                        if (data.errors) {
                            let errors = Object.values(data.errors).flat().map(err => {
                                // Convert KB to MB if message contains kilobytes
                                const match = err.match(/(\d+)\s?kilobytes/i);
                                if (match) {
                                    const kb = parseInt(match[1]);
                                    const mb = (kb / 1024).toFixed(2);
                                    return err.replace(match[0], `${mb} MB`);
                                }
                                return err;
                            }).join('\n');

                            showToast(errors, 'error');
                            return;
                        }

                        showToast(data.message || 'Failed to save catalogue.', 'error');
                    })
                    .catch(() => {
                        showToast('Server error. Please try again.', 'error');
                    });
            });

            const carouselElement = document.getElementById('catalogueCarousel');
            console.log('[manage-cateloge] carouselElement=', carouselElement);
            console.log('[manage-cateloge] bootstrap available=', typeof bootstrap !== 'undefined');
            if (carouselElement && typeof bootstrap !== 'undefined') {
                console.log('[manage-cateloge] initializing bootstrap carousel');
                const catalogueCarousel = bootstrap.Carousel.getOrCreateInstance(carouselElement, {
                    interval: false,
                    wrap: false,
                    touch: true
                });

                const prevBtn = document.getElementById('prevCatalogueBtn');
                const nextBtn = document.getElementById('nextCatalogueBtn');

                if (prevBtn) {
                    prevBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        catalogueCarousel.prev();
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        catalogueCarousel.next();
                    });
                }

                let wheelLock = false;
                let lastWheelAt = 0;
                const WHEEL_COOLDOWN = 650;

                carouselElement.addEventListener('wheel', function(e) {
                    const delta = Math.abs(e.deltaX) > Math.abs(e.deltaY) ? e.deltaX : e.deltaY;
                    const now = Date.now();

                    if (Math.abs(delta) < 2) {
                        return;
                    }

                    e.preventDefault();
                    if (wheelLock || (now - lastWheelAt) < WHEEL_COOLDOWN) {
                        return;
                    }

                    wheelLock = true;
                    lastWheelAt = now;

                    if (delta > 0) {
                        catalogueCarousel.next();
                    } else {
                        catalogueCarousel.prev();
                    }

                    setTimeout(() => {
                        wheelLock = false;
                    }, WHEEL_COOLDOWN);
                }, {
                    passive: false
                });
            }
        });
    </script>

    <script>
        document.querySelectorAll('.disdlt').forEach(button => {
            button.addEventListener('click', function() {
                let id = this.getAttribute('data-id');

                if (confirm("Are you sure you want to delete?")) {
                    fetch("{{ route('publisher.delete_catalogue') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status) {
                                showToast('Catalogue deleted successfully.', 'success');
                                location.reload();
                            } else {
                                showToast('Error occurred while deleting catalogue.', 'error');
                            }
                        });
                }
            });
        });
    </script>

    <Script>
           document.getElementById('applicable_board').addEventListener('change', function() {
            let boardId = this.value;

            // Reset Medium Select
            let mediumSelect = document.getElementById('mediumSelect');
            mediumSelect.innerHTML = '<option value="">Loading...</option>';

            if (boardId === "") {
                mediumSelect.innerHTML = '<option value="">Select Medium</option>';
                return;
            }

            fetch(`/get-mediums/${boardId}`)
                .then(res => res.json())
                .then(data => {
                    console.log('Received mediums:', data);
                    mediumSelect.innerHTML = '<option value="">Select Medium</option>';

                    data.forEach(item => {
                        mediumSelect.innerHTML += `
                    <option value="${item.medium_id}">
                        ${item.medium_name}
                    </option>`;
                    });
                })
                .catch(err => {
                    console.error(err);
                    mediumSelect.innerHTML = '<option value="">Error loading</option>';
                });
        });
    </Script>
@endpush
