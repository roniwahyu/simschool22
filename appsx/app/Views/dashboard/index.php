<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="welcome-title">Welcome to SmartSchool Dashboard</h2>
                        <p class="welcome-text">Manage your school efficiently with our comprehensive system</p>
                    </div>
                    <div class="welcome-actions">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quickActionsModal">
                            <i class="fas fa-plus me-2"></i>Quick Actions
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-primary">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number" id="totalStudents"><?= $stats['total_students'] ?? 0 ?></h3>
                        <p class="stats-label">Total Students</p>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12% from last month</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-success">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number" id="totalClasses"><?= $stats['total_classes'] ?? 0 ?></h3>
                        <p class="stats-label">Total Classes</p>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up"></i>
                            <span>+2 new classes</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-warning">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number" id="totalSections"><?= $stats['total_sections'] ?? 0 ?></h3>
                        <p class="stats-label">Total Sections</p>
                        <div class="stats-change">
                            <i class="fas fa-minus"></i>
                            <span>No change</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-3">
            <div class="stats-card stats-info">
                <div class="stats-content">
                    <div class="stats-icon">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <div class="stats-info">
                        <h3 class="stats-number" id="totalRooms"><?= $stats['total_rooms'] ?? 0 ?></h3>
                        <p class="stats-label">Total Rooms</p>
                        <div class="stats-change">
                            <i class="fas fa-arrow-up"></i>
                            <span>+1 new room</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Charts and Analytics -->
    <div class="row mb-4">
        <!-- Monthly Enrollment Chart -->
        <div class="col-xl-8 col-lg-7 mb-3">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Monthly Enrollment Trend</h5>
                    <div class="card-actions">
                        <button class="btn btn-sm btn-outline-secondary" onclick="refreshEnrollmentChart()">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="enrollmentChart" height="100"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Class Distribution -->
        <div class="col-xl-4 col-lg-5 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Class-wise Distribution</h5>
                </div>
                <div class="card-body">
                    <canvas id="classDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activities and Quick Actions -->
    <div class="row">
        <!-- Recent Students -->
        <div class="col-xl-6 col-lg-6 mb-3">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Recent Students</h5>
                    <a href="<?= base_url('students') ?>" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    <?php if (!empty($stats['recent_students'])): ?>
                        <div class="list-group list-group-flush">
                            <?php foreach ($stats['recent_students'] as $student): ?>
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="student-avatar me-3">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($student['firstname'] . ' ' . $student['lastname']) ?>&background=random" 
                                                 alt="<?= esc($student['firstname']) ?>" class="rounded-circle" width="40" height="40">
                                        </div>
                                        <div>
                                            <h6 class="mb-0"><?= esc($student['firstname'] . ' ' . $student['lastname']) ?></h6>
                                            <small class="text-muted">Added <?= date('M d, Y', strtotime($student['created_at'])) ?></small>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="badge bg-success">New</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No recent students found</p>
                            <a href="<?= base_url('students/create') ?>" class="btn btn-primary">Add New Student</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Active Session Info -->
        <div class="col-xl-6 col-lg-6 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Session</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($stats['active_session'])): ?>
                        <div class="session-info">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-primary mb-0"><?= esc($stats['active_session']['session']) ?></h4>
                                <span class="badge bg-success">Active</span>
                            </div>
                            <div class="session-stats">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="stat-item">
                                            <h5 class="mb-1"><?= $stats['total_students'] ?></h5>
                                            <small class="text-muted">Students Enrolled</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-item">
                                            <h5 class="mb-1"><?= $stats['total_classes'] ?></h5>
                                            <small class="text-muted">Active Classes</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="<?= base_url('academic/sessions') ?>" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-cog me-1"></i>Manage Sessions
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-calendar-alt fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No active session found</p>
                            <a href="<?= base_url('academic/sessions') ?>" class="btn btn-primary">Create Session</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Modal -->
<div class="modal fade" id="quickActionsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Quick Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="<?= base_url('students/create') ?>" class="btn btn-outline-primary w-100 h-100 d-flex flex-column justify-content-center">
                            <i class="fas fa-user-plus fa-2x mb-2"></i>
                            <span>Add Student</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= base_url('classes/create') ?>" class="btn btn-outline-success w-100 h-100 d-flex flex-column justify-content-center">
                            <i class="fas fa-chalkboard fa-2x mb-2"></i>
                            <span>Add Class</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= base_url('sections/create') ?>" class="btn btn-outline-warning w-100 h-100 d-flex flex-column justify-content-center">
                            <i class="fas fa-layer-group fa-2x mb-2"></i>
                            <span>Add Section</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= base_url('rooms/create') ?>" class="btn btn-outline-info w-100 h-100 d-flex flex-column justify-content-center">
                            <i class="fas fa-door-open fa-2x mb-2"></i>
                            <span>Add Room</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize charts
    initializeEnrollmentChart();
    initializeClassDistributionChart();
    
    // Auto-refresh stats every 5 minutes
    setInterval(refreshDashboardStats, 300000);
});

function initializeEnrollmentChart() {
    const ctx = document.getElementById('enrollmentChart').getContext('2d');
    const enrollmentData = <?= json_encode($stats['monthly_enrollment'] ?? []) ?>;
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: enrollmentData.map(item => item.month),
            datasets: [{
                label: 'New Enrollments',
                data: enrollmentData.map(item => item.count),
                borderColor: 'rgb(13, 110, 253)',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                tension: 0.4,
                fill: true
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
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
}

function initializeClassDistributionChart() {
    const ctx = document.getElementById('classDistributionChart').getContext('2d');
    const classData = <?= json_encode($stats['class_wise_count'] ?? []) ?>;
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: classData.map(item => item.class_name),
            datasets: [{
                data: classData.map(item => item.student_count),
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8',
                    '#6f42c1', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

function refreshDashboardStats() {
    fetch('<?= base_url('api/dashboard/stats') ?>')
        .then(response => response.json())
        .then(data => {
            if (data.status === 200) {
                updateStatsCards(data.data);
            }
        })
        .catch(error => {
            console.error('Error refreshing stats:', error);
        });
}

function updateStatsCards(stats) {
    document.getElementById('totalStudents').textContent = stats.total_students || 0;
    document.getElementById('totalClasses').textContent = stats.total_classes || 0;
    document.getElementById('totalSections').textContent = stats.total_sections || 0;
    document.getElementById('totalRooms').textContent = stats.total_rooms || 0;
}

function refreshEnrollmentChart() {
    // Reload the page or fetch new chart data
    location.reload();
}
</script>
