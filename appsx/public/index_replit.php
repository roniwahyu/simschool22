<?php
// Simple PHP application entry point for SmartSchool Dashboard
session_start();

// Basic routing
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$path = trim($path, '/');

// Route handling
switch($path) {
    case '':
    case 'dashboard':
        include 'dashboard.php';
        break;
    case 'module-generator':
        include 'module-generator.php';
        break;
    case 'form-builder':
        include 'form-builder.php';
        break;
    case 'students':
    case 'student-details':
        include 'modules/students.php';
        break;
    case 'student-admission':
        include 'modules/student-admission.php';
        break;
    case 'teachers':
    case 'staff-directory':
        include 'modules/teachers.php';
        break;
    case 'add-staff':
        include 'modules/add-staff.php';
        break;
    case 'academics':
    case 'class-timetable':
        include 'modules/academics.php';
        break;
    case 'subjects':
        include 'modules/subjects.php';
        break;
    case 'classes':
        include 'modules/classes.php';
        break;
    case 'hr':
    case 'human-resource':
        include 'modules/hr.php';
        break;
    case 'payroll':
        include 'modules/payroll.php';
        break;
    case 'communicate':
        include 'modules/communicate.php';
        break;
    case 'notice-board':
        include 'modules/notice-board.php';
        break;
    case 'library':
        include 'modules/library.php';
        break;
    case 'inventory':
        include 'modules/inventory.php';
        break;
    case 'transport':
        include 'modules/transport.php';
        break;
    case 'hostel':
        include 'modules/hostel.php';
        break;
    case 'examinations':
        include 'modules/examinations.php';
        break;
    case 'online-exam':
        include 'modules/online-exam.php';
        break;
    case 'lesson-plan':
        include 'modules/lesson-plan.php';
        break;
    case 'attendance':
        include 'modules/attendance.php';
        break;
    case 'homework':
        include 'modules/homework.php';
        break;
    case 'fees':
        include 'modules/fees.php';
        break;
    case 'accounts':
        include 'modules/accounts.php';
        break;
    case 'reports':
        include 'modules/reports.php';
        break;
    case 'system-settings':
        include 'modules/system-settings.php';
        break;
    case 'whatsapp':
        include 'modules/whatsapp.php';
        break;
    default:
        // Show 404 or redirect to dashboard
        include 'dashboard.php';
        break;
}
?>