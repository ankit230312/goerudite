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
                <div class="class-card">
                    <span class="badge">Active</span>
                    <span class="delete-icon" onclick="openDeleteModal('Class 1')"> <i class="fa-solid fa-trash"></i></span>
                    <h4>Class 1</h4>
                    <div class="card-info">
                        Sections: 3<br>
                        Students: 120
                    </div>
                    <div class="card-actions">
                        <button class="btn-sm btn-outline"  onclick="openEditModal('Class 1',3,120)"; >Edit Records</button>
                        <button class="btn-sm btn-solid">Procure Set</button>
                    </div>
                </div>

                <!-- Duplicate for more classes -->
                <div class="class-card"><span class="badge">Active</span>
                    <span class="delete-icon" onclick="openDeleteModal('Class 1')"> <i class="fa-solid fa-trash"></i></span><h4>Class 2</h4><div class="card-info">Sections: 3<br>Students: 120</div><div class="card-actions"><button class="btn-sm btn-outline">Edit Records</button><button class="btn-sm btn-solid">Procure Set</button></div></div>
                <div class="class-card"><span class="badge">Active</span>
                    <span class="delete-icon" onclick="openDeleteModal('Class 1')"> <i class="fa-solid fa-trash"></i></span><h4>Class 3</h4><div class="card-info">Sections: 3<br>Students: 120</div><div class="card-actions"><button class="btn-sm btn-outline">Edit Records</button><button class="btn-sm btn-solid">Procure Set</button></div></div>
                <div class="class-card"><span class="badge">Active</span>
                    <span class="delete-icon" onclick="openDeleteModal('Class 1')"> <i class="fa-solid fa-trash"></i></span><h4>Class 4</h4><div class="card-info">Sections: 3<br>Students: 120</div><div class="card-actions"><button class="btn-sm btn-outline">Edit Records</button><button class="btn-sm btn-solid">Procure Set</button></div></div>
                <div class="class-card"><span class="badge">Active</span>
                    <span class="delete-icon" onclick="openDeleteModal('Class 1')"> <i class="fa-solid fa-trash"></i></span><h4>Class 4</h4><div class="card-info">Sections: 3<br>Students: 120</div><div class="card-actions"><button class="btn-sm btn-outline">Edit Records</button><button class="btn-sm btn-solid">Procure Set</button></div></div>
                <div class="class-card"><span class="badge">Active</span>
                    <span class="delete-icon" onclick="openDeleteModal('Class 1')"> <i class="fa-solid fa-trash"></i></span><h4>Class 4</h4><div class="card-info">Sections: 3<br>Students: 120</div><div class="card-actions"><button class="btn-sm btn-outline">Edit Records</button><button class="btn-sm btn-solid">Procure Set</button></div></div>
            </div>

            <!-- <div class="tip">
                <strong>Pro Tip:</strong> Update student counts regularly. RFQs auto-calculate with 2% safety buffer.
            </div> -->
        


    </main>
    <!-- ADD CLASS MODAL -->
    <div id="addClassModal" class="modal">
        <div class="modal-box large">

            <h3 class="modal-title">Add Class</h3>

            <!-- BASIC CLASS DETAILS -->
            <div class="form-section">
                <h4>BASIC CLASS DETAILS</h4>
                <div class="form-grid">
                    <div>
                        <label>Class Name</label>
                        <input type="text" placeholder="Class Name">
                    </div>

                    <div>
                        <label>Academic Session</label>
                        <select name="" id="">
                            <option value="">2024-25</option>
                            <option value="">2025-26</option>
                            <option value="">2026-27</option>
                            <option value="">2027-28</option>
                        </select>
                    </div>

                    <div>
                        <label>Board</label>
                        <select>
                            <option value="">Select Board</option>
                            <option value="">CBSE</option>
                            <option value="">ICSE</option>
                            <option value="">State Board</option>
                            <option value="">Other</option>
                        </select>
                    </div>

                    <div>
                        <label>Medium of Instruction</label>
                        <select>
                            <option value="">Select Medium of Instruction</option>
                            <option value="">English</option>
                            <option value="">Hindi</option>
                            <option value="">Regional</option>
                        </select>
                    </div>

                    <div>
                        <label>Sections Count</label>
                        <input type="number" placeholder="Sections">
                    </div>
                </div>
            </div>

            <!-- STUDENT INFORMATION -->
            <div class="form-section">
                <h4>STUDENT INFORMATION</h4>
                <div class="form-grid">
                    <div>
                        <label>Total Students</label>
                        <input type="number">
                    </div>

                    <div>
                        <label>Boys</label>
                        <input type="number">
                    </div>

                    <div>
                        <label>Girls</label>
                        <input type="number">
                    </div>

                    <div>
                        <label>Expected New Admissions</label>
                        <input type="number">
                    </div>
                </div>
            </div>

            <!-- ACADEMIC DETAILS -->
            <div class="form-section">
                <h4>ACADEMIC DETAILS</h4>
                <div class="form-grid three">
                    <div>
                        <label>Subjects Offered</label>
                        <input type="text">
                    </div>

                    <div>
                        <label>Prescribed Book Publisher</label>
                        <input type="text">
                    </div>

                    <div>
                        <label>Syllabus Pattern</label>
                        <input type="text">
                    </div>
                </div>
            </div>


            <!-- ACTIONS -->
            <div class="modal-actions">
                <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                <button class="btn-sm btn-solid">Save</button>
            </div>

        </div>
    </div>

    <!-- EDIT CLASS MODAL -->
    <div id="editClassModal" class="modal">
        <div class="modal-box large">

            <h3 class="modal-title">Edit Class</h3>

            <!-- BASIC CLASS DETAILS -->
            <div class="form-section">
                <h4>BASIC CLASS DETAILS</h4>
                <div class="form-grid">
                    <div>
                        <label>Class Name</label>
                        <input type="text" placeholder="Class Name">
                    </div>

                    <div>
                        <label>Academic Session</label>
                        <select name="" id="">
                            <option value="">2024-25</option>
                            <option value="">2025-26</option>
                            <option value="">2026-27</option>
                            <option value="">2027-28</option>
                        </select>
                    </div>

                    <div>
                        <label>Board</label>
                        <select>
                            <option value="">Select Board</option>
                            <option value="">CBSE</option>
                            <option value="">ICSE</option>
                            <option value="">State Board</option>
                            <option value="">Other</option>
                        </select>
                    </div>

                    <div>
                        <label>Medium of Instruction</label>
                        <select>
                            <option value="">Select Medium of Instruction</option>
                            <option value="">English</option>
                            <option value="">Hindi</option>
                            <option value="">Regional</option>
                        </select>
                    </div>

                    <div>
                        <label>Sections Count</label>
                        <input type="number" placeholder="Sections">
                    </div>
                </div>
            </div>

            <!-- STUDENT INFORMATION -->
            <div class="form-section">
                <h4>STUDENT INFORMATION</h4>
                <div class="form-grid">
                    <div>
                        <label>Total Students</label>
                        <input type="number">
                    </div>

                    <div>
                        <label>Boys</label>
                        <input type="number">
                    </div>

                    <div>
                        <label>Girls</label>
                        <input type="number">
                    </div>

                    <div>
                        <label>Expected New Admissions</label>
                        <input type="number">
                    </div>
                </div>
            </div>

            <!-- ACADEMIC DETAILS -->
            <div class="form-section">
                <h4>ACADEMIC DETAILS</h4>
                <div class="form-grid three">
                    <div>
                        <label>Subjects Offered</label>
                        <input type="text">
                    </div>

                    <div>
                        <label>Prescribed Book Publisher</label>
                        <input type="text">
                    </div>

                    <div>
                        <label>Syllabus Pattern</label>
                        <input type="text">
                    </div>
                </div>
            </div>


            <!-- ACTIONS -->
            <div class="modal-actions">
                <button class="btn-sm btn-outline" onclick="closeModal()">Cancel</button>
                <button class="btn-sm btn-solid">Update</button>
            </div>

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
                <button class="btn-sm btn-solid danger">Delete</button>
            </div>
        </div>
    </div>

    <script>
        function openAddModal() {
            document.getElementById('addClassModal').style.display = 'flex';
        }

        function openEditModal(name, sections, students) {
            //document.getElementById('editClassName').value = name;
            //document.getElementById('editSections').value = sections;
            //document.getElementById('editStudents').value = students;
            document.getElementById('editClassModal').style.display = 'flex';
        }

        let deleteClassName = '';

        function openDeleteModal(className) {
            deleteClassName = className;
            document.getElementById('deleteText').innerText =
                `Are you sure you want to delete ${className}? This action cannot be undone.`;

            document.getElementById('deleteClassModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('addClassModal').style.display = 'none';
            document.getElementById('editClassModal').style.display = 'none';
            document.getElementById('deleteClassModal').style.display = 'none';
        }
    </script>


@endsection
