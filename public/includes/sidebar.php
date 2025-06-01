<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="/" class="sidebar-brand">
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
                <a href="/" class="nav-link <?= (isset($currentModule) && $currentModule == 'dashboard') ? 'active' : '' ?>">
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
                            <a href="/hr" class="nav-link">Staff Directory</a>
                        </li>
                        <li class="nav-item">
                            <a href="/staff-attendance" class="nav-link">Staff Attendance</a>
                        </li>
                        <li class="nav-item">
                            <a href="/payroll" class="nav-link">Payroll</a>
                        </li>
                        <li class="nav-item">
                            <a href="/leave-request" class="nav-link">Leave Request</a>
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
                            <a href="/notice-board" class="nav-link">Notice Board</a>
                        </li>
                        <li class="nav-item">
                            <a href="/send-email" class="nav-link">Send Email</a>
                        </li>
                        <li class="nav-item">
                            <a href="/send-sms" class="nav-link">Send SMS</a>
                        </li>
                        <li class="nav-item">
                            <a href="/email-sms-log" class="nav-link">Email/SMS Log</a>
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
                            <a href="/library" class="nav-link">Book List</a>
                        </li>
                        <li class="nav-item">
                            <a href="/issue-return" class="nav-link">Issue Return</a>
                        </li>
                        <li class="nav-item">
                            <a href="/add-book" class="nav-link">Add Book</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            <!-- Tools -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#toolsSubmenu" aria-expanded="false">
                    <i class="fas fa-tools"></i>
                    <span>Development Tools</span>
                    <i class="fas fa-chevron-down"></i>
                </a>
                <div class="collapse" id="toolsSubmenu">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a href="/module-generator" class="nav-link">Module Generator</a>
                        </li>
                        <li class="nav-item">
                            <a href="/form-builder" class="nav-link">Form Builder</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>