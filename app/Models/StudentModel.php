<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'admission_no', 'roll_no', 'firstname', 'lastname', 'image', 'mobileno', 'email',
        'state', 'city', 'pincode', 'religion', 'dob', 'current_address', 'permanent_address',
        'category_id', 'adhar_no', 'samagra_id', 'bank_account_no', 'bank_name', 'ifsc_code',
        'guardian_is', 'father_name', 'father_phone', 'father_occupation', 'mother_name',
        'mother_phone', 'mother_occupation', 'guardian_name', 'guardian_relation',
        'guardian_phone', 'guardian_occupation', 'guardian_address', 'guardian_email',
        'father_pic', 'mother_pic', 'guardian_pic', 'is_active', 'created_at', 'updated_at',
        'father_email', 'mother_email', 'rte', 'gender', 'blood_group', 'school_house_id',
        'student_session_id', 'class_id', 'section_id', 'session_id', 'user_id', 'parent_id',
        'admission_date', 'student_photo', 'measurement_date', 'height', 'weight', 'note',
        'cast', 'disability'
    ];

    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $validationRules = [
        'firstname' => 'required|min_length[2]|max_length[50]',
        'lastname' => 'required|min_length[2]|max_length[50]',
        'email' => 'permit_empty|valid_email',
        'mobileno' => 'permit_empty|min_length[10]|max_length[15]',
        'dob' => 'permit_empty|valid_date',
        'gender' => 'permit_empty|in_list[Male,Female]',
        'class_id' => 'permit_empty|integer',
        'section_id' => 'permit_empty|integer',
        'session_id' => 'permit_empty|integer',
    ];

    protected $validationMessages = [
        'firstname' => [
            'required' => 'First name is required',
            'min_length' => 'First name must be at least 2 characters',
            'max_length' => 'First name cannot exceed 50 characters'
        ],
        'lastname' => [
            'required' => 'Last name is required',
            'min_length' => 'Last name must be at least 2 characters',
            'max_length' => 'Last name cannot exceed 50 characters'
        ],
        'email' => [
            'valid_email' => 'Please enter a valid email address'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Get student with class, section, and session details
     */
    public function getStudentWithDetails($id)
    {
        return $this->select('
            students.*,
            classes.class as class_name,
            sections.section as section_name,
            sessions.session as session_name,
            categories.category as category_name
        ')
        ->join('classes', 'classes.id = students.class_id', 'left')
        ->join('sections', 'sections.id = students.section_id', 'left')
        ->join('sessions', 'sessions.id = students.session_id', 'left')
        ->join('categories', 'categories.id = students.category_id', 'left')
        ->find($id);
    }

    /**
     * Get students for export
     */
    public function getStudentsForExport()
    {
        return $this->select('
            students.admission_no,
            students.firstname,
            students.lastname,
            students.email,
            students.mobileno,
            students.dob,
            students.gender,
            students.is_active,
            classes.class as class_name,
            sections.section as section_name,
            sessions.session as session_name
        ')
        ->join('classes', 'classes.id = students.class_id', 'left')
        ->join('sections', 'sections.id = students.section_id', 'left')
        ->join('sessions', 'sessions.id = students.session_id', 'left')
        ->orderBy('students.firstname', 'ASC')
        ->findAll();
    }

    /**
     * Get students by class
     */
    public function getStudentsByClass($classId, $sectionId = null)
    {
        $builder = $this->where('class_id', $classId);
        
        if ($sectionId) {
            $builder->where('section_id', $sectionId);
        }
        
        return $builder->where('is_active', 'yes')
                      ->orderBy('firstname', 'ASC')
                      ->findAll();
    }

    /**
     * Get student statistics
     */
    public function getStudentStats()
    {
        return [
            'total' => $this->countAll(),
            'active' => $this->where('is_active', 'yes')->countAllResults(),
            'inactive' => $this->where('is_active', 'no')->countAllResults(),
            'male' => $this->where('gender', 'Male')->countAllResults(),
            'female' => $this->where('gender', 'Female')->countAllResults(),
        ];
    }

    /**
     * Search students
     */
    public function searchStudents($query)
    {
        return $this->select('
            students.*,
            classes.class as class_name,
            sections.section as section_name
        ')
        ->join('classes', 'classes.id = students.class_id', 'left')
        ->join('sections', 'sections.id = students.section_id', 'left')
        ->groupStart()
            ->like('students.firstname', $query)
            ->orLike('students.lastname', $query)
            ->orLike('students.admission_no', $query)
            ->orLike('students.email', $query)
        ->groupEnd()
        ->where('students.is_active', 'yes')
        ->limit(10)
        ->findAll();
    }
}
