<?php
$currentPage = 'Classes Management';
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
                                            <i class="fas fa-school me-2"></i><?= $currentPage ?>
                                        </h4>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClassModal">
                                            <i class="fas fa-plus me-1"></i>Add Class
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <div class="card border-primary">
                                                <div class="card-header bg-primary text-white">
                                                    <h5 class="mb-0">Class 1</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><strong>Sections:</strong> A, B</p>
                                                            <p><strong>Students:</strong> 45</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p><strong>Class Teacher:</strong> Sarah Johnson</p>
                                                            <p><strong>Room:</strong> 101</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-outline-primary me-1">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success me-1">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-users"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="card border-success">
                                                <div class="card-header bg-success text-white">
                                                    <h5 class="mb-0">Class 2</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><strong>Sections:</strong> A, B</p>
                                                            <p><strong>Students:</strong> 42</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p><strong>Class Teacher:</strong> Emily Davis</p>
                                                            <p><strong>Room:</strong> 102</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-outline-primary me-1">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success me-1">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-users"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="card border-info">
                                                <div class="card-header bg-info text-white">
                                                    <h5 class="mb-0">Class 3</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><strong>Sections:</strong> A, B, C</p>
                                                            <p><strong>Students:</strong> 38</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p><strong>Class Teacher:</strong> Michael Brown</p>
                                                            <p><strong>Room:</strong> 103</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-outline-primary me-1">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success me-1">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-users"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="card border-warning">
                                                <div class="card-header bg-warning text-dark">
                                                    <h5 class="mb-0">Class 4</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><strong>Sections:</strong> A, B</p>
                                                            <p><strong>Students:</strong> 40</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p><strong>Class Teacher:</strong> Lisa Taylor</p>
                                                            <p><strong>Room:</strong> 104</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-outline-primary me-1">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success me-1">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-users"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <div class="card border-danger">
                                                <div class="card-header bg-danger text-white">
                                                    <h5 class="mb-0">Class 5</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p><strong>Sections:</strong> A, B</p>
                                                            <p><strong>Students:</strong> 35</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p><strong>Class Teacher:</strong> Robert Wilson</p>
                                                            <p><strong>Room:</strong> 105</p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <button class="btn btn-sm btn-outline-primary me-1">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success me-1">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-users"></i>
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
            </div>
        </div>
    </div>

    <!-- Add Class Modal -->
    <div class="modal fade" id="addClassModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="classForm">
                        <div class="mb-3">
                            <label for="className" class="form-label">Class Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="className" required placeholder="e.g., Class 6">
                        </div>
                        <div class="mb-3">
                            <label for="classTeacher" class="form-label">Class Teacher</label>
                            <select class="form-select" id="classTeacher">
                                <option value="">Select Teacher</option>
                                <option value="sarah_johnson">Sarah Johnson</option>
                                <option value="emily_davis">Emily Davis</option>
                                <option value="michael_brown">Michael Brown</option>
                                <option value="lisa_taylor">Lisa Taylor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="roomNumber" class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="roomNumber" placeholder="e.g., 106">
                        </div>
                        <div class="mb-3">
                            <label for="maxStudents" class="form-label">Maximum Students</label>
                            <input type="number" class="form-control" id="maxStudents" placeholder="e.g., 40">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="classForm" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Class
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        $('#classForm').on('submit', function(e) {
            e.preventDefault();
            alert('Class added successfully!');
            $('#addClassModal').modal('hide');
        });
    </script>
</body>
</html>