<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i>Student Details
                        </h4>
                        <div class="card-actions">
                            <a href="<?= base_url('students/edit/' . $student['id']) ?>" class="btn btn-primary me-2">
                                <i class="fas fa-edit me-1"></i>Edit Student
                            </a>
                            <a href="<?= base_url('students') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to List
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Student Photo -->
                        <div class="col-md-3 text-center mb-4">
                            <div class="student-photo-container">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($student['firstname'] . ' ' . $student['lastname']) ?>&size=200&background=007bff&color=fff" 
                                     alt="<?= esc($student['firstname']) ?>" class="student-photo rounded-circle mb-3">
                                <h5 class="text-primary"><?= esc($student['firstname'] . ' ' . $student['lastname']) ?></h5>
                                <p class="text-muted">Admission No: <?= esc($student['admission_no'] ?? 'N/A') ?></p>
                                <?php if (($student['is_active'] ?? 'yes') === 'yes'): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Student Information -->
                        <div class="col-md-9">
                            <!-- Personal Information -->
                            <div class="info-section mb-4">
                                <h5 class="section-title text-primary">
                                    <i class="fas fa-user me-2"></i>Personal Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold">First Name:</td>
                                                <td><?= esc($student['firstname'] ?? 'N/A') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Last Name:</td>
                                                <td><?= esc($student['lastname'] ?? 'N/A') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Email:</td>
                                                <td>
                                                    <?php if (!empty($student['email'])): ?>
                                                        <a href="mailto:<?= esc($student['email']) ?>"><?= esc($student['email']) ?></a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Mobile:</td>
                                                <td>
                                                    <?php if (!empty($student['mobileno'])): ?>
                                                        <a href="tel:<?= esc($student['mobileno']) ?>"><?= esc($student['mobileno']) ?></a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold">Date of Birth:</td>
                                                <td>
                                                    <?php if (!empty($student['dob'])): ?>
                                                        <?= date('d M, Y', strtotime($student['dob'])) ?>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Gender:</td>
                                                <td><?= esc($student['gender'] ?? 'N/A') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Blood Group:</td>
                                                <td><?= esc($student['blood_group'] ?? 'N/A') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Enrolled:</td>
                                                <td>
                                                    <?php if (!empty($student['created_at'])): ?>
                                                        <?= date('d M, Y', strtotime($student['created_at'])) ?>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Academic Information -->
                            <div class="info-section mb-4">
                                <h5 class="section-title text-success">
                                    <i class="fas fa-graduation-cap me-2"></i>Academic Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="academic-card">
                                            <div class="academic-icon">
                                                <i class="fas fa-calendar-alt"></i>
                                            </div>
                                            <div class="academic-info">
                                                <h6>Session</h6>
                                                <p><?= esc($student['session_name'] ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="academic-card">
                                            <div class="academic-icon">
                                                <i class="fas fa-chalkboard"></i>
                                            </div>
                                            <div class="academic-info">
                                                <h6>Class</h6>
                                                <p><?= esc($student['class_name'] ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="academic-card">
                                            <div class="academic-icon">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                            <div class="academic-info">
                                                <h6>Section</h6>
                                                <p><?= esc($student['section_name'] ?? 'N/A') ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Guardian Information -->
                            <?php if (!empty($student['father_name']) || !empty($student['mother_name']) || !empty($student['guardian_phone'])): ?>
                            <div class="info-section mb-4">
                                <h5 class="section-title text-warning">
                                    <i class="fas fa-users me-2"></i>Guardian Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold">Father's Name:</td>
                                                <td><?= esc($student['father_name'] ?? 'N/A') ?></td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Mother's Name:</td>
                                                <td><?= esc($student['mother_name'] ?? 'N/A') ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-borderless">
                                            <tr>
                                                <td class="fw-semibold">Guardian Phone:</td>
                                                <td>
                                                    <?php if (!empty($student['guardian_phone'])): ?>
                                                        <a href="tel:<?= esc($student['guardian_phone']) ?>"><?= esc($student['guardian_phone']) ?></a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">Guardian Email:</td>
                                                <td>
                                                    <?php if (!empty($student['guardian_email'])): ?>
                                                        <a href="mailto:<?= esc($student['guardian_email']) ?>"><?= esc($student['guardian_email']) ?></a>
                                                    <?php else: ?>
                                                        N/A
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <!-- Address Information -->
                            <?php if (!empty($student['current_address']) || !empty($student['permanent_address'])): ?>
                            <div class="info-section mb-4">
                                <h5 class="section-title text-info">
                                    <i class="fas fa-map-marker-alt me-2"></i>Address Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="address-card">
                                            <h6>Current Address</h6>
                                            <p><?= nl2br(esc($student['current_address'] ?? 'N/A')) ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="address-card">
                                            <h6>Permanent Address</h6>
                                            <p><?= nl2br(esc($student['permanent_address'] ?? 'N/A')) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.student-photo {
    width: 200px;
    height: 200px;
    object-fit: cover;
    border: 4px solid #007bff;
}

.info-section {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 0.5rem;
    border-left: 4px solid #007bff;
}

.section-title {
    margin-bottom: 1rem;
    font-weight: 600;
}

.academic-card {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 1rem;
}

.academic-icon {
    font-size: 2rem;
    color: #28a745;
    margin-bottom: 0.5rem;
}

.academic-info h6 {
    color: #6c757d;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.academic-info p {
    margin: 0;
    font-weight: 600;
    color: #212529;
}

.address-card {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
}

.address-card h6 {
    color: #17a2b8;
    margin-bottom: 0.5rem;
}
</style>
