<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\SectionModel;
use App\Models\SessionModel;

class Students extends BaseController
{
    protected $studentModel;
    protected $classModel;
    protected $sectionModel;
    protected $sessionModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->classModel = new ClassModel();
        $this->sectionModel = new SectionModel();
        $this->sessionModel = new SessionModel();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Students Management',
            'breadcrumb' => ['Dashboard' => '/', 'Students'],
        ];

        return $this->render('students/index', $data);
    }

    public function datatables()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/students');
        }

        $request = $this->request;
        $draw = intval($request->getVar('draw'));
        $start = intval($request->getVar('start'));
        $length = intval($request->getVar('length'));
        $searchValue = $request->getVar('search')['value'] ?? '';

        $builder = $this->studentModel->getBuilder();
        $builder->select('
            students.id,
            students.admission_no,
            students.firstname,
            students.lastname,
            students.email,
            students.mobileno,
            students.dob,
            students.gender,
            classes.class as class_name,
            sections.section as section_name,
            sessions.session as session_name,
            students.is_active,
            students.created_at
        ');
        $builder->join('classes', 'classes.id = students.class_id', 'left');
        $builder->join('sections', 'sections.id = students.section_id', 'left');
        $builder->join('sessions', 'sessions.id = students.session_id', 'left');

        // Total records
        $totalRecords = $builder->countAllResults(false);

        // Search
        if (!empty($searchValue)) {
            $builder->groupStart();
            $builder->like('students.firstname', $searchValue);
            $builder->orLike('students.lastname', $searchValue);
            $builder->orLike('students.admission_no', $searchValue);
            $builder->orLike('students.email', $searchValue);
            $builder->orLike('classes.class', $searchValue);
            $builder->groupEnd();
        }

        $filteredRecords = $builder->countAllResults(false);

        // Order
        $orderColumnIndex = intval($request->getVar('order')[0]['column'] ?? 0);
        $orderDirection = $request->getVar('order')[0]['dir'] ?? 'asc';
        
        $columns = ['students.id', 'students.admission_no', 'students.firstname', 'students.email', 'classes.class', 'students.created_at'];
        $orderColumn = $columns[$orderColumnIndex] ?? 'students.id';
        
        $builder->orderBy($orderColumn, $orderDirection);

        // Limit
        if ($length != -1) {
            $builder->limit($length, $start);
        }

        $students = $builder->get()->getResultArray();

        $data = [];
        foreach ($students as $student) {
            $statusBadge = $student['is_active'] === 'yes' 
                ? '<span class="badge bg-success">Active</span>' 
                : '<span class="badge bg-danger">Inactive</span>';

            $actions = '
                <div class="btn-group btn-group-sm">
                    <a href="' . base_url('students/view/' . $student['id']) . '" class="btn btn-outline-info" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="' . base_url('students/edit/' . $student['id']) . '" class="btn btn-outline-primary" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button class="btn btn-outline-danger" onclick="deleteStudent(' . $student['id'] . ')" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            ';

            $data[] = [
                $student['admission_no'] ?? '',
                $student['firstname'] . ' ' . $student['lastname'],
                $student['email'] ?? '',
                $student['mobileno'] ?? '',
                $student['class_name'] ?? '',
                $student['section_name'] ?? '',
                $student['gender'] ?? '',
                $statusBadge,
                date('d/m/Y', strtotime($student['created_at'])),
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
            'page_title' => 'Add New Student',
            'breadcrumb' => ['Dashboard' => '/', 'Students' => '/students', 'Add New'],
            'classes' => $this->classModel->where('is_active', 'yes')->findAll(),
            'sessions' => $this->sessionModel->where('is_active', 'yes')->findAll(),
        ];

        return $this->render('students/create', $data);
    }

    public function store()
    {
        $rules = [
            'firstname' => 'required|min_length[2]|max_length[50]',
            'lastname' => 'required|min_length[2]|max_length[50]',
            'email' => 'permit_empty|valid_email|is_unique[students.email]',
            'mobileno' => 'permit_empty|min_length[10]|max_length[15]',
            'dob' => 'required|valid_date',
            'gender' => 'required|in_list[Male,Female]',
            'class_id' => 'required|integer',
            'section_id' => 'required|integer',
            'session_id' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            // Generate admission number
            $admissionNo = $this->generateAdmissionNumber();

            $data = [
                'admission_no' => $admissionNo,
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'mobileno' => $this->request->getPost('mobileno'),
                'dob' => $this->request->getPost('dob'),
                'gender' => $this->request->getPost('gender'),
                'class_id' => $this->request->getPost('class_id'),
                'section_id' => $this->request->getPost('section_id'),
                'session_id' => $this->request->getPost('session_id'),
                'father_name' => $this->request->getPost('father_name'),
                'mother_name' => $this->request->getPost('mother_name'),
                'guardian_phone' => $this->request->getPost('guardian_phone'),
                'guardian_email' => $this->request->getPost('guardian_email'),
                'current_address' => $this->request->getPost('current_address'),
                'permanent_address' => $this->request->getPost('permanent_address'),
                'is_active' => 'yes',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $studentId = $this->studentModel->insert($data);

            if ($studentId) {
                if ($this->isAjax()) {
                    return $this->sendSuccess(['id' => $studentId], 'Student added successfully!');
                }
                $this->setSuccess('Student added successfully!');
                return redirect()->to('/students');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to add student');
                }
                $this->setError('Failed to add student');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Student creation error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while adding the student');
            }
            $this->setError('An error occurred while adding the student');
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        $student = $this->studentModel->find($id);
        
        if (!$student) {
            $this->setError('Student not found');
            return redirect()->to('/students');
        }

        $data = [
            'page_title' => 'Edit Student',
            'breadcrumb' => ['Dashboard' => '/', 'Students' => '/students', 'Edit'],
            'student' => $student,
            'classes' => $this->classModel->where('is_active', 'yes')->findAll(),
            'sections' => $this->sectionModel->where('class_id', $student['class_id'])->findAll(),
            'sessions' => $this->sessionModel->where('is_active', 'yes')->findAll(),
        ];

        return $this->render('students/edit', $data);
    }

    public function update($id)
    {
        $student = $this->studentModel->find($id);
        
        if (!$student) {
            if ($this->isAjax()) {
                return $this->sendError('Student not found', 404);
            }
            $this->setError('Student not found');
            return redirect()->to('/students');
        }

        $rules = [
            'firstname' => 'required|min_length[2]|max_length[50]',
            'lastname' => 'required|min_length[2]|max_length[50]',
            'email' => 'permit_empty|valid_email|is_unique[students.email,id,' . $id . ']',
            'mobileno' => 'permit_empty|min_length[10]|max_length[15]',
            'dob' => 'required|valid_date',
            'gender' => 'required|in_list[Male,Female]',
            'class_id' => 'required|integer',
            'section_id' => 'required|integer',
            'session_id' => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            $data = [
                'firstname' => $this->request->getPost('firstname'),
                'lastname' => $this->request->getPost('lastname'),
                'email' => $this->request->getPost('email'),
                'mobileno' => $this->request->getPost('mobileno'),
                'dob' => $this->request->getPost('dob'),
                'gender' => $this->request->getPost('gender'),
                'class_id' => $this->request->getPost('class_id'),
                'section_id' => $this->request->getPost('section_id'),
                'session_id' => $this->request->getPost('session_id'),
                'father_name' => $this->request->getPost('father_name'),
                'mother_name' => $this->request->getPost('mother_name'),
                'guardian_phone' => $this->request->getPost('guardian_phone'),
                'guardian_email' => $this->request->getPost('guardian_email'),
                'current_address' => $this->request->getPost('current_address'),
                'permanent_address' => $this->request->getPost('permanent_address'),
                'is_active' => $this->request->getPost('is_active') ?? 'yes',
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $result = $this->studentModel->update($id, $data);

            if ($result) {
                if ($this->isAjax()) {
                    return $this->sendSuccess([], 'Student updated successfully!');
                }
                $this->setSuccess('Student updated successfully!');
                return redirect()->to('/students');
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to update student');
                }
                $this->setError('Failed to update student');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Student update error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while updating the student');
            }
            $this->setError('An error occurred while updating the student');
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        if (!$this->isAjax()) {
            return redirect()->to('/students');
        }

        $csrf = $this->validateCSRF();
        if ($csrf !== true) {
            return $csrf;
        }

        try {
            $student = $this->studentModel->find($id);
            
            if (!$student) {
                return $this->sendError('Student not found', 404);
            }

            $result = $this->studentModel->delete($id);

            if ($result) {
                return $this->sendSuccess([], 'Student deleted successfully!');
            } else {
                return $this->sendError('Failed to delete student');
            }

        } catch (\Exception $e) {
            log_message('error', 'Student deletion error: ' . $e->getMessage());
            return $this->sendError('An error occurred while deleting the student');
        }
    }

    public function view($id)
    {
        $student = $this->studentModel->getStudentWithDetails($id);
        
        if (!$student) {
            $this->setError('Student not found');
            return redirect()->to('/students');
        }

        $data = [
            'page_title' => 'Student Details',
            'breadcrumb' => ['Dashboard' => '/', 'Students' => '/students', 'View'],
            'student' => $student,
        ];

        return $this->render('students/view', $data);
    }

    public function bulkDelete()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/students');
        }

        $csrf = $this->validateCSRF();
        if ($csrf !== true) {
            return $csrf;
        }

        $ids = $this->request->getPost('ids');
        
        if (empty($ids) || !is_array($ids)) {
            return $this->sendError('No students selected');
        }

        try {
            $deleted = 0;
            foreach ($ids as $id) {
                if ($this->studentModel->delete($id)) {
                    $deleted++;
                }
            }

            if ($deleted > 0) {
                return $this->sendSuccess([], "$deleted student(s) deleted successfully!");
            } else {
                return $this->sendError('Failed to delete students');
            }

        } catch (\Exception $e) {
            log_message('error', 'Bulk deletion error: ' . $e->getMessage());
            return $this->sendError('An error occurred while deleting students');
        }
    }

    public function export()
    {
        // This is a placeholder for export functionality
        // In a real implementation, you would generate CSV/Excel files
        
        $students = $this->studentModel->getStudentsForExport();
        
        $filename = 'students_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // CSV headers
        fputcsv($output, [
            'Admission No', 'First Name', 'Last Name', 'Email', 'Mobile', 
            'DOB', 'Gender', 'Class', 'Section', 'Session', 'Status'
        ]);
        
        foreach ($students as $student) {
            fputcsv($output, [
                $student['admission_no'],
                $student['firstname'],
                $student['lastname'],
                $student['email'],
                $student['mobileno'],
                $student['dob'],
                $student['gender'],
                $student['class_name'],
                $student['section_name'],
                $student['session_name'],
                $student['is_active']
            ]);
        }
        
        fclose($output);
        exit;
    }

    private function generateAdmissionNumber()
    {
        $year = date('Y');
        $lastStudent = $this->studentModel
            ->where('admission_no LIKE', $year . '%')
            ->orderBy('id', 'DESC')
            ->first();

        if ($lastStudent) {
            $lastNumber = intval(substr($lastStudent['admission_no'], -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $year . $newNumber;
    }
}
