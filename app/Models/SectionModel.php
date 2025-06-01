<?php

namespace App\Models;

use CodeIgniter\Model;

class SectionModel extends Model
{
    protected $table = 'sections';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'section', 'class_id', 'is_active', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'section' => 'required|min_length[1]|max_length[50]',
        'class_id' => 'required|integer'
    ];

    protected $validationMessages = [
        'section' => [
            'required' => 'Section name is required',
            'min_length' => 'Section name must be at least 1 character',
            'max_length' => 'Section name cannot exceed 50 characters'
        ],
        'class_id' => [
            'required' => 'Class is required',
            'integer' => 'Class must be a valid ID'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get section with class details
     */
    public function getSectionWithClass($id)
    {
        return $this->select('sections.*, classes.class as class_name')
                   ->join('classes', 'classes.id = sections.class_id', 'left')
                   ->find($id);
    }

    /**
     * Get sections by class
     */
    public function getSectionsByClass($classId)
    {
        return $this->where('class_id', $classId)
                   ->where('is_active', 'yes')
                   ->orderBy('section', 'ASC')
                   ->findAll();
    }

    /**
     * Get all active sections
     */
    public function getActiveSections()
    {
        return $this->select('sections.*, classes.class as class_name')
                   ->join('classes', 'classes.id = sections.class_id', 'left')
                   ->where('sections.is_active', 'yes')
                   ->orderBy('classes.class', 'ASC')
                   ->orderBy('sections.section', 'ASC')
                   ->findAll();
    }

    /**
     * Get section statistics
     */
    public function getSectionStats()
    {
        $studentModel = new \App\Models\StudentModel();
        
        return [
            'total' => $this->countAll(),
            'active' => $this->where('is_active', 'yes')->countAllResults(),
            'with_students' => $this->select('sections.id')
                                  ->join('students', 'students.section_id = sections.id')
                                  ->groupBy('sections.id')
                                  ->countAllResults(),
        ];
    }

    /**
     * Get sections with student count
     */
    public function getSectionsWithStudentCount()
    {
        return $this->select('
            sections.*,
            classes.class as class_name,
            COUNT(students.id) as student_count
        ')
        ->join('classes', 'classes.id = sections.class_id', 'left')
        ->join('students', 'students.section_id = sections.id', 'left')
        ->groupBy('sections.id')
        ->orderBy('classes.class', 'ASC')
        ->orderBy('sections.section', 'ASC')
        ->findAll();
    }

    /**
     * Check if section can be deleted
     */
    public function canDelete($id)
    {
        $studentModel = new \App\Models\StudentModel();
        $hasStudents = $studentModel->where('section_id', $id)->countAllResults() > 0;
        
        return !$hasStudents;
    }

    /**
     * Get unique section for class validation
     */
    public function isUniqueForClass($section, $classId, $excludeId = null)
    {
        $builder = $this->where('section', $section)
                       ->where('class_id', $classId);
        
        if ($excludeId) {
            $builder->where('id !=', $excludeId);
        }
        
        return $builder->countAllResults() === 0;
    }
}
