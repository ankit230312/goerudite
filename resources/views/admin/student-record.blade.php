@extends('layouts.dashboard')

@section('content')

    <main class="content">
        
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                <div>
                    <div class="page-title">Class-wise Strength</div>
                    <div class="page-sub">Active Session</div>
                </div>

                <button class="btn-sm btn-solid" onclick="openAddModal()">➕ Add Class</button>
            </div>

            <div class="class-grid">
                <!-- Repeat card -->
                    @foreach($class_arr as $class)
                        <div class="class-card">
                            
                            <span class="badge">Active</span>

                            <span class="delete-icon"
                                onclick="openDeleteModal({{ $class->id }}, '{{ $class->class_name }}')">
                                <i class="fa-solid fa-trash"></i>
                            </span>

                            <h4>{{ $class->class_name }}</h4>

                            <div class="card-info">
                                Sections: {{ $class->sections }}<br>
                                Students: {{ $class->total_students }}
                            </div>

                            <div class="card-actions">
                                <button class="btn-sm btn-outline"
                                        onclick="openEditModal({{ $class }})">
                                    Edit Records
                                </button>

                                <button class="btn-sm btn-solid">
                                    Procure Set
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
            <form id="addClassForm">
            @csrf
                <h3 class="modal-title">Add Class</h3>

                <!-- BASIC CLASS DETAILS -->
                <div class="form-section">
                    <h4>BASIC CLASS DETAILS</h4>
                    <div class="form-grid">
                        <div>
                            <label>Class Name</label>
                            <input type="text" name="class_name" placeholder="Class Name">
                        </div>

                        <div>
                            <label>Academic Session</label>
                            <select name="academic_session" id="">
                                <option value="">Select Academic Session</option>
                                <option value="2024-25">2024-25</option>
                                <option value="2025-26">2025-26</option>
                                <option value="2026-27">2026-27</option>
                                <option value="2027-28">2027-28</option>
                            </select>
                        </div>

                        <div>
                            <label>Board</label>
                            <select name="board">
                                <option value="">Select Board</option>
                                <option value="CBSE">CBSE</option>
                                <option value="ICSE">ICSE</option>
                                <option value="State Board">State Board</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label>Medium of Instruction</label>
                            <select name="medium">
                                <option value="">Select Medium of Instruction</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Regional">Regional</option>
                            </select>
                        </div>

                        <div>
                            <label>Sections Count</label>
                            <input type="number" name="sections" placeholder="Sections">
                        </div>
                    </div>
                </div>

                <!-- STUDENT INFORMATION -->
                <div class="form-section">
                    <h4>STUDENT INFORMATION</h4>
                    <div class="form-grid">
                        <div>
                            <label>Total Students</label>
                            <input type="number"  name="total_students">
                        </div>

                        <div>
                            <label>Boys</label>
                            <input type="number" name="boys">
                        </div>

                        <div>
                            <label>Girls</label>
                            <input type="number" name="girls">
                        </div>

                        <div>
                            <label>Expected New Admissions</label>
                            <input type="number" name="expected_admissions">
                        </div>
                    </div>
                </div>

                <!-- ACADEMIC DETAILS -->
                <div class="form-section">
                    <h4>ACADEMIC DETAILS</h4>
                    <div class="form-grid three">
                        <div>
                            <label>Subjects Offered</label>
                            <input type="text" name="subjects">
                        </div>

                        <div>
                            <label>Prescribed Book Publisher</label>
                            <input type="text" name="publisher">
                        </div>

                        <div>
                            <label>Syllabus Pattern</label>
                            <input type="text" name="syllabus">
                        </div>
                    </div>
                </div>


                <!-- ACTIONS -->
                <div class="modal-actions">
                    <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                    <button class="btn-sm btn-solid" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>

    <!-- EDIT CLASS MODAL -->
    <div id="editClassModal" class="modal">
        <div class="modal-box large">

            <form id="editClassForm">
                @csrf
                <input type="hidden" name="id" id="edit_id">

                <h3 class="modal-title">Edit Class</h3>

                <!-- BASIC CLASS DETAILS -->
                <div class="form-section">
                    <h4>BASIC CLASS DETAILS</h4>
                    <div class="form-grid">

                        <div>
                            <label>Class Name</label>
                            <input type="text" name="class_name" id="edit_class_name">
                        </div>

                        <div>
                            <label>Academic Session</label>
                            <select name="academic_session" id="edit_academic_session">
                                <option value="">Select Academic Session</option>
                                <option value="2024-25">2024-25</option>
                                <option value="2025-26">2025-26</option>
                                <option value="2026-27">2026-27</option>
                                <option value="2027-28">2027-28</option>
                            </select>
                        </div>

                        <div>
                            <label>Board</label>
                            <select name="board" id="edit_board">
                                <option value="">Select Board</option>
                                <option value="CBSE">CBSE</option>
                                <option value="ICSE">ICSE</option>
                                <option value="State Board">State Board</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div>
                            <label>Medium of Instruction</label>
                            <select name="medium" id="edit_medium">
                                <option value="">Select Medium</option>
                                <option value="English">English</option>
                                <option value="Hindi">Hindi</option>
                                <option value="Regional">Regional</option>
                            </select>
                        </div>

                        <div>
                            <label>Sections Count</label>
                            <input type="number" name="sections" id="edit_sections">
                        </div>

                    </div>
                </div>

                <!-- STUDENT INFORMATION -->
                <div class="form-section">
                    <h4>STUDENT INFORMATION</h4>
                    <div class="form-grid">
                        <input type="number" name="total_students" id="edit_total_students" placeholder="Total Students">
                        <input type="number" name="boys" id="edit_boys" placeholder="Boys">
                        <input type="number" name="girls" id="edit_girls" placeholder="Girls">
                        <input type="number" name="expected_admissions" id="edit_expected_admissions" placeholder="Expected New Admissions">
                    </div>
                </div>

                <!-- ACADEMIC DETAILS -->
                <div class="form-section">
                    <h4>ACADEMIC DETAILS</h4>
                    <div class="form-grid three">
                        <input type="text" name="subjects" id="edit_subjects" placeholder="Subjects Offered">
                        <input type="text" name="publisher" id="edit_publisher" placeholder="Book Publisher">
                        <input type="text" name="syllabus" id="edit_syllabus" placeholder="Syllabus Pattern">
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="modal-actions">
                    <button type="button" class="btn-sm btn-outline" onclick="closeModal();">Cancel</button>
                    <button type="submit" class="btn-sm btn-solid">Update</button>
                </div>

            </form>
        </div>
    </div>


    <div id="deleteClassModal" class="modal">
        <div class="modal-box">
            <h3>Delete Class</h3>
            <p id="deleteText" style="margin-bottom:15px;color:#555;">
                Are you sure?
            </p>

            <div class="modal-actions">
                <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                <button class="btn-sm btn-solid danger" onclick="deleteClass()">Delete</button>
            </div>
        </div>
    </div>

    <script>
        // add class
        document.getElementById('addClassForm').addEventListener('submit', function(e) {
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

            fetch("{{ route('admin.save-class') }}", {
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
                        text: "Class added successfully",
                        duration: 3000,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "linear-gradient(135deg, #ff7a18, #ffb347)"
                    }).showToast();

                    setTimeout(() => location.reload(), 1000);
                }else{
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

        // update class
        document.getElementById('editClassForm').addEventListener('submit', function(e){
            e.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('admin.class.update') }}", {
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
                        text: "Class updated successfully",
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
            document.getElementById('addClassModal').style.display = 'flex';
        }

        function openEditModal(data) {

            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_class_name').value = data.class_name;
            document.getElementById('edit_academic_session').value = data.academic_session;
            document.getElementById('edit_board').value = data.board;
            document.getElementById('edit_medium').value = data.medium;
            document.getElementById('edit_sections').value = data.sections;
            document.getElementById('edit_total_students').value = data.total_students;
            document.getElementById('edit_boys').value = data.boys;
            document.getElementById('edit_girls').value = data.girls;
            document.getElementById('edit_expected_admissions').value = data.expected_admissions;
            document.getElementById('edit_subjects').value = data.subjects;
            document.getElementById('edit_publisher').value = data.publisher;
            document.getElementById('edit_syllabus').value = data.syllabus;

            document.getElementById('editClassModal').style.display = 'flex';
        }

        let deleteClassId = null;

        function openDeleteModal(id, className) {
            deleteClassId = id;

            document.getElementById('deleteText').innerText =
                `Are you sure you want to delete "${className}"? This action cannot be undone.`;

            document.getElementById('deleteClassModal').style.display = 'flex';
        }

        function deleteClass() {
            fetch("{{ route('admin.class.delete') }}", {
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
                        text: "Class deleted successfully",
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
            document.getElementById('addClassModal').style.display = 'none';
            document.getElementById('editClassModal').style.display = 'none';
            document.getElementById('deleteClassModal').style.display = 'none';
        }
    </script>


@endsection
