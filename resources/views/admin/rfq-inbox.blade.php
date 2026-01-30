@extends('layouts.dashboard')

@section('content')
    <style>

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .modal-box.rfq-box {
            width: 95%;
            max-width: 1100px;
            background: #fff;
            border-radius: 14px;
            padding: 22px 26px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
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

        
        
    </style>

    <main class="content">

        <!-- Header -->
        <div class="rfq-header">
            <div>
                <h2>Request for Quotation (RFQ) History</h2>

                <div class="tabs">
                    <button class="tab active" onclick="switchTab('active')">Active Request</button>
                    <button class="tab" onclick="switchTab('history')">History</button>
                </div>
            </div>

            <button class="btn-create" onclick="openCreateRfq();">+ Create RFQ</button>
        </div>

        <!-- ACTIVE RFQs -->
        <div id="activeTab" class="rfq-list">
            @forelse($activeRfqs as $rfq)
            <div class="rfq-card">
                <div class="rfq-left">
                    <span class="rfq-id">RFQ-{{ $rfq->id }}</span>
                    <span class="status open">{{ ucfirst($rfq->status) }}</span>

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
                    <a href="#" class="view-link" onclick="viewDetails({{ $rfq->id }})">View Details ➜</a>
                </div>
            </div>
            @empty
            <p>No active RFQs found.</p>
            @endforelse
        </div>

        <!-- HISTORY RFQs -->
        <div id="historyTab" class="rfq-list" style="display:none;">
            @forelse($historyRfqs as $rfq)
            <div class="rfq-card">
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
                    <a href="#" class="view-link" onclick="viewDetails({{ $rfq->id }})">View Details ➜</a>
                </div>
            </div>
            @empty
            <p>No history RFQs found.</p>
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
                <button class="btn-dark" onclick="openCloseRfqModal()">Close RFQ</button>
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

    <!-- create rfq modal -->
    <div id="createRfqModal" class="modal">
        <div class="modal-box rfq-box">

            <!-- HEADER -->
            <div class="rfq-header-modal">
                <h3>Group-1</h3>
                <button class="btn-save">Save</button>
            </div>

            <form id="rfqForm">
                @csrf
                <!-- BASIC INFO -->
                <h5 class="form-title">School Identification</h5>
                <div class="rfq-basic-grid">
                    <div>
                        <label>School Name</label>
                        <input type="text" name="school_name" value="{{ auth()->user()->business_name ?? '' }}" readonly>
                    </div>

                    <div>
                        <label>City</label>
                        <input type="text" name="city" placeholder="Enter City Name" required>
                    </div>

                    <div>
                        <label>Academic Session</label>
                        <select name="academic_session" required>
                            <option value="">Select Academic Session</option>
                            <option value="2024-25">2024-25</option>
                            <option value="2025-26">2025-26</option>
                            <option value="2026-27">2026-27</option>
                            <option value="2027-28">2027-28</option>
                        </select>
                    </div>
                </div>

                <!-- BOOKS SECTION -->
                <h5 class="form-title">Book Requirement</h5>
                <div id="booksWrapper">
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
                    <button type="button" class="btn-dark">+ Add Another Class Set</button>

                    <div class="footer-actions">
                        <button type="button" class="btn-outline" onclick="closeModal();">Cancel</button>
                        <button type="button" class="btn-solid" onclick="submitRfqForm()">Publish Class Wise RFQ</button>
                    </div>
                </div>
            </form>

        </div>
    </div>


    <script>
        function switchTab(type) {

            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            if (type === 'active') {
                document.getElementById('activeTab').style.display = 'flex';
                document.getElementById('historyTab').style.display = 'none';
                event.target.classList.add('active');
            } else {
                document.getElementById('activeTab').style.display = 'none';
                document.getElementById('historyTab').style.display = 'flex';
                event.target.classList.add('active');
            }
        }

        function addBookRow() {
            let row = `
            <div class="book-row">
                <input type="text" placeholder="Class Name">
                <input type="text" placeholder="Subject">
                <input type="text" placeholder="Book Title">
                <select name="publisher[]">
                    <option>Publisher</option>
                    <option>NCERT</option>
                    <option>Oxford</option>
                    <option>Other</option>
                </select>
                <input type="text" name="edition[]" placeholder="Edition / Year">
                <input type="number" name="quantity[]" placeholder="Qty">
                <button class="delete-book" onclick="this.parentElement.remove()">🗑</button>
            </div>`;
            document.getElementById('booksWrapper').insertAdjacentHTML('beforeend', row);
        }

        function openCreateRfq() {
            document.getElementById('createRfqModal').style.display = 'flex';
        }

        function closeModal() {
            document.querySelectorAll('.modal').forEach(m => m.style.display = 'none');
        }

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
                    if (data.success) {
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
                                    <h6>Book Requirements</h6>
                                    <ul>
                        `;

                        books.forEach(book => {
                            content += `<li><strong>${book.class_name} - ${book.subject}</strong><br>${book.book_title} (${book.quantity})</li>`;
                        });
                        content += '</ul></div></div>';
                        document.getElementById('detailsContent').innerHTML = content;
                        const modal = document.getElementById('viewDetailsModal');
                        modal.dataset.rfqId = id;
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
            fetch(`/admin/close-rfq/${id}`, {
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
            const submitBtn = document.querySelector('#rfqForm button[type="button"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Submitting...';
            submitBtn.disabled = true;

            fetch('/admin/store-rfq', {
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
    </script>




@endsection
