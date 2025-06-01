<?php
session_start();

// Database connection
$host = $_ENV['PGHOST'] ?? 'localhost';
$port = $_ENV['PGPORT'] ?? '5432';
$dbname = $_ENV['PGDATABASE'] ?? 'smartschool';
$username = $_ENV['PGUSER'] ?? 'postgres';
$password = $_ENV['PGPASSWORD'] ?? '';

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $pdo = null;
}

// Handle AJAX requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    switch($_POST['action']) {
        case 'generate_module':
            echo generateModule($_POST);
            exit;
        case 'preview_module':
            echo previewModule($_POST);
            exit;
        case 'get_tables':
            echo getTables();
            exit;
        case 'get_table_structure':
            echo getTableStructure($_POST['table']);
            exit;
    }
}

function generateModule($data) {
    global $pdo;
    
    $moduleName = $data['module_name'];
    $tableName = $data['table_name'];
    $fields = json_decode($data['fields'], true);
    
    // Create directory structure
    $moduleDir = "../app/Modules/" . ucfirst($moduleName);
    $dirs = [
        $moduleDir,
        $moduleDir . "/Controllers",
        $moduleDir . "/Models",
        $moduleDir . "/Views"
    ];
    
    foreach($dirs as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    }
    
    // Generate Model
    $modelContent = generateModelContent($moduleName, $tableName, $fields);
    file_put_contents($moduleDir . "/Models/" . ucfirst($moduleName) . ".php", $modelContent);
    
    // Generate Controller
    $controllerContent = generateControllerContent($moduleName, $fields);
    file_put_contents($moduleDir . "/Controllers/" . ucfirst($moduleName) . ".php", $controllerContent);
    
    // Generate Views
    $indexView = generateIndexView($moduleName, $fields);
    file_put_contents($moduleDir . "/Views/index.php", $indexView);
    
    $createView = generateCreateView($moduleName, $fields);
    file_put_contents($moduleDir . "/Views/create.php", $createView);
    
    $editView = generateEditView($moduleName, $fields);
    file_put_contents($moduleDir . "/Views/edit.php", $editView);
    
    // Create database table if doesn't exist
    if ($pdo) {
        $createTableSQL = generateCreateTableSQL($tableName, $fields);
        try {
            $pdo->exec($createTableSQL);
        } catch(PDOException $e) {
            // Table might already exist
        }
    }
    
    return json_encode([
        'success' => true,
        'message' => 'Module generated successfully!',
        'files' => [
            'model' => $moduleDir . "/Models/" . ucfirst($moduleName) . ".php",
            'controller' => $moduleDir . "/Controllers/" . ucfirst($moduleName) . ".php",
            'views' => [
                $moduleDir . "/Views/index.php",
                $moduleDir . "/Views/create.php",
                $moduleDir . "/Views/edit.php"
            ]
        ]
    ]);
}

function generateModelContent($moduleName, $tableName, $fields) {
    $className = ucfirst($moduleName);
    $validationRules = [];
    
    foreach($fields as $field) {
        if ($field['required']) {
            $validationRules[] = "        '{$field['name']}' => 'required'";
        }
    }
    
    $validationRulesStr = implode(",\n", $validationRules);
    
    return "<?php

namespace App\\Modules\\{$className}\\Models;

use CodeIgniter\\Model;

class {$className} extends Model
{
    protected \$table = '{$tableName}';
    protected \$primaryKey = 'id';
    protected \$useAutoIncrement = true;
    protected \$returnType = 'array';
    protected \$useSoftDeletes = false;
    protected \$protectFields = true;
    protected \$allowedFields = [" . implode(', ', array_map(function($f) { return "'{$f['name']}'"; }, $fields)) . "];

    protected \$useTimestamps = true;
    protected \$createdField = 'created_at';
    protected \$updatedField = 'updated_at';

    protected \$validationRules = [
{$validationRulesStr}
    ];

    protected \$validationMessages = [];
    protected \$skipValidation = false;
}";
}

