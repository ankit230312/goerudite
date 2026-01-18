@extends('layouts.dashboard')

@section('content')

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

            <div class="rfq-card">
                <div class="rfq-left">
                    <span class="rfq-id">RFQ-101</span>
                    <span class="status open">Open</span>

                    <h4>CBSE Class 10 Complete Set</h4>

                    <div class="rfq-meta">
                        <span>📅 2024-03-10</span>
                        <span>📦 Quantity: 500</span>
                    </div>
                </div>

                <div class="rfq-right">
                    <div class="quote-count">
                        <strong>3</strong>
                        <span>Quotes Received</span>
                    </div>
                    <a href="#" class="view-link">View Details ➜</a>
                </div>
            </div>

        </div>

        <!-- HISTORY RFQs -->
        <div id="historyTab" class="rfq-list" style="display:none;">

            <div class="rfq-card">
                <div class="rfq-left">
                    <span class="rfq-id">RFQ-102</span>
                    <span class="status closed">Closed</span>

                    <h4>ICSE Math Lab Manuals</h4>

                    <div class="rfq-meta">
                        <span>📅 2024-03-12</span>
                        <span>📦 Quantity: 150</span>
                    </div>
                </div>

                <div class="rfq-right">
                    <div class="quote-count">
                        <strong>5</strong>
                        <span>Quotes Received</span>
                    </div>
                    <a href="#" class="view-link">View Details ➜</a>
                </div>
            </div>

        </div>

    </main>


    <!-- create rfq modal -->
    <div id="createRfqModal" class="modal">
        <div class="modal-box rfq-box">

            <!-- HEADER -->
            <div class="rfq-header-modal">
                <h3>Group-1</h3>
                <button class="btn-save">Save</button>
            </div>

            <!-- BASIC INFO -->
            <div class="rfq-basic-grid">
                <div>
                    <label>Class</label>
                    <input type="text" placeholder="Enter Class">
                </div>

                <div>
                    <label>Class Strength (Total Quantity)</label>
                    <input type="number" placeholder="Total Quantity">
                </div>

                <div>
                    <label>Session</label>
                    <input type="text" placeholder="2024-25">
                </div>
            </div>

            <!-- BOOKS SECTION -->
            <h4 class="section-title">Class Books & Materials</h4>

            <div id="booksWrapper">

                <div class="book-row">
                    <input type="text" placeholder="Books Name / Subject">
                    <input type="text" placeholder="Preference (CBSE / ICSE / State)">
                    <select>
                        <option>English</option>
                        <option>Hindi</option>
                        <option>Regional</option>
                    </select>
                    <button class="delete-book">🗑</button>
                </div>

            </div>

            <button class="add-title-btn" onclick="addBookRow()">+ Add Title</button>

            <!-- FOOTER -->
            <div class="rfq-footer">
                <button class="btn-dark">+ Add Another Class Set</button>

                <div class="footer-actions">
                    <button class="btn-outline" onclick="closeModal();">Cancel</button>
                    <button class="btn-solid">Publish Class Wise RFQ</button>
                </div>
            </div>

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
                <input type="text" placeholder="Books Name / Subject">
                <input type="text" placeholder="Preference">
                <select>
                    <option>English</option>
                    <option>Hindi</option>
                    <option>Regional</option>
                </select>
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
    </script>




@endsection
