<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-calendar-alt me-2"></i>Academic Sessions
                        </h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSessionModal">
                            <i class="fas fa-plus me-1"></i>Add New Session
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Session</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($sessions)): ?>
                                    <?php foreach ($sessions as $session): ?>
                                        <tr>
                                            <td>
                                                <strong><?= esc($session['session']) ?></strong>
                                            </td>
                                            <td>
                                                <?php if ($session['is_active'] === 'yes'): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= date('d M, Y', strtotime($session['created_at'])) ?></td>
                                            <td>
                                                <?php if ($session['is_active'] !== 'yes'): ?>
                                                    <button class="btn btn-sm btn-outline-success" onclick="activateSession(<?= $session['id'] ?>)">
                                                        <i class="fas fa-check"></i> Activate
                                                    </button>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <i class="fas fa-calendar-alt fa-3x text-muted mb-3 d-block"></i>
                                            <p class="text-muted">No sessions found. Create your first academic session.</p>
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

<!-- Create Session Modal -->
<div class="modal fade" id="createSessionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="createSessionForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="session" class="form-label">Session Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="session" name="session" required 
                               placeholder="e.g., 2024-2025">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="yes">
                            <label class="form-check-label" for="is_active">
                                Set as active session
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/academic.js') ?>"></script>
