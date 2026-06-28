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
        <div class="row mb-4 align-items-center">
            <div class="col-8">
                <h1 class="h3 fw-bold mb-1">Publisher Hub</h1>
                <p class="text-muted mb-0">Operational RFQ Activity</p>
            </div>
            <div class="col-4 text-end">
                {{-- <button class="common-btn" type="button" data-bs-toggle="modal" data-bs-target="#publisherRfqModal">
                    SEND RFQ
                </button> --}}
            </div>
        </div>

         @php
    $stats = $stats ?? [
    ['label' => 'Followers', 'icon' => 'fa-user', 'value' => 0],
    ['label' => 'Add to Cart', 'icon' => 'fa-cart-plus', 'value' => 0],
    ['label' => 'Active Request', 'icon' => 'fa-graduation-cap', 'value' => 0],
    ['label' => 'Manage Records', 'icon' => 'fa-clipboard-list', 'value' => 0],
    ['label' => 'Notification RFQ', 'icon' => 'fa-bell', 'value' => 0],
    ['label' => 'live Lead', 'icon' => 'fa-eye', 'value' => 0],
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

        <div class="row">
            <div class="col-12">
                <div class="card bg-white rounded shadow-sm">
                    <div class="card-header fw-bold d-flex align-items-center">
                        <span class="me-2">📋</span> Operational Log
                    </div>

                    <ul class="list-group list-group-flush">
                        @forelse($operationLogs as $log)
                            @php
                                $rfq = $log['rfq'];
                                $isReceived = $log['type'] === 'received';
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">RFQ-{{ $rfq->id }} | {{ $rfq->school_name }}</div>
                                    <small class="text-muted">{{ $rfq->created_at->format('d-m-Y') }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="{{ $isReceived ? 'text-success' : 'text-danger' }}">
                                        {{ $isReceived ? 'Received RFQ' : 'Sent RFQ' }}
                                    </span><br>
                                    <a href="#" class="small" onclick="viewDetails({{ $rfq->id }}); return false;">View Details</a>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item">No RFQ activity found.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <div class="modal fade" id="publisherRfqModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send RFQ (Nearby)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="publisherRfqForm">
                        @csrf
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">School / Business Name</label>
                                <input type="text" class="form-control" name="school_name" value="{{ auth()->user()->business_name ?? '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" name="city" value="{{ auth()->user()->city ?? '' }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Academic Session</label>
                                <select class="form-select" name="academic_session" required>
                                    <option value="">Select Session</option>
                                    @foreach($academicSessions as $session)
                                        <option value="{{ $session->name }}">{{ $session->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Send To Roles</label>
                                <div class="border rounded p-2">
                                    <label class="d-block"><input type="checkbox" name="target_roles[]" value="distributor"> Distributor</label>
                                    <label class="d-block"><input type="checkbox" name="target_roles[]" value="retailer"> Retailer</label>
                                    <label class="d-block"><input type="checkbox" name="target_roles[]" value="publisher"> Publisher</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">State</label>
                                <select class="form-select" name="target_state">
                                    <option value="">All States (Nearby)</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state }}">{{ $state }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">City</label>
                                <select class="form-select" name="target_city">
                                    <option value="">All Cities (Nearby)</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city }}">{{ $city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row g-2 mb-3" id="publisherBookRows">
                            <div class="col-md-2"><input class="form-control" name="class_name[]" placeholder="Class" required></div>
                            <div class="col-md-2"><input class="form-control" name="subject[]" placeholder="Subject" required></div>
                            <div class="col-md-3"><input class="form-control" name="book_title[]" placeholder="Book Title" required></div>
                            <div class="col-md-2"><input class="form-control" name="publisher[]" placeholder="Publisher"></div>
                            <div class="col-md-1"><input class="form-control" name="edition[]" placeholder="Year"></div>
                            <div class="col-md-1"><input class="form-control" type="number" name="quantity[]" placeholder="Qty" min="1" required></div>
                            <div class="col-md-1"><button type="button" class="btn btn-outline-secondary w-100" onclick="addPublisherBookRow()">+</button></div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Delivery From</label>
                                <input type="date" class="form-control" name="delivery_from" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Delivery To</label>
                                <input type="date" class="form-control" name="delivery_to" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Urgency</label>
                                <select class="form-select" name="urgency" required>
                                    <option value="Normal">Normal</option>
                                    <option value="Time-sensitive">Time-sensitive</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comparison Criteria</label>
                            <div class="border rounded p-2">
                                <label class="d-block"><input type="checkbox" name="evaluation[]" value="price"> Price</label>
                                <label class="d-block"><input type="checkbox" name="evaluation[]" value="delivery"> Delivery Timeline</label>
                                <label class="d-block"><input type="checkbox" name="evaluation[]" value="publisher"> Publisher Availability</label>
                                <label class="d-block"><input type="checkbox" name="evaluation[]" value="relationship"> Existing Relationship</label>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">RFQ Closing Date</label>
                                <input type="date" class="form-control" name="rfq_closing_date" required>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label><input type="checkbox" name="confirm_rfq" required> I confirm this RFQ is valid.</label>
                        </div>

                        <button type="button" id="publisherSendRfqBtn" class="btn btn-primary" onclick="submitPublisherRfq()">Send RFQ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="publisherRfqDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">RFQ Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="publisherRfqDetailsBody"></div>
            </div>
        </div>
    </div> --}}
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
                {{-- <button class="btn-dark" id="closeRfqBtn" onclick="openCloseRfqModal()">Close RFQ</button> --}}
                <div class="footer-actions">
                    <button class="btn-outline" onclick="closeModal();">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const distributorCurrentUserId = {{ auth()->id() }};

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
        function addPublisherBookRow() {
            const row = document.createElement('div');
            row.className = 'row g-2 mb-2';
            row.innerHTML = `
                <div class="col-md-2"><input class="form-control" name="class_name[]" placeholder="Class" required></div>
                <div class="col-md-2"><input class="form-control" name="subject[]" placeholder="Subject" required></div>
                <div class="col-md-3"><input class="form-control" name="book_title[]" placeholder="Book Title" required></div>
                <div class="col-md-2"><input class="form-control" name="publisher[]" placeholder="Publisher"></div>
                <div class="col-md-1"><input class="form-control" name="edition[]" placeholder="Year"></div>
                <div class="col-md-1"><input class="form-control" type="number" name="quantity[]" placeholder="Qty" min="1" required></div>
                <div class="col-md-1"><button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.row').remove()">-</button></div>
            `;
            document.getElementById('publisherBookRows').appendChild(row);
        }

        function submitPublisherRfq() {
            const form = document.getElementById('publisherRfqForm');
            const formData = new FormData(form);
            const books = [];
            const classNames = formData.getAll('class_name[]');
            const subjects = formData.getAll('subject[]');
            const bookTitles = formData.getAll('book_title[]');
            const publishers = formData.getAll('publisher[]');
            const editions = formData.getAll('edition[]');
            const quantities = formData.getAll('quantity[]');

            for (let i = 0; i < classNames.length; i++) {
                books.push({
                    class_name: classNames[i],
                    subject: subjects[i],
                    book_title: bookTitles[i],
                    publisher: publishers[i],
                    edition: editions[i],
                    quantity: quantities[i]
                });
            }

            formData.append('books', JSON.stringify(books));

            const sendBtn = document.getElementById('publisherSendRfqBtn');
            const originalText = sendBtn.textContent;
            sendBtn.textContent = 'Sending...';
            sendBtn.disabled = true;

            fetch('/publisher/store-rfq', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('#publisherRfqForm input[name=_token]').value
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.status) {
                    location.reload();
                } else {
                    alert(data.message || 'Unable to send RFQ');
                }
            })
            .catch(() => alert('Server error while sending RFQ'))
            .finally(() => {
                sendBtn.textContent = originalText;
                sendBtn.disabled = false;
            });
        }

        function viewPublisherRfqDetails(id) {
            fetch(`/publisher/rfq-details/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        return;
                    }

                    const rfq = data.rfq;
                    const books = Array.isArray(rfq.books) ? rfq.books : JSON.parse(rfq.books || '[]');
                    const roles = Array.isArray(rfq.target_roles) ? rfq.target_roles.join(', ') : '';

                    let html = `
                        <p><strong>School:</strong> ${rfq.school_name}</p>
                        <p><strong>City:</strong> ${rfq.city}</p>
                        <p><strong>Session:</strong> ${rfq.academic_session}</p>
                        <p><strong>Target Roles:</strong> ${roles || 'N/A'}</p>
                        <p><strong>Target State:</strong> ${rfq.target_state || 'All States'}</p>
                        <p><strong>Target City:</strong> ${rfq.target_city || 'All Cities'}</p>
                        <p><strong>Notes:</strong> ${rfq.notes || 'N/A'}</p>
                        <hr>
                        <h6>Books</h6>
                        <ul>
                    `;

                    books.forEach(book => {
                        html += `<li>${book.class_name} - ${book.subject} - ${book.book_title} (${book.quantity})</li>`;
                    });

                    html += '</ul>';
                    document.getElementById('publisherRfqDetailsBody').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById('publisherRfqDetailsModal'));
                    modal.show();
                });
        }



         function viewDetails(id) {
            fetch(`/publisher/rfq-details/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const rfq = data.rfq;
                        const response = data.response || null;
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

                        books.forEach(book => {
                            content += `<li><strong>${book.class_name} - ${book.subject}</strong><br>${book.book_title} (${book.quantity})</li>`;
                        });
                        content += '</ul></div>';

                        if (response) {
                            content += `
                                <div class="rfq-details-section">
                                    <h5>Your Response</h5>
                                    <p><strong>Indicative Unit Price:</strong> ${response.indicative_unit_price ?? 'N/A'}</p>
                                    <p><strong>Total Indicative Value:</strong> ${response.total_indicative_value ?? 'N/A'}</p>
                                    <p><strong>Available Quantity:</strong> ${response.available_quantity ?? 'N/A'}</p>
                                    <p><strong>Delivery:</strong> ${formatDate(response.delivery_from)} to ${formatDate(response.delivery_to)}</p>
                                    <p><strong>Stock Status:</strong> ${response.stock_status ? response.stock_status.replace(/_/g, ' ') : 'N/A'}</p>
                                    <p><strong>Notes:</strong> ${response.additional_notes || 'N/A'}</p>
                                    <p><strong>Submitted At:</strong> ${formatDate(response.submitted_at)}</p>
                                </div>
                            `;
                        }

                        content += '</div>';
                        document.getElementById('detailsContent').innerHTML = content;
                        const modal = document.getElementById('viewDetailsModal');
                        modal.dataset.rfqId = id;
                        const canClose = Number(rfq.user_id) === distributorCurrentUserId;
                        // document.getElementById('closeRfqBtn').style.display = canClose ? 'inline-block' : 'none';
                        modal.style.display = 'flex';
                    }
                });
        }


        function closeModal() {
            document.querySelectorAll('.modal').forEach(m => m.style.display = 'none');
        }
    </script>
@endsection

