<?php
$currentPage = 'Human Resources';
$currentModule = 'hr';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $currentPage ?> - SmartSchool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="assets/css/dashboard.css" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <?php include 'includes/sidebar.php'; ?>
        
        <div class="main-content">
            <?php include 'includes/topbar.php'; ?>
            
            <div class="content-wrapper">
                <div class="container-fluid py-4">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">
                                        <i class="fas fa-users me-2"></i>Staff Overview
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <div class="card bg-primary text-white">
                                                <div class="card-body text-center">
                                                    <h3>24</h3>
                                                    <p class="mb-0">Total Staff</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-success text-white">
                                                <div class="card-body text-center">
                                                    <h3>18</h3>
                                                    <p class="mb-0">Teachers</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-info text-white">
                                                <div class="card-body text-center">
                                                    <h3>4</h3>
                                                    <p class="mb-0">Admin</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card bg-warning text-white">
                                                <div class="card-body text-center">
                                                    <h3>2</h3>
                                                    <p class="mb-0">Support</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h5>Department Distribution</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <canvas id="departmentChart" width="400" height="200"></canvas>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="list-group">
                                                <div class="list-group-item d-flex justify-content-between">
                                                    <span>Mathematics</span>
                                                    <span class="badge bg-primary">4</span>
                                                </div>
                                                <div class="list-group-item d-flex justify-content-between">
                                                    <span>Science</span>
                                                    <span class="badge bg-success">3</span>
                                                </div>
                                                <div class="list-group-item d-flex justify-content-between">
                                                    <span>English</span>
                                                    <span class="badge bg-info">3</span>
                                                </div>
                                                <div class="list-group-item d-flex justify-content-between">
                                                    <span>Social Studies</span>
                                                    <span class="badge bg-warning">2</span>
                                                </div>
                                                <div class="list-group-item d-flex justify-content-between">
                                                    <span>Physical Education</span>
                                                    <span class="badge bg-danger">2</span>
                                                </div>
                                                <div class="list-group-item d-flex justify-content-between">
                                                    <span>Administration</span>
                                                    <span class="badge bg-dark">4</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Today's Attendance</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-6">
                                            <div class="card bg-success text-white">
                                                <div class="card-body">
                                                    <h4>22</h4>
                                                    <p class="mb-0">Present</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card bg-danger text-white">
                                                <div class="card-body">
                                                    <h4>2</h4>
                                                    <p class="mb-0">Absent</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6>Absent Today:</h6>
                                        <ul class="list-unstyled">
                                            <li><i class="fas fa-user-times text-danger me-2"></i>John Smith - Sick Leave</li>
                                            <li><i class="fas fa-user-times text-danger me-2"></i>Mary Johnson - Personal</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Pending Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Leave Requests</strong><br>
                                                <small>3 pending approvals</small>
                                            </div>
                                            <span class="badge bg-warning">3</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Performance Reviews</strong><br>
                                                <small>5 due this month</small>
                                            </div>
                                            <span class="badge bg-info">5</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Contract Renewals</strong><br>
                                                <small>2 expiring soon</small>
                                            </div>
                                            <span class="badge bg-danger">2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Quick Actions</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <a href="/add-staff" class="btn btn-outline-primary w-100 mb-2">
                                                <i class="fas fa-user-plus me-2"></i>Add New Staff
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="/staff-attendance" class="btn btn-outline-success w-100 mb-2">
                                                <i class="fas fa-calendar-check me-2"></i>Mark Attendance
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="/payroll" class="btn btn-outline-info w-100 mb-2">
                                                <i class="fas fa-dollar-sign me-2"></i>Process Payroll
                                            </a>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-outline-warning w-100 mb-2">
                                                <i class="fas fa-file-alt me-2"></i>Generate Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        // Department Chart
        const ctx = document.getElementById('departmentChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Mathematics', 'Science', 'English', 'Social Studies', 'PE', 'Administration'],
                datasets: [{
                    data: [4, 3, 3, 2, 2, 4],
                    backgroundColor: [
                        '#007bff',
                        '#28a745',
                        '#17a2b8',
                        '#ffc107',
                        '#dc3545',
                        '#343a40'
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
    </script>
</body>
</html>