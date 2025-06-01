<?php
$currentPage = 'Student Management';
$currentModule = 'students';
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
                                            <i class="fas fa-user-graduate me-2"></i><?= $currentPage ?>
                                        </h4>
                                        <div>
                                            <a href="/student-admission" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i>Add New Student
                                            </a>
                                            <button class="btn btn-outline-success ms-2">
                                                <i class="fas fa-file-excel me-1"></i>Export
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <select class="form-select" id="classFilter">
                                                <option value="">All Classes</option>
                                                <option value="1">Class 1</option>
                                                <option value="2">Class 2</option>
                                                <option value="3">Class 3</option>
                                                <option value="4">Class 4</option>
                                                <option value="5">Class 5</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select" id="sectionFilter">
                                                <option value="">All Sections</option>
                                                <option value="A">Section A</option>
                                                <option value="B">Section B</option>
                                                <option value="C">Section C</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-select" id="statusFilter">
                                                <option value="">All Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-outline-primary w-100" onclick="filterStudents()">
                                                <i class="fas fa-filter me-1"></i>Filter
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="studentsTable">
                                            <thead>
                                                <tr>
                                                    <th>Admission No</th>
                                                    <th>Student Name</th>
                                                    <th>Class</th>
                                                    <th>Section</th>
                                                    <th>Father Name</th>
                                                    <th>Mobile</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>STU001</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar me-2">
                                                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Student">
                                                            </div>
                                                            <div>
                                                                <strong>John Doe</strong><br>
                                                                <small class="text-muted">DOB: 15/05/2010</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Class 5</td>
                                                    <td>A</td>
                                                    <td>Robert Doe</td>
                                                    <td>+1234567890</td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-primary" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger" title="Delete">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>STU002</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar me-2">
                                                                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Student">
                                                            </div>
                                                            <div>
                                                                <strong>Jane Smith</strong><br>
                                                                <small class="text-muted">DOB: 22/08/2011</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>Class 4</td>
                                                    <td>B</td>
                                                    <td>Michael Smith</td>
                                                    <td>+1234567891</td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-sm btn-outline-primary" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-success" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-danger" title="Delete">
                                                                <i class="fas fa-trash"></i>
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
            $('#studentsTable').DataTable({
                responsive: true,
                pageLength: 25,
                order: [[0, 'asc']]
            });
        });
        
        function filterStudents() {
            console.log('Filtering students...');
        }
    </script>
</body>
</html>