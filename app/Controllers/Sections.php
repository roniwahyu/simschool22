<?php

namespace App\Controllers;

use App\Models\SectionModel;
use App\Models\ClassModel;

class Sections extends BaseController
{
    protected $sectionModel;
    protected $classModel;

    public function __construct()
    {
        $this->sectionModel = new SectionModel();
        $this->classModel = new ClassModel();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Sections Management',
            'breadcrumb' => ['Dashboard' => '/', 'Sections'],
            'classes' => $this->classModel->where('is_active', 'yes')->findAll(),
        ];

        return $this->render('sections/index', $data);
    }

    public function datatables()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/sections');
        }

        $request = $this->request;
        $draw = intval($request->getVar('draw'));
        $start = intval($request->getVar('start'));
        $length = intval($request->getVar('length'));
        $searchValue = $request->getVar('search')['value'] ?? '';

        $builder = $this->sectionModel->getBuilder();
        $builder->select('sections.*, classes.class as class_name');
        $builder->join('classes', 'classes.id = sections.class_id', 'left');

        // Total records
        $totalRecords = $builder->countAllResults(false);

        // Search
        if (!empty($searchValue)) {
            $builder->groupStart();
            $builder->like('sections.section', $searchValue);
            $builder->orLike('classes.class', $searchValue);
            $builder->groupEnd();
        }

        $filteredRecords = $builder->countAllResults(false);

        // Order
        $orderColumnIndex = intval($request->getVar('order')[0]['column'] ?? 0);
        $orderDirection = $request->getVar('order')[0]['dir'] ?? 'asc';
        
        $columns = ['sections.id', 'sections.section', 'classes.class', 'sections.is_active', 'sections.created_at'];
        $orderColumn = $columns[$orderColumnIndex] ?? 'sections.id';
        
        $builder->orderBy($orderColumn, $orderDirection);

        // Limit
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $sections = $builder->get()->getResultArray();

        $data = [];
        foreach ($sections as $section) {
            $statusBadge = $section['is_active'] === 'yes' 
                ? '<span class="badge bg-success">Active</span>' 
                : '<span class="badge bg-danger">Inactive</span>';

            $actions = '
                <div class="btn-group btn-group-sm">
                    <a href="' . base_url('sections/edit/' . $section['id']) . '" class="btn btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-outline-danger" onclick="deleteSection(' . $section['id'] . ')" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            ';

            $data[] = [
                $section['section'],
                $section['class_name'] ?? '',
                $statusBadge,
                date('d/m/Y', strtotime($section['created_at'])),
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
            'page_title' => 'Add New Section',
            'breadcrumb' => ['Dashboard' => '/', 'Sections' => '/sections', 'Add New'],
            'classes' => $this->classModel->where('is_active', 'yes')->findAll(),
        ];

        return $this->render('sections/create', $data);
    }

    public function store()
    {
        $rules = [
            'section' => 'required|min_length[1]|max_length[50]',
            'class_id' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            // Check if section already exists for this class
            $existingSection = $this->sectionModel
                ->where('section', $this->request->getPost('section'))
                ->where('class_id', $this->request->getPost('class_id'))
                ->first();

            if ($existingSection) {
                if ($this->isAjax()) {
                    return $this->sendError('Section already exists for this class');
                }
                $this->setError('Section already exists for this class');
                return redirect()->back()->withInput();
            }

            $data = [
                'section' => $this->request->getPost('section'),
                'class_id' => $this->request->getPost('class_id'),
                'is_active' => 'yes',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $sectionId = $this->sectionModel->insert($data);

            if ($sectionId) {
                if ($this->isAjax()) {
                    return $this->sendSuccess(['id' => $sectionId], 'Section added successfully!');
                }
                $this->setSuccess('Section added successfully!');
                return redirect()->to('/sections');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to add section');
                }
                $this->setError('Failed to add section');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Section creation error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while adding the section');
            }
            $this->setError('An error occurred while adding the section');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $section = $this->sectionModel->find($id);
        
        if (!$section) {
            $this->setError('Section not found');
            return redirect()->to('/sections');
        }

        $data = [
            'page_title' => 'Edit Section',
            'breadcrumb' => ['Dashboard' => '/', 'Sections' => '/sections', 'Edit'],
            'section' => $section,
            'classes' => $this->classModel->where('is_active', 'yes')->findAll(),
        ];

        return $this->render('sections/edit', $data);
    }

    public function update($id)
    {
        $section = $this->sectionModel->find($id);
        
        if (!$section) {
            if ($this->isAjax()) {
                return $this->sendError('Section not found', 404);
            }
            $this->setError('Section not found');
            return redirect()->to('/sections');
        }

        $rules = [
            'section' => 'required|min_length[1]|max_length[50]',
            'class_id' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            // Check if section already exists for this class (excluding current record)
            $existingSection = $this->sectionModel
                ->where('section', $this->request->getPost('section'))
                ->where('class_id', $this->request->getPost('class_id'))
                ->where('id !=', $id)
                ->first();

            if ($existingSection) {
                if ($this->isAjax()) {
                    return $this->sendError('Section already exists for this class');
                }
                $this->setError('Section already exists for this class');
                return redirect()->back()->withInput();
            }

            $data = [
                'section' => $this->request->getPost('section'),
                'class_id' => $this->request->getPost('class_id'),
                'is_active' => $this->request->getPost('is_active') ?? 'yes',
                'updated_at' => date('Y-m-d'),
            ];

            $result = $this->sectionModel->update($id, $data);

            if ($result) {
                if ($this->isAjax()) {
                    return $this->sendSuccess([], 'Section updated successfully!');
                }
                $this->setSuccess('Section updated successfully!');
                return redirect()->to('/sections');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to update section');
                }
                $this->setError('Failed to update section');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Section update error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while updating the section');
            }
            $this->setError('An error occurred while updating the section');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        if (!$this->isAjax()) {
            return redirect()->to('/sections');
        }

        $csrf = $this->validateCSRF();
        if ($csrf !== true) {
            return $csrf;
        }

        try {
            $section = $this->sectionModel->find($id);
            
            if (!$section) {
                return $this->sendError('Section not found', 404);
            }

            // Check if section has students
            $studentModel = new \App\Models\StudentModel();
            $hasStudents = $studentModel->where('section_id', $id)->countAllResults() > 0;

            if ($hasStudents) {
                return $this->sendError('Cannot delete section. It has students assigned to it.');
            }

            $result = $this->sectionModel->delete($id);

            if ($result) {
                return $this->sendSuccess([], 'Section deleted successfully!');
            } else {
                return $this->sendError('Failed to delete section');
            }

        } catch (\Exception $e) {
            log_message('error', 'Section deletion error: ' . $e->getMessage());
            return $this->sendError('An error occurred while deleting the section');
        }
    }
}
