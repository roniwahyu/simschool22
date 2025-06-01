<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'sessions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'session', 'is_active', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'session' => 'required|min_length[4]|max_length[20]'
    ];

    protected $validationMessages = [
        'session' => [
            'required' => 'Session name is required',
            'min_length' => 'Session name must be at least 4 characters',
            'max_length' => 'Session name cannot exceed 20 characters'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get active session
     */
    public function getActiveSession()
    {
        return $this->where('is_active', 'yes')->first();
    }

    /**
     * Get all active sessions
     */
    public function getActiveSessions()
    {
        return $this->where('is_active', 'yes')
                   ->orderBy('session', 'DESC')
                   ->findAll();
    }

    /**
     * Set session as active (deactivate others)
     */
    public function setActiveSession($id)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // Deactivate all sessions
            $this->set('is_active', 'no')->update();
            
            // Activate the selected session
            $result = $this->update($id, ['is_active' => 'yes']);
            
            $db->transComplete();
            
            return $db->transStatus();
        } catch (\Exception $e) {
            $db->transRollback();
            return false;
        }
    }

    /**
     * Get session statistics
     */
    public function getSessionStats()
    {
        $studentModel = new \App\Models\StudentModel();
        
        return [
            'total' => $this->countAll(),
            'active' => $this->where('is_active', 'yes')->countAllResults(),
            'with_students' => $this->select('sessions.id')
                                  ->join('students', 'students.session_id = sessions.id')
                                  ->groupBy('sessions.id')
                                  ->countAllResults(),
        ];
    }

    /**
     * Get sessions with student count
     */
    public function getSessionsWithStudentCount()
    {
        return $this->select('
            sessions.*,
            COUNT(students.id) as student_count
        ')
        ->join('students', 'students.session_id = sessions.id', 'left')
        ->groupBy('sessions.id')
        ->orderBy('sessions.session', 'DESC')
        ->findAll();
    }

    /**
     * Check if session can be deleted
     */
    public function canDelete($id)
    {
        $studentModel = new \App\Models\StudentModel();
        $hasStudents = $studentModel->where('session_id', $id)->countAllResults() > 0;
        
        return !$hasStudents;
    }

    /**
     * Generate next session
     */
    public function generateNextSession()
    {
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        
        return $currentYear . '-' . $nextYear;
    }

    /**
     * Check if session name is unique
     */
    public function isSessionUnique($session, $excludeId = null)
    {
        $builder = $this->where('session', $session);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->countAllResults() === 0;
    }
}
