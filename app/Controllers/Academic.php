<?php

namespace App\Controllers;

use App\Models\SessionModel;
use App\Models\SubjectModel;
use App\Models\ClassModel;

class Academic extends BaseController
{
    protected $sessionModel;
    protected $subjectModel;
    protected $classModel;

    public function __construct()
    {
        $this->sessionModel = new SessionModel();
        $this->subjectModel = new SubjectModel();
        $this->classModel = new ClassModel();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Academic Management',
            'breadcrumb' => ['Dashboard' => '/', 'Academic'],
            'active_session' => $this->sessionModel->where('is_active', 'yes')->first(),
            'total_sessions' => $this->sessionModel->countAll(),
            'total_subjects' => $this->subjectModel->countAll(),
        ];

        return $this->render('academic/index', $data);
    }

    public function sessions()
    {
        if ($this->isAjax()) {
            $sessions = $this->sessionModel->orderBy('created_at', 'DESC')->findAll();
            return $this->sendSuccess($sessions);
        }

        $data = [
            'page_title' => 'Session Management',
            'breadcrumb' => ['Dashboard' => '/', 'Academic' => '/academic', 'Sessions'],
            'sessions' => $this->sessionModel->orderBy('created_at', 'DESC')->findAll(),
        ];

        return $this->render('academic/sessions', $data);
    }

    public function storeSessions()
    {
        $rules = [
            'session' => 'required|min_length[4]|max_length[20]|is_unique[sessions.session]',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            // If this is being set as active, deactivate others
            $isActive = $this->request->getPost('is_active') === 'yes';
            if ($isActive) {
                $this->sessionModel->update(['is_active' => 'yes'], ['is_active' => 'no']);
            }

            $data = [
                'session' => $this->request->getPost('session'),
                'is_active' => $isActive ? 'yes' : 'no',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $sessionId = $this->sessionModel->insert($data);

            if ($sessionId) {
                if ($this->isAjax()) {
                    return $this->sendSuccess(['id' => $sessionId], 'Session created successfully!');
                }
                $this->setSuccess('Session created successfully!');
                return redirect()->back();
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to create session');
                }
                $this->setError('Failed to create session');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Session creation error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while creating the session');
            }
            $this->setError('An error occurred while creating the session');
            return redirect()->back()->withInput();
        }
    }

    public function subjects()
    {
        if ($this->isAjax()) {
            $subjects = $this->subjectModel
                ->select('subjects.*, subject_groups.name as group_name')
                ->join('subject_groups', 'subject_groups.id = subjects.subject_group_id', 'left')
                ->orderBy('subjects.name', 'ASC')
                ->findAll();
            return $this->sendSuccess($subjects);
        }

        $data = [
            'page_title' => 'Subject Management',
            'breadcrumb' => ['Dashboard' => '/', 'Academic' => '/academic', 'Subjects'],
            'subjects' => $this->subjectModel
                ->select('subjects.*, subject_groups.name as group_name')
                ->join('subject_groups', 'subject_groups.id = subjects.subject_group_id', 'left')
                ->orderBy('subjects.name', 'ASC')
                ->findAll(),
            'classes' => $this->classModel->where('is_active', 'yes')->findAll(),
        ];

        return $this->render('academic/subjects', $data);
    }

    public function storeSubjects()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'code' => 'required|min_length[2]|max_length[20]|is_unique[subjects.code]',
            'type' => 'required|in_list[Theory,Practical]',
        ];

        if (!$this->validate($rules)) {
            if ($this->isAjax()) {
                return $this->sendError('Validation failed', 422, $this->getValidationErrors());
            }
            return redirect()->back()->withInput()->with('errors', $this->getValidationErrors());
        }

        try {
            $data = [
                'name' => $this->request->getPost('name'),
                'code' => $this->request->getPost('code'),
                'type' => $this->request->getPost('type'),
                'is_active' => 'yes',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $subjectId = $this->subjectModel->insert($data);

            if ($subjectId) {
                if ($this->isAjax()) {
                    return $this->sendSuccess(['id' => $subjectId], 'Subject created successfully!');
                }
                $this->setSuccess('Subject created successfully!');
                return redirect()->back();
            } else {
                if ($this->isAjax()) {
                    return $this->sendError('Failed to create subject');
                }
                $this->setError('Failed to create subject');
                return redirect()->back()->withInput();
            }

        } catch (\Exception $e) {
            log_message('error', 'Subject creation error: ' . $e->getMessage());
            if ($this->isAjax()) {
                return $this->sendError('An error occurred while creating the subject');
            }
            $this->setError('An error occurred while creating the subject');
            return redirect()->back()->withInput();
        }
    }
}
