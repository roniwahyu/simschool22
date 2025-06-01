<!-- Top Navigation Bar -->
<nav class="topbar">
    <div class="topbar-content">
        <div class="topbar-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="breadcrumb-container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                        <?php if(isset($currentPage) && $currentPage != 'Dashboard'): ?>
                        <li class="breadcrumb-item active"><?= htmlspecialchars($currentPage) ?></li>
                        <?php endif; ?>
                    </ol>
                </nav>
            </div>
        </div>
        
        <div class="topbar-right">
            <div class="dropdown notifications">
                <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell"></i>
                    <span class="badge bg-danger">3</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><h6 class="dropdown-header">Notifications</h6></li>
                    <li><a class="dropdown-item" href="#">New student admission pending</a></li>
                    <li><a class="dropdown-item" href="#">Fee reminder for Class 5</a></li>
                    <li><a class="dropdown-item" href="#">Staff attendance low</a></li>
                </ul>
            </div>
            
            <div class="dropdown user-menu">
                <button class="btn btn-link" type="button" data-bs-toggle="dropdown">
                    <img src="https://via.placeholder.com/32" class="rounded-circle me-2" alt="User">
                    <span>Admin User</span>
                    <i class="fas fa-chevron-down ms-2"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/profile"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="/settings"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>