<div class="container-fluid">
    <div class="row">
        <!-- Toolbox -->
        <div class="col-md-3">
            <div class="card sticky-top">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-toolbox me-2"></i>Form Elements
                    </h5>
                </div>
                <div class="card-body">
                    <div class="form-elements">
                        <!-- Basic Fields -->
                        <div class="element-group mb-3">
                            <h6 class="element-group-title">Basic Fields</h6>
                            <div class="element-item" draggable="true" data-type="text">
                                <i class="fas fa-font me-2"></i>Text Input
                            </div>
                            <div class="element-item" draggable="true" data-type="email">
                                <i class="fas fa-envelope me-2"></i>Email
                            </div>
                            <div class="element-item" draggable="true" data-type="number">
                                <i class="fas fa-hashtag me-2"></i>Number
                            </div>
                            <div class="element-item" draggable="true" data-type="textarea">
                                <i class="fas fa-align-left me-2"></i>Textarea
                            </div>
                        </div>
                        
                        <!-- Selection Fields -->
                        <div class="element-group mb-3">
                            <h6 class="element-group-title">Selection</h6>
                            <div class="element-item" draggable="true" data-type="select">
                                <i class="fas fa-list me-2"></i>Dropdown
                            </div>
                            <div class="element-item" draggable="true" data-type="checkbox">
                                <i class="fas fa-check-square me-2"></i>Checkbox
                            </div>
                            <div class="element-item" draggable="true" data-type="radio">
                                <i class="fas fa-dot-circle me-2"></i>Radio Buttons
                            </div>
                        </div>
                        
                        <!-- Date & Time -->
                        <div class="element-group mb-3">
                            <h6 class="element-group-title">Date & Time</h6>
                            <div class="element-item" draggable="true" data-type="date">
                                <i class="fas fa-calendar me-2"></i>Date
                            </div>
                            <div class="element-item" draggable="true" data-type="time">
                                <i class="fas fa-clock me-2"></i>Time
                            </div>
                            <div class="element-item" draggable="true" data-type="datetime">
                                <i class="fas fa-calendar-alt me-2"></i>Date & Time
                            </div>
                        </div>
                        
                        <!-- Advanced -->
                        <div class="element-group">
                            <h6 class="element-group-title">Advanced</h6>
                            <div class="element-item" draggable="true" data-type="file">
                                <i class="fas fa-file me-2"></i>File Upload
                            </div>
                            <div class="element-item" draggable="true" data-type="password">
                                <i class="fas fa-lock me-2"></i>Password
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Form Builder Area -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-wpforms me-2"></i>Form Builder
                    </h5>
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="clearForm()">
                            <i class="fas fa-trash me-1"></i>Clear
                        </button>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="previewForm()">
                            <i class="fas fa-eye me-1"></i>Preview
                        </button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="saveForm()">
                            <i class="fas fa-save me-1"></i>Save Form
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Form Settings -->
                    <div class="form-settings mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formName" class="form-label">Form Name</label>
                                    <input type="text" class="form-control" id="formName" placeholder="Enter form name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formMethod" class="form-label">Form Method</label>
                                    <select class="form-select" id="formMethod">
                                        <option value="POST">POST</option>
                                        <option value="GET">GET</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Drop Zone -->
                    <div class="drop-zone" id="formDropZone">
                        <div class="drop-zone-content">
                            <i class="fas fa-mouse-pointer fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">Drag form elements here</h5>
                            <p class="text-muted">Start building your form by dragging elements from the toolbox</p>
                        </div>
                    </div>
                    
                    <!-- Form Fields Container -->
                    <div class="form-fields-container" id="formFieldsContainer">
                        <!-- Form fields will be added here -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Properties Panel -->
        <div class="col-md-3">
            <div class="card sticky-top">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cog me-2"></i>Properties
                    </h5>
                </div>
                <div class="card-body">
                    <div id="propertiesPanel">
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-hand-pointer fa-3x mb-3"></i>
                            <p>Select a form field to edit its properties</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Preview Modal -->
<div class="modal fade" id="formPreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="formPreviewContent">
                    <!-- Form preview will be displayed here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="exportFormHTML()">
                    <i class="fas fa-download me-1"></i>Export HTML
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Field Property Template -->
<template id="fieldPropertiesTemplate">
    <div class="field-properties">
        <div class="mb-3">
            <label class="form-label">Field Name</label>
            <input type="text" class="form-control field-prop" data-prop="name" placeholder="Field name">
        </div>
        <div class="mb-3">
            <label class="form-label">Label</label>
            <input type="text" class="form-control field-prop" data-prop="label" placeholder="Field label">
        </div>
        <div class="mb-3">
            <label class="form-label">Placeholder</label>
            <input type="text" class="form-control field-prop" data-prop="placeholder" placeholder="Placeholder text">
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input field-prop" type="checkbox" data-prop="required">
                <label class="form-check-label">Required</label>
            </div>
        </div>
        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input field-prop" type="checkbox" data-prop="readonly">
                <label class="form-check-label">Read Only</label>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">CSS Classes</label>
            <input type="text" class="form-control field-prop" data-prop="class" placeholder="Additional CSS classes">
        </div>
        <div class="mb-3">
            <button type="button" class="btn btn-danger btn-sm w-100" onclick="removeField()">
                <i class="fas fa-trash me-1"></i>Remove Field
            </button>
        </div>
    </div>
</template>

<script src="<?= base_url('assets/js/form-builder.js') ?>"></script>

<style>
.element-group-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.5rem;
}

.element-item {
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    cursor: grab;
    transition: all 0.2s ease;
}

.element-item:hover {
    background: #e9ecef;
    border-color: #007bff;
    transform: translateY(-1px);
}

.element-item:active {
    cursor: grabbing;
}

.drop-zone {
    min-height: 200px;
    border: 2px dashed #dee2e6;
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.drop-zone.drag-over {
    border-color: #007bff;
    background: rgba(0, 123, 255, 0.1);
}

.drop-zone-content {
    text-align: center;
    padding: 2rem;
}

.form-fields-container {
    min-height: 100px;
}

.form-field-item {
    position: relative;
    margin-bottom: 1rem;
    padding: 1rem;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    background: #fff;
    cursor: pointer;
}

.form-field-item:hover {
    border-color: #007bff;
}

.form-field-item.selected {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.field-controls {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    display: none;
}

.form-field-item:hover .field-controls {
    display: block;
}

.sticky-top {
    top: 1rem;
}
</style>
