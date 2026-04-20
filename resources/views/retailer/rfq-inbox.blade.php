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

        .rfq-header-modal h3 {
            color: #fff;
            font-size: 18px;
        }

        .btn-save {
            background: #ff7a18;
            border: none;
            color: #fff;
            padding: 6px 16px;
            border-radius: 20px;
            cursor: pointer;
        }

        .form-title {
            font-size: 15px;
            font-weight: 600;
            margin: 20px 0 10px;
            color: #ff6b1a;
            /* #ff6b1a */
        }


        .rfq-basic-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        @media(max-width: 900px) {
            .rfq-basic-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media(max-width: 600px) {
            .rfq-basic-grid {
                grid-template-columns: 1fr;
            }
        }


        .rfq-box label {
            font-size: 13px;
            color: #555;
            margin-bottom: 4px;
            display: block;
        }

        .rfq-box input[type="text"],
        .rfq-box input[type="number"],
        .rfq-box input[type="date"],
        .rfq-box select,
        .rfq-box textarea {
            width: 100%;
            padding: 9px 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 13px;
        }

        .rfq-box input[type="checkbox"] {
            width: auto;
            margin-right: 8px;
        }

        .rfq-box textarea {
            resize: none;
        }


        .book-row {
            display: grid;
            grid-template-columns: 1fr 1.2fr 1fr 1fr 1fr 80px 20px;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }

        .book-row select,
        .book-row input {
            font-size: 13px;
        }

        .delete-book {
            background: none;
            border: none;
            color: #ff4d4f;
            font-size: 18px;
            cursor: pointer;
        }


        .add-title-btn {
            background: #fff;
            border: 1px dashed #ff7a18;
            color: #ff7a18;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            cursor: pointer;
            margin-top: 10px;
        }


        .rfq-checkbox-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }

        .rfq-checkbox-grid label {
            font-size: 13px;
        }


        .confirmation-box {
            background: #fff8f2;
            border: 1px solid #ffd8b5;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-top: 15px;
        }


        .rfq-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-actions {
            display: flex;
            gap: 10px;
        }

        .btn-dark {
            background: #222;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 8px;
        }

        .btn-outline {
            border: 1px solid #ff7a18;
            background: #fff;
            color: #ff7a18;
            padding: 8px 14px;
            border-radius: 8px;
        }

        .btn-solid {
            background: #ff7a18;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 8px;
        }

        /* View Details Modal Enhancements */
        .rfq-details-content {
            display: grid;
            gap: 20px;
        }

        .rfq-details-section {
            background: #f9f9f9;
            border-radius: 10px;
            padding: 15px;
            border-left: 4px solid #ff7a18;
        }

        .rfq-details-section h5 {
            margin: 0 0 10px 0;
            color: #333;
            font-size: 16px;
            font-weight: 600;
        }

        .rfq-details-section p {
            margin: 5px 0;
            color: #555;
            font-size: 14px;
        }

        .rfq-details-section h6 {
            margin: 15px 0 10px 0;
            color: #ff6b1a;
            font-size: 15px;
            font-weight: 600;
        }

        .rfq-details-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .rfq-details-section li {
            background: #fff;
            margin-bottom: 8px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
            font-size: 13px;
            color: #444;
        }

        .rfq-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        /* new */
        .rfq-checkbox-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 10px 20px;
            margin-top: 8px;
        }

        .rfq-checkbox-grid label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            cursor: pointer;
            color: #333;
        }

        .rfq-checkbox-grid input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .rfq-checkbox-grid {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .rfq-checkbox-grid input[type="checkbox"] {
            accent-color: #ff7a18;
        }
    </style>

    <main class="content">

        <!-- Header -->
        <div class="rfq-header">
            <div>
                <h2>Request for Quotation (RFQ) History</h2>

                <div class="tabs">
                    <button class="tab active" onclick="switchTab('active', this)">Active Request</button>
                    <button class="tab" onclick="switchTab('history', this)">History</button>
                    <button class="tab" onclick="switchTab('received', this)">Received RFQ</button>
                </div>
            </div>

            <button class="btn-create" onclick="openCreateRfq();">+ Create RFQ</button>
        </div>

        <!-- ACTIVE RFQs -->
        <div id="activeTab" class="rfq-list">
            @forelse($activeRfqs as $rfq)
                <div class="rfq-card" data-rfq-id="{{ $rfq->id }}">
                    <div class="rfq-left">
                        <span class="rfq-id">RFQ-{{ $rfq->id }}</span>
                        <span class="status open">{{ ucfirst($rfq->status) }}</span>

                        <h4>{{ $rfq->school_name }} - {{ $rfq->academic_session }}</h4>

                        <div class="rfq-meta">
                            <span>📅 {{ $rfq->created_at->format('Y-m-d') }}</span>
                            <span>📦 Books: {{ count($rfq->books) }}</span>
                        </div>
                    </div>

                    <div class="rfq-right">
                        <div class="quote-count">
                            <strong>0</strong>
                            <span>Quotes Received</span>
                        </div>
                        <a href="#" class="view-link"
                            onclick="openRaiseRfqModal({{ $rfq->id }}); return false;">Raise RFQ ➜</a>
                        <a href="#" class="view-link" onclick="viewDetails({{ $rfq->id }}); return false;">View
                            Details ➜</a>
                    </div>
                </div>
            @empty
                <p>No active RFQs found.</p>
            @endforelse
        </div>

        <!-- HISTORY RFQs -->
        <div id="historyTab" class="rfq-list" style="display:none;">
            @forelse($historyRfqs as $rfq)
                <div class="rfq-card" data-rfq-id="{{ $rfq->id }}">
                    <div class="rfq-left">
                        <span class="rfq-id">RFQ-{{ $rfq->id }}</span>
                        <span class="status closed">{{ ucfirst($rfq->status) }}</span>

                        <h4>{{ $rfq->school_name }} - {{ $rfq->academic_session }}</h4>

                        <div class="rfq-meta">
                            <span>📅 {{ $rfq->created_at->format('Y-m-d') }}</span>
                            <span>📦 Books: {{ count(json_decode($rfq->books, true) ?? []) }}</span>
                        </div>
                    </div>

                    <div class="rfq-right">
                        <div class="quote-count">
                            <strong>0</strong>
                            <span>Quotes Received</span>
                        </div>
                        <a href="#" class="view-link"
                            onclick="openRaiseRfqModal({{ $rfq->id }}); return false;">Raise RFQ ➜</a>
                        <a href="#" class="view-link" onclick="viewDetails({{ $rfq->id }}); return false;">View
                            Details ➜</a>
                    </div>
                </div>
            @empty
                <p>No history RFQs found.</p>
            @endforelse
        </div>

        <div id="receivedTab" class="rfq-list" style="display:none;">
            @forelse($receivedRfqs as $rfq)
                @php($isReceived = in_array($rfq->id, $acknowledgedRfqIds ?? []))
                <div class="rfq-card" data-rfq-id="{{ $rfq->id }}">
                    <div class="rfq-left">
                        <span class="rfq-id">RFQ-{{ $rfq->id }}</span>
                        <span
                            class="status {{ $isReceived ? 'closed' : 'open' }}">{{ $isReceived ? 'Received' : 'Pending' }}</span>

                        <h4>{{ $rfq->school_name }} - {{ $rfq->academic_session }}</h4>

                        <div class="rfq-meta">
                            <span>📅 {{ $rfq->created_at->format('Y-m-d') }}</span>
                            <span>📍 {{ $rfq->city }}</span>
                        </div>
                    </div>

                    <div class="rfq-right">
                        <div class="quote-count">
                            <strong>0</strong>
                            <span>Quotes Received</span>
                        </div>
                        @if (!$isReceived)
                            <button type="button" class="btn-solid"
                                onclick="receiveAndRespond({{ $rfq->id }})">Received RFQ</button>
                        @else
                            <button type="button" class="btn-dark" disabled>Received Done</button>
                        @endif
                        <br>
                        <a href="#" class="view-link" onclick="viewDetails({{ $rfq->id }}); return false;">View
                            Details ➜</a>
                    </div>
                </div>
            @empty
                <p>No received RFQs found for your role and location.</p>
            @endforelse
        </div>

    </main>

    <!-- view details modal -->
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
                <button class="btn-dark" id="closeRfqBtn" onclick="openCloseRfqModal()">Close RFQ</button>
                <div class="footer-actions">
                    <button class="btn-outline" onclick="closeModal();">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- close rfq confirmation modal -->
    <div id="closeRfqModal" class="modal">
        <div class="modal-box" style="max-width: 400px;">
            <div class="rfq-header-modal">
                <h3>Confirm Close RFQ</h3>
            </div>

            <div style="padding: 20px; text-align: center;">
                <p style="margin-bottom: 20px; color: #555;">Are you sure you want to close this RFQ?</p>
                <p style="font-size: 12px; color: #777;">This action cannot be undone.</p>
            </div>

            <div class="rfq-footer">
                <div class="footer-actions">
                    <button class="btn-outline" onclick="closeModal();">Cancel</button>
                    <button class="btn-dark" onclick="confirmCloseRfq()">Close RFQ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- raise rfq modal -->
    <div id="raiseRfqModal" class="modal">
        <div class="modal-box" style="max-width: 560px;">
            <div class="rfq-header-modal">
                <h3>Raise RFQ</h3>
            </div>

            <form id="raiseRfqForm">
                @csrf
                <input type="hidden" id="raiseRfqId" name="rfq_id">

                <div style="padding: 0 4px 10px;">
                    <label>Send To Roles</label>
                    <div class="rfq-checkbox-grid">
                        <label><input type="checkbox" name="target_roles[]" value="distributor"> Distributor</label>
                        <label><input type="checkbox" name="target_roles[]" value="retailer"> Retailer</label>
                        <label><input type="checkbox" name="target_roles[]" value="publisher"> Publisher</label>
                    </div>
                </div>

                <div class="rfq-basic-grid" style="grid-template-columns: repeat(2, 1fr);">
                    <div>
                        <label>State</label>
                        <select name="target_state" data-state-select data-location-group="distributor-raise-rfq">
                            <option value="">All States (Nearby)</option>
                        </select>
                    </div>
                    <div>
                        <label>City</label>
                        <select name="target_city" data-city-select data-location-group="distributor-raise-rfq">
                            <option value="">All Cities (Nearby)</option>
                        </select>
                    </div>
                </div>

                <div class="rfq-footer">
                    <div class="footer-actions" style="margin-left: auto;">
                        <button type="button" class="btn-outline" onclick="closeModal();">Cancel</button>
                        <button type="button" class="btn-solid" id="raiseRfqSendBtn"
                            onclick="submitRaiseRfq()">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- create rfq modal -->
    <div id="createRfqModal" class="modal">
        <div class="modal-box rfq-box">

            <!-- HEADER -->
            <div class="rfq-header-modal">
                <h3>Group-1</h3>
                {{-- <button class="btn-save">Save</button> --}}
            </div>

            <form id="rfqForm">
                @csrf
                <!-- BASIC INFO -->
                <h5 class="form-title">Distributor Identification</h5>
                <div class="rfq-basic-grid">
                    <div>
                        <label>Distributor Name</label>
                        <input type="text" name="school_name" value="{{ auth()->user()->business_name ?? '' }}"
                            readonly>
                    </div>

                    <div>
                        <label>State</label>
                        <select name="state" data-state-select data-location-group="profile" data-selected-state="">
                            <option value="">Select State</option>
                        </select>
                    </div>

                    <div>
                        <label>City</label>
                        <select name="city" data-city-select data-location-group="profile" data-selected-city="">
                            <option value="">Select City</option>
                        </select>
                    </div>

                    <div>
                        <label>Academic Session</label>
                        <select name="academic_session" required>
                            <option value="">Select Academic Session</option>
                            @foreach ($academicSessions as $session)
                                <option value="{{ $session->name }}">{{ $session->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- <h5 class="form-title">Raise RFQ</h5>
                <div class="rfq-basic-grid">
                    <div>
                        <label>Send To Role</label>
                        <div class="rfq-checkbox-grid">
                            <label><input type="checkbox" name="target_roles[]" value="distributor"> Distributor</label>
                            <label><input type="checkbox" name="target_roles[]" value="retailer"> Retailer</label>
                            <label><input type="checkbox" name="target_roles[]" value="publisher"> Publisher</label>
                        </div>
                    </div>

                    <div>
                        <label>State</label>
                        <select name="target_state" data-state-select data-location-group="distributor-raise-rfq">
                            <option value="">All States (Nearby)</option>
                        </select>
                    </div>

                    <div>
                        <label>City</label>
                        <select name="target_city" data-city-select data-location-group="distributor-raise-rfq">
                            <option value="">All Cities (Nearby)</option>
                        </select>
                    </div>
                </div> --}}

                <!-- BOOKS SECTION -->
                <h5 class="form-title">Book Requirement</h5>
                <div id="booksWrapper">
                    <div class="book-row">
                        <input type="text" name="class_name[]" placeholder="Class Name" required>
                        <input type="text" name="subject[]" placeholder="Subject" required>
                        <input type="text" name="book_title[]" placeholder="Book Title" required>
                        <select name="publisher[]" class="publisher-select" required>
                            <option value="">Select Publisher</option>

                            @foreach ($boards as $board)
                                <option value="{{ $board->id }}">{{ $board->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="edition[]" placeholder="Edition / Year">
                        <input type="number" name="quantity[]" placeholder="Qty" required min="1">
                        <button type="button" class="delete-book">🗑</button>
                    </div>
                </div>

                <button type="button" class="add-title-btn" onclick="addBookRow()">+ Add Title</button>
                <h5 class="form-title">Timeline & Priority</h5>

                <div class="rfq-basic-grid">
                    <div>
                        <label>Delivery From</label>
                        <input type="date" name="delivery_from" required>
                    </div>

                    <div>
                        <label>Delivery To</label>
                        <input type="date" name="delivery_to" required>
                    </div>

                    <div>
                        <label>Urgency Level</label>
                        <select name="urgency" required>
                            <option>Normal</option>
                            <option>Time-sensitive</option>
                            <option>Flexible</option>
                        </select>
                    </div>
                </div>

                <h5 class="form-title">Comparison & Closure</h5>

                <div class="rfq-checkbox-grid">
                    <label><input type="checkbox" name="evaluation[]" value="price"> Price</label>
                    <label><input type="checkbox" name="evaluation[]" value="delivery"> Delivery Timeline</label>
                    <label><input type="checkbox" name="evaluation[]" value="publisher"> Publisher Availability</label>
                    <label><input type="checkbox" name="evaluation[]" value="relationship"> Existing Relationship</label>
                </div>

                <div style="margin-top:10px;">
                    <label>RFQ Closing Date</label>
                    <input type="date" name="rfq_closing_date" required>
                </div>

                <h5 class="form-title">Additional Notes</h5>
                <textarea name="notes" rows="3" placeholder="Optional notes for suppliers"></textarea>

                <div class="confirmation-box">
                    <label>
                        <input type="checkbox" name="confirm_rfq" required>
                        I confirm that this RFQ is created by the school for quotation purposes only.
                    </label>
                </div>

                <!-- FOOTER -->
                <div class="rfq-footer">
                    {{-- <button type="button" class="btn-dark">+ Add Another Class Set</button> --}}

                    <div class="footer-actions">
                        <button type="button" class="btn-outline" onclick="closeModal();">Cancel</button>
                        <button type="button" id="publishRfqBtn" class="btn-solid" onclick="submitRfqForm()">Publish
                            Class Wise RFQ</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="modal fade" id="distributorRfqDetailsModal" tabindex="-1" aria-hidden="true">
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
                            <div>Final price, terms, payment, and delivery are decided directly between the parties outside
                                the platform.</div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 1: RFQ Summary (Read-Only)</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">RFQ ID</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryId"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">School Name / Masked School Identity</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummarySchool"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Quantity Requested</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryTotalQty"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sender Role</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSenderRole"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sender Company</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSenderCompany"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sender City / State</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSenderLocation"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Required Delivery Window</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryDelivery"
                                        readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RFQ Closing Date</label>
                                    <input type="text" class="form-control form-control-sm" id="rfqSummaryClosing"
                                        readonly>
                                </div>
                            </div>
                            <div class="mt-3">
                                <div class="small text-muted mb-2">Class / Grade, Book Title, Publisher, Quantity Requested
                                </div>
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
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ ucfirst(auth()->user()->role ?? 'Distributor') }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ auth()->user()->business_name ?? 'N/A' }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City / State / Coverage Area</label>
                                    <input type="text" class="form-control form-control-sm"
                                        value="{{ trim((auth()->user()->city ?? '') . (auth()->user()->state ? ', ' . auth()->user()->state : '') . (auth()->user()->coverage_area ? ' | ' . auth()->user()->coverage_area : '')) ?: 'N/A' }}"
                                        readonly>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 3: Response Details</h6>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label">Indicative Unit Price (Optional)</label>
                                    <input type="number" class="form-control form-control-sm" id="indicativeUnitPrice"
                                        name="indicative_unit_price" min="0" step="0.01">
                                    <div class="form-text">Optional. Indicative price if available. Not binding.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Total Indicative Value</label>
                                    <input type="text" class="form-control form-control-sm" id="totalIndicativeValue"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Available Quantity (Mandatory)</label>
                                    <input type="number" class="form-control form-control-sm" id="availableQuantity"
                                        name="available_quantity" min="1" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Approx Delivery Window (Mandatory)</label>
                                    <div class="d-flex gap-2">
                                        <input type="date" class="form-control form-control-sm" id="deliveryFrom"
                                            name="delivery_from" required>
                                        <input type="date" class="form-control form-control-sm" id="deliveryTo"
                                            name="delivery_to" required>
                                    </div>
                                    <div class="form-text">Mention approximate delivery window, not a fixed date.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Stock / Supply Status (Optional)</label>
                                    <div class="d-flex flex-wrap gap-3 mt-1">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input me-1" name="stock_status"
                                                value="in_stock">
                                            In stock
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input me-1" name="stock_status"
                                                value="partially_available">
                                            Partially available
                                        </label>
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input me-1" name="stock_status"
                                                value="to_be_arranged">
                                            To be arranged
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Additional Notes (Optional)</label>
                                    <textarea class="form-control form-control-sm" name="additional_notes" rows="3"
                                        placeholder="Any assumptions or clarifications (non-binding)."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 4: Response Confirmation (Mandatory)</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rfqResponseConfirm"
                                    name="confirm_indicative" required>
                                <label class="form-check-label" for="rfqResponseConfirm">
                                    I confirm this is an indicative response only. It is not a confirmed offer, order
                                    acceptance, or supply commitment.
                                </label>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Section 5: Contact Visibility (Controlled)</h6>
                            <div class="border rounded p-3 mb-3">
                                <div class="small text-muted">Default visible</div>
                                <div class="d-flex flex-wrap gap-3 mt-2">
                                    <span><strong>Company Name:</strong>
                                        {{ auth()->user()->business_name ?? 'N/A' }}</span>
                                    <span><strong>City / State:</strong>
                                        {{ trim((auth()->user()->city ?? '') . (auth()->user()->state ? ', ' . auth()->user()->state : '')) ?: 'N/A' }}</span>
                                    <span><strong>Role:</strong>
                                        {{ ucfirst(auth()->user()->role ?? 'Distributor') }}</span>
                                </div>
                                <button type="button" class="btn btn-sm btn-outline-secondary mt-3"
                                    id="viewContactDetailsBtn">View contact details</button>
                            </div>
                            <div class="alert alert-info small d-none" id="contactDetailsDisclaimer">
                                Contact details are shared only to facilitate independent communication. The platform does
                                not participate in or manage any transaction.
                            </div>
                            <div class="border rounded p-3 d-none" id="contactDetailsSection">
                                <div class="d-flex flex-column gap-2">
                                    <span><strong>Business phone number:</strong>
                                        {{ auth()->user()->mobile ?? 'N/A' }}</span>
                                    <span><strong>Business email ID:</strong> {{ auth()->user()->email ?? 'N/A' }}</span>
                                    <span><strong>Business address (optional):</strong>
                                        {{ auth()->user()->address ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary" id="rfqResponseSubmitBtn" disabled>Submit RFQ
                                Response</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const distributorCurrentUserId = {{ auth()->id() }};

        function switchTab(type, tabButton = null) {
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.getElementById('activeTab').style.display = 'none';
            document.getElementById('historyTab').style.display = 'none';
            document.getElementById('receivedTab').style.display = 'none';

            if (type === 'active') {
                document.getElementById('activeTab').style.display = 'flex';
            } else if (type === 'history') {
                document.getElementById('historyTab').style.display = 'flex';
            } else if (type === 'received') {
                document.getElementById('receivedTab').style.display = 'flex';
            }

            if (tabButton) {
                tabButton.classList.add('active');
            }
        }

        function addBookRow() {
            let row = `
            <div class="book-row">
                <input type="text" name="class_name[]" placeholder="Class Name" required>
                <input type="text" name="subject[]" placeholder="Subject" required>
                <input type="text" name="book_title[]" placeholder="Book Title" required>
                <select name="publisher[]">
                    <option>Publisher</option>
                    <option>NCERT</option>
                    <option>Oxford</option>
                    <option>Other</option>
                </select>
                <input type="text" name="edition[]" placeholder="Edition / Year">
                <input type="number" name="quantity[]" placeholder="Qty" min="1" required>
                <button type="button" class="delete-book" onclick="this.parentElement.remove()">🗑</button>
            </div>`;
            document.getElementById('booksWrapper').insertAdjacentHTML('beforeend', row);
        }

        function openCreateRfq() {
            document.getElementById('createRfqModal').style.display = 'flex';
            if (typeof initializeIndiaStateCityDropdowns === 'function') {
                initializeIndiaStateCityDropdowns(document.getElementById('createRfqModal'));
            }
        }

        function openRaiseRfqModal(id) {
            const form = document.getElementById('raiseRfqForm');
            if (form) {
                form.reset();
            }
            document.getElementById('raiseRfqId').value = id;
            document.getElementById('raiseRfqModal').style.display = 'flex';
            if (typeof initializeIndiaStateCityDropdowns === 'function') {
                initializeIndiaStateCityDropdowns(document.getElementById('raiseRfqModal'));
            }
        }

        function closeModal() {
            document.querySelectorAll('.modal').forEach(m => m.style.display = 'none');
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

        function viewDetails(id) {
            fetch(`/retailer/rfq-details/${id}`)
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
                            content +=
                                `<li><strong>${book.class_name} - ${book.subject}</strong><br>${book.book_title} (${book.quantity})</li>`;
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
                        document.getElementById('closeRfqBtn').style.display = canClose ? 'inline-block' : 'none';
                        modal.style.display = 'flex';
                    }
                });
        }

        function editRfq() {
            // Implement edit functionality - could open the create modal in edit mode
        }

        function openCloseRfqModal() {
            document.getElementById('closeRfqModal').style.display = 'flex';
        }

        function confirmCloseRfq() {
            const id = document.querySelector('#viewDetailsModal').dataset.rfqId;
            fetch(`/retailer/close-rfq/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        location.reload();
                    }
                });
        }

        function submitRfqForm() {
            const form = document.getElementById('rfqForm');
            const formData = new FormData(form);

            // Collect books data
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

            // Show loading
            const submitBtn = document.getElementById('publishRfqBtn');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;

            fetch('/retailer/store-rfq', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                    }

                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        closeModal();
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                })
                .finally(() => {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                });
        }

        function submitRaiseRfq() {
            const form = document.getElementById('raiseRfqForm');
            const formData = new FormData(form);
            const id = document.getElementById('raiseRfqId').value;
            if (!id) return;
            const sendBtn = document.getElementById('raiseRfqSendBtn');
            const originalText = sendBtn.textContent;

            sendBtn.textContent = 'Sending...';
            sendBtn.disabled = true;

            fetch(`/retailer/send-rfq/${id}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('#raiseRfqForm input[name=_token]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        closeModal();
                        location.reload();
                    } else {
                        alert(data.message || 'Unable to send RFQ');
                    }
                })
                .catch(() => {
                    alert('Server error. Please try again.');
                })
                .finally(() => {
                    sendBtn.textContent = originalText;
                    sendBtn.disabled = false;
                });
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
        }

        function renderRfqResponseSummary({
            rfq,
            sender,
            books
        }) {
            document.getElementById('rfqSummaryId').value = `RFQ-${rfq.id}`;
            document.getElementById('rfqSummarySchool').value = maskSchoolName(rfq.school_name);
            document.getElementById('rfqSummaryDelivery').value =
                `${formatDate(rfq.delivery_from)} to ${formatDate(rfq.delivery_to)}`;
            document.getElementById('rfqSummaryClosing').value = formatDate(rfq.rfq_closing_date);
            document.getElementById('rfqSenderRole').value = sender.role ? sender.role.charAt(0).toUpperCase() + sender.role
                .slice(1) : 'N/A';
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
        }

        function markReceivedCard(rfqId) {
            const card = document.querySelector(`.rfq-card[data-rfq-id="${rfqId}"]`);
            if (!card) {
                return;
            }
            const statusBadge = card.querySelector('.status');
            if (statusBadge) {
                statusBadge.classList.remove('open');
                statusBadge.classList.add('closed');
                statusBadge.textContent = 'Received';
            }
            const actionBtn = card.querySelector('.rfq-right .btn-solid');
            if (actionBtn) {
                actionBtn.classList.remove('btn-solid');
                actionBtn.classList.add('btn-dark');
                actionBtn.textContent = 'Received Done';
                actionBtn.disabled = true;
            }
        }

        function viewDistributorRfqResponse(id) {
            fetch(`/retailer/rfq-details/${id}`)
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        return;
                    }

                    const rfq = data.rfq;
                    const sender = data.sender || {};
                    const books = Array.isArray(rfq.books) ? rfq.books : JSON.parse(rfq.books || '[]');

                    resetRfqResponseForm();
                    document.getElementById('rfqResponseId').value = rfq.id;
                    renderRfqResponseSummary({
                        rfq,
                        sender,
                        books
                    });

                    const modal = new bootstrap.Modal(document.getElementById('distributorRfqDetailsModal'));
                    modal.show();

                });
        }

        function receiveAndRespond(id) {
            viewDistributorRfqResponse(id);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const unitPriceInput = document.getElementById('indicativeUnitPrice');
            const qtyInput = document.getElementById('availableQuantity');
            const totalValueInput = document.getElementById('totalIndicativeValue');
            const totalHiddenInput = document.getElementById('totalIndicativeValueHidden');
            const confirmCheckbox = document.getElementById('rfqResponseConfirm');
            const submitBtn = document.getElementById('rfqResponseSubmitBtn');
            const viewContactBtn = document.getElementById('viewContactDetailsBtn');

            if (unitPriceInput && qtyInput && totalValueInput && totalHiddenInput && confirmCheckbox && submitBtn) {
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

                if (viewContactBtn) {
                    viewContactBtn.addEventListener('click', () => {
                        document.getElementById('contactDetailsDisclaimer').classList.remove('d-none');
                        document.getElementById('contactDetailsSection').classList.remove('d-none');
                    });
                }

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
                                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                const modalEl = document.getElementById('distributorRfqDetailsModal');
                                const modal = bootstrap.Modal.getInstance(modalEl);
                                if (modal) {
                                    modal.hide();
                                }
                                if (rfqId) {
                                    markReceivedCard(rfqId);
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
            }

            const params = new URLSearchParams(window.location.search);
            const tab = params.get('tab');
            if (tab === 'received') {
                const tabButton = document.querySelector('.tab[onclick*="received"]');
                switchTab('received', tabButton);
            }
            if (params.get('create') === '1') {
                openCreateRfq();
            }
        });



        $(document).ready(function() {
            $('.publisher-select').select2({
                placeholder: "Select Publisher",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    @include('partials.india-state-city-script')
@endsection
