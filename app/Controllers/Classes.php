<?php

namespace App\Controllers;

use App\Models\ClassModel;
use App\Models\SectionModel;
use App\Models\SessionModel;

class Classes extends BaseController
{
    protected $classModel;
    protected $sectionModel;
    protected $sessionModel;

    public function __construct()
    {
        $this->classModel = new ClassModel();
        $this->sectionModel = new SectionModel();
        $this->sessionModel = new SessionModel();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Classes Management',
            'breadcrumb' => ['Dashboard' => '/', 'Classes'],
        ];

        return $this->render('classes/index', $data);
    }

    public function datatables()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/classes');
        }

        $request = $this->request;
        $draw = intval($request->getVar('draw'));
        $start = intval($request->getVar('start'));
        $length = intval($request->getVar('length'));
        $searchValue = $request->getVar('search')['value'] ?? '';

        $builder = $this->classModel->getBuilder();
        
        // Total records
        $totalRecords = $builder->countAllResults(false);

        // Search
        if (!empty($searchValue)) {
            $builder->like('class', $searchValue);
        }

        $filteredRecords = $builder->countAllResults(false);

        // Order
        $orderColumnIndex = intval($request->getVar('order')[0]['column'] ?? 0);
        $orderDirection = $request->getVar('order')[0]['dir'] ?? 'asc';
        
        $columns = ['id', 'class', 'is_active', 'created_at'];
        $orderColumn = $columns[$orderColumnIndex] ?? 'id';
        
        $builder->orderBy($orderColumn, $orderDirection);

        // Limit
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $classes = $builder->get()->getResultArray();

        $data = [];
        foreach ($classes as $class) {
            $statusBadge = $class['is_active'] === 'yes' 
                ? '<span class="badge bg-success">Active</span>' 
                : '<span class="badge bg-danger">Inactive</span>';

            // Get sections count
            $sectionsCount = $this->sectionModel->where('class_id', $class['id'])->countAllResults();

            $actions = '
                <div class="btn-group btn-group-sm">
                    <a href="' . base_url('classes/edit/' . $class['id']) . '" class="btn btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-outline-info" onclick="viewSections(' . $class['id'] . ')" title="View Sections">
                        <i class="fas fa-list"></i>
                    </button>
                    <button class="btn btn-outline-danger" onclick="deleteClass(' . $class['id'] . ')" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            ';

            $data[] = [
                $class['class'],
                $sectionsCount,
                $statusBadge,
                date('d/m/Y', strtotime($class['created_at'])),
                $actions
            ];
        }

        $response = [
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data
        ];

        return $this->response->setJSON($response);
    }

    public function create()
    {
        $data = [
            'page_title' => 'Add New Class',
            'breadcrumb' => ['Dashboard' => '/', 'Classes' => '/classes', 'Add New'],
        ];

        return $this->render('classes/create', $data);
    }

    public function store()
    {
        $rules = [
            'class' => 'required|min_length[1]|max_length[50]|is_unique[classes.class]',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            $data = [
                'class' => $this->request->getPost('class'),
                'is_active' => 'yes',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $classId = $this->classModel->insert($data);

            if ($classId) {
                if ($this->isAjax()) {
                    return $this->sendSuccess(['id' => $classId], 'Class added successfully!');
                }
                $this->setSuccess('Class added successfully!');
                return redirect()->to('/classes');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to add class');
                }
                $this->setError('Failed to add class');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Class creation error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while adding the class');
            }
            $this->setError('An error occurred while adding the class');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $class = $this->classModel->find($id);
        
        if (!$class) {
            $this->setError('Class not found');
            return redirect()->to('/classes');
        }

        $data = [
            'page_title' => 'Edit Class',
            'breadcrumb' => ['Dashboard' => '/', 'Classes' => '/classes', 'Edit'],
            'class' => $class,
        ];

        return $this->render('classes/edit', $data);
    }

    public function update($id)
    {
        $class = $this->classModel->find($id);
        
        if (!$class) {
            if ($this->isAjax()) {
                return $this->sendError('Class not found', 404);
            }
            $this->setError('Class not found');
            return redirect()->to('/classes');
        }

        $rules = [
            'class' => 'required|min_length[1]|max_length[50]|is_unique[classes.class,id,' . $id . ']',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            $data = [
                'class' => $this->request->getPost('class'),
                'is_active' => $this->request->getPost('is_active') ?? 'yes',
                'updated_at' => date('Y-m-d'),
            ];

            $result = $this->classModel->update($id, $data);

            if ($result) {
                if ($this->isAjax()) {
                    return $this->sendSuccess([], 'Class updated successfully!');
                }
                $this->setSuccess('Class updated successfully!');
                return redirect()->to('/classes');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to update class');
                }
                $this->setError('Failed to update class');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Class update error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while updating the class');
            }
            $this->setError('An error occurred while updating the class');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        if (!$this->isAjax()) {
            return redirect()->to('/classes');
        }

        $csrf = $this->validateCSRF();
        if ($csrf !== true) {
            return $csrf;
        }

        try {
            $class = $this->classModel->find($id);
            
            if (!$class) {
                return $this->sendError('Class not found', 404);
            }

            // Check if class has students
            $studentModel = new \App\Models\StudentModel();
            $hasStudents = $studentModel->where('class_id', $id)->countAllResults() > 0;

            if ($hasStudents) {
                return $this->sendError('Cannot delete class. It has students assigned to it.');
            }

            $result = $this->classModel->delete($id);

            if ($result) {
                return $this->sendSuccess([], 'Class deleted successfully!');
            } else {
                return $this->sendError('Failed to delete class');
            }

        } catch (\Exception $e) {
            log_message('error', 'Class deletion error: ' . $e->getMessage());
            return $this->sendError('An error occurred while deleting the class');
        }
    }

    public function getSections($classId)
    {
        if (!$this->isAjax()) {
            return redirect()->to('/classes');
        }

        try {
            $sections = $this->sectionModel->where('class_id', $classId)->findAll();
            return $this->sendSuccess($sections);

        } catch (\Exception $e) {
            log_message('error', 'Get sections error: ' . $e->getMessage());
            return $this->sendError('An error occurred while fetching sections');
        }
    }
}
