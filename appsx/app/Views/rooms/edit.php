<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Room
                    </h4>
                </div>
                <div class="card-body">
                    <form id="editRoomForm" method="post" action="<?= base_url('rooms/update/' . $room['id']) ?>" novalidate>
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="room_no" class="form-label">Room Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="room_no" name="room_no" 
                                           value="<?= esc($room['room_no'] ?? '') ?>" required
                                           placeholder="Enter room number (e.g., 101, A-205)">
                                    <div class="invalid-feedback"></div>
                                    <div class="form-text">Enter a unique room number</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="room_type" class="form-label">Room Type <span class="text-danger">*</span></label>
                                    <select class="form-select" id="room_type" name="room_type" required>
                                        <option value="">Select Room Type</option>
                                        <option value="classroom" <?= ($room['room_type'] ?? '') === 'classroom' ? 'selected' : '' ?>>Classroom</option>
                                        <option value="laboratory" <?= ($room['room_type'] ?? '') === 'laboratory' ? 'selected' : '' ?>>Laboratory</option>
                                        <option value="library" <?= ($room['room_type'] ?? '') === 'library' ? 'selected' : '' ?>>Library</option>
                                        <option value="auditorium" <?= ($room['room_type'] ?? '') === 'auditorium' ? 'selected' : '' ?>>Auditorium</option>
                                        <option value="other" <?= ($room['room_type'] ?? '') === 'other' ? 'selected' : '' ?>>Other</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="is_active" class="form-label">Status</label>
                                    <select class="form-select" id="is_active" name="is_active">
                                        <option value="yes" <?= ($room['is_active'] ?? 'yes') === 'yes' ? 'selected' : '' ?>>Active</option>
                                        <option value="no" <?= ($room['is_active'] ?? 'yes') === 'no' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="number" class="form-control" id="capacity" name="capacity" min="1"
                                           value="<?= esc($room['capacity'] ?? '') ?>"
                                           placeholder="Enter room capacity">
                                    <div class="invalid-feedback"></div>
                                    <div class="form-text">Maximum number of people the room can accommodate</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"
                                              placeholder="Enter room description, facilities, equipment, etc."><?= esc($room['description'] ?? '') ?></textarea>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Form Actions -->
                        <div class="row">
                            <div class="col-12">
                                <hr>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="<?= base_url('rooms') ?>" class="btn btn-secondary">
                                        <i class="fas fa-times me-1"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-1"></i>Update Room
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
    $('#editRoomForm').on('submit', function(e) {
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
                        window.location.href = '<?= base_url('rooms') ?>';
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
                toastr.error('An error occurred while updating the room');
            }
        });
    });
});
</script>
