@extends('layouts.dashboard')

@section('content')
<main class="container-fluid py-4">

    <!-- Page Header -->
    <div class="row mb-4 align-items-center">
        <div class="col-8">
            <h1 class="h3 fw-bold mb-1">Retailer Hub</h1>
            <p class="text-muted mb-0">Active Session</p>
        </div>
        <div class="col-4 text-end">
            <a href="{{ route('retailer.rfq_inbox') }}?tab=received" class="common-btn me-2">RECEIVE RFQ</a>
            <a href="{{ route('retailer.rfq_inbox') }}?create=1" class="common-btn">RAISE RFQ</a>
        </div>
    </div>

    <!-- Stats Grid -->
    @php
    $stats = $stats ?? [
    ['label' => 'Followers', 'icon' => 'fa-user', 'value' => 0],
    ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => 0],
    ['label' => 'Active Request', 'icon' => 'fa-graduation-cap', 'value' => 0],
    ['label' => 'Manage Records', 'icon' => 'fa-clipboard-list', 'value' => 0],
    ['label' => 'Notification RFQ', 'icon' => 'fa-bell', 'value' => 0],
    ];
    @endphp
    <div class="row g-3 mb-4">
        @foreach ($stats as $s)
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            <div class="card text-center h-100 bg-white  shadow-sm">
                <div class="card-body">
                    <i class="fas {{ $s['icon'] }} fa-2x text-orange mb-2"></i>
                    <div class="text-muted small">{{ strtoupper($s['label']) }}</div>
                    <h3 class="fw-bold mb-1 text-orange">{{ $s['value'] ?? 0 }}</h3>

                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Operational Log -->
    <div class="row">
        <div class="col-12 lg:col-7 mb-4 lg:mb-0">
            <div class="card bg-white rounded shadow-sm">
                <div class="card-header fw-bold d-flex align-items-center">
                    <span class="me-2">📋</span> Operational Log
                </div>

                <ul class="list-group list-group-flush">
                    @forelse($operationLogs as $rfq)
                    @php($isReceived = in_array($rfq->id, $acknowledgedRfqIds ?? []))
                    <li class="list-group-item d-flex justify-content-between align-items-center" data-rfq-id="{{ $rfq->id }}">
                        <div>
                            <div class="fw-bold">RFQ-{{ $rfq->id }} | {{ $rfq->school_name }}</div>
                            <small class="text-muted">{{ $rfq->created_at->format('d-m-Y') }}</small>
                        </div>
                        <div class="text-end">
                            <span class="rfq-status {{ $isReceived ? 'text-success' : 'text-warning' }}">
                                {{ $isReceived ? 'Status: Received' : 'Status: Pending' }}
                            </span><br>
                            <a href="#" class="small" onclick="viewRetailerRfqDetails({{ $rfq->id }}); return false;">View RFQ</a>
                            <br>
                            <span class="rfq-received-action">
                                @if(!$isReceived)
                                <a href="javascript:void(0);"
                                    class="small text-primary"
                                    onclick="receiveAndRespondFromDashboard({{ $rfq->id }})">
                                    Received RFQ
                                </a>
                                @else
                                <span class="small text-success">Received Done</span>
                                @endif
                            </span>
                        </div>
                    </li>
                    @empty
                    <li class="list-group-item">No received RFQ found.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- RFQ Modal -->
    <div class="modal fade" id="classRfqModal" tabindex="-1" aria-labelledby="classRfqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classRfqModalLabel">Send RFQ (Nearby Publications)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- begin form card -->
                    <div class="card h-100 bg-white rounded shadow-sm">
                        <div class="card-header fw-bold">
                            🚀 Send RFQ (Nearby Publications)
                        </div>
                        <div class="card-body">
                            <p class="text-muted">Send your requirement to verified nearby publishers for best pricing and
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
                                            <input type="text" class="form-control form-control-sm" placeholder="Class">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm"
                                                placeholder="Class Strength (Total Quantity)">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" placeholder="Session">
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
                                                <input type="text" class="form-control form-control-sm" placeholder="Medium">
                                            </div>

                                            <!-- Action buttons -->
                                            <div class="col-auto">
                                                <button type="button" class="common-btn  add-row">
                                                    +
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger remove-row d-none">
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
                                    <label for="confirmRfq" class="form-label ms-1">I confirm that this RFQ will be sent only
                                        to verified nearby publishers based on my selected location.</label>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i> Send Message
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- end form card -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="retailerRfqDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">RFQ Response</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="rfqResponseForm">
                        @csrf
                        <input type="hidden" id="rfqResponseId" name="rfq_id">
                        <input type="hidden" id="totalIndicativeValueHidden" name="total_indicative_value">

                        <div class="alert alert-warning small mb-4">
                            <div class="fw-semibold">This response is for quotation reference only.</div>
                            <div>It does not represent a confirmed offer, order, supply commitment, or transaction.</div>
                            <div>Final price, terms, payment, and delivery are decided directly between the parties outside the platform.</div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 1: RFQ Summary (Read-Only)</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">RFQ ID</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryId" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">School Name / Masked School Identity</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummarySchool" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Quantity Requested</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryTotalQty" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sender Role</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSenderRole" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sender Company</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSenderCompany" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sender City / State</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSenderLocation" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Required Delivery Window</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryDelivery" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RFQ Closing Date</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryClosing" readonly>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="small text-muted mb-2">Class / Grade, Book Title, Publisher, Quantity Requested</div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Class / Grade</th>
                                                <th>Book Title</th>
                                                <th>Publisher</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody id="rfqSummaryBooksBody">
                                            <tr>
                                                <td colspan="4" class="text-muted text-center">No books listed.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 2: Responder Identity (Auto-Filled)</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Responder Role</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ ucfirst(auth()->user()->role ?? 'Retailer') }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ auth()->user()->business_name ?? 'N/A' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City / State / Coverage Area</label>
                                    <input type="text" class="form-control form-control-sm" value="{{ trim((auth()->user()->city ?? '') . (auth()->user()->state ? ', ' . auth()->user()->state : '') . (auth()->user()->coverage_area ? ' | ' . auth()->user()->coverage_area : '')) ?: 'N/A' }}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 d-none" id="existingResponseSection">
                            <h6 class="fw-bold mb-3">Existing Response (Read-Only)</h6>
                            <div class="row g-3 small">
                                <div class="col-md-4"><strong>Indicative Unit Price:</strong> <span id="existingIndicativeUnitPrice">N/A</span></div>
                                <div class="col-md-4"><strong>Total Indicative Value:</strong> <span id="existingTotalIndicativeValue">N/A</span></div>
                                <div class="col-md-4"><strong>Available Quantity:</strong> <span id="existingAvailableQuantity">N/A</span></div>
                                <div class="col-md-6"><strong>Delivery Window:</strong> <span id="existingDeliveryWindow">N/A</span></div>
                                <div class="col-md-6"><strong>Stock Status:</strong> <span id="existingStockStatus">N/A</span></div>
                                <div class="col-12"><strong>Notes:</strong> <span id="existingAdditionalNotes">N/A</span></div>
                                <div class="col-12"><strong>Submitted At:</strong> <span id="existingSubmittedAt">N/A</span></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 3: Response Details</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Indicative Unit Price (Optional)</label>
                                    <input type="number" class="form-control form-control-sm" id="indicativeUnitPrice" name="indicative_unit_price" min="0" step="0.01">
                                    <div class="form-text">Optional. Indicative price if available. Not binding.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Total Indicative Value</label>
                                    <input type="text" class="form-control form-control-sm" id="totalIndicativeValue" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Available Quantity (Mandatory)</label>
                                    <input type="number" class="form-control form-control-sm" id="availableQuantity" name="available_quantity" min="1" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Approx Delivery Window (Mandatory)</label>
                                    <div class="d-flex gap-2">
                                        <input type="date" class="form-control form-control-sm" id="deliveryFrom" name="delivery_from" required>
                                        <input type="date" class="form-control form-control-sm" id="deliveryTo" name="delivery_to" required>
                                    </div>
                                    <div class="form-text">Mention approximate delivery window, not a fixed date.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Stock / Supply Status (Optional)</label>
                                    <div class="d-flex flex-wrap gap-3 mt-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input me-1" name="stock_status" value="in_stock">
                                            In stock
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input me-1" name="stock_status" value="partially_available">
                                            Partially available
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input me-1" name="stock_status" value="to_be_arranged">
                                            To be arranged
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Additional Notes (Optional)</label>
                                    <textarea class="form-control form-control-sm" name="additional_notes" rows="3" placeholder="Any assumptions or clarifications (non-binding)."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 4: Response Confirmation (Mandatory)</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rfqResponseConfirm" name="confirm_indicative" required>
                                <label class="form-check-label" for="rfqResponseConfirm">
                                    I confirm this is an indicative response only. It is not a confirmed offer, order acceptance, or supply commitment.
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 5: Contact Visibility (Controlled)</h6>
                            <div class="border rounded p-3 mb-3">
                                <div class="small text-muted">Default visible</div>
                                <div class="d-flex flex-wrap gap-3 mt-2">
                                    <span><strong>Company Name:</strong> {{ auth()->user()->business_name ?? 'N/A' }}</span>
                                    <span><strong>City / State:</strong> {{ trim((auth()->user()->city ?? '') . (auth()->user()->state ? ', ' . auth()->user()->state : '')) ?: 'N/A' }}</span>
                                    <span><strong>Role:</strong> {{ ucfirst(auth()->user()->role ?? 'Retailer') }}</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-secondary mt-3" id="viewContactDetailsBtn">View contact details</button>
                            </div>
                            <div class="alert alert-info small d-none" id="contactDetailsDisclaimer">
                                Contact details are shared only to facilitate independent communication. The platform does not participate in or manage any transaction.
                            </div>
                            <div class="border rounded p-3 d-none" id="contactDetailsSection">
                                <div class="d-flex flex-column gap-2">
                                    <span><strong>Business phone number:</strong> {{ auth()->user()->mobile ?? 'N/A' }}</span>
                                    <span><strong>Business email ID:</strong> {{ auth()->user()->email ?? 'N/A' }}</span>
                                    <span><strong>Business address (optional):</strong> {{ auth()->user()->address ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="rfqResponseSubmitBtn" disabled>Submit RFQ Response</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="retailerRfqViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">RFQ Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="rfqDetailsContent"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function markRfqReceivedFromDashboard(id) {
            fetch(`/retailer/receive-rfq/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        location.reload();
                    } else {
                        alert(data.message || 'Unable to mark RFQ as received');
                    }
                })
                .catch(() => {
                    alert('Server error. Please try again.');
                });
        }

        function formatDate(dateStr) {
            if (!dateStr) {
                return 'N/A';
            }
            const date = new Date(dateStr);
            if (Number.isNaN(date.getTime())) {
                return dateStr;
            }
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function maskSchoolName(name) {
            if (!name) {
                return 'N/A';
            }
            const trimmed = String(name).trim();
            if (trimmed.length <= 4) {
                return trimmed[0] + '*'.repeat(Math.max(0, trimmed.length - 1));
            }
            return `${trimmed.slice(0, 3)}${'*'.repeat(Math.max(0, trimmed.length - 5))}${trimmed.slice(-2)}`;
        }

        function resetRfqResponseForm() {
            const form = document.getElementById('rfqResponseForm');
            if (form) {
                form.reset();
            }
            const totalField = document.getElementById('totalIndicativeValue');
            if (totalField) {
                totalField.value = '';
            }
            const totalHiddenField = document.getElementById('totalIndicativeValueHidden');
            if (totalHiddenField) {
                totalHiddenField.value = '';
            }
            document.getElementById('rfqSenderRole').value = '';
            document.getElementById('rfqSenderCompany').value = '';
            document.getElementById('rfqSenderLocation').value = '';
            document.getElementById('contactDetailsDisclaimer').classList.add('d-none');
            document.getElementById('contactDetailsSection').classList.add('d-none');
            document.getElementById('rfqResponseSubmitBtn').disabled = true;
            const existingSection = document.getElementById('existingResponseSection');
            if (existingSection) {
                existingSection.classList.add('d-none');
            }
        }

        function viewRetailerRfqResponse(id) {
            fetch(`/retailer/rfq-details/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        return;
                    }

                    const rfq = data.rfq;
                    const sender = data.sender || {};
                    const response = data.response || null;
                    const books = Array.isArray(rfq.books) ? rfq.books : JSON.parse(rfq.books || '[]');

                    resetRfqResponseForm();

                    document.getElementById('rfqResponseId').value = rfq.id;
                    document.getElementById('rfqSummaryId').value = `RFQ-${rfq.id}`;
                    document.getElementById('rfqSummarySchool').value = maskSchoolName(rfq.school_name);
                    document.getElementById('rfqSummaryDelivery').value = `${formatDate(rfq.delivery_from)} to ${formatDate(rfq.delivery_to)}`;
                    document.getElementById('rfqSummaryClosing').value = formatDate(rfq.rfq_closing_date);
                    document.getElementById('rfqSenderRole').value = sender.role ? sender.role.charAt(0).toUpperCase() + sender.role.slice(1) : 'N/A';
                    document.getElementById('rfqSenderCompany').value = sender.business_name || 'N/A';
                    const senderLocation = [sender.city, sender.state].filter(Boolean).join(', ');
                    document.getElementById('rfqSenderLocation').value = senderLocation || 'N/A';

                    const booksBody = document.getElementById('rfqSummaryBooksBody');
                    booksBody.innerHTML = '';

                    let totalQty = 0;
                    if (books.length) {
                        books.forEach(book => {
                            const qty = Number(book.quantity || 0);
                            totalQty += Number.isFinite(qty) ? qty : 0;
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                    <td>${book.class_name || 'N/A'}</td>
                                    <td>${book.book_title || book.subject || 'N/A'}</td>
                                    <td>${book.publisher || rfq.publisher || 'N/A'}</td>
                                    <td>${book.quantity || 'N/A'}</td>
                                `;
                            booksBody.appendChild(row);
                        });
                    } else {
                        const row = document.createElement('tr');
                        row.innerHTML = '<td colspan="4" class="text-muted text-center">No books listed.</td>';
                        booksBody.appendChild(row);
                    }

                    document.getElementById('rfqSummaryTotalQty').value = totalQty || 'N/A';

                    if (response) {
                        document.getElementById('existingIndicativeUnitPrice').textContent = response.indicative_unit_price ?? 'N/A';
                        document.getElementById('existingTotalIndicativeValue').textContent = response.total_indicative_value ?? 'N/A';
                        document.getElementById('existingAvailableQuantity').textContent = response.available_quantity ?? 'N/A';
                        document.getElementById('existingDeliveryWindow').textContent = `${formatDate(response.delivery_from)} to ${formatDate(response.delivery_to)}`;
                        document.getElementById('existingStockStatus').textContent = response.stock_status ? response.stock_status.replace(/_/g, ' ') : 'N/A';
                        document.getElementById('existingAdditionalNotes').textContent = response.additional_notes || 'N/A';
                        document.getElementById('existingSubmittedAt').textContent = formatDate(response.submitted_at);
                        document.getElementById('existingResponseSection').classList.remove('d-none');
                    }

                    const modal = new bootstrap.Modal(document.getElementById('retailerRfqDetailsModal'));
                    modal.show();
                });
        }

        function viewRetailerRfqDetails(id) {
            fetch(`/retailer/rfq-details/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        return;
                    }

                    const rfq = data.rfq;
                    let books = rfq.books;
                    if (typeof books === 'string') {
                        books = JSON.parse(books);
                    }

                    let content = `
                        <div class="rfq-details-content">
                            <div class="rfq-details-grid">
                                <div class="rfq-details-section">
                                    <h5>School Information</h5>
                                    <p><strong>School:</strong> ${rfq.school_name}</p>
                                    <p><strong>City:</strong> ${rfq.city}</p>
                                    <p><strong>Session:</strong> ${rfq.academic_session}</p>
                                </div>
                                <div class="rfq-details-section">
                                    <h5>Timeline & Priority</h5>
                                    <p><strong>Delivery:</strong> ${formatDate(rfq.delivery_from)} to ${formatDate(rfq.delivery_to)}</p>
                                    <p><strong>Urgency:</strong> ${rfq.urgency}</p>
                                    <p><strong>Closing Date:</strong> ${formatDate(rfq.rfq_closing_date)}</p>
                                </div>
                            </div>
                            <div class="rfq-details-section">
                                <h5>Additional Notes</h5>
                                <p>${rfq.notes || 'N/A'}</p>
                            </div>
                            <div class="rfq-details-section">
                                <h5>Target Audience</h5>
                                <p><strong>Roles:</strong> ${(rfq.target_roles || []).join(', ') || 'N/A'}</p>
                                <p><strong>State:</strong> ${rfq.target_state || 'All States'}</p>
                                <p><strong>City:</strong> ${rfq.target_city || 'All Cities'}</p>
                            </div>
                            <div class="rfq-details-section">
                                <h6>Book Requirements</h6>
                                <ul>
                    `;

                    if (Array.isArray(books) && books.length) {
                        books.forEach(book => {
                            content += `<li><strong>${book.class_name || 'N/A'} - ${book.subject || 'N/A'}</strong><br>${book.book_title || 'N/A'} (${book.quantity || 'N/A'})</li>`;
                        });
                    } else {
                        content += '<li>No books listed.</li>';
                    }

                    content += '</ul></div></div>';

                    document.getElementById('rfqDetailsContent').innerHTML = content;
                    const modal = new bootstrap.Modal(document.getElementById('retailerRfqViewModal'));
                    modal.show();
                });
        }

        function markReceivedInDashboard(id) {
            const row = document.querySelector(`li[data-rfq-id="${id}"]`);
            if (!row) {
                return;
            }
            const statusEl = row.querySelector('.rfq-status');
            if (statusEl) {
                statusEl.classList.remove('text-warning');
                statusEl.classList.add('text-success');
                statusEl.textContent = 'Status: Received';
            }
            const actionWrap = row.querySelector('.rfq-received-action');
            if (actionWrap) {
                actionWrap.innerHTML = '<span class="small text-success">Received Done</span>';
            }
        }

        function receiveAndRespondFromDashboard(id) {
            viewRetailerRfqResponse(id);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const unitPriceInput = document.getElementById('indicativeUnitPrice');
            const qtyInput = document.getElementById('availableQuantity');
            const totalValueInput = document.getElementById('totalIndicativeValue');
            const totalHiddenInput = document.getElementById('totalIndicativeValueHidden');
            const confirmCheckbox = document.getElementById('rfqResponseConfirm');
            const submitBtn = document.getElementById('rfqResponseSubmitBtn');
            const viewContactBtn = document.getElementById('viewContactDetailsBtn');

            const updateTotal = () => {
                const price = parseFloat(unitPriceInput.value);
                const qty = parseFloat(qtyInput.value);
                if (!Number.isNaN(price) && !Number.isNaN(qty)) {
                    const total = (price * qty).toFixed(2);
                    totalValueInput.value = total;
                    totalHiddenInput.value = total;
                } else {
                    totalValueInput.value = '';
                    totalHiddenInput.value = '';
                }
            };

            const updateSubmitState = () => {
                submitBtn.disabled = !confirmCheckbox.checked;
            };

            unitPriceInput.addEventListener('input', updateTotal);
            qtyInput.addEventListener('input', updateTotal);
            confirmCheckbox.addEventListener('change', updateSubmitState);
            updateSubmitState();

            viewContactBtn.addEventListener('click', () => {
                document.getElementById('contactDetailsDisclaimer').classList.remove('d-none');
                document.getElementById('contactDetailsSection').classList.remove('d-none');
            });

            submitBtn.addEventListener('click', () => {
                const form = document.getElementById('rfqResponseForm');
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                const formData = new FormData(form);
                const rfqId = document.getElementById('rfqResponseId').value;
                const originalText = submitBtn.textContent;
                submitBtn.textContent = 'Submitting...';
                submitBtn.disabled = true;

                fetch('/retailer/rfq-response', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            const modalEl = document.getElementById('retailerRfqDetailsModal');
                            const modal = bootstrap.Modal.getInstance(modalEl);
                            if (modal) {
                                modal.hide();
                            }
                            if (rfqId) {
                                markReceivedInDashboard(rfqId);
                            }
                        } else {
                            alert(data.message || 'Unable to submit RFQ response');
                        }
                    })
                    .catch(() => {
                        alert('Server error. Please try again.');
                    })
                    .finally(() => {
                        submitBtn.textContent = originalText;
                        updateSubmitState();
                    });
            });
        });
    </script>


</main>
@endsection



