<aside class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <i class="fas fa-graduation-cap text-primary me-2"></i>
            <span class="brand-text">SmartSchool</span>
        </div>
        <button type="button" class="btn btn-link sidebar-close d-lg-none" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    <div class="sidebar-content">
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link <?= url_is('/') || url_is('dashboard*') ? 'active' : '' ?>" href="<?= base_url('/') ?>">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <!-- Students Management -->
                <li class="nav-item">
                    <a class="nav-link <?= url_is('students*') ? 'active' : '' ?>" href="<?= base_url('students') ?>">
                        <i class="fas fa-user-graduate"></i>
                        <span>Students</span>
                    </a>
                </li>
                
                <!-- Academic Management -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= url_is('classes*') || url_is('sections*') || url_is('academic*') ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#academicMenu" 
                       aria-expanded="<?= url_is('classes*') || url_is('sections*') || url_is('academic*') ? 'true' : 'false' ?>">
                        <i class="fas fa-book-open"></i>
                        <span>Academic</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse <?= url_is('classes*') || url_is('sections*') || url_is('academic*') ? 'show' : '' ?>" id="academicMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('academic') ? 'active' : '' ?>" href="<?= base_url('academic') ?>">
                                    <i class="fas fa-chart-line"></i>
                                    <span>Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('classes*') ? 'active' : '' ?>" href="<?= base_url('classes') ?>">
                                    <i class="fas fa-chalkboard"></i>
                                    <span>Classes</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('sections*') ? 'active' : '' ?>" href="<?= base_url('sections') ?>">
                                    <i class="fas fa-layer-group"></i>
                                    <span>Sections</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('academic/sessions*') ? 'active' : '' ?>" href="<?= base_url('academic/sessions') ?>">
                                    <i class="fas fa-calendar-alt"></i>
                                    <span>Sessions</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('academic/subjects*') ? 'active' : '' ?>" href="<?= base_url('academic/subjects') ?>">
                                    <i class="fas fa-book"></i>
                                    <span>Subjects</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Infrastructure -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= url_is('rooms*') ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#infrastructureMenu" 
                       aria-expanded="<?= url_is('rooms*') ? 'true' : 'false' ?>">
                        <i class="fas fa-building"></i>
                        <span>Infrastructure</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse <?= url_is('rooms*') ? 'show' : '' ?>" id="infrastructureMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('rooms*') ? 'active' : '' ?>" href="<?= base_url('rooms') ?>">
                                    <i class="fas fa-door-open"></i>
                                    <span>Rooms</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Tools & Utilities -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= url_is('module-generator*') ? 'active' : '' ?>" 
                       href="#" data-bs-toggle="collapse" data-bs-target="#toolsMenu" 
                       aria-expanded="<?= url_is('module-generator*') ? 'true' : 'false' ?>">
                        <i class="fas fa-tools"></i>
                        <span>Tools</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse <?= url_is('module-generator*') ? 'show' : '' ?>" id="toolsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('module-generator') ? 'active' : '' ?>" href="<?= base_url('module-generator') ?>">
                                    <i class="fas fa-cogs"></i>
                                    <span>Module Generator</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= url_is('module-generator/form-builder') ? 'active' : '' ?>" href="<?= base_url('module-generator/form-builder') ?>">
                                    <i class="fas fa-wpforms"></i>
                                    <span>Form Builder</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Reports -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#reportsMenu" aria-expanded="false">
                        <i class="fas fa-chart-bar"></i>
                        <span>Reports</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="reportsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-users"></i>
                                    <span>Student Reports</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-chart-pie"></i>
                                    <span>Academic Reports</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-file-export"></i>
                                    <span>Export Data</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Settings -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#settingsMenu" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                        <i class="fas fa-chevron-down ms-auto"></i>
                    </a>
                    <div class="collapse" id="settingsMenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-school"></i>
                                    <span>School Settings</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-users-cog"></i>
                                    <span>User Management</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-shield-alt"></i>
                                    <span>Permissions</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-database"></i>
                                    <span>Backup & Restore</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
    
    <div class="sidebar-footer">
        <div class="footer-content">
            <div class="version-info">
                <small class="text-muted">Version 1.0.0</small>
            </div>
        </div>
    </div>
</aside>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay d-lg-none" id="sidebarOverlay"></div>
