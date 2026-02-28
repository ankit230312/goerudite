@extends('layouts.dashboard')

@section('content')
    <main class="container-fluid py-4">
        <div class="row mb-4 align-items-center">
            <div class="col-8">
                <h1 class="h3 fw-bold mb-1">Retailer Hub</h1>
                <p class="text-muted mb-0">Operational RFQ Activity</p>
            </div>
            <div class="col-4 text-end">
                <button class="common-btn" type="button" data-bs-toggle="modal" data-bs-target="#retailerRfqModal">
                    SEND RFQ
                </button>
            </div>
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
                                    <a href="#" class="small" onclick="viewRetailerRfqDetails({{ $rfq->id }}); return false;">View Details</a>
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

    <div class="modal fade" id="retailerRfqModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send RFQ (Nearby)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="retailerRfqForm">
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
                                    <option value="2024-25">2024-25</option>
                                    <option value="2025-26">2025-26</option>
                                    <option value="2026-27">2026-27</option>
                                    <option value="2027-28">2027-28</option>
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

                        <div class="row g-2 mb-3" id="retailerBookRows">
                            <div class="col-md-2"><input class="form-control" name="class_name[]" placeholder="Class" required></div>
                            <div class="col-md-2"><input class="form-control" name="subject[]" placeholder="Subject" required></div>
                            <div class="col-md-3"><input class="form-control" name="book_title[]" placeholder="Book Title" required></div>
                            <div class="col-md-2"><input class="form-control" name="publisher[]" placeholder="Publisher"></div>
                            <div class="col-md-1"><input class="form-control" name="edition[]" placeholder="Year"></div>
                            <div class="col-md-1"><input class="form-control" type="number" name="quantity[]" placeholder="Qty" min="1" required></div>
                            <div class="col-md-1"><button type="button" class="btn btn-outline-secondary w-100" onclick="addRetailerBookRow()">+</button></div>
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

                        <button type="button" id="retailerSendRfqBtn" class="btn btn-primary" onclick="submitRetailerRfq()">Send RFQ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="retailerRfqDetailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">RFQ Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="retailerRfqDetailsBody"></div>
            </div>
        </div>
    </div>

    <script>
        function addRetailerBookRow() {
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
            document.getElementById('retailerBookRows').appendChild(row);
        }

        function submitRetailerRfq() {
            const form = document.getElementById('retailerRfqForm');
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

            const sendBtn = document.getElementById('retailerSendRfqBtn');
            const originalText = sendBtn.textContent;
            sendBtn.textContent = 'Sending...';
            sendBtn.disabled = true;

            fetch('/retailer/store-rfq', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('#retailerRfqForm input[name=_token]').value
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

        function viewRetailerRfqDetails(id) {
            fetch(`/retailer/rfq-details/${id}`)
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
                    document.getElementById('retailerRfqDetailsBody').innerHTML = html;
                    const modal = new bootstrap.Modal(document.getElementById('retailerRfqDetailsModal'));
                    modal.show();
                });
        }
    </script>
@endsection