function generateControllerContent($moduleName, $fields) {
    $className = ucfirst($moduleName);
    
    return "<?php

namespace App\\Modules\\{$className}\\Controllers;

use App\\Controllers\\BaseController;
use App\\Modules\\{$className}\\Models\\{$className};

class {$className} extends BaseController
{
    protected \$model;

    public function __construct()
    {
        \$this->model = new {$className}();
    }

    public function index()
    {
        \$data = [
            'title' => '{$className} Management',
            'records' => \$this->model->findAll()
        ];

        return view('App\\Modules\\{$className}\\Views\\index', \$data);
    }

    public function create()
    {
        \$data = [
            'title' => 'Add New {$className}',
            'validation' => \\Config\\Services::validation()
        ];

        return view('App\\Modules\\{$className}\\Views\\create', \$data);
    }

    public function store()
    {
        if (!\$this->validate(\$this->model->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', \$this->validator->getErrors());
        }

        \$data = \$this->request->getPost();
        
        if (\$this->model->insert(\$data)) {
            return redirect()->to('/{$moduleName}')->with('success', '{$className} created successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to create {$moduleName}');
        }
    }

    public function edit(\$id)
    {
        \$record = \$this->model->find(\$id);
        
        if (!\$record) {
            throw new \\CodeIgniter\\Exceptions\\PageNotFoundException('Record not found');
        }

        \$data = [
            'title' => 'Edit {$className}',
            'record' => \$record,
            'validation' => \\Config\\Services::validation()
        ];

        return view('App\\Modules\\{$className}\\Views\\edit', \$data);
    }

    public function update(\$id)
    {
        if (!\$this->validate(\$this->model->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', \$this->validator->getErrors());
        }

        \$data = \$this->request->getPost();
        
        if (\$this->model->update(\$id, \$data)) {
            return redirect()->to('/{$moduleName}')->with('success', '{$className} updated successfully');
        } else {
            return redirect()->back()->withInput()->with('error', 'Failed to update {$moduleName}');
        }
    }

    public function delete(\$id)
    {
        if (\$this->model->delete(\$id)) {
            return redirect()->to('/{$moduleName}')->with('success', '{$className} deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete {$moduleName}');
        }
    }

    public function api_list()
    {
        return \$this->response->setJSON(\$this->model->findAll());
    }
}";
}

function generateIndexView($moduleName, $fields) {
    $className = ucfirst($moduleName);
    $tableHeaders = '';
    $tableColumns = '';
    
    foreach($fields as $field) {
        if ($field['name'] !== 'id' && $field['name'] !== 'created_at' && $field['name'] !== 'updated_at') {
            $tableHeaders .= "                                    <th>" . ucwords(str_replace('_', ' ', $field['label'])) . "</th>\n";
            $tableColumns .= "                                            <td><?= esc(\$record['{$field['name']}']) ?></td>\n";
        }
    }
    
    return "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title><?= \$title ?></title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\" rel=\"stylesheet\">
    <link href=\"https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css\" rel=\"stylesheet\">
</head>
<body>
    <div class=\"container-fluid py-4\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"card\">
                    <div class=\"card-header\">
                        <div class=\"d-flex justify-content-between align-items-center\">
                            <h4 class=\"card-title mb-0\">
                                <i class=\"fas fa-list me-2\"></i>{$className} Management
                            </h4>
                            <a href=\"/{$moduleName}/create\" class=\"btn btn-primary\">
                                <i class=\"fas fa-plus me-1\"></i>Add New {$className}
                            </a>
                        </div>
                    </div>
                    <div class=\"card-body\">
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                                <?= session()->getFlashdata('success') ?>
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                            </div>
                        <?php endif; ?>
                        
                        <div class=\"table-responsive\">
                            <table class=\"table table-striped\" id=\"dataTable\">
                                <thead>
                                    <tr>
                                        <th>ID</th>
{$tableHeaders}                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (\$records as \$record): ?>
                                        <tr>
                                            <td><?= \$record['id'] ?></td>
{$tableColumns}                                            <td><?= date('d M, Y', strtotime(\$record['created_at'])) ?></td>
                                            <td>
                                                <a href=\"/{$moduleName}/edit/<?= \$record['id'] ?>\" class=\"btn btn-sm btn-outline-primary\">
                                                    <i class=\"fas fa-edit\"></i>
                                                </a>
                                                <button class=\"btn btn-sm btn-outline-danger\" onclick=\"deleteRecord(<?= \$record['id'] ?>)\">
                                                    <i class=\"fas fa-trash\"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
    <script src=\"https://code.jquery.com/jquery-3.7.0.min.js\"></script>
    <script src=\"https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js\"></script>
    <script src=\"https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js\"></script>
    
    <script>
        \$(document).ready(function() {
            \$('#dataTable').DataTable({
                responsive: true,
                pageLength: 25
            });
        });
        
        function deleteRecord(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                window.location.href = '/{$moduleName}/delete/' + id;
            }
        }
    </script>
</body>
</html>";
}

function generateCreateView($moduleName, $fields) {
    $className = ucfirst($moduleName);
    $formFields = '';
    
    foreach($fields as $field) {
        if ($field['name'] !== 'id' && $field['name'] !== 'created_at' && $field['name'] !== 'updated_at') {
            $required = $field['required'] ? 'required' : '';
            $label = ucwords(str_replace('_', ' ', $field['label']));
            $requiredMark = $field['required'] ? '<span class="text-danger">*</span>' : '';
            
            $formFields .= "                            <div class=\"mb-3\">\n";
            $formFields .= "                                <label for=\"{$field['name']}\" class=\"form-label\">{$label} {$requiredMark}</label>\n";
            
            switch($field['type']) {
                case 'textarea':
                    $formFields .= "                                <textarea class=\"form-control\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}></textarea>\n";
                    break;
                case 'select':
                    $formFields .= "                                <select class=\"form-select\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}>\n";
                    $formFields .= "                                    <option value=\"\">Select {$label}</option>\n";
                    $formFields .= "                                </select>\n";
                    break;
                case 'checkbox':
                    $formFields .= "                                <div class=\"form-check\">\n";
                    $formFields .= "                                    <input class=\"form-check-input\" type=\"checkbox\" id=\"{$field['name']}\" name=\"{$field['name']}\" value=\"1\">\n";
                    $formFields .= "                                    <label class=\"form-check-label\" for=\"{$field['name']}\">{$label}</label>\n";
                    $formFields .= "                                </div>\n";
                    break;
                default:
                    $inputType = in_array($field['type'], ['email', 'number', 'date', 'time', 'datetime-local']) ? $field['type'] : 'text';
                    $formFields .= "                                <input type=\"{$inputType}\" class=\"form-control\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}>\n";
            }
            
            $formFields .= "                            </div>\n\n";
        }
    }
    
    return "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title><?= \$title ?></title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\" rel=\"stylesheet\">
</head>
<body>
    <div class=\"container-fluid py-4\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"card\">
                    <div class=\"card-header\">
                        <h4 class=\"card-title mb-0\">
                            <i class=\"fas fa-plus me-2\"></i><?= \$title ?>
                        </h4>
                    </div>
                    <div class=\"card-body\">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                                <?= session()->getFlashdata('error') ?>
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action=\"/{$moduleName}/store\" method=\"post\">
                            <?= csrf_field() ?>
                            
{$formFields}                            
                            <div class=\"d-flex justify-content-between\">
                                <a href=\"/{$moduleName}\" class=\"btn btn-secondary\">
                                    <i class=\"fas fa-arrow-left me-1\"></i>Back
                                </a>
                                <button type=\"submit\" class=\"btn btn-primary\">
                                    <i class=\"fas fa-save me-1\"></i>Save {$className}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
</body>
</html>";
}

function generateEditView($moduleName, $fields) {
    $className = ucfirst($moduleName);
    $formFields = '';
    
    foreach($fields as $field) {
        if ($field['name'] !== 'id' && $field['name'] !== 'created_at' && $field['name'] !== 'updated_at') {
            $required = $field['required'] ? 'required' : '';
            $label = ucwords(str_replace('_', ' ', $field['label']));
            $requiredMark = $field['required'] ? '<span class="text-danger">*</span>' : '';
            
            $formFields .= "                            <div class=\"mb-3\">\n";
            $formFields .= "                                <label for=\"{$field['name']}\" class=\"form-label\">{$label} {$requiredMark}</label>\n";
            
            switch($field['type']) {
                case 'textarea':
                    $formFields .= "                                <textarea class=\"form-control\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}><?= old('{$field['name']}', \$record['{$field['name']}']) ?></textarea>\n";
                    break;
                case 'select':
                    $formFields .= "                                <select class=\"form-select\" id=\"{$field['name']}\" name=\"{$field['name']}\" {$required}>\n";
                    $formFields .= "                                    <option value=\"\">Select {$label}</option>\n";
                    $formFields .= "                                </select>\n";
                    break;
                case 'checkbox':
                    $formFields .= "                                <div class=\"form-check\">\n";
                    $formFields .= "                                    <input class=\"form-check-input\" type=\"checkbox\" id=\"{$field['name']}\" name=\"{$field['name']}\" value=\"1\" <?= old('{$field['name']}', \$record['{$field['name']}']) ? 'checked' : '' ?>>\n";
                    $formFields .= "                                    <label class=\"form-check-label\" for=\"{$field['name']}\">{$label}</label>\n";
                    $formFields .= "                                </div>\n";
                    break;
                default:
                    $inputType = in_array($field['type'], ['email', 'number', 'date', 'time', 'datetime-local']) ? $field['type'] : 'text';
                    $formFields .= "                                <input type=\"{$inputType}\" class=\"form-control\" id=\"{$field['name']}\" name=\"{$field['name']}\" value=\"<?= old('{$field['name']}', \$record['{$field['name']}']) ?>\" {$required}>\n";
            }
            
            $formFields .= "                            </div>\n\n";
        }
    }
    
    return "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title><?= \$title ?></title>
    <link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css\" rel=\"stylesheet\">
    <link href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css\" rel=\"stylesheet\">
</head>
<body>
    <div class=\"container-fluid py-4\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"card\">
                    <div class=\"card-header\">
                        <h4 class=\"card-title mb-0\">
                            <i class=\"fas fa-edit me-2\"></i><?= \$title ?>
                        </h4>
                    </div>
                    <div class=\"card-body\">
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                                <?= session()->getFlashdata('error') ?>
                                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form action=\"/{$moduleName}/update/<?= \$record['id'] ?>\" method=\"post\">
                            <?= csrf_field() ?>
                            
{$formFields}                            
                            <div class=\"d-flex justify-content-between\">
                                <a href=\"/{$moduleName}\" class=\"btn btn-secondary\">
                                    <i class=\"fas fa-arrow-left me-1\"></i>Back
                                </a>
                                <button type=\"submit\" class=\"btn btn-primary\">
                                    <i class=\"fas fa-save me-1\"></i>Update {$className}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js\"></script>
</body>
</html>";
}

function generateCreateTableSQL($tableName, $fields) {
    $sql = "CREATE TABLE IF NOT EXISTS {$tableName} (\n";
    $sql .= "    id SERIAL PRIMARY KEY,\n";
    
    foreach($fields as $field) {
        if ($field['name'] !== 'id' && $field['name'] !== 'created_at' && $field['name'] !== 'updated_at') {
            $type = 'VARCHAR(255)';
            switch($field['type']) {
                case 'number':
                    $type = 'INTEGER';
                    break;
                case 'textarea':
                    $type = 'TEXT';
                    break;
                case 'date':
                    $type = 'DATE';
                    break;
                case 'datetime':
                    $type = 'TIMESTAMP';
                    break;
                case 'checkbox':
                    $type = 'BOOLEAN DEFAULT FALSE';
                    break;
            }
            
            $nullable = $field['required'] ? 'NOT NULL' : 'NULL';
            $sql .= "    {$field['name']} {$type} {$nullable},\n";
        }
    }
    
    $sql .= "    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,\n";
    $sql .= "    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n";
    $sql .= ");";
    
    return $sql;
}

function getTables() {
    global $pdo;
    
    if (!$pdo) {
        return json_encode(['error' => 'Database connection failed']);
    }
    
    try {
        $stmt = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        return json_encode(['success' => true, 'tables' => $tables]);
    } catch(PDOException $e) {
        return json_encode(['error' => $e->getMessage()]);
    }
}

function getTableStructure($tableName) {
    global $pdo;
    
    if (!$pdo) {
        return json_encode(['error' => 'Database connection failed']);
    }
    
    try {
        $stmt = $pdo->prepare("
            SELECT column_name, data_type, is_nullable, column_default 
            FROM information_schema.columns 
            WHERE table_name = ? AND table_schema = 'public'
            ORDER BY ordinal_position
        ");
        $stmt->execute([$tableName]);
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return json_encode(['success' => true, 'columns' => $columns]);
    } catch(PDOException $e) {
        return json_encode(['error' => $e->getMessage()]);
    }
}

function previewModule($data) {
    $moduleName = $data['module_name'];
    $fields = json_decode($data['fields'], true);
    
    $preview = [
        'module_name' => $moduleName,
        'files_to_generate' => [
            'model' => "app/Modules/" . ucfirst($moduleName) . "/Models/" . ucfirst($moduleName) . ".php",
            'controller' => "app/Modules/" . ucfirst($moduleName) . "/Controllers/" . ucfirst($moduleName) . ".php",
            'views' => [
                "app/Modules/" . ucfirst($moduleName) . "/Views/index.php",
                "app/Modules/" . ucfirst($moduleName) . "/Views/create.php",
                "app/Modules/" . ucfirst($moduleName) . "/Views/edit.php"
            ]
        ],
        'database_table' => $data['table_name'],
        'fields_count' => count($fields),
        'validation_rules' => array_filter($fields, function($f) { return $f['required']; })
    ];
    
    return json_encode(['success' => true, 'preview' => $preview]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module Generator - SmartSchool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
    <style>
        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
        }
        
        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }
        
        .step:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            right: -50%;
            width: 100%;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }
        
        .step.active:not(:last-child)::after {
            background: #007bff;
        }
        
        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e9ecef;
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            position: relative;
            z-index: 2;
        }
        
        .step.active .step-number {
            background: #007bff;
            color: white;
        }
        
        .step.completed .step-number {
            background: #28a745;
            color: white;
        }
        
        .field-item {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
            background: #f8f9fa;
        }
        
        .preview-code {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            max-height: 300px;
            overflow-y: auto;
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
                                <i class="fas fa-magic me-2"></i>Advanced Module Generator
                            </h4>
                            <a href="dashboard.php" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step active" id="step1">
                                <div class="step-number">1</div>
                                <div class="step-label">Module Info</div>
                            </div>
                            <div class="step" id="step2">
                                <div class="step-number">2</div>
                                <div class="step-label">Configure Fields</div>
                            </div>
                            <div class="step" id="step3">
                                <div class="step-number">3</div>
                                <div class="step-label">Preview & Generate</div>
                            </div>
                        </div>
                        
                        <form id="moduleGeneratorForm">
                            <!-- Step 1: Module Information -->
                            <div class="step-content" id="stepContent1">
                                <h5 class="text-primary mb-3">Module Information</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="moduleName" class="form-label">Module Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="moduleName" name="module_name" required 
                                                   placeholder="e.g., Product, Category, Employee">
                                            <div class="form-text">Use singular form (e.g., Product not Products)</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="tableName" class="form-label">Database Table <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tableName" name="table_name" required 
                                                   placeholder="e.g., products, categories, employees">
                                            <div class="form-text">Use plural form and snake_case</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="moduleDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="moduleDescription" name="module_description" rows="3"
                                                      placeholder="Brief description of what this module manages"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Import from Existing Table</label>
                                            <select class="form-select" id="existingTable">
                                                <option value="">Select existing table (optional)</option>
                                            </select>
                                            <div class="form-text">Import field structure from existing database table</div>
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
                            <div class="step-content d-none" id="stepContent2">
                                <h5 class="text-primary mb-3">Configure Fields</h5>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6>Fields</h6>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addField()">
                                        <i class="fas fa-plus me-1"></i>Add Field
                                    </button>
                                </div>
                                
                                <div id="fieldsContainer">
                                    <!-- Fields will be added here dynamically -->
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
                            <div class="step-content d-none" id="stepContent3">
                                <h5 class="text-primary mb-3">Preview & Generate Module</h5>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Files to be Generated</h6>
                                            </div>
                                            <div class="card-body">
                                                <div id="previewContent">
                                                    <!-- Preview content will be loaded here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="card-title mb-0">Module Summary</h6>
                                            </div>
                                            <div class="card-body">
                                                <div id="moduleSummary">
                                                    <!-- Summary content will be loaded here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-secondary" onclick="previousStep(2)">
                                        <i class="fas fa-arrow-left me-1"></i>Previous
                                    </button>
                                    <div>
                                        <button type="button" class="btn btn-outline-info me-2" onclick="previewModule()">
                                            <i class="fas fa-eye me-1"></i>Preview
                                        </button>
                                        <button type="button" class="btn btn-success" onclick="generateModule()">
                                            <i class="fas fa-magic me-1"></i>Generate Module
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
    
    <!-- Field Template -->
    <template id="fieldTemplate">
        <div class="field-item">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <h6 class="mb-0">Field <span class="field-number"></span></h6>
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
                            <option value="datetime">DateTime</option>
                            <option value="time">Time</option>
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
                        <label class="form-check-label">Searchable in List</label>
                    </div>
                </div>
            </div>
        </div>
    </template>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        let currentStep = 1;
        let fieldCounter = 0;
        
        // Load existing tables on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadExistingTables();
            
            // Auto-generate table name from module name
            document.getElementById('moduleName').addEventListener('input', function() {
                const moduleName = this.value.toLowerCase();
                const tableName = moduleName + 's'; // Simple pluralization
                document.getElementById('tableName').value = tableName;
            });
        });
        
        function loadExistingTables() {
            fetch('module-generator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_tables'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const select = document.getElementById('existingTable');
                    data.tables.forEach(table => {
                        const option = document.createElement('option');
                        option.value = table;
                        option.textContent = table;
                        select.appendChild(option);
                    });
                    
                    // Handle table selection
                    select.addEventListener('change', function() {
                        if (this.value) {
                            importTableStructure(this.value);
                        }
                    });
                }
            })
            .catch(error => {
                console.error('Error loading tables:', error);
            });
        }
        
        function importTableStructure(tableName) {
            fetch('module-generator.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=get_table_structure&table=' + encodeURIComponent(tableName)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Clear existing fields
                    document.getElementById('fieldsContainer').innerHTML = '';
                    fieldCounter = 0;
                    
                    // Set table name
                    document.getElementById('tableName').value = tableName;
                    
                    // Add fields based on table structure
                    data.columns.forEach(column => {
                        if (column.column_name !== 'id' && 
                            column.column_name !== 'created_at' && 
                            column.column_name !== 'updated_at') {
                            
                            addField();
                            
                            const fieldItem = document.querySelector('.field-item:last-child');
                            fieldItem.querySelector('.field-name').value = column.column_name;
                            fieldItem.querySelector('.field-label').value = column.column_name.replace(/_/g, ' ');
                            
                            // Map database types to form types
                            let fieldType = 'text';
                            if (column.data_type.includes('text')) fieldType = 'textarea';
                            else if (column.data_type.includes('integer')) fieldType = 'number';
                            else if (column.data_type.includes('date')) fieldType = 'date';
                            else if (column.data_type.includes('timestamp')) fieldType = 'datetime';
                            else if (column.data_type.includes('boolean')) fieldType = 'checkbox';
                            
                            fieldItem.querySelector('.field-type').value = fieldType;
                            fieldItem.querySelector('.field-required').checked = column.is_nullable === 'NO';
                        }
                    });
                    
                    showNotification('Table structure imported successfully!', 'success');
                }
            })
            .catch(error => {
                console.error('Error importing table structure:', error);
                showNotification('Failed to import table structure', 'error');
            });
        }
        
        function nextStep(step) {
            if (validateCurrentStep()) {
                // Hide current step
                document.getElementById('stepContent' + currentStep).classList.add('d-none');
                document.getElementById('step' + currentStep).classList.remove('active');
                document.getElementById('step' + currentStep).classList.add('completed');
                
                // Show next step
                currentStep = step;
                document.getElementById('stepContent' + currentStep).classList.remove('d-none');
                document.getElementById('step' + currentStep).classList.add('active');
                
                if (step === 3) {
                    loadPreview();
                }
            }
        }
        
        function previousStep(step) {
            // Hide current step
            document.getElementById('stepContent' + currentStep).classList.add('d-none');
            document.getElementById('step' + currentStep).classList.remove('active');
            
            // Show previous step
            currentStep = step;
            document.getElementById('stepContent' + currentStep).classList.remove('d-none');
            document.getElementById('step' + currentStep).classList.add('active');
            document.getElementById('step' + currentStep).classList.remove('completed');
        }
        
        function validateCurrentStep() {
            if (currentStep === 1) {
                const moduleName = document.getElementById('moduleName').value;
                const tableName = document.getElementById('tableName').value;
                
                if (!moduleName || !tableName) {
                    showNotification('Please fill in all required fields', 'error');
                    return false;
                }
            } else if (currentStep === 2) {
                const fields = getFieldsData();
                if (fields.length === 0) {
                    showNotification('Please add at least one field', 'error');
                    return false;
                }
            }
            
            return true;
        }
        
        function addField() {
            const template = document.getElementById('fieldTemplate');
            const clone = template.content.cloneNode(true);
            
            fieldCounter++;
            clone.querySelector('.field-number').textContent = fieldCounter;
            
            document.getElementById('fieldsContainer').appendChild(clone);
        }
        
        function removeField(button) {
            button.closest('.field-item').remove();
            updateFieldNumbers();
        }
        
        function updateFieldNumbers() {
            const fields = document.querySelectorAll('.field-item');
            fields.forEach((field, index) => {
                field.querySelector('.field-number').textContent = index + 1;
            });
            fieldCounter = fields.length;
        }
        
        function getFieldsData() {
            const fields = [];
            document.querySelectorAll('.field-item').forEach(item => {
                const field = {
                    name: item.querySelector('.field-name').value,
                    label: item.querySelector('.field-label').value,
                    type: item.querySelector('.field-type').value,
                    required: item.querySelector('.field-required').checked,
                    searchable: item.querySelector('.field-searchable').checked
                };
                
                if (field.name && field.label && field.type) {
                    fields.push(field);
                }
            });
            
            return fields;
        }
        
        function loadPreview() {
            const formData = new FormData();
            formData.append('action', 'preview_module');
            formData.append('module_name', document.getElementById('moduleName').value);
            formData.append('table_name', document.getElementById('tableName').value);
            formData.append('fields', JSON.stringify(getFieldsData()));
            
            fetch('module-generator.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayPreview(data.preview);
                }
            })
            .catch(error => {
                console.error('Error loading preview:', error);
            });
        }
        
        function displayPreview(preview) {
            const previewContent = document.getElementById('previewContent');
            const moduleSummary = document.getElementById('moduleSummary');
            
            previewContent.innerHTML = `
                <h6 class="text-success mb-3">Files to be Generated:</h6>
                <ul class="list-unstyled">
                    <li><i class="fas fa-file-code text-primary me-2"></i><code>${preview.files_to_generate.model}</code></li>
                    <li><i class="fas fa-file-code text-success me-2"></i><code>${preview.files_to_generate.controller}</code></li>
                    ${preview.files_to_generate.views.map(view => 
                        `<li><i class="fas fa-file-code text-warning me-2"></i><code>${view}</code></li>`
                    ).join('')}
                </ul>
            `;
            
            moduleSummary.innerHTML = `
                <table class="table table-sm">
                    <tr>
                        <td><strong>Module Name:</strong></td>
                        <td>${preview.module_name}</td>
                    </tr>
                    <tr>
                        <td><strong>Database Table:</strong></td>
                        <td>${preview.database_table}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Fields:</strong></td>
                        <td>${preview.fields_count}</td>
                    </tr>
                    <tr>
                        <td><strong>Required Fields:</strong></td>
                        <td>${preview.validation_rules.length}</td>
                    </tr>
                </table>
            `;
        }
        
        function generateModule() {
            const formData = new FormData();
            formData.append('action', 'generate_module');
            formData.append('module_name', document.getElementById('moduleName').value);
            formData.append('table_name', document.getElementById('tableName').value);
            formData.append('module_description', document.getElementById('moduleDescription').value);
            formData.append('fields', JSON.stringify(getFieldsData()));
            
            // Show loading state
            const generateBtn = event.target;
            const originalText = generateBtn.innerHTML;
            generateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Generating...';
            generateBtn.disabled = true;
            
            fetch('module-generator.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Module generated successfully!', 'success');
                    
                    // Show generated files
                    const previewContent = document.getElementById('previewContent');
                    previewContent.innerHTML = `
                        <div class="alert alert-success">
                            <h6 class="alert-heading">Module Generated Successfully!</h6>
                            <p>The following files have been created:</p>
                            <ul class="mb-0">
                                <li>Model: <code>${data.files.model}</code></li>
                                <li>Controller: <code>${data.files.controller}</code></li>
                                <li>Views: ${data.files.views.length} files created</li>
                            </ul>
                        </div>
                    `;
                } else {
                    showNotification('Failed to generate module: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error generating module:', error);
                showNotification('An error occurred while generating the module', 'error');
            })
            .finally(() => {
                // Restore button state
                generateBtn.innerHTML = originalText;
                generateBtn.disabled = false;
            });
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
        
        // Initialize with one field
        addField();
    </script>
</body>
</html>