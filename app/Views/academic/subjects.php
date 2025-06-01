<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-book me-2"></i>Subject Management
                        </h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSubjectModal">
                            <i class="fas fa-plus me-1"></i>Add New Subject
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Group</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($subjects)): ?>
                                    <?php foreach ($subjects as $subject): ?>
                                        <tr>
                                            <td><strong><?= esc($subject['name']) ?></strong></td>
                                            <td><code><?= esc($subject['code']) ?></code></td>
                                            <td>
                                                <?php if ($subject['type'] === 'Theory'): ?>
                                                    <span class="badge bg-primary">Theory</span>
                                                <?php else: ?>
                                                    <span class="badge bg-info">Practical</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= esc($subject['group_name'] ?? 'N/A') ?></td>
                                            <td>
                                                <?php if ($subject['is_active'] === 'yes'): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary" onclick="editSubject(<?= $subject['id'] ?>)">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="fas fa-book fa-3x text-muted mb-3 d-block"></i>
                                            <p class="text-muted">No subjects found. Create your first subject.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Subject Modal -->
<div class="modal fade" id="createSubjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createSubjectForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Subject Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required 
                               placeholder="e.g., Mathematics, English">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="code" class="form-label">Subject Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code" name="code" required 
                               placeholder="e.g., MATH101, ENG101">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Subject Type <span class="text-danger">*</span></label>
                        <select class="form-select" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Theory">Theory</option>
                            <option value="Practical">Practical</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/academic.js') ?>"></script>
