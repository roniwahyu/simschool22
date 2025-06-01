<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\SectionModel;
use App\Models\RoomModel;
use App\Models\SessionModel;

class Dashboard extends BaseController
{
    protected $studentModel;
    protected $classModel;
    protected $sectionModel;
    protected $roomModel;
    protected $sessionModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->classModel = new ClassModel();
        $this->sectionModel = new SectionModel();
        $this->roomModel = new RoomModel();
        $this->sessionModel = new SessionModel();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Dashboard',
            'breadcrumb' => ['Dashboard'],
            'stats' => $this->getStatistics(),
        ];

        return $this->render('dashboard/index', $data);
    }

    public function getStats()
    {
        if (!$this->isAjax()) {
            return redirect()->to('/');
        }

        $stats = $this->getStatistics();
        return $this->sendSuccess($stats);
    }

    private function getStatistics()
    {
        try {
            // Get basic counts
            $totalStudents = $this->studentModel->countAll();
            $totalClasses = $this->classModel->countAll();
            $totalSections = $this->sectionModel->countAll();
            $totalRooms = $this->roomModel->countAll();

            // Get active session
            $activeSession = $this->sessionModel->where('is_active', 'yes')->first();

            // Get recent activities
            $recentStudents = $this->studentModel
                ->select('firstname, lastname, created_at')
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->find();

            // Get class-wise student count
            $classWiseCount = $this->studentModel
                ->select('classes.class as class_name, COUNT(students.id) as student_count')
                ->join('classes', 'classes.id = students.class_id', 'left')
                ->groupBy('students.class_id')
                ->orderBy('student_count', 'DESC')
                ->limit(10)
                ->findAll();

            // Get monthly enrollment data (last 6 months)
            $monthlyData = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = date('Y-m', strtotime("-$i months"));
                $count = $this->studentModel
                    ->where('DATE_FORMAT(created_at, "%Y-%m")', $month)
                    ->countAllResults();
                
                $monthlyData[] = [
                    'month' => date('M Y', strtotime("-$i months")),
                    'count' => $count
                ];
            }

            return [
                'total_students' => $totalStudents,
                'total_classes' => $totalClasses,
                'total_sections' => $totalSections,
                'total_rooms' => $totalRooms,
                'active_session' => $activeSession,
                'recent_students' => $recentStudents,
                'class_wise_count' => $classWiseCount,
                'monthly_enrollment' => $monthlyData,
            ];

        } catch (\Exception $e) {
            log_message('error', 'Dashboard statistics error: ' . $e->getMessage());
            return [
                'total_students' => 0,
                'total_classes' => 0,
                'total_sections' => 0,
                'total_rooms' => 0,
                'active_session' => null,
                'recent_students' => [],
                'class_wise_count' => [],
                'monthly_enrollment' => [],
            ];
        }
    }
}
