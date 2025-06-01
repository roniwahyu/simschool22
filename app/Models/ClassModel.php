<?php

namespace App\Models;

use CodeIgniter\Model;

class ClassModel extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'class', 'is_active', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'class' => 'required|min_length[1]|max_length[50]'
    ];

    protected $validationMessages = [
        'class' => [
            'required' => 'Class name is required',
            'min_length' => 'Class name must be at least 1 character',
            'max_length' => 'Class name cannot exceed 50 characters'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get class with sections
     */
    public function getClassWithSections($id)
    {
        $class = $this->find($id);
        
        if ($class) {
            $sectionModel = new SectionModel();
            $class['sections'] = $sectionModel->where('class_id', $id)->findAll();
        }
        
        return $class;
    }

    /**
     * Get all active classes
     */
    public function getActiveClasses()
    {
        return $this->where('is_active', 'yes')
                   ->orderBy('class', 'ASC')
                   ->findAll();
    }

    /**
     * Get class statistics
     */
    public function getClassStats()
    {
        $studentModel = new \App\Models\StudentModel();
        
        return [
            'total' => $this->countAll(),
            'active' => $this->where('is_active', 'yes')->countAllResults(),
            'with_students' => $this->select('classes.id')
                                  ->join('students', 'students.class_id = classes.id')
                                  ->groupBy('classes.id')
                                  ->countAllResults(),
        ];
    }

    /**
     * Get classes with student count
     */
    public function getClassesWithStudentCount()
    {
        return $this->select('
            classes.*,
            COUNT(students.id) as student_count
        ')
        ->join('students', 'students.class_id = classes.id', 'left')
        ->groupBy('classes.id')
        ->orderBy('classes.class', 'ASC')
        ->findAll();
    }

    /**
     * Check if class can be deleted
     */
    public function canDelete($id)
    {
        $studentModel = new \App\Models\StudentModel();
        $hasStudents = $studentModel->where('class_id', $id)->countAllResults() > 0;
        
        $sectionModel = new SectionModel();
        $hasSections = $sectionModel->where('class_id', $id)->countAllResults() > 0;
        
        return !$hasStudents && !$hasSections;
    }
}
