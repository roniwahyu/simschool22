<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="welcome-title">Module Generator</h2>
                        <p class="welcome-text">Generate complete CRUD modules with models, controllers, and views</p>
                    </div>
                    <div class="welcome-actions">
                        <a href="<?= base_url('module-generator/create') ?>" class="btn btn-primary me-2">
                            <i class="fas fa-plus me-2"></i>Generate Module
                        </a>
                        <a href="<?= base_url('module-generator/form-builder') ?>" class="btn btn-outline-primary">
                            <i class="fas fa-wpforms me-2"></i>Form Builder
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Features -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="card h-100 border-primary">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs me-2"></i>CRUD Generator
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Generate complete CRUD (Create, Read, Update, Delete) modules with:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Model with validation rules</li>
                        <li><i class="fas fa-check text-success me-2"></i>Controller with all CRUD methods</li>
                        <li><i class="fas fa-check text-success me-2"></i>Views (List, Create, Edit)</li>
                        <li><i class="fas fa-check text-success me-2"></i>DataTables integration</li>
                        <li><i class="fas fa-check text-success me-2"></i>Form validation</li>
                    </ul>
                    <div class="d-grid">
                        <a href="<?= base_url('module-generator/create') ?>" class="btn btn-primary">
                            <i class="fas fa-rocket me-1"></i>Start Generation
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <div class="card h-100 border-success">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-wpforms me-2"></i>Form Builder
                    </h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Build dynamic forms with drag-and-drop interface:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success me-2"></i>Drag & drop form fields</li>
                        <li><i class="fas fa-check text-success me-2"></i>Field validation rules</li>
                        <li><i class="fas fa-check text-success me-2"></i>Custom field properties</li>
                        <li><i class="fas fa-check text-success me-2"></i>Form preview</li>
                        <li><i class="fas fa-check text-success me-2"></i>Export form HTML</li>
                    </ul>
                    <div class="d-grid">
                        <a href="<?= base_url('module-generator/form-builder') ?>" class="btn btn-success">
                            <i class="fas fa-hammer me-1"></i>Build Form
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- How it Works -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-question-circle me-2"></i>How it Works
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <i class="fas fa-database fa-2x text-primary mb-2"></i>
                                <h6>Define Module</h6>
                                <p class="text-muted small">Specify module name, table name, and database fields</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <i class="fas fa-list fa-2x text-success mb-2"></i>
                                <h6>Configure Fields</h6>
                                <p class="text-muted small">Set field types, validation rules, and properties</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <i class="fas fa-magic fa-2x text-warning mb-2"></i>
                                <h6>Generate Code</h6>
                                <p class="text-muted small">Automatically generate model, controller, and views</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <i class="fas fa-check-circle fa-2x text-info mb-2"></i>
                                <h6>Ready to Use</h6>
                                <p class="text-muted small">Your complete CRUD module is ready for deployment</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Generated Modules History -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-history me-2"></i>Generated Modules
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">No modules generated yet</h5>
                        <p class="text-muted">Start by generating your first module using the CRUD Generator</p>
                        <a href="<?= base_url('module-generator/create') ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>Generate First Module
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.step-item {
    position: relative;
    padding: 1rem;
}

.step-number {
    position: absolute;
    top: 0;
    right: 1rem;
    background: #007bff;
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    font-weight: bold;
}
</style>
