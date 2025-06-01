<?php

namespace App\Controllers;

class ModuleGenerator extends BaseController
{
    public function index()
    {
        $data = [
            'page_title' => 'Module Generator',
            'breadcrumb' => ['Dashboard' => '/', 'Module Generator'],
        ];

        return $this->render('module_generator/index', $data);
    }

    public function create()
    {
        $data = [
            'page_title' => 'Create New Module',
            'breadcrumb' => ['Dashboard' => '/', 'Module Generator' => '/module-generator', 'Create'],
        ];

        return $this->render('module_generator/create', $data);
    }

    public function generate()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/module-generator');
        }

        $rules = [
            'module_name' => 'required|min_length[2]|max_length[50]|alpha_dash',
            'table_name' => 'required|min_length[2]|max_length[50]|alpha_dash',
            'fields' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->sendError('Validation failed', 422, $this->getValidationErrors());
        }

        try {
            $moduleName = $this->request->getPost('module_name');
            $tableName = $this->request->getPost('table_name');
            $fields = json_decode($this->request->getPost('fields'), true);

            if (!$fields || !is_array($fields)) {
                return $this->sendError('Invalid fields data');
            }

            // Generate module files
            $result = $this->generateModuleFiles($moduleName, $tableName, $fields);

            if ($result['success']) {
                return $this->sendSuccess($result, 'Module generated successfully!');
            } else {
                return $this->sendError($result['message']);
            }

        } catch (\Exception $e) {
            log_message('error', 'Module generation error: ' . $e->getMessage());
            return $this->sendError('An error occurred while generating the module');
        }
    }

    public function formBuilder()
    {
        $data = [
            'page_title' => 'Form Builder',
            'breadcrumb' => ['Dashboard' => '/', 'Module Generator' => '/module-generator', 'Form Builder'],
        ];

        return $this->render('module_generator/form_builder', $data);
    }

    public function saveForm()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/module-generator/form-builder');
        }

        $rules = [
            'form_name' => 'required|min_length[2]|max_length[50]',
            'form_fields' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->sendError('Validation failed', 422, $this->getValidationErrors());
        }

        try {
            $formName = $this->request->getPost('form_name');
            $formFields = json_decode($this->request->getPost('form_fields'), true);

            if (!$formFields || !is_array($formFields)) {
                return $this->sendError('Invalid form fields data');
            }

            // Save form configuration (in a real implementation, this would be saved to database)
            $formConfig = [
                'name' => $formName,
                'fields' => $formFields,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            // Generate form HTML
            $formHtml = $this->generateFormHTML($formConfig);

            return $this->sendSuccess([
                'config' => $formConfig,
                'html' => $formHtml
            ], 'Form saved successfully!');

        } catch (\Exception $e) {
            log_message('error', 'Form builder error: ' . $e->getMessage());
            return $this->sendError('An error occurred while saving the form');
        }
    }

    private function generateModuleFiles($moduleName, $tableName, $fields)
    {
        try {
            $moduleNameCamel = ucfirst(strtolower($moduleName));
            $moduleNamePlural = $moduleName . 's';

            // Generate Model
            $modelContent = $this->generateModelContent($moduleNameCamel, $tableName, $fields);
            
            // Generate Controller
            $controllerContent = $this->generateControllerContent($moduleNameCamel, $moduleNamePlural, $fields);
            
            // Generate Views
            $indexViewContent = $this->generateIndexViewContent($moduleNameCamel, $moduleNamePlural, $fields);
            $createViewContent = $this->generateCreateViewContent($moduleNameCamel, $fields);
            $editViewContent = $this->generateEditViewContent($moduleNameCamel, $fields);

            // In a real implementation, these files would be written to the filesystem
            // For now, we'll return the generated content
            
            return [
                'success' => true,
                'files' => [
                    'model' => "app/Models/{$moduleNameCamel}Model.php",
                    'controller' => "app/Controllers/{$moduleNamePlural}.php",
                    'index_view' => "app/Views/{$moduleNamePlural}/index.php",
                    'create_view' => "app/Views/{$moduleNamePlural}/create.php",
                    'edit_view' => "app/Views/{$moduleNamePlural}/edit.php",
                ],
                'content' => [
                    'model' => $modelContent,
                    'controller' => $controllerContent,
                    'index_view' => $indexViewContent,
                    'create_view' => $createViewContent,
                    'edit_view' => $editViewContent,
                ]
            ];

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to generate module: ' . $e->getMessage()
            ];
        }
    }

    private function generateModelContent($className, $tableName, $fields)
    {
        $allowedFields = [];
        $validationRules = [];

        foreach ($fields as $field) {
            $allowedFields[] = "'{$field['name']}'";
            
            if ($field['required']) {
                $validationRules[] = "'{$field['name']}' => 'required'";
            }
        }

        $allowedFieldsStr = implode(', ', $allowedFields);
        $validationRulesStr = implode(',', $validationRules);

        return "<?php

namespace App\Models;

use CodeIgniter\Model;

class {$className}Model extends Model
{
    protected \$table = '{$tableName}';
    protected \$primaryKey = 'id';
    protected \$useAutoIncrement = true;
    protected \$returnType = 'array';
    protected \$useSoftDeletes = false;
    protected \$protectFields = true;
    protected \$allowedFields = [{$allowedFieldsStr}];

    protected \$useTimestamps = true;
    protected \$dateFormat = 'datetime';
    protected \$createdField = 'created_at';
    protected \$updatedField = 'updated_at';
    protected \$deletedField = 'deleted_at';

    protected \$validationRules = [
        {$validationRulesStr}
    ];

    protected \$validationMessages = [];
    protected \$skipValidation = false;
    protected \$cleanValidationRules = true;
}";
    }

    private function generateControllerContent($className, $classNamePlural, $fields)
    {
        return "<?php

namespace App\Controllers;

use App\Models\\{$className}Model;

class {$classNamePlural} extends BaseController
{
    protected \${$className}Model;

    public function __construct()
    {
        \$this->{$className}Model = new {$className}Model();
    }

    public function index()
    {
        \$data = [
            'page_title' => '{$className} Management',
            'breadcrumb' => ['Dashboard' => '/', '{$classNamePlural}'],
        ];

        return \$this->render('{$classNamePlural}/index', \$data);
    }

    public function create()
    {
        \$data = [
            'page_title' => 'Add New {$className}',
            'breadcrumb' => ['Dashboard' => '/', '{$classNamePlural}' => '/{$classNamePlural}', 'Add New'],
        ];

        return \$this->render('{$classNamePlural}/create', \$data);
    }

    public function store()
    {
        // Validation rules would be defined here based on fields
        
        try {
            \$data = \$this->request->getPost();
            \$id = \$this->{$className}Model->insert(\$data);

            if (\$id) {
                \$this->setSuccess('{$className} added successfully!');
                return redirect()->to('/{$classNamePlural}');
            } else {
                \$this->setError('Failed to add {$className}');
                return redirect()->back()->withInput();
            }

        } catch (\Exception \$e) {
            log_message('error', '{$className} creation error: ' . \$e->getMessage());
            \$this->setError('An error occurred while adding the {$className}');
            return redirect()->back()->withInput();
        }
    }

    // Additional methods (edit, update, delete) would be generated here...
}";
    }

    private function generateIndexViewContent($className, $classNamePlural, $fields)
    {
        $tableHeaders = '';
        foreach ($fields as $field) {
            $tableHeaders .= "                    <th>{$field['label']}</th>\n";
        }

        return "<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header d-flex justify-content-between align-items-center\">
                    <h4 class=\"card-title mb-0\">{$className} Management</h4>
                    <a href=\"<?= base_url('{$classNamePlural}/create') ?>\" class=\"btn btn-primary\">
                        <i class=\"fas fa-plus me-2\"></i>Add New {$className}
                    </a>
                </div>
                <div class=\"card-body\">
                    <div class=\"table-responsive\">
                        <table id=\"{$classNamePlural}Table\" class=\"table table-striped table-bordered\">
                            <thead>
                                <tr>
{$tableHeaders}                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be loaded via DataTables AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    private function generateCreateViewContent($className, $fields)
    {
        $formFields = '';
        foreach ($fields as $field) {
            $required = $field['required'] ? 'required' : '';
            $formFields .= "                <div class=\"mb-3\">
                    <label for=\"{$field['name']}\" class=\"form-label\">{$field['label']}</label>
                    <input type=\"{$field['type']}\" class=\"form-control\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}>
                </div>\n";
        }

        return "<div class=\"container-fluid\">
    <div class=\"row\">
        <div class=\"col-12\">
            <div class=\"card\">
                <div class=\"card-header\">
                    <h4 class=\"card-title mb-0\">Add New {$className}</h4>
                </div>
                <div class=\"card-body\">
                    <form id=\"create{$className}Form\" method=\"post\" action=\"<?= base_url('{$className}/store') ?>\">
                        <?= csrf_field() ?>
{$formFields}
                        <div class=\"mb-3\">
                            <button type=\"submit\" class=\"btn btn-primary\">Save {$className}</button>
                            <a href=\"<?= base_url('{$className}') ?>\" class=\"btn btn-secondary\">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    private function generateEditViewContent($className, $fields)
    {
        // Similar to create view but with edit-specific modifications
        return $this->generateCreateViewContent($className, $fields);
    }

    private function generateFormHTML($formConfig)
    {
        $html = "<form id=\"dynamic-form\" class=\"needs-validation\" novalidate>\n";
        
        foreach ($formConfig['fields'] as $field) {
            $required = $field['required'] ? 'required' : '';
            $html .= "    <div class=\"mb-3\">\n";
            $html .= "        <label for=\"{$field['name']}\" class=\"form-label\">{$field['label']}</label>\n";
            
            switch ($field['type']) {
                case 'textarea':
                    $html .= "        <textarea class=\"form-control\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}></textarea>\n";
                    break;
                case 'select':
                    $html .= "        <select class=\"form-select\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}>\n";
                    $html .= "            <option value=\"\">Choose...</option>\n";
                    $html .= "        </select>\n";
                    break;
                default:
                    $html .= "        <input type=\"{$field['type']}\" class=\"form-control\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}>\n";
            }
            
            $html .= "    </div>\n";
        }
        
        $html .= "    <div class=\"mb-3\">\n";
        $html .= "        <button type=\"submit\" class=\"btn btn-primary\">Submit</button>\n";
        $html .= "        <button type=\"reset\" class=\"btn btn-secondary\">Reset</button>\n";
        $html .= "    </div>\n";
        $html .= "</form>\n";
        
        return $html;
    }
}
