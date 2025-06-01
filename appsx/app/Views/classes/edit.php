<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Class
                    </h4>
                </div>
                <div class="card-body">
                    <form id="editClassForm" method="post" action="<?= base_url('classes/update/' . $class['id']) ?>" novalidate>
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="class" class="form-label">Class Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="class" name="class" 
                                           value="<?= esc($class['class'] ?? '') ?>" required
                                           placeholder="Enter class name (e.g., Class 1, Grade 10)">
                                    <div class="invalid-feedback"></div>
                                    <div class="form-text">Enter a unique class name</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="yes" <?= ($class['is_active'] ?? 'yes') === 'yes' ? 'selected' : '' ?>>Active</option>
                                        <option value="no" <?= ($class['is_active'] ?? 'yes') === 'no' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?= base_url('classes') ?>" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Update Class
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
    // Form validation and submission
    $('#editClassForm').on('submit', function(e) {
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
                        window.location.href = '<?= base_url('classes') ?>';
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
                toastr.error('An error occurred while updating the class');
            }
        });
    });
});
</script>
