<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-chalkboard me-2"></i>Classes Management
                        </h4>
                        <div class="card-actions">
                            <a href="<?= base_url('classes/create') ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Add New Class
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- DataTable -->
                    <div class="table-responsive">
                        <table id="classesTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Class Name</th>
                                    <th>Sections</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
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

<!-- View Sections Modal -->
<div class="modal fade" id="viewSectionsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Class Sections</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="sectionsModalBody">
                <!-- Sections will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" id="addSectionBtn" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Add Section
                </a>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/classes.js') ?>"></script>
