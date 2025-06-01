<?php
session_start();

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    switch($_POST['action']) {
        case 'save_form':
            echo saveForm($_POST);
            exit;
        case 'export_html':
            echo exportFormHTML($_POST);
            exit;
        case 'load_saved_forms':
            echo loadSavedForms();
            exit;
        case 'delete_form':
            echo deleteForm($_POST['form_id']);
            exit;
    }
}

function saveForm($data) {
    $formName = $data['form_name'];
    $formFields = json_decode($data['form_fields'], true);
    $formSettings = json_decode($data['form_settings'], true);
    
    // Create forms directory if it doesn't exist
    $formsDir = "../storage/forms";
    if (!file_exists($formsDir)) {
        mkdir($formsDir, 0755, true);
    }
    
    // Save form data
    $formData = [
        'name' => $formName,
        'fields' => $formFields,
        'settings' => $formSettings,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    $formId = uniqid();
    $fileName = $formsDir . '/' . $formId . '.json';
    
    if (file_put_contents($fileName, json_encode($formData, JSON_PRETTY_PRINT))) {
        return json_encode([
            'success' => true,
            'message' => 'Form saved successfully!',
            'form_id' => $formId
        ]);
    } else {
        return json_encode([
            'success' => false,
            'message' => 'Failed to save form'
        ]);
    }
}

function exportFormHTML($data) {
    $formFields = json_decode($data['form_fields'], true);
    $formSettings = json_decode($data['form_settings'], true);
    
    $html = generateFormHTML($formFields, $formSettings);
    
    return json_encode([
        'success' => true,
        'html' => $html
    ]);
}

function generateFormHTML($fields, $settings) {
    $formMethod = $settings['method'] ?? 'POST';
    $formAction = $settings['action'] ?? '#';
    $formClass = $settings['css_class'] ?? 'form';
    
    $html = "<form method=\"{$formMethod}\" action=\"{$formAction}\" class=\"{$formClass}\">\n";
    
    foreach ($fields as $field) {
        $html .= generateFieldHTML($field);
    }
    
    $html .= "    <div class=\"form-group\">\n";
    $html .= "        <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n";
    $html .= "        <button type=\"reset\" class=\"btn btn-secondary\">Reset</button>\n";
    $html .= "    </div>\n";
    $html .= "</form>";
    
    return $html;
}

function generateFieldHTML($field) {
    $fieldId = $field['id'] ?? 'field_' . uniqid();
    $fieldName = $field['name'] ?? $fieldId;
    $fieldLabel = $field['label'] ?? ucfirst($fieldName);
    $fieldType = $field['type'] ?? 'text';
    $fieldClass = $field['class'] ?? 'form-control';
    $fieldRequired = $field['required'] ? 'required' : '';
    $fieldPlaceholder = $field['placeholder'] ?? '';
    
    $html = "    <div class=\"form-group mb-3\">\n";
    $html .= "        <label for=\"{$fieldId}\" class=\"form-label\">{$fieldLabel}</label>\n";
    
    switch ($fieldType) {
        case 'textarea':
            $html .= "        <textarea id=\"{$fieldId}\" name=\"{$fieldName}\" class=\"{$fieldClass}\" placeholder=\"{$fieldPlaceholder}\" {$fieldRequired}></textarea>\n";
            break;
        case 'select':
            $html .= "        <select id=\"{$fieldId}\" name=\"{$fieldName}\" class=\"{$fieldClass}\" {$fieldRequired}>\n";
            $html .= "            <option value=\"\">Choose...</option>\n";
            if (isset($field['options'])) {
                foreach ($field['options'] as $option) {
                    $html .= "            <option value=\"{$option['value']}\">{$option['text']}</option>\n";
                }
            }
            $html .= "        </select>\n";
            break;
        case 'checkbox':
            $html .= "        <div class=\"form-check\">\n";
            $html .= "            <input type=\"checkbox\" id=\"{$fieldId}\" name=\"{$fieldName}\" class=\"form-check-input\" value=\"1\" {$fieldRequired}>\n";
            $html .= "            <label for=\"{$fieldId}\" class=\"form-check-label\">{$fieldLabel}</label>\n";
            $html .= "        </div>\n";
            break;
        case 'radio':
            if (isset($field['options'])) {
                foreach ($field['options'] as $index => $option) {
                    $radioId = $fieldId . '_' . $index;
                    $html .= "        <div class=\"form-check\">\n";
                    $html .= "            <input type=\"radio\" id=\"{$radioId}\" name=\"{$fieldName}\" class=\"form-check-input\" value=\"{$option['value']}\" {$fieldRequired}>\n";
                    $html .= "            <label for=\"{$radioId}\" class=\"form-check-label\">{$option['text']}</label>\n";
                    $html .= "        </div>\n";
                }
            }
            break;
        default:
            $inputType = in_array($fieldType, ['email', 'number', 'date', 'time', 'datetime-local', 'password', 'url', 'tel']) ? $fieldType : 'text';
            $html .= "        <input type=\"{$inputType}\" id=\"{$fieldId}\" name=\"{$fieldName}\" class=\"{$fieldClass}\" placeholder=\"{$fieldPlaceholder}\" {$fieldRequired}>\n";
    }
    
    if (isset($field['help_text']) && $field['help_text']) {
        $html .= "        <div class=\"form-text\">{$field['help_text']}</div>\n";
    }
    
    $html .= "    </div>\n\n";
    
    return $html;
}

function loadSavedForms() {
    $formsDir = "../storage/forms";
    $forms = [];
    
    if (is_dir($formsDir)) {
        $files = glob($formsDir . "/*.json");
        foreach ($files as $file) {
            $formData = json_decode(file_get_contents($file), true);
            $formId = basename($file, '.json');
            $forms[] = [
                'id' => $formId,
                'name' => $formData['name'],
                'field_count' => count($formData['fields']),
                'created_at' => $formData['created_at']
            ];
        }
    }
    
    return json_encode(['success' => true, 'forms' => $forms]);
}

function deleteForm($formId) {
    $formsDir = "../storage/forms";
    $fileName = $formsDir . '/' . $formId . '.json';
    
    if (file_exists($fileName) && unlink($fileName)) {
        return json_encode(['success' => true, 'message' => 'Form deleted successfully']);
    } else {
        return json_encode(['success' => false, 'message' => 'Failed to delete form']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Builder - SmartSchool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <style>
        .toolbox {
            background: #f8f9fa;
            border-right: 1px solid #dee2e6;
            height: calc(100vh - 120px);
            overflow-y: auto;
        }
        
        .form-builder-area {
            min-height: calc(100vh - 120px);
            background: #fff;
        }
        
        .properties-panel {
            background: #f8f9fa;
            border-left: 1px solid #dee2e6;
            height: calc(100vh - 120px);
            overflow-y: auto;
        }
        
        .element-item {
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            background: #fff;
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
            min-height: 400px;
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            margin: 1rem;
        }
        
        .drop-zone.drag-over {
            border-color: #007bff;
            background: rgba(0, 123, 255, 0.1);
        }
        
        .drop-zone-content {
            text-align: center;
            color: #6c757d;
        }
        
        .form-field-preview {
            position: relative;
            margin-bottom: 1rem;
            padding: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            background: #fff;
            cursor: pointer;
        }
        
        .form-field-preview:hover {
            border-color: #007bff;
        }
        
        .form-field-preview.selected {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .field-controls {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            display: none;
        }
        
        .form-field-preview:hover .field-controls {
            display: block;
        }
        
        .element-group-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            padding: 0 0.75rem;
        }
        
        .form-preview {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: #fff;
            margin: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-wpforms me-2"></i>Advanced Form Builder
                            </h4>
                            <div>
                                <a href="dashboard.php" class="btn btn-secondary me-2">
                                    <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                                </a>
                                <button class="btn btn-outline-primary me-2" onclick="loadSavedForms()">
                                    <i class="fas fa-folder-open me-1"></i>Load Form
                                </button>
                                <button class="btn btn-outline-success me-2" onclick="saveForm()">
                                    <i class="fas fa-save me-1"></i>Save Form
                                </button>
                                <button class="btn btn-outline-info me-2" onclick="previewForm()">
                                    <i class="fas fa-eye me-1"></i>Preview
                                </button>
                                <button class="btn btn-primary" onclick="exportHTML()">
                                    <i class="fas fa-download me-1"></i>Export HTML
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <!-- Toolbox -->
            <div class="col-md-3">
                <div class="toolbox p-3">
                    <h6 class="element-group-title">Form Settings</h6>
                    <div class="mb-3">
                        <label for="formName" class="form-label">Form Name</label>
                        <input type="text" class="form-control form-control-sm" id="formName" placeholder="Enter form name">
                    </div>
                    <div class="mb-3">
                        <label for="formMethod" class="form-label">Method</label>
                        <select class="form-select form-select-sm" id="formMethod">
                            <option value="POST">POST</option>
                            <option value="GET">GET</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formAction" class="form-label">Action URL</label>
                        <input type="text" class="form-control form-control-sm" id="formAction" placeholder="/submit">
                    </div>
                    <div class="mb-4">
                        <label for="formClass" class="form-label">CSS Class</label>
                        <input type="text" class="form-control form-control-sm" id="formClass" placeholder="form">
                    </div>
                    
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
                    <div class="element-item" draggable="true" data-type="password">
                        <i class="fas fa-lock me-2"></i>Password
                    </div>
                    <div class="element-item" draggable="true" data-type="textarea">
                        <i class="fas fa-align-left me-2"></i>Textarea
                    </div>
                    
                    <h6 class="element-group-title mt-3">Selection</h6>
                    <div class="element-item" draggable="true" data-type="select">
                        <i class="fas fa-list me-2"></i>Dropdown
                    </div>
                    <div class="element-item" draggable="true" data-type="checkbox">
                        <i class="fas fa-check-square me-2"></i>Checkbox
                    </div>
                    <div class="element-item" draggable="true" data-type="radio">
                        <i class="fas fa-dot-circle me-2"></i>Radio Buttons
                    </div>
                    
                    <h6 class="element-group-title mt-3">Date & Time</h6>
                    <div class="element-item" draggable="true" data-type="date">
                        <i class="fas fa-calendar me-2"></i>Date
                    </div>
                    <div class="element-item" draggable="true" data-type="time">
                        <i class="fas fa-clock me-2"></i>Time
                    </div>
                    <div class="element-item" draggable="true" data-type="datetime-local">
                        <i class="fas fa-calendar-alt me-2"></i>Date & Time
                    </div>
                    
                    <h6 class="element-group-title mt-3">Advanced</h6>
                    <div class="element-item" draggable="true" data-type="file">
                        <i class="fas fa-file me-2"></i>File Upload
                    </div>
                    <div class="element-item" draggable="true" data-type="url">
                        <i class="fas fa-link me-2"></i>URL
                    </div>
                    <div class="element-item" draggable="true" data-type="tel">
                        <i class="fas fa-phone me-2"></i>Phone
                    </div>
                </div>
            </div>
            
            <!-- Form Builder Area -->
            <div class="col-md-6">
                <div class="form-builder-area">
                    <div class="p-3">
                        <h6>Form Preview</h6>
                        <div id="formPreviewArea" class="form-preview">
                            <div class="drop-zone" id="dropZone">
                                <div class="drop-zone-content">
                                    <i class="fas fa-mouse-pointer fa-3x mb-3"></i>
                                    <h5>Drag form elements here</h5>
                                    <p>Start building your form by dragging elements from the toolbox</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Properties Panel -->
            <div class="col-md-3">
                <div class="properties-panel p-3">
                    <h6>Properties</h6>
                    <div id="propertiesContent">
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-hand-pointer fa-3x mb-3"></i>
                            <p>Select a form field to edit its properties</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Preview Modal -->
    <div class="modal fade" id="previewModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Form Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="formPreviewContent">
                        <!-- Form preview will be displayed here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="exportHTML()">
                        <i class="fas fa-download me-1"></i>Export HTML
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Saved Forms Modal -->
    <div class="modal fade" id="savedFormsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Saved Forms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="savedFormsList">
                        <!-- Saved forms will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        let formFields = [];
        let selectedField = null;
        let fieldCounter = 0;
        
        document.addEventListener('DOMContentLoaded', function() {
            initializeDragAndDrop();
        });
        
        function initializeDragAndDrop() {
            const elements = document.querySelectorAll('.element-item');
            const dropZone = document.getElementById('dropZone');
            const formPreviewArea = document.getElementById('formPreviewArea');
            
            elements.forEach(element => {
                element.addEventListener('dragstart', function(e) {
                    e.dataTransfer.setData('text/plain', this.dataset.type);
                });
            });
            
            formPreviewArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });
            
            formPreviewArea.addEventListener('dragleave', function(e) {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
            });
            
            formPreviewArea.addEventListener('drop', function(e) {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
                
                const fieldType = e.dataTransfer.getData('text/plain');
                addFormField(fieldType);
            });
        }
        
        function addFormField(type) {
            fieldCounter++;
            const fieldId = 'field_' + fieldCounter;
            
            const field = {
                id: fieldId,
                type: type,
                name: 'field_' + fieldCounter,
                label: getFieldLabel(type) + ' ' + fieldCounter,
                placeholder: '',
                required: false,
                class: 'form-control',
                help_text: '',
                options: type === 'select' || type === 'radio' ? [
                    {value: 'option1', text: 'Option 1'},
                    {value: 'option2', text: 'Option 2'}
                ] : []
            };
            
            formFields.push(field);
            renderFormPreview();
            selectField(fieldId);
        }
        
        function getFieldLabel(type) {
            const labels = {
                'text': 'Text Field',
                'email': 'Email Field',
                'number': 'Number Field',
                'password': 'Password Field',
                'textarea': 'Textarea',
                'select': 'Dropdown',
                'checkbox': 'Checkbox',
                'radio': 'Radio Group',
                'date': 'Date Field',
                'time': 'Time Field',
                'datetime-local': 'DateTime Field',
                'file': 'File Upload',
                'url': 'URL Field',
                'tel': 'Phone Field'
            };
            return labels[type] || 'Field';
        }
        
        function renderFormPreview() {
            const formPreviewArea = document.getElementById('formPreviewArea');
            
            if (formFields.length === 0) {
                formPreviewArea.innerHTML = `
                    <div class="drop-zone" id="dropZone">
                        <div class="drop-zone-content">
                            <i class="fas fa-mouse-pointer fa-3x mb-3"></i>
                            <h5>Drag form elements here</h5>
                            <p>Start building your form by dragging elements from the toolbox</p>
                        </div>
                    </div>
                `;
                initializeDragAndDrop();
                return;
            }
            
            let html = '<div class="form-preview">';
            
            formFields.forEach(field => {
                html += renderFieldPreview(field);
            });
            
            html += '</div>';
            formPreviewArea.innerHTML = html;
            
            // Add click handlers for field selection
            document.querySelectorAll('.form-field-preview').forEach(element => {
                element.addEventListener('click', function() {
                    selectField(this.dataset.fieldId);
                });
            });
            
            // Re-initialize drag and drop
            initializeDragAndDrop();
        }
        
        function renderFieldPreview(field) {
            let fieldHTML = '';
            
            switch (field.type) {
                case 'textarea':
                    fieldHTML = `<textarea class="${field.class}" placeholder="${field.placeholder}" ${field.required ? 'required' : ''}></textarea>`;
                    break;
                case 'select':
                    fieldHTML = `<select class="${field.class}" ${field.required ? 'required' : ''}>`;
                    fieldHTML += '<option value="">Choose...</option>';
                    field.options.forEach(option => {
                        fieldHTML += `<option value="${option.value}">${option.text}</option>`;
                    });
                    fieldHTML += '</select>';
                    break;
                case 'checkbox':
                    fieldHTML = `
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" ${field.required ? 'required' : ''}>
                            <label class="form-check-label">${field.label}</label>
                        </div>
                    `;
                    break;
                case 'radio':
                    fieldHTML = '';
                    field.options.forEach((option, index) => {
                        fieldHTML += `
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="${field.name}" value="${option.value}" ${field.required ? 'required' : ''}>
                                <label class="form-check-label">${option.text}</label>
                            </div>
                        `;
                    });
                    break;
                default:
                    const inputType = ['email', 'number', 'password', 'date', 'time', 'datetime-local', 'file', 'url', 'tel'].includes(field.type) ? field.type : 'text';
                    fieldHTML = `<input type="${inputType}" class="${field.class}" placeholder="${field.placeholder}" ${field.required ? 'required' : ''}>`;
            }
            
            return `
                <div class="form-field-preview ${selectedField === field.id ? 'selected' : ''}" data-field-id="${field.id}">
                    <div class="field-controls">
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeField('${field.id}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">${field.label}</label>
                        ${fieldHTML}
                        ${field.help_text ? `<div class="form-text">${field.help_text}</div>` : ''}
                    </div>
                </div>
            `;
        }
        
        function selectField(fieldId) {
            selectedField = fieldId;
            renderFormPreview();
            renderProperties(fieldId);
        }
        
        function renderProperties(fieldId) {
            const field = formFields.find(f => f.id === fieldId);
            if (!field) return;
            
            const propertiesContent = document.getElementById('propertiesContent');
            
            let optionsHTML = '';
            if (field.type === 'select' || field.type === 'radio') {
                optionsHTML = `
                    <div class="mb-3">
                        <label class="form-label">Options</label>
                        <div id="optionsContainer">
                            ${field.options.map((option, index) => `
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control form-control-sm" value="${option.value}" placeholder="Value" onchange="updateOption('${fieldId}', ${index}, 'value', this.value)">
                                    <input type="text" class="form-control form-control-sm" value="${option.text}" placeholder="Text" onchange="updateOption('${fieldId}', ${index}, 'text', this.value)">
                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeOption('${fieldId}', ${index})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addOption('${fieldId}')">
                            <i class="fas fa-plus me-1"></i>Add Option
                        </button>
                    </div>
                `;
            }
            
            propertiesContent.innerHTML = `
                <div class="mb-3">
                    <label class="form-label">Field Name</label>
                    <input type="text" class="form-control form-control-sm" value="${field.name}" onchange="updateFieldProperty('${fieldId}', 'name', this.value)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Label</label>
                    <input type="text" class="form-control form-control-sm" value="${field.label}" onchange="updateFieldProperty('${fieldId}', 'label', this.value)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Placeholder</label>
                    <input type="text" class="form-control form-control-sm" value="${field.placeholder}" onchange="updateFieldProperty('${fieldId}', 'placeholder', this.value)">
                </div>
                <div class="mb-3">
                    <label class="form-label">CSS Class</label>
                    <input type="text" class="form-control form-control-sm" value="${field.class}" onchange="updateFieldProperty('${fieldId}', 'class', this.value)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Help Text</label>
                    <textarea class="form-control form-control-sm" rows="2" onchange="updateFieldProperty('${fieldId}', 'help_text', this.value)">${field.help_text}</textarea>
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" ${field.required ? 'checked' : ''} onchange="updateFieldProperty('${fieldId}', 'required', this.checked)">
                        <label class="form-check-label">Required</label>
                    </div>
                </div>
                ${optionsHTML}
                <div class="d-grid">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeField('${fieldId}')">
                        <i class="fas fa-trash me-1"></i>Remove Field
                    </button>
                </div>
            `;
        }
        
        function updateFieldProperty(fieldId, property, value) {
            const field = formFields.find(f => f.id === fieldId);
            if (field) {
                field[property] = value;
                renderFormPreview();
            }
        }
        
        function updateOption(fieldId, optionIndex, property, value) {
            const field = formFields.find(f => f.id === fieldId);
            if (field && field.options[optionIndex]) {
                field.options[optionIndex][property] = value;
                renderFormPreview();
            }
        }
        
        function addOption(fieldId) {
            const field = formFields.find(f => f.id === fieldId);
            if (field) {
                field.options.push({
                    value: 'option' + (field.options.length + 1),
                    text: 'Option ' + (field.options.length + 1)
                });
                renderProperties(fieldId);
                renderFormPreview();
            }
        }
        
        function removeOption(fieldId, optionIndex) {
            const field = formFields.find(f => f.id === fieldId);
            if (field && field.options.length > 1) {
                field.options.splice(optionIndex, 1);
                renderProperties(fieldId);
                renderFormPreview();
            }
        }
        
        function removeField(fieldId) {
            formFields = formFields.filter(f => f.id !== fieldId);
            if (selectedField === fieldId) {
                selectedField = null;
                document.getElementById('propertiesContent').innerHTML = `
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-hand-pointer fa-3x mb-3"></i>
                        <p>Select a form field to edit its properties</p>
                    </div>
                `;
            }
            renderFormPreview();
        }
        
        function saveForm() {
            const formName = document.getElementById('formName').value;
            if (!formName) {
                showNotification('Please enter a form name', 'error');
                return;
            }
            
            if (formFields.length === 0) {
                showNotification('Please add at least one field to the form', 'error');
                return;
            }
            
            const formSettings = {
                method: document.getElementById('formMethod').value,
                action: document.getElementById('formAction').value,
                css_class: document.getElementById('formClass').value
            };
            
            const formData = new FormData();
            formData.append('action', 'save_form');
            formData.append('form_name', formName);
            formData.append('form_fields', JSON.stringify(formFields));
            formData.append('form_settings', JSON.stringify(formSettings));
            
            fetch('form-builder.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Form saved successfully!', 'success');
                } else {
                    showNotification('Failed to save form: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error saving form:', error);
                showNotification('An error occurred while saving the form', 'error');
            });
        }
        
        function previewForm() {
            if (formFields.length === 0) {
                showNotification('Please add some fields to preview', 'error');
                return;
            }
            
            const formSettings = {
                method: document.getElementById('formMethod').value,
                action: document.getElementById('formAction').value,
                css_class: document.getElementById('formClass').value
            };
            
            const formData = new FormData();
            formData.append('action', 'export_html');
            formData.append('form_fields', JSON.stringify(formFields));
            formData.append('form_settings', JSON.stringify(formSettings));
            
            fetch('form-builder.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('formPreviewContent').innerHTML = data.html;
                    new bootstrap.Modal(document.getElementById('previewModal')).show();
                }
            })
            .catch(error => {
                console.error('Error generating preview:', error);
                showNotification('Failed to generate preview', 'error');
            });
        }
        
        function exportHTML() {
            if (formFields.length === 0) {
                showNotification('Please add some fields to export', 'error');
                return;
            }
            
            const formSettings = {
                method: document.getElementById('formMethod').value,
                action: document.getElementById('formAction').value,
                css_class: document.getElementById('formClass').value
            };
            
            const formData = new FormData();
            formData.append('action', 'export_html');
            formData.append('form_fields', JSON.stringify(formFields));
            formData.append('form_settings', JSON.stringify(formSettings));
            
            fetch('form-builder.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Create and download file
                    const blob = new Blob([data.html], { type: 'text/html' });
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = (document.getElementById('formName').value || 'form') + '.html';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                    
                    showNotification('Form HTML exported successfully!', 'success');
                }
            })
            .catch(error => {
                console.error('Error exporting HTML:', error);
                showNotification('Failed to export HTML', 'error');
            });
        }
        
        function loadSavedForms() {
            fetch('form-builder.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=load_saved_forms'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displaySavedForms(data.forms);
                    new bootstrap.Modal(document.getElementById('savedFormsModal')).show();
                }
            })
            .catch(error => {
                console.error('Error loading saved forms:', error);
                showNotification('Failed to load saved forms', 'error');
            });
        }
        
        function displaySavedForms(forms) {
            const savedFormsList = document.getElementById('savedFormsList');
            
            if (forms.length === 0) {
                savedFormsList.innerHTML = `
                    <div class="text-center text-muted py-4">
                        <i class="fas fa-folder-open fa-3x mb-3"></i>
                        <p>No saved forms found</p>
                    </div>
                `;
                return;
            }
            
            savedFormsList.innerHTML = forms.map(form => `
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">${form.name}</h6>
                                <small class="text-muted">${form.field_count} fields • Created ${form.created_at}</small>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-outline-primary me-1" onclick="loadForm('${form.id}')">Load</button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteForm('${form.id}')">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            `).join('');
        }
        
        function showNotification(message, type) {
            const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
            const notification = document.createElement('div');
            notification.className = `alert ${alertClass} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 5000);
        }
    </script>
</body>
</html>