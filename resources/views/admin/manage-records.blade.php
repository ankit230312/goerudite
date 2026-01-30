@extends('layouts.dashboard')

@section('content')

    <main class="content">
        
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <div>
                    <div class="page-title">All Purchase Records</div>
                    <!-- <div class="page-sub">Active Session</div> -->
                </div>

                <button class="btn-sm btn-solid" onclick="openAddModal()">➕ Add New Purchase Entry</button>
            </div>

            <div class="class-grid">
                <!-- Repeat card -->
                    @foreach($purchase_records as $record)
                        <div class="class-card">

                            <span class="badge">{{ ucfirst($record->delivery_status) }}</span>

                            <span class="delete-icon"
                                onclick="openDeleteModal({{ $record->id }}, '{{ $record->record_name }}')">
                                <i class="fa-solid fa-trash"></i>
                            </span>

                            <h4>{{ $record->record_name }}</h4>

                            <div class="card-info">
                                Item: {{ $record->item_name }}<br>
                                Supplier: {{ $record->supplier }}<br>
                                Amount: ${{ $record->amount }}
                            </div>

                            <div class="card-actions">
                                <button class="btn-sm btn-outline"
                                        onclick="openEditModal({{ $record }})">
                                    View Details
                                </button>

                                <button class="btn-sm btn-solid"
                                        onclick="downloadInvoice({{ $record->id }})">
                                    Download Invoice
                                </button>
                            </div>
                        </div>

                    @endforeach
                </div>

            <!-- <div class="tip">
                <strong>Pro Tip:</strong> Update student counts regularly. RFQs auto-calculate with 2% safety buffer.
            </div> -->
        


    </main>
    <!-- ADD CLASS MODAL -->
    <div id="addClassModal" class="modal">
        <div class="modal-box large">
            <form id="purchaseRecordForm" enctype="multipart/form-data" method="post">
                @csrf

                <h3 class="modal-title">All your purchases. One clear record.</h3>

                <!-- PURCHASE RECORD DETAILS -->
                <div class="form-section">
                    <div class="form-grid three">

                        <div>
                            <label>Create Record Name</label>
                            <input type="text" name="record_name" placeholder="Record Name">
                        </div>

                        <div>
                            <label>Purchase ID / Invoice No.</label>
                            <input type="text" name="invoice_no">
                        </div>

                        <div>
                            <label>Purchase Date</label>
                            <input type="date" name="purchase_date">
                        </div>

                        <div>
                            <label>Item / Book / Service Name</label>
                            <input type="text" name="item_name">
                        </div>

                        <div>
                            <label>GST / Tax Details</label>
                            <input type="text" name="gst_details">
                        </div>

                        <div>
                            <label>Delivery Status</label>
                            <select name="delivery_status">
                                <option value="">Select Status</option>
                                <option value="delivered">Delivered</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label>Payment Status</label>
                            <select name="payment_status">
                                <option value="">Select Payment Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="partial">Partial</option>
                            </select>
                        </div>

                        <div>
                            <label>Supplier / Distributor / Publisher</label>
                            <input type="text" name="supplier">
                        </div>

                        <div>
                            <label>Quantity</label>
                            <input type="number" name="quantity">
                        </div>

                        <div>
                            <label>Unit Price & Total Amount</label>
                            <input type="text" name="amount">
                        </div>

                    </div>
                </div>

                <!-- DOCUMENTS -->
                <div class="form-section">
                    <div class="form-grid three">

                        <div>
                            <label>Attached Invoice / Document</label>
                            <input type="file" name="invoice_file" accept="application/pdf,image/*">
                            <small>PDF / JPEG Format</small>
                        </div>

                        <div>
                            <label>Return / Replace Request</label>
                            <input type="file" name="return_file" accept="application/pdf,image/*">
                            <small>PDF / JPEG Format</small>
                        </div>

                        <div>
                            <label>Document Name (if any)</label>
                            <input type="file" name="document_name" accept="application/pdf,image/*">
                            <small>PDF / JPEG Format</small>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="modal-actions center">
                    <button type="button" class="btn-sm btn-outline" onclick="closeModal()">Close</button>
                    <button type="submit" class="btn-sm btn-solid">Save</button>
                </div>

            </form>

        </div>
    </div>

    <!-- EDIT PURCHASE RECORD MODAL -->
    <div id="editPurchaseRecordModal" class="modal">
        <div class="modal-box large">
            <form id="editPurchaseRecordForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="edit_record_id">

                <h3 class="modal-title">Edit Purchase Record</h3>

                <!-- PURCHASE RECORD DETAILS -->
                <div class="form-section">
                    <div class="form-grid three">

                        <div>
                            <label>Create Record Name</label>
                            <input type="text" name="record_name" id="edit_record_name" placeholder="Record Name">
                        </div>

                        <div>
                            <label>Purchase ID / Invoice No.</label>
                            <input type="text" name="invoice_no" id="edit_invoice_no">
                        </div>

                        <div>
                            <label>Purchase Date</label>
                            <input type="date" name="purchase_date" id="edit_purchase_date">
                        </div>

                        <div>
                            <label>Item / Book / Service Name</label>
                            <input type="text" name="item_name" id="edit_item_name">
                        </div>

                        <div>
                            <label>GST / Tax Details</label>
                            <input type="text" name="gst_details" id="edit_gst_details">
                        </div>

                        <div>
                            <label>Delivery Status</label>
                            <select name="delivery_status" id="edit_delivery_status">
                                <option value="">Select Status</option>
                                <option value="delivered">Delivered</option>
                                <option value="pending">Pending</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label>Payment Status</label>
                            <select name="payment_status" id="edit_payment_status">
                                <option value="">Select Payment Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="partial">Partial</option>
                            </select>
                        </div>

                        <div>
                            <label>Supplier / Distributor / Publisher</label>
                            <input type="text" name="supplier" id="edit_supplier">
                        </div>

                        <div>
                            <label>Quantity</label>
                            <input type="number" name="quantity" id="edit_quantity">
                        </div>

                        <div>
                            <label>Unit Price & Total Amount</label>
                            <input type="text" name="amount" id="edit_amount">
                        </div>

                    </div>
                </div>

                <!-- DOCUMENTS -->
                <div class="form-section">
                    <div class="form-grid three">

                        <div>
                            <label>Attached Invoice / Document</label>
                            <input type="file" name="invoice_file" accept="application/pdf,image/*">
                            <small>PDF / JPEG Format</small>
                            <div id="current_invoice_file"></div>
                        </div>

                        <div>
                            <label>Return / Replace Request</label>
                            <input type="file" name="return_file" accept="application/pdf,image/*">
                            <small>PDF / JPEG Format</small>
                            <div id="current_return_file"></div>
                        </div>

                        <div>
                            <label>Document Name (if any)</label>
                            <input type="file" name="document_name" accept="application/pdf,image/*">
                            <small>PDF / JPEG Format</small>
                            <div id="current_document_name"></div>
                        </div>

                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="modal-actions center">
                    <button type="button" class="btn-sm btn-outline" onclick="closeModal()">Close</button>
                    <button type="submit" class="btn-sm btn-solid">Update</button>
                </div>

            </form>
        </div>
    </div>


    <div id="deleteClassModal" class="modal">
        <div class="modal-box">
            <h3>Delete Purchase Record</h3>
            <p id="deleteText" style="margin-bottom:15px;color:#555;">
                Are you sure?
            </p>

            <div class="modal-actions">
                <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                <button class="btn-sm btn-solid danger" onclick="deletePurchaseRecord()">Delete</button>
            </div>
        </div>
    </div>

    <script>

        // save purchase record
        document.getElementById('purchaseRecordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            // Check required fields
            let requiredFields = ['record_name', 'purchase_date', 'item_name', 'delivery_status', 'payment_status', 'supplier', 'quantity', 'amount'];
            let isValid = true;
            requiredFields.forEach(field => {
                if (!formData.get(field) || formData.get(field).trim() === '') {
                    isValid = false;
                }
            });

            if (!isValid) {
                Toastify({
                    text: "All required fields must be filled",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#ff4d4f"
                }).showToast();
                return;
            }

            fetch("{{ route('admin.save-purchase-record') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    closeModal();
                    Toastify({
                        text: "Purchase record saved successfully",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(135deg, #ff7a18, #ffb347)"
                    }).showToast();

                    setTimeout(() => location.reload(), 1000);
                } else {
                    let messages = '';

                    if (data.errors) {
                        messages = Object.values(data.errors).flat().join('\n');
                    } else if (data.message) {
                        messages = data.message;
                    } else {
                        messages = 'Something went wrong';
                    }
                    Toastify({
                        text: messages,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ff4d4f"
                    }).showToast();
                }
            })
            .catch(() => {
                Toastify({
                    text: "Server error. Try again.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#ff4d4f"
                }).showToast();
            });
        });

        // update purchase record
        document.getElementById('editPurchaseRecordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            // Check required fields
            let requiredFields = ['record_name', 'purchase_date', 'item_name', 'delivery_status', 'payment_status', 'supplier', 'quantity', 'amount'];
            let isValid = true;
            requiredFields.forEach(field => {
                if (!formData.get(field) || formData.get(field).trim() === '') {
                    isValid = false;
                }
            });

            if (!isValid) {
                Toastify({
                    text: "All required fields must be filled",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#ff4d4f"
                }).showToast();
                return;
            }

            fetch("{{ route('admin.update-purchase-record') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    closeModal();
                    Toastify({
                        text: "Purchase record updated successfully",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(135deg, #4CAF50, #81C784)"
                    }).showToast();

                    setTimeout(() => location.reload(), 1000);
                } else {
                    let messages = '';

                    if (data.errors) {
                        messages = Object.values(data.errors).flat().join('\n');
                    } else if (data.message) {
                        messages = data.message;
                    } else {
                        messages = 'Something went wrong';
                    }
                    Toastify({
                        text: messages,
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ff4d4f"
                    }).showToast();
                }
            })
            .catch(() => {
                Toastify({
                    text: "Server error. Try again.",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#ff4d4f"
                }).showToast();
            });
        });
    </script>


    <script>
        function openAddModal() {
            document.getElementById('addClassModal').style.display = 'flex';
        }

        function openEditModal(data) {

            document.getElementById('edit_record_id').value = data.id;
            document.getElementById('edit_record_name').value = data.record_name;
            document.getElementById('edit_invoice_no').value = data.invoice_no;
            document.getElementById('edit_purchase_date').value = data.purchase_date;
            document.getElementById('edit_item_name').value = data.item_name;
            document.getElementById('edit_gst_details').value = data.gst_details;
            document.getElementById('edit_delivery_status').value = data.delivery_status;
            document.getElementById('edit_payment_status').value = data.payment_status;
            document.getElementById('edit_supplier').value = data.supplier;
            document.getElementById('edit_quantity').value = data.quantity;
            document.getElementById('edit_amount').value = data.amount;

            // Show current file links
            document.getElementById('current_invoice_file').innerHTML = data.invoice_file ? `<a href="/storage/${data.invoice_file}" target="_blank">View Current Invoice</a>` : 'No file uploaded';
            document.getElementById('current_return_file').innerHTML = data.return_file ? `<a href="/storage/${data.return_file}" target="_blank">View Current Return File</a>` : 'No file uploaded';
            document.getElementById('current_document_name').innerHTML = data.document_name ? `<a href="/storage/${data.document_name}" target="_blank">View Current Document</a>` : 'No file uploaded';

            document.getElementById('editPurchaseRecordModal').style.display = 'flex';
        }

        let deleteClassId = null;

        function openDeleteModal(id, className) {
            deleteClassId = id;

            document.getElementById('deleteText').innerText =
                `Are you sure you want to delete "${className}"? This action cannot be undone.`;

            document.getElementById('deleteClassModal').style.display = 'flex';
        }

        function deletePurchaseRecord() {
            fetch("{{ route('admin.delete-purchase-record') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: deleteClassId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    closeModal();

                    Toastify({
                        text: "Purchase record deleted successfully",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ff4d4f"
                    }).showToast();

                    setTimeout(() => location.reload(), 800);
                }
            });
        }

        function downloadInvoice(recordId) {
            window.open("{{ url('/admin/download-invoice') }}/" + recordId, '_blank');
        }

        function closeModal() {
            document.getElementById('addClassModal').style.display = 'none';
            document.getElementById('editPurchaseRecordModal').style.display = 'none';
            document.getElementById('deleteClassModal').style.display = 'none';
        }
    </script>


@endsection
