<?php
$currentPage = 'Staff Directory';
$currentModule = 'teachers';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $currentPage ?> - SmartSchool</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">
                                            <i class="fas fa-chalkboard-teacher me-2"></i><?= $currentPage ?>
                                        </h4>
                                        <div>
                                            <a href="/add-staff" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i>Add New Staff
                                            </a>
                                            <button class="btn btn-outline-success ms-2">
                                                <i class="fas fa-file-excel me-1"></i>Export
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="teachersTable">
                                            <thead>
                                                <tr>
                                                    <th>Staff ID</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Department</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>TCH001</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar me-2">
                                                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Teacher">
                                                            </div>
                                                            <div>
                                                                <strong>Sarah Johnson</strong><br>
                                                                <small class="text-muted">Mathematics Teacher</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Teacher</td>
                                                    <td>Mathematics</td>
                                                    <td>+1234567890</td>
                                                    <td>sarah.johnson@school.com</td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-primary" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-info" title="Payroll">
                                                                <i class="fas fa-dollar-sign"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>TCH002</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar me-2">
                                                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Teacher">
                                                            </div>
                                                            <div>
                                                                <strong>Michael Brown</strong><br>
                                                                <small class="text-muted">Science Teacher</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Teacher</td>
                                                    <td>Science</td>
                                                    <td>+1234567891</td>
                                                    <td>michael.brown@school.com</td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-primary" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-info" title="Payroll">
                                                                <i class="fas fa-dollar-sign"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#teachersTable').DataTable({
                responsive: true,
                pageLength: 25,
                order: [[0, 'asc']]
            });
        });
    </script>
</body>
</html>