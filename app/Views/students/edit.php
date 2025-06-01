<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-user-edit me-2"></i>Edit Student
                    </h4>
                </div>
                <div class="card-body">
                    <form id="editStudentForm" method="post" action="<?= base_url('students/update/' . $student['id']) ?>" novalidate>
                        <?= csrf_field() ?>
                        
                        <!-- Personal Information -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="section-title">Personal Information</h5>
                                <hr class="section-divider">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="admission_no" class="form-label">Admission Number</label>
                                <input type="text" class="form-control" id="admission_no" name="admission_no" 
                                       value="<?= esc($student['admission_no'] ?? '') ?>" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="firstname" name="firstname" 
                                       value="<?= esc($student['firstname'] ?? '') ?>" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastname" name="lastname" 
                                       value="<?= esc($student['lastname'] ?? '') ?>" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= esc($student['email'] ?? '') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="mobileno" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="mobileno" name="mobileno" 
                                       value="<?= esc($student['mobileno'] ?? '') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="dob" name="dob" 
                                       value="<?= esc($student['dob'] ?? '') ?>" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male" <?= ($student['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                                    <option value="Female" <?= ($student['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-4">
                                <label for="blood_group" class="form-label">Blood Group</label>
                                <select class="form-select" id="blood_group" name="blood_group">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" <?= ($student['blood_group'] ?? '') === 'A+' ? 'selected' : '' ?>>A+</option>
                                    <option value="A-" <?= ($student['blood_group'] ?? '') === 'A-' ? 'selected' : '' ?>>A-</option>
                                    <option value="B+" <?= ($student['blood_group'] ?? '') === 'B+' ? 'selected' : '' ?>>B+</option>
                                    <option value="B-" <?= ($student['blood_group'] ?? '') === 'B-' ? 'selected' : '' ?>>B-</option>
                                    <option value="O+" <?= ($student['blood_group'] ?? '') === 'O+' ? 'selected' : '' ?>>O+</option>
                                    <option value="O-" <?= ($student['blood_group'] ?? '') === 'O-' ? 'selected' : '' ?>>O-</option>
                                    <option value="AB+" <?= ($student['blood_group'] ?? '') === 'AB+' ? 'selected' : '' ?>>AB+</option>
                                    <option value="AB-" <?= ($student['blood_group'] ?? '') === 'AB-' ? 'selected' : '' ?>>AB-</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <!-- Academic Information -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="section-title">Academic Information</h5>
                                <hr class="section-divider">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="session_id" class="form-label">Session <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="session_id" name="session_id" required>
                                    <option value="">Select Session</option>
                                    <?php if (!empty($sessions)): ?>
                                        <?php foreach ($sessions as $session): ?>
                                            <option value="<?= $session['id'] ?>" <?= ($student['session_id'] ?? '') == $session['id'] ? 'selected' : '' ?>>
                                                <?= esc($session['session']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="class_id" name="class_id" required>
                                    <option value="">Select Class</option>
                                    <?php if (!empty($classes)): ?>
                                        <?php foreach ($classes as $class): ?>
                                            <option value="<?= $class['id'] ?>" <?= ($student['class_id'] ?? '') == $class['id'] ? 'selected' : '' ?>>
                                                <?= esc($class['class']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="section_id" class="form-label">Section <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="section_id" name="section_id" required>
                                    <option value="">Select Section</option>
                                    <?php if (!empty($sections)): ?>
                                        <?php foreach ($sections as $section): ?>
                                            <option value="<?= $section['id'] ?>" <?= ($student['section_id'] ?? '') == $section['id'] ? 'selected' : '' ?>>
                                                <?= esc($section['section']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-3">
                                <label for="is_active" class="form-label">Status</label>
                                <select class="form-select" id="is_active" name="is_active">
                                    <option value="yes" <?= ($student['is_active'] ?? 'yes') === 'yes' ? 'selected' : '' ?>>Active</option>
                                    <option value="no" <?= ($student['is_active'] ?? 'yes') === 'no' ? 'selected' : '' ?>>Inactive</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <!-- Guardian Information -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="section-title">Guardian Information</h5>
                                <hr class="section-divider">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="father_name" class="form-label">Father's Name</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" 
                                       value="<?= esc($student['father_name'] ?? '') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="mother_name" class="form-label">Mother's Name</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" 
                                       value="<?= esc($student['mother_name'] ?? '') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="guardian_phone" class="form-label">Guardian Phone</label>
                                <input type="text" class="form-control" id="guardian_phone" name="guardian_phone" 
                                       value="<?= esc($student['guardian_phone'] ?? '') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="guardian_email" class="form-label">Guardian Email</label>
                                <input type="email" class="form-control" id="guardian_email" name="guardian_email" 
                                       value="<?= esc($student['guardian_email'] ?? '') ?>">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <!-- Address Information -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="section-title">Address Information</h5>
                                <hr class="section-divider">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="current_address" class="form-label">Current Address</label>
                                <textarea class="form-control" id="current_address" name="current_address" rows="3"><?= esc($student['current_address'] ?? '') ?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="permanent_address" class="form-label">Permanent Address</label>
                                <textarea class="form-control" id="permanent_address" name="permanent_address" rows="3"><?= esc($student['permanent_address'] ?? '') ?></textarea>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?= base_url('students') ?>" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Update Student
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });
    
    // Load sections when class is selected
    $('#class_id').on('change', function() {
        const classId = $(this).val();
        const sectionSelect = $('#section_id');
        const currentSectionId = '<?= $student['section_id'] ?? '' ?>';
        
        sectionSelect.empty().append('<option value="">Select Section</option>');
        
        if (classId) {
            $.ajax({
                url: `<?= base_url('classes/sections') ?>/${classId}`,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 200 && response.data) {
                        response.data.forEach(function(section) {
                            const selected = section.id == currentSectionId ? 'selected' : '';
                            sectionSelect.append(`<option value="${section.id}" ${selected}>${section.section}</option>`);
                        });
                    }
                },
                error: function() {
                    toastr.error('Failed to load sections');
                }
            });
        }
    });
    
    // Form validation and submission
    $('#editStudentForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        
        // Clear previous validation errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        
        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                hideLoading();
                
                if (response.status === 200) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = '<?= base_url('students') ?>';
                    }, 1000);
                } else {
                    toastr.error(response.message);
                    
                    // Display validation errors
                    if (response.data && typeof response.data === 'object') {
                        Object.keys(response.data).forEach(function(field) {
                            const input = $(`[name="${field}"]`);
                            input.addClass('is-invalid');
                            input.siblings('.invalid-feedback').text(response.data[field]);
                        });
                    }
                }
            },
            error: function() {
                hideLoading();
                toastr.error('An error occurred while updating the student');
            }
        });
    });
});
</script>
