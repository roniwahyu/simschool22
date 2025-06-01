<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>CRUD Module Generator
                    </h4>
                </div>
                <div class="card-body">
                    <form id="moduleGeneratorForm" novalidate>
                        <?= csrf_field() ?>
                        
                        <!-- Step 1: Module Information -->
                        <div class="step" id="step1">
                            <div class="step-header mb-4">
                                <h5 class="text-primary">
                                    <span class="step-number">1</span>
                                    Module Information
                                </h5>
                                <p class="text-muted">Define the basic information for your module</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="module_name" class="form-label">Module Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="module_name" name="module_name" required 
                                               placeholder="e.g., Product, Category, Employee">
                                        <div class="invalid-feedback"></div>
                                        <div class="form-text">Use singular form (e.g., Product not Products)</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="table_name" class="form-label">Database Table <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="table_name" name="table_name" required 
                                               placeholder="e.g., products, categories, employees">
                                        <div class="invalid-feedback"></div>
                                        <div class="form-text">Use plural form and snake_case</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="module_description" class="form-label">Description</label>
                                        <textarea class="form-control" id="module_description" name="module_description" rows="2"
                                                  placeholder="Brief description of what this module manages"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                                    Next <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 2: Field Configuration -->
                        <div class="step d-none" id="step2">
                            <div class="step-header mb-4">
                                <h5 class="text-primary">
                                    <span class="step-number">2</span>
                                    Field Configuration
                                </h5>
                                <p class="text-muted">Define the fields for your module</p>
                            </div>
                            
                            <div class="field-container">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6>Fields</h6>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addField()">
                                        <i class="fas fa-plus me-1"></i>Add Field
                                    </button>
                                </div>
                                
                                <div id="fieldsContainer">
                                    <!-- Fields will be added here dynamically -->
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="previousStep(1)">
                                    <i class="fas fa-arrow-left me-1"></i>Previous
                                </button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                    Next <i class="fas fa-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 3: Preview & Generate -->
                        <div class="step d-none" id="step3">
                            <div class="step-header mb-4">
                                <h5 class="text-primary">
                                    <span class="step-number">3</span>
                                    Preview & Generate
                                </h5>
                                <p class="text-muted">Review your configuration and generate the module</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="preview-card">
                                        <h6 class="text-success">Files to be Generated:</h6>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-file-code text-primary me-2"></i><code id="modelFile"></code></li>
                                            <li><i class="fas fa-file-code text-success me-2"></i><code id="controllerFile"></code></li>
                                            <li><i class="fas fa-file-code text-warning me-2"></i><code id="indexViewFile"></code></li>
                                            <li><i class="fas fa-file-code text-info me-2"></i><code id="createViewFile"></code></li>
                                            <li><i class="fas fa-file-code text-secondary me-2"></i><code id="editViewFile"></code></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="preview-card">
                                        <h6 class="text-info">Module Summary:</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <td><strong>Module Name:</strong></td>
                                                <td id="previewModuleName"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Table Name:</strong></td>
                                                <td id="previewTableName"></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Fields:</strong></td>
                                                <td id="previewFieldCount"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="previousStep(2)">
                                    <i class="fas fa-arrow-left me-1"></i>Previous
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-magic me-1"></i>Generate Module
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Field Template -->
<template id="fieldTemplate">
    <div class="field-item card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h6 class="card-title mb-0">Field <span class="field-number"></span></h6>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeField(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Field Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control field-name" required placeholder="e.g., name, email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Field Label <span class="text-danger">*</span></label>
                        <input type="text" class="form-control field-label" required placeholder="e.g., Full Name, Email">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label">Field Type <span class="text-danger">*</span></label>
                        <select class="form-select field-type" required>
                            <option value="">Select Type</option>
                            <option value="text">Text</option>
                            <option value="email">Email</option>
                            <option value="number">Number</option>
                            <option value="date">Date</option>
                            <option value="textarea">Textarea</option>
                            <option value="select">Select</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="radio">Radio</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input field-required" type="checkbox">
                        <label class="form-check-label">Required Field</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input field-searchable" type="checkbox">
                        <label class="form-check-label">Searchable</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="<?= base_url('assets/js/module-generator.js') ?>"></script>

<style>
.step-header {
    border-bottom: 2px solid #e9ecef;
    padding-bottom: 1rem;
}

.step-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    font-weight: bold;
    margin-right: 0.5rem;
}

.preview-card {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
    margin-bottom: 1rem;
}

.field-item {
    border-left: 4px solid #007bff;
}
</style>
