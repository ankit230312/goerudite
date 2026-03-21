@extends('layouts.dashboard')

@section('content')

    <main class="content">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <div>
                <div class="page-title">Academic Session Master</div>
                <div class="page-sub">Create and manage academic sessions</div>
            </div>

            <button class="btn-sm btn-solid" onclick="openAddModal()">➕ Add Session</button>
        </div>

        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th style="width:140px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sessions as $session)
                        <tr>
                            <td>{{ $session->id }}</td>
                            <td>{{ $session->name }}</td>
                            <td>{{ ucfirst($session->status) }}</td>
                            <td>
                                <button class="btn-sm btn-outline" onclick="openEditModal({{ $session }})">Edit</button>
                                <button class="btn-sm btn-solid danger" onclick="openDeleteModal({{ $session->id }}, '{{ $session->name }}')">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:#777;">No academic sessions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- ADD SESSION MODAL -->
    <div id="addSessionModal" class="modal">
        <div class="modal-box">
            <form id="addSessionForm">
                @csrf
                <h3 class="modal-title">Add Academic Session</h3>

                <div class="form-section">
                    <div class="form-grid">
                        <div>
                            <label>Session Name</label>
                            <input type="text" name="name" placeholder="2026-27">
                        </div>

                        <div>
                            <label>Status</label>
                            <select name="status">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                    <button class="btn-sm btn-solid" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT SESSION MODAL -->
    <div id="editSessionModal" class="modal">
        <div class="modal-box">
            <form id="editSessionForm">
                @csrf
                <input type="hidden" name="id" id="edit_id">

                <h3 class="modal-title">Edit Academic Session</h3>

                <div class="form-section">
                    <div class="form-grid">
                        <div>
                            <label>Session Name</label>
                            <input type="text" name="name" id="edit_name">
                        </div>

                        <div>
                            <label>Status</label>
                            <select name="status" id="edit_status">
                                <option value="">Select Status</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn-sm btn-outline" onclick="closeModal();">Cancel</button>
                    <button type="submit" class="btn-sm btn-solid">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- DELETE SESSION MODAL -->
    <div id="deleteSessionModal" class="modal">
        <div class="modal-box">
            <h3>Delete Academic Session</h3>
            <p id="deleteText" style="margin-bottom:15px;color:#555;">
                Are you sure?
            </p>

            <div class="modal-actions">
                <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                <button class="btn-sm btn-solid danger" onclick="deleteSession()">Delete</button>
            </div>
        </div>
    </div>

    <script>
        // add session
        document.getElementById('addSessionForm').addEventListener('submit', function(e) {
            e.preventDefault();

            let form = this;
            let formData = new FormData(form);

            for (let [key, value] of formData.entries()) {
                if (!value.trim()) {
                    Toastify({
                        text: "All fields are required",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ff4d4f"
                    }).showToast();
                    return;
                }
            }

            fetch("{{ route('admin.save-academic-session') }}", {
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
                        text: "Academic session added successfully",
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

        // update session
        document.getElementById('editSessionForm').addEventListener('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('admin.academic-session.update') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if(data.status){
                    closeModal();
                    Toastify({
                        text: "Academic session updated successfully",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(135deg,#4CAF50,#81C784)"
                    }).showToast();

                    setTimeout(()=>location.reload(),800);
                }
            });
        });
    </script>

    <script>
        function openAddModal() {
            document.getElementById('addSessionModal').style.display = 'flex';
        }

        function openEditModal(data) {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_status').value = data.status;

            document.getElementById('editSessionModal').style.display = 'flex';
        }

        let deleteSessionId = null;

        function openDeleteModal(id, name) {
            deleteSessionId = id;

            document.getElementById('deleteText').innerText =
                `Are you sure you want to delete "${name}"? This action cannot be undone.`;

            document.getElementById('deleteSessionModal').style.display = 'flex';
        }

        function deleteSession() {
            fetch("{{ route('admin.academic-session.delete') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: deleteSessionId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    closeModal();

                    Toastify({
                        text: "Academic session deleted successfully",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#ff4d4f"
                    }).showToast();

                    setTimeout(() => location.reload(), 800);
                }
            });
        }

        function closeModal() {
            document.getElementById('addSessionModal').style.display = 'none';
            document.getElementById('editSessionModal').style.display = 'none';
            document.getElementById('deleteSessionModal').style.display = 'none';
        }
    </script>

@endsection
