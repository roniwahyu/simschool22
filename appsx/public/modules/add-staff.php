<?php
$currentPage = 'Add Staff';
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
                                    <form id="staffForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="mb-3">Personal Information</h5>
                                                <div class="mb-3">
                                                    <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="firstName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="lastName" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" id="email" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                                    <input type="tel" class="form-control" id="phone" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dob" class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control" id="dob">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-select" id="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h5 class="mb-3">Professional Information</h5>
                                                <div class="mb-3">
                                                    <label for="employeeId" class="form-label">Employee ID <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="employeeId" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                                                    <select class="form-select" id="role" required>
                                                        <option value="">Select Role</option>
                                                        <option value="teacher">Teacher</option>
                                                        <option value="admin">Administrator</option>
                                                        <option value="principal">Principal</option>
                                                        <option value="librarian">Librarian</option>
                                                        <option value="accountant">Accountant</option>
                                                        <option value="support">Support Staff</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="department" class="form-label">Department</label>
                                                    <select class="form-select" id="department">
                                                        <option value="">Select Department</option>
                                                        <option value="mathematics">Mathematics</option>
                                                        <option value="science">Science</option>
                                                        <option value="english">English</option>
                                                        <option value="history">History</option>
                                                        <option value="geography">Geography</option>
                                                        <option value="art">Art</option>
                                                        <option value="physical-education">Physical Education</option>
                                                        <option value="administration">Administration</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="joiningDate" class="form-label">Joining Date</label>
                                                    <input type="date" class="form-control" id="joiningDate">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="salary" class="form-label">Salary</label>
                                                    <input type="number" class="form-control" id="salary" placeholder="Monthly salary">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="qualification" class="form-label">Qualification</label>
                                                    <textarea class="form-control" id="qualification" rows="3" placeholder="Educational qualifications"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="d-flex justify-content-end">
                                                    <a href="/teachers" class="btn btn-secondary me-2">Cancel</a>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save me-1"></i>Save Staff Member
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
        $('#staffForm').on('submit', function(e) {
            e.preventDefault();
            // Form submission logic
            alert('Staff member added successfully!');
        });
    </script>
</body>
</html>