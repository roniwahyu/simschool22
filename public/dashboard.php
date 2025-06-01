<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartSchool Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    <i class="fas fa-graduation-cap"></i>
                    <span class="brand-text">SmartSchool</span>
                </a>
                <button class="sidebar-close" id="sidebarClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="sidebar-content">
                <ul class="sidebar-nav nav flex-column">
                    <li class="nav-item">
                        <a href="/" class="nav-link active">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <!-- Student Management -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#studentSubmenu" aria-expanded="false">
                            <i class="fas fa-user-graduate"></i>
                            <span>Student Information</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="studentSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="/students" class="nav-link">Student Details</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/student-admission" class="nav-link">Student Admission</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/disabled-students" class="nav-link">Disabled Students</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/bulk-delete" class="nav-link">Bulk Delete</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Teacher Management -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#teacherSubmenu" aria-expanded="false">
                            <i class="fas fa-chalkboard-teacher"></i>
                            <span>Teachers</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="teacherSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="/teachers" class="nav-link">Staff Directory</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/add-staff" class="nav-link">Add Staff</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/staff-attendance" class="nav-link">Staff Attendance</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Academics -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#academicsSubmenu" aria-expanded="false">
                            <i class="fas fa-book"></i>
                            <span>Academics</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="academicsSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="/academics" class="nav-link">Class Timetable</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/assign-class-teacher" class="nav-link">Assign Class Teacher</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/promote-students" class="nav-link">Promote Students</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/subject-group" class="nav-link">Subject Group</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/subjects" class="nav-link">Subjects</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/classes" class="nav-link">Class</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/sections" class="nav-link">Sections</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Human Resource -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#hrSubmenu" aria-expanded="false">
                            <i class="fas fa-users"></i>
                            <span>Human Resource</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="hrSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Staff Directory</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Staff Attendance</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Payroll</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Leave Request</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Communicate -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#communicateSubmenu" aria-expanded="false">
                            <i class="fas fa-envelope"></i>
                            <span>Communicate</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="communicateSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Notice Board</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Send Email</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Send SMS</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Email/SMS Log</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Library -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#librarySubmenu" aria-expanded="false">
                            <i class="fas fa-book-open"></i>
                            <span>Library</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="librarySubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Book List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Issue Return</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Add Book</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Inventory -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#inventorySubmenu" aria-expanded="false">
                            <i class="fas fa-boxes"></i>
                            <span>Inventory</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="inventorySubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Item</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Add Item</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Item Store</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Item Supplier</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Transport -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#transportSubmenu" aria-expanded="false">
                            <i class="fas fa-bus"></i>
                            <span>Transport</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="transportSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Routes</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Vehicles</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Assign Vehicle</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Hostel -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#hostelSubmenu" aria-expanded="false">
                            <i class="fas fa-building"></i>
                            <span>Hostel</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="hostelSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Hostel Rooms</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Room Type</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Hostel</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Examinations -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#examSubmenu" aria-expanded="false">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Examinations</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="examSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Exam Group</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Exam Schedule</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Exam Result</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Design Admit Card</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Print Admit Card</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Marks Grade</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Online Examination -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#onlineExamSubmenu" aria-expanded="false">
                            <i class="fas fa-laptop"></i>
                            <span>Online Examination</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="onlineExamSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Online Exam</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Question Bank</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Lesson Plan -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#lessonSubmenu" aria-expanded="false">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Lesson Plan</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="lessonSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Manage Lesson Plan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Manage Syllabus Status</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Lesson</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Topic</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Download Center -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#downloadSubmenu" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            <span>Download Center</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="downloadSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Upload Content</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Assignment</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Study Material</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Syllabus</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Other Downloads</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Alumni -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#alumniSubmenu" aria-expanded="false">
                            <i class="fas fa-user-friends"></i>
                            <span>Alumni</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="alumniSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Manage Alumni</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Events</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Reports -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#reportsSubmenu" aria-expanded="false">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reports</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="reportsSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Student Information</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Finance</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Attendance</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Examination</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Human Resource</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Library</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Inventory</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Transport</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Hostel</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Alumni</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- System Settings -->
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#systemSubmenu" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <span>System Settings</span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <div class="collapse" id="systemSubmenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">General Setting</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Session Setting</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Notification Setting</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Email Config</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">SMS Config</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Payment Methods</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">Languages</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <!-- Module Generator -->
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="showModuleGenerator()">
                            <i class="fas fa-magic"></i>
                            <span>Module Generator</span>
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="sidebar-footer">
                <div class="version-info">
                    <small>SmartSchool v7.0</small>
                </div>
            </div>
        </nav>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-content">
                    <button class="sidebar-toggle" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="page-title">
                        <h4>Dashboard</h4>
                    </div>
                    
                    <div class="header-actions">
                        <div class="search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
                                <button class="btn" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge bg-danger rounded-pill">5</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">New student admission request</a></li>
                                <li><a class="dropdown-item" href="#">Fee payment reminder due</a></li>
                                <li><a class="dropdown-item" href="#">Staff attendance alert</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">View all notifications</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <a href="#" class="user-profile" data-bs-toggle="dropdown">
                                <div class="user-avatar">
                                    <img src="https://via.placeholder.com/40" alt="User Avatar">
                                </div>
                                <div class="user-info">
                                    <div class="user-name">Admin User</div>
                                    <div class="user-role">Administrator</div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Content Area -->
            <div class="content-area">
                <div id="dashboardContent">
                    <!-- Welcome Card -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="welcome-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="welcome-title">Welcome to SmartSchool Dashboard</h2>
                                        <p class="welcome-text">Comprehensive School Information System for modern educational management</p>
                                    </div>
                                    <div class="welcome-actions">
                                        <button class="btn btn-light me-2" onclick="showStudentAdmission()">
                                            <i class="fas fa-user-plus me-2"></i>Add Student
                                        </button>
                                        <button class="btn btn-outline-light" onclick="showModuleGenerator()">
                                            <i class="fas fa-magic me-2"></i>Module Generator
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stats-card stats-primary">
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <div class="stats-info">
                                        <div class="stats-number">1,247</div>
                                        <div class="stats-label">Total Students</div>
                                        <div class="stats-change">
                                            <i class="fas fa-arrow-up"></i>+12% from last month
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stats-card stats-success">
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <div class="stats-info">
                                        <div class="stats-number">89</div>
                                        <div class="stats-label">Teachers</div>
                                        <div class="stats-change">
                                            <i class="fas fa-arrow-up"></i>+3% from last month
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stats-card stats-warning">
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <div class="stats-info">
                                        <div class="stats-number">45</div>
                                        <div class="stats-label">Subjects</div>
                                        <div class="stats-change">
                                            <i class="fas fa-minus"></i>No change
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-3">
                            <div class="stats-card stats-info">
                                <div class="stats-content">
                                    <div class="stats-icon">
                                        <i class="fas fa-school"></i>
                                    </div>
                                    <div class="stats-info">
                                        <div class="stats-number">12</div>
                                        <div class="stats-label">Classes</div>
                                        <div class="stats-change">
                                            <i class="fas fa-arrow-up"></i>+1 new class
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions & Recent Activity -->
                    <div class="row">
                        <div class="col-lg-8 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-chart-line me-2"></i>Student Enrollment Trends
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="enrollmentChart" height="300"></canvas>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-tasks me-2"></i>Quick Actions
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-primary" onclick="showStudentAdmission()">
                                            <i class="fas fa-user-plus me-2"></i>Add New Student
                                        </button>
                                        <button class="btn btn-outline-success">
                                            <i class="fas fa-user-tie me-2"></i>Add New Staff
                                        </button>
                                        <button class="btn btn-outline-info">
                                            <i class="fas fa-calendar-plus me-2"></i>Create Timetable
                                        </button>
                                        <button class="btn btn-outline-warning">
                                            <i class="fas fa-clipboard-list me-2"></i>Generate Reports
                                        </button>
                                        <button class="btn btn-outline-secondary" onclick="showModuleGenerator()">
                                            <i class="fas fa-magic me-2"></i>Module Generator
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Activities -->
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-bell me-2"></i>Recent Activities
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="activity-item">
                                        <div class="activity-icon bg-primary">
                                            <i class="fas fa-user-plus"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h6>New Student Admission</h6>
                                            <p>John Doe admitted to Class 10-A</p>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                    </div>
                                    
                                    <div class="activity-item">
                                        <div class="activity-icon bg-success">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h6>Fee Payment Received</h6>
                                            <p>₹25,000 fee payment from Sarah Wilson</p>
                                            <small class="text-muted">4 hours ago</small>
                                        </div>
                                    </div>
                                    
                                    <div class="activity-item">
                                        <div class="activity-icon bg-warning">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                        <div class="activity-content">
                                            <h6>Attendance Alert</h6>
                                            <p>Low attendance detected for Class 8-B</p>
                                            <small class="text-muted">6 hours ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-calendar me-2"></i>Upcoming Events
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="event-item">
                                        <div class="event-date">
                                            <span class="day">15</span>
                                            <span class="month">Jun</span>
                                        </div>
                                        <div class="event-content">
                                            <h6>Annual Sports Day</h6>
                                            <p>School ground activities and competitions</p>
                                        </div>
                                    </div>
                                    
                                    <div class="event-item">
                                        <div class="event-date">
                                            <span class="day">20</span>
                                            <span class="month">Jun</span>
                                        </div>
                                        <div class="event-content">
                                            <h6>Parent-Teacher Meeting</h6>
                                            <p>Quarterly academic progress discussion</p>
                                        </div>
                                    </div>
                                    
                                    <div class="event-item">
                                        <div class="event-date">
                                            <span class="day">25</span>
                                            <span class="month">Jun</span>
                                        </div>
                                        <div class="event-content">
                                            <h6>Science Exhibition</h6>
                                            <p>Student project showcase</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Module Generator Content (hidden by default) -->
                <div id="moduleGeneratorContent" style="display: none;">
                    <!-- Module Generator content will be loaded here -->
                </div>
                
                <!-- Student Admission Content (hidden by default) -->
                <div id="studentAdmissionContent" style="display: none;">
                    <!-- Student admission form will be loaded here -->
                </div>
            </div>
        </main>
    </div>
    
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <style>
        .activity-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .activity-item:last-child {
            border-bottom: none;
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-right: 1rem;
            flex-shrink: 0;
        }
        
        .activity-content h6 {
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        
        .activity-content p {
            margin-bottom: 0.25rem;
            color: #6c757d;
        }
        
        .event-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .event-item:last-child {
            border-bottom: none;
        }
        
        .event-date {
            text-align: center;
            margin-right: 1rem;
            min-width: 50px;
        }
        
        .event-date .day {
            display: block;
            font-size: 1.5rem;
            font-weight: 700;
            color: #007bff;
        }
        
        .event-date .month {
            display: block;
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
        }
        
        .event-content h6 {
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        
        .event-content p {
            margin-bottom: 0;
            color: #6c757d;
        }
    </style>
    
    <script>
        // Initialize enrollment chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('enrollmentChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'New Enrollments',
                        data: [65, 78, 90, 81, 95, 102],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
        
        function showModuleGenerator() {
            document.getElementById('dashboardContent').style.display = 'none';
            document.getElementById('studentAdmissionContent').style.display = 'none';
            document.getElementById('moduleGeneratorContent').style.display = 'block';
            
            // Load module generator content
            document.getElementById('moduleGeneratorContent').innerHTML = `
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="welcome-card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h2 class="welcome-title">Module Generator</h2>
                                        <p class="welcome-text">Generate complete CRUD modules with models, controllers, and views</p>
                                    </div>
                                    <div class="welcome-actions">
                                        <button class="btn btn-light me-2" onclick="showDashboard()">
                                            <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-cogs me-2"></i>CRUD Generator
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Generate complete CRUD (Create, Read, Update, Delete) modules with:</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Model with validation rules</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Controller with all CRUD methods</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Views (List, Create, Edit)</li>
                                        <li><i class="fas fa-check text-success me-2"></i>DataTables integration</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Form validation</li>
                                    </ul>
                                    <div class="d-grid">
                                        <button class="btn btn-primary" onclick="showCRUDGenerator()">
                                            <i class="fas fa-rocket me-1"></i>Start Generation
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-success">
                                <div class="card-header bg-success text-white">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-wpforms me-2"></i>Form Builder
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Build dynamic forms with drag-and-drop interface:</p>
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-check text-success me-2"></i>Drag & drop form fields</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Field validation rules</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Custom field properties</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Form preview</li>
                                        <li><i class="fas fa-check text-success me-2"></i>Export form HTML</li>
                                    </ul>
                                    <div class="d-grid">
                                        <button class="btn btn-success" onclick="showFormBuilder()">
                                            <i class="fas fa-hammer me-1"></i>Build Form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
        
        function showStudentAdmission() {
            document.getElementById('dashboardContent').style.display = 'none';
            document.getElementById('moduleGeneratorContent').style.display = 'none';
            document.getElementById('studentAdmissionContent').style.display = 'block';
            
            // Load student admission form
            document.getElementById('studentAdmissionContent').innerHTML = `
                <div class="container-fluid">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">
                                            <i class="fas fa-user-plus me-2"></i>Student Admission
                                        </h4>
                                        <button class="btn btn-secondary" onclick="showDashboard()">
                                            <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="studentAdmissionForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admission_no" class="form-label">Admission No <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="admission_no" name="admission_no" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="roll_no" class="form-label">Roll Number</label>
                                                    <input type="text" class="form-control" id="roll_no" name="roll_no">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="lastname" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastname" name="lastname">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="class_id" class="form-label">Class <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="class_id" name="class_id" required>
                                                        <option value="">Select Class</option>
                                                        <option value="1">Class 1</option>
                                                        <option value="2">Class 2</option>
                                                        <option value="3">Class 3</option>
                                                        <option value="4">Class 4</option>
                                                        <option value="5">Class 5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="section_id" class="form-label">Section <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="section_id" name="section_id" required>
                                                        <option value="">Select Section</option>
                                                        <option value="1">A</option>
                                                        <option value="2">B</option>
                                                        <option value="3">C</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="dob" class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control" id="dob" name="dob">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="mobileno" class="form-label">Mobile Number</label>
                                                    <input type="tel" class="form-control" id="mobileno" name="mobileno">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr class="my-4">
                                        <h5 class="text-primary mb-3">Parent/Guardian Information</h5>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="father_name" class="form-label">Father's Name</label>
                                                    <input type="text" class="form-control" id="father_name" name="father_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="father_phone" class="form-label">Father's Phone</label>
                                                    <input type="tel" class="form-control" id="father_phone" name="father_phone">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="mother_name" class="form-label">Mother's Name</label>
                                                    <input type="text" class="form-control" id="mother_name" name="mother_name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="mother_phone" class="form-label">Mother's Phone</label>
                                                    <input type="tel" class="form-control" id="mother_phone" name="mother_phone">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label for="current_address" class="form-label">Current Address</label>
                                                    <textarea class="form-control" id="current_address" name="current_address" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-end">
                                            <button type="button" class="btn btn-secondary me-2" onclick="showDashboard()">Cancel</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Save Student
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
        
        function showDashboard() {
            document.getElementById('moduleGeneratorContent').style.display = 'none';
            document.getElementById('studentAdmissionContent').style.display = 'none';
            document.getElementById('dashboardContent').style.display = 'block';
        }
        
        function showCRUDGenerator() {
            window.location.href = 'module-generator.php';
        }
        
        function showFormBuilder() {
            window.location.href = 'form-builder.php';
        }
        
        // Mobile sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        });
        
        document.getElementById('sidebarClose').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
        
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
        });
    </script>
</body>
</html>