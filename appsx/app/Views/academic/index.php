<div class="container-fluid">
    <!-- Academic Overview -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="welcome-title">Academic Management</h2>
                        <p class="welcome-text">Manage sessions, subjects, and academic configurations</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Current Session Info -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Current Academic Session
                    </h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($active_session)): ?>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h3 class="text-primary mb-1"><?= esc($active_session['session']) ?></h3>
                                <p class="text-muted mb-0">Active Session</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="<?= base_url('academic/sessions') ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-cog me-1"></i>Manage Sessions
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <h5>No Active Session Found</h5>
                            <p class="text-muted">Please create and activate an academic session to continue.</p>
                            <a href="<?= base_url('academic/sessions') ?>" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Create Session
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Academic Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-primary">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number"><?= $total_sessions ?? 0 ?></h3>
                        <p class="stats-label">Total Sessions</p>
                        <div class="stats-change">
                            <a href="<?= base_url('academic/sessions') ?>" class="btn btn-sm btn-outline-primary">
                                Manage
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-success">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number"><?= $total_subjects ?? 0 ?></h3>
                        <p class="stats-label">Total Subjects</p>
                        <div class="stats-change">
                            <a href="<?= base_url('academic/subjects') ?>" class="btn btn-sm btn-outline-success">
                                Manage
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-warning">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number">0</h3>
                        <p class="stats-label">Exams</p>
                        <div class="stats-change">
                            <span class="text-muted">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-info">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number">0</h3>
                        <p class="stats-label">Assessments</p>
                        <div class="stats-change">
                            <span class="text-muted">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-calendar-alt me-2"></i>Session Management
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Manage academic sessions, set active session, and configure session settings.</p>
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('academic/sessions') ?>" class="btn btn-primary">
                            <i class="fas fa-cog me-1"></i>Manage Sessions
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-book me-2"></i>Subject Management
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Configure subjects, subject groups, and assign subjects to classes.</p>
                    <div class="d-grid gap-2">
                        <a href="<?= base_url('academic/subjects') ?>" class="btn btn-success">
                            <i class="fas fa-book me-1"></i>Manage Subjects
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Coming Soon Features -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-rocket me-2"></i>Coming Soon Features
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="coming-soon-item">
                                <i class="fas fa-file-alt fa-3x text-muted mb-2"></i>
                                <h6>Exam Management</h6>
                                <p class="text-muted small">Create and manage exams</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="coming-soon-item">
                                <i class="fas fa-chart-bar fa-3x text-muted mb-2"></i>
                                <h6>Grade Management</h6>
                                <p class="text-muted small">Configure grading system</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="coming-soon-item">
                                <i class="fas fa-calendar-check fa-3x text-muted mb-2"></i>
                                <h6>Attendance Tracking</h6>
                                <p class="text-muted small">Track student attendance</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="coming-soon-item">
                                <i class="fas fa-award fa-3x text-muted mb-2"></i>
                                <h6>Certificates</h6>
                                <p class="text-muted small">Generate certificates</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.coming-soon-item {
    padding: 1rem;
    border-radius: 0.5rem;
    background: #f8f9fa;
}
</style>
