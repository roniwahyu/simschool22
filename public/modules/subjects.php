<?php
$currentPage = 'Subjects Management';
$currentModule = 'academics';
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
                                            <i class="fas fa-book me-2"></i><?= $currentPage ?>
                                        </h4>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                                            <i class="fas fa-plus me-1"></i>Add Subject
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="subjectsTable">
                                            <thead>
                                                <tr>
                                                    <th>Subject Code</th>
                                                    <th>Subject Name</th>
                                                    <th>Subject Type</th>
                                                    <th>Classes</th>
                                                    <th>Teacher</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>MATH101</td>
                                                    <td>Mathematics</td>
                                                    <td><span class="badge bg-primary">Core</span></td>
                                                    <td>1, 2, 3, 4, 5</td>
                                                    <td>Sarah Johnson</td>
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
                                                    <td>ENG101</td>
                                                    <td>English Language</td>
                                                    <td><span class="badge bg-primary">Core</span></td>
                                                    <td>1, 2, 3, 4, 5</td>
                                                    <td>Emily Davis</td>
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
                                                    <td>SCI101</td>
                                                    <td>General Science</td>
                                                    <td><span class="badge bg-primary">Core</span></td>
                                                    <td>3, 4, 5</td>
                                                    <td>Michael Brown</td>
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
                                                    <td>ART101</td>
                                                    <td>Art & Craft</td>
                                                    <td><span class="badge bg-secondary">Elective</span></td>
                                                    <td>1, 2, 3, 4, 5</td>
                                                    <td>Anna Miller</td>
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

    <!-- Add Subject Modal -->
    <div class="modal fade" id="addSubjectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="subjectForm">
                        <div class="mb-3">
                            <label for="subjectCode" class="form-label">Subject Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subjectCode" required placeholder="e.g., MATH101">
                        </div>
                        <div class="mb-3">
                            <label for="subjectName" class="form-label">Subject Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="subjectName" required placeholder="e.g., Mathematics">
                        </div>
                        <div class="mb-3">
                            <label for="subjectType" class="form-label">Subject Type <span class="text-danger">*</span></label>
                            <select class="form-select" id="subjectType" required>
                                <option value="">Select Type</option>
                                <option value="core">Core Subject</option>
                                <option value="elective">Elective</option>
                                <option value="optional">Optional</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assignedTeacher" class="form-label">Assigned Teacher</label>
                            <select class="form-select" id="assignedTeacher">
                                <option value="">Select Teacher</option>
                                <option value="sarah_johnson">Sarah Johnson</option>
                                <option value="emily_davis">Emily Davis</option>
                                <option value="michael_brown">Michael Brown</option>
                                <option value="anna_miller">Anna Miller</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" placeholder="Subject description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="subjectForm" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Subject
                    </button>
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
            $('#subjectsTable').DataTable({
                responsive: true,
                pageLength: 25,
                order: [[0, 'asc']]
            });
        });
        
        $('#subjectForm').on('submit', function(e) {
            e.preventDefault();
            alert('Subject added successfully!');
            $('#addSubjectModal').modal('hide');
        });
    </script>
</body>
</html>