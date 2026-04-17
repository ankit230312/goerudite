@extends('layouts.dashboard')

@section('content')

    <main class="content">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
            <div>
                <div class="page-title">Board Master</div>
                <div class="page-sub">Create and manage boards</div>
            </div>

            <button class="btn-sm btn-solid" onclick="openAddModal()">➕ Add Board</button>
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
                    @forelse($boards as $board)
                        <tr>
                            <td>{{ $board->id }}</td>
                            <td>{{ $board->name }}</td>
                            <td>{{ ucfirst($board->status) }}</td>
                            <td>
                                <button class="btn-sm btn-outline" onclick="openEditModal({{ $board }})">Edit</button>
                                <button class="btn-sm btn-solid danger" onclick="openDeleteModal({{ $board->id }}, '{{ $board->name }}')">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;color:#777;">No boards found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- ADD BOARD MODAL -->
    <div id="addBoardModal" class="modal">
        <div class="modal-box">
            <form id="addBoardForm">
                @csrf
                <h3 class="modal-title">Add Board</h3>

                <div class="form-section">
                    <div class="form-grid">
                        <div>
                            <label>Board Name</label>
                            <input type="text" name="name" placeholder="Board Name">
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

    <!-- EDIT BOARD MODAL -->
    <div id="editBoardModal" class="modal">
        <div class="modal-box">
            <form id="editBoardForm">
                @csrf
                <input type="hidden" name="id" id="edit_id">

                <h3 class="modal-title">Edit Board</h3>

                <div class="form-section">
                    <div class="form-grid">
                        <div>
                            <label>Board Name</label>
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

    <!-- DELETE BOARD MODAL -->
    <div id="deleteBoardModal" class="modal">
        <div class="modal-box">
            <h3>Delete Board</h3>
            <p id="deleteText" style="margin-bottom:15px;color:#555;">
                Are you sure?
            </p>

            <div class="modal-actions">
                <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                <button class="btn-sm btn-solid danger" onclick="deleteBoard()">Delete</button>
            </div>
        </div>
    </div>

    <script>
        // add board
        document.getElementById('addBoardForm').addEventListener('submit', function(e) {
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

            fetch("{{ route('distributor.save-board') }}", {
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
                        text: "Board added successfully",
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

        // update board
        document.getElementById('editBoardForm').addEventListener('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('distributor.board.update') }}", {
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
                        text: "Board updated successfully",
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
            document.getElementById('addBoardModal').style.display = 'flex';
        }

        function openEditModal(data) {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_status').value = data.status;

            document.getElementById('editBoardModal').style.display = 'flex';
        }

        let deleteBoardId = null;

        function openDeleteModal(id, name) {
            deleteBoardId = id;

            document.getElementById('deleteText').innerText =
                `Are you sure you want to delete "${name}"? This action cannot be undone.`;

            document.getElementById('deleteBoardModal').style.display = 'flex';
        }

        function deleteBoard() {
            fetch("{{ route('distributor.board.delete') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ id: deleteBoardId })
            })
            .then(res => res.json())
            .then(data => {
                if (data.status) {
                    closeModal();

                    Toastify({
                        text: "Board deleted successfully",
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
            document.getElementById('addBoardModal').style.display = 'none';
            document.getElementById('editBoardModal').style.display = 'none';
            document.getElementById('deleteBoardModal').style.display = 'none';
        }
    </script>

@endsection
