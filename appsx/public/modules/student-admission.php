<?php
$currentPage = 'Student Admission';
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
                                    <h4 class="card-title mb-0">
                                        <i class="fas fa-user-plus me-2"></i><?= $currentPage ?>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form id="admissionForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="mb-3">Student Information</h5>
                                                <div class="mb-3">
                                                    <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="firstName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="lastName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dob" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" id="dob" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="gender" required>
                                                        <option value="">Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="class" class="form-label">Class <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="class" required>
                                                        <option value="">Select Class</option>
                                                        <option value="1">Class 1</option>
                                                        <option value="2">Class 2</option>
                                                        <option value="3">Class 3</option>
                                                        <option value="4">Class 4</option>
                                                        <option value="5">Class 5</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="section" class="form-label">Section</label>
                                                    <select class="form-select" id="section">
                                                        <option value="">Select Section</option>
                                                        <option value="A">Section A</option>
                                                        <option value="B">Section B</option>
                                                        <option value="C">Section C</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="mb-3">Parent Information</h5>
                                                <div class="mb-3">
                                                    <label for="fatherName" class="form-label">Father's Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="fatherName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="motherName" class="form-label">Mother's Name</label>
                                                    <input type="text" class="form-control" id="motherName">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="mobile" class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="mobile" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea class="form-control" id="address" rows="3"></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="photo" class="form-label">Student Photo</label>
                                                    <input type="file" class="form-control" id="photo" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-end">
                                                    <a href="/students" class="btn btn-secondary me-2">Cancel</a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save me-1"></i>Save Student
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        $('#admissionForm').on('submit', function(e) {
            e.preventDefault();
            // Form submission logic
            alert('Student admission form submitted successfully!');
        });
    </script>
</body>
</html>