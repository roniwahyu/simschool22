<header class="header">
    <div class="header-content">
        <!-- Mobile Menu Toggle -->
        <button type="button" class="btn btn-link sidebar-toggle d-lg-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <!-- Page Title -->
        <div class="page-title">
            <h4 class="mb-0"><?= $page_title ?? 'Dashboard' ?></h4>
        </div>
        
        <!-- Header Actions -->
        <div class="header-actions">
            <!-- Search -->
            <div class="search-box me-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." id="globalSearch">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <!-- Notifications -->
            <div class="dropdown me-3">
                <button class="btn btn-link position-relative" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                        <span class="visually-hidden">unread notifications</span>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end notification-dropdown">
                    <li class="dropdown-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Notifications</span>
                            <span class="badge bg-primary rounded-pill">3</span>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-user-plus text-success"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">New student registered</div>
                                    <div class="text-muted small">John Doe has been enrolled in Class 10-A</div>
                                    <div class="text-muted small">2 minutes ago</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-calendar text-info"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Class schedule updated</div>
                                    <div class="text-muted small">Mathematics class moved to Room 101</div>
                                    <div class="text-muted small">1 hour ago</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-warning"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">System maintenance</div>
                                    <div class="text-muted small">Scheduled for tonight at 11:00 PM</div>
                                    <div class="text-muted small">3 hours ago</div>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-center" href="#">
                            <small>View all notifications</small>
                        </a>
                    </li>
                </ul>
            </div>
            
            <!-- Settings -->
            <div class="dropdown me-3">
                <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-cog fs-5"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-palette me-2"></i>Theme</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-language me-2"></i>Language</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-question-circle me-2"></i>Help</a></li>
                </ul>
            </div>
            
            <!-- User Profile -->
            <div class="dropdown">
                <button class="btn btn-link user-profile" type="button" data-bs-toggle="dropdown">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar me-2">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=007bff&color=fff" alt="User" class="rounded-circle">
                        </div>
                        <div class="user-info d-none d-md-block">
                            <div class="user-name">Administrator</div>
                            <div class="user-role">Super Admin</div>
                        </div>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-header">
                        <div class="d-flex align-items-center">
                            <div class="user-avatar me-2">
                                <img src="https://ui-avatars.com/api/?name=Admin&background=007bff&color=fff" alt="User" class="rounded-circle">
                            </div>
                            <div>
                                <div class="fw-semibold">Administrator</div>
                                <div class="text-muted small">admin@smartschool.com</div>
                            </div>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>My Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-key me-2"></i>Change Password</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-bell me-2"></i>Notifications</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
