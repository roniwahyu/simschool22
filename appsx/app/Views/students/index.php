<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-user-graduate me-2"></i>Students Management
                        </h4>
                        <div class="card-actions">
                            <button class="btn btn-outline-secondary me-2" onclick="exportStudents()">
                                <i class="fas fa-download me-1"></i>Export
                            </button>
                            <button class="btn btn-outline-danger me-2" id="bulkDeleteBtn" style="display: none;">
                                <i class="fas fa-trash me-1"></i>Delete Selected
                            </button>
                            <a href="<?= base_url('students/create') ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Add New Student
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select class="form-select" id="classFilter">
                                <option value="">All Classes</option>
                                <!-- Options will be loaded via AJAX -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sectionFilter">
                                <option value="">All Sections</option>
                                <!-- Options will be loaded based on class selection -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="yes">Active</option>
                                <option value="no">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-outline-secondary" onclick="clearFilters()">
                                <i class="fas fa-times me-1"></i>Clear Filters
                            </button>
                        </div>
                    </div>
                    
                    <!-- DataTable -->
                    <div class="table-responsive">
                        <table id="studentsTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th>Admission No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Class</th>
                                    <th>Section</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Enrolled</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded via DataTables AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Student Modal -->
<div class="modal fade" id="viewStudentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="studentDetailsBody">
                <!-- Student details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/students.js') ?>"></script>
