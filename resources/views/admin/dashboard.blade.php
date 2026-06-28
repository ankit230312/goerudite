@extends('layouts.dashboard')

@section('content')
<style>
    .modal-box.rfq-box {
    width: 95%;
    max-width: 1100px;
    background: #fff;
    border-radius: 14px;
    padding: 22px 26px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    max-height: 90vh;
    overflow-y: auto;
}
.rfq-header-modal {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #000;
    padding: 14px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
}
.rfq-details-content {
    display: grid;
    gap: 20px;
}
.rfq-details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 15px;
}
.rfq-details-section {
    background: #f9f9f9;
    border-radius: 10px;
    padding: 15px;
    border-left: 4px solid #ff7a18;
}
.rfq-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
    flex-wrap: wrap;
    gap: 10px;
}
.btn-outline {
            border: 1px solid #ff7a18;
            background: #fff;
            color: #ff7a18;
            padding: 8px 14px;
            border-radius: 8px;
        }

</style>
    <main class="container-fluid py-4">

        <!-- Page Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-8">
                <h1 class="h3 fw-bold mb-1">Admin Hub</h1>
                <p class="text-muted mb-0">Active Session</p>
            </div>
            <div class="col-4 text-end">
                <a href="{{ route('admin.rfq_inbox') }}?create=1" class=" common-btn ">RAISE CLASS-WISE RFQ</a>
            </div>
        </div>

        <!-- Stats Grid -->
        @php
            $stats = $stats ?? [
                ['label' => 'Followers', 'icon' => 'fa-user', 'value' => 0],
                ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => 0],
                ['label' => 'Remaining Students', 'icon' => 'fa-graduation-cap', 'value' => 0],
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
                            @if (!empty($s['sub']))
                                <small class="text-muted text-orange">{{ $s['sub'] }}</small>
                            @endif
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

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">RFQ-{{ $rfq->id }} | {{ $rfq->school_name }}</div>
                                    <small class="text-muted">{{ $rfq->created_at->format('d-m-Y') }}</small>
                                </div>

                                <div class="text-end">

                                    @if ($rfq->action === 'responded')
                                        <span class="text-primary">
                                            Responded by: {{ $rfq->name }} ({{ ucfirst($rfq->role) }})
                                        </span>
                                    @else
                                        <span class="{{ $isReceived ? 'text-success' : 'text-warning' }}">
                                            {{ $isReceived ? 'Status: Received' : 'Status: Pending' }}
                                        </span>
                                    @endif

                                    <br>
                                    <a href="#" class="small"
                                        onclick="viewDetails({{ $rfq->id }}); return false;">
                                        View RFQ
                                    </a><br>

                                    {{-- @if ($rfq->action !== 'responded')
                                        @if (!$isReceived)
                                            <a href="javascript:void(0);" class="small text-primary"
                                                onclick="markRfqReceivedFromDashboard({{ $rfq->id }})">
                                                Received RFQ
                                            </a>
                                        @else
                                            <span class="small text-success">Received Done</span>
                                        @endif
                                    @endif --}}
                                </div>
                            </li>

                        @empty
                            <li class="list-group-item">No records found.</li>
                        @endforelse
                    </ul>
                </div>
            </div>


            <div id="viewDetailsModal" class="modal">
                <div class="modal-box rfq-box">
                    <div class="rfq-header-modal">
                        <h3>RFQ Details</h3>
                        <!-- <button clasy'/s="btn-save" onclick="editRfq()">Edit</button> -->
                    </div>

                    <div id="detailsContent">
                        <!-- Details will be loaded here -->
                    </div>

                    <div class="rfq-footer">
                        {{-- <button class="btn-dark" onclick="openCloseRfqModal()">Close RFQ</button> --}}
                        <div class="footer-actions">
                            <button class="btn-outline" onclick="closeModal();">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-6 lg:col-5">
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
            </div> --}}
        </div>


        <script>
            function formatDate(dateStr) {
                const date = new Date(dateStr);
                const day = String(date.getDate()).padStart(2, '0');
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            function viewDetails(id) {
                fetch(`/admin/rfq-details/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            return;
                        }

                        const rfq = data.rfq;
                        let books = rfq.books;

                        // convert string → array
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
                                content +=
                                    `<li><strong>${book.class_name} - ${book.subject}</strong><br>${book.book_title} (${book.quantity})</li>`;
                            });
                        } else {
                            content += '<li>No books listed.</li>';
                        }

                        content += '</ul></div></div>';
                        document.getElementById('detailsContent').innerHTML = content;

                        const modal = document.getElementById('viewDetailsModal');
                        modal.dataset.rfqId = id;
                        modal.style.display = 'flex';

                        fetch(`/admin/rfq-responses/${id}`)
                            .then(res => res.json())
                            .then(resData => {
                                if (!resData.success) {
                                    return;
                                }

                                const responses = resData.responses || [];
                                let responseHtml = `
                                <div class="rfq-details-section">
                                    <h5>Responses</h5>
                            `;

                                if (!responses.length) {
                                    responseHtml += '<p class="text-muted">No responses received yet.</p>';
                                } else {
                                    responseHtml += `
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Responder</th>
                                                    <th>Role</th>
                                                    <th>City / State</th>
                                                    <th>Unit Price</th>
                                                    <th>Total Value</th>
                                                    <th>Qty</th>
                                                    <th>Delivery</th>
                                                    <th>Stock</th>
                                                    <th>Notes</th>
                                                    <th>Submitted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                `;

                                    responses.forEach(item => {
                                        const location = [item.city, item.state].filter(Boolean).join(', ') ||
                                            'N/A';
                                        responseHtml += `
                                        <tr>
                                            <td>${item.business_name || 'N/A'}</td>
                                            <td>${item.responder_role || 'N/A'}</td>
                                            <td>${location}</td>
                                            <td>${item.indicative_unit_price ?? 'N/A'}</td>
                                            <td>${item.total_indicative_value ?? 'N/A'}</td>
                                            <td>${item.available_quantity ?? 'N/A'}</td>
                                            <td>${formatDate(item.delivery_from)} to ${formatDate(item.delivery_to)}</td>
                                            <td>${item.stock_status ? item.stock_status.replace(/_/g, ' ') : 'N/A'}</td>
                                            <td>${item.additional_notes || 'N/A'}</td>
                                            <td>${formatDate(item.submitted_at)}</td>
                                        </tr>
                                    `;
                                    });

                                    responseHtml += '</tbody></table></div>';
                                }

                                responseHtml += '</div>';
                                document.getElementById('detailsContent').insertAdjacentHTML('beforeend', responseHtml);
                            });
                    });
            }

            function closeModal() {
            document.querySelectorAll('.modal').forEach(m => m.style.display = 'none');
        }
        </script>
    </main>
@endsection
