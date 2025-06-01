<?php

namespace App\Models;

use CodeIgniter\Model;

class SubjectModel extends Model
{
    protected $table = 'subjects';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'name', 'code', 'type', 'subject_group_id', 'is_active', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'name' => 'required|min_length[2]|max_length[100]',
        'code' => 'required|min_length[2]|max_length[20]',
        'type' => 'required|in_list[Theory,Practical]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Subject name is required',
            'min_length' => 'Subject name must be at least 2 characters',
            'max_length' => 'Subject name cannot exceed 100 characters'
        ],
        'code' => [
            'required' => 'Subject code is required',
            'min_length' => 'Subject code must be at least 2 characters',
            'max_length' => 'Subject code cannot exceed 20 characters'
        ],
        'type' => [
            'required' => 'Subject type is required',
            'in_list' => 'Subject type must be Theory or Practical'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get all active subjects
     */
    public function getActiveSubjects()
    {
        return $this->where('is_active', 'yes')
                   ->orderBy('name', 'ASC')
                   ->findAll();
    }

    /**
     * Get subjects by type
     */
    public function getSubjectsByType($type)
    {
        return $this->where('type', $type)
                   ->where('is_active', 'yes')
                   ->orderBy('name', 'ASC')
                   ->findAll();
    }

    /**
     * Get subject statistics
     */
    public function getSubjectStats()
    {
        return [
            'total' => $this->countAll(),
            'active' => $this->where('is_active', 'yes')->countAllResults(),
            'theory' => $this->where('type', 'Theory')->where('is_active', 'yes')->countAllResults(),
            'practical' => $this->where('type', 'Practical')->where('is_active', 'yes')->countAllResults(),
        ];
    }

    /**
     * Get subjects with group details
     */
    public function getSubjectsWithGroups()
    {
        return $this->select('subjects.*, subject_groups.name as group_name')
                   ->join('subject_groups', 'subject_groups.id = subjects.subject_group_id', 'left')
                   ->where('subjects.is_active', 'yes')
                   ->orderBy('subjects.name', 'ASC')
                   ->findAll();
    }

    /**
     * Search subjects
     */
    public function searchSubjects($query)
    {
        return $this->groupStart()
                   ->like('name', $query)
                   ->orLike('code', $query)
                   ->groupEnd()
                   ->where('is_active', 'yes')
                   ->limit(10)
                   ->findAll();
    }

    /**
     * Check if subject code is unique
     */
    public function isCodeUnique($code, $excludeId = null)
    {
        $builder = $this->where('code', $code);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->countAllResults() === 0;
    }

    /**
     * Get subjects by class
     */
    public function getSubjectsByClass($classId)
    {
        // This would typically involve a class_subjects relationship table
        // For now, return all active subjects
        return $this->getActiveSubjects();
    }
}
