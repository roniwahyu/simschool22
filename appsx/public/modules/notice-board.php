<?php
$currentPage = 'Notice Board';
$currentModule = 'communicate';
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
                                            <i class="fas fa-bullhorn me-2"></i><?= $currentPage ?>
                                        </h4>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNoticeModal">
                                            <i class="fas fa-plus me-1"></i>Add Notice
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card border-info">
                                                <div class="card-header bg-info text-white">
                                                    <h6 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Important</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h6>Parent-Teacher Meeting</h6>
                                                    <p class="text-muted">Scheduled for June 5th, 2025 at 2:00 PM. All parents are requested to attend.</p>
                                                    <small class="text-muted">Posted: May 30, 2025</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-warning">
                                                <div class="card-header bg-warning text-dark">
                                                    <h6 class="mb-0"><i class="fas fa-calendar me-2"></i>Event</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h6>Annual Sports Day</h6>
                                                    <p class="text-muted">Get ready for our annual sports day on June 15th. Participation forms available at office.</p>
                                                    <small class="text-muted">Posted: May 28, 2025</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-success">
                                                <div class="card-header bg-success text-white">
                                                    <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>General</h6>
                                                </div>
                                                <div class="card-body">
                                                    <h6>Library Hours Extended</h6>
                                                    <p class="text-muted">Library will now be open until 6 PM on weekdays for additional study hours.</p>
                                                    <small class="text-muted">Posted: May 25, 2025</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Category</th>
                                                            <th>Target Audience</th>
                                                            <th>Posted Date</th>
                                                            <th>Status</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Parent-Teacher Meeting</td>
                                                            <td><span class="badge bg-info">Important</span></td>
                                                            <td>All Parents</td>
                                                            <td>May 30, 2025</td>
                                                            <td><span class="badge bg-success">Active</span></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-success">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Annual Sports Day</td>
                                                            <td><span class="badge bg-warning">Event</span></td>
                                                            <td>All Students</td>
                                                            <td>May 28, 2025</td>
                                                            <td><span class="badge bg-success">Active</span></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-primary">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-success">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-danger">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
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
        </div>
    </div>

    <!-- Add Notice Modal -->
    <div class="modal fade" id="addNoticeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="noticeForm">
                        <div class="mb-3">
                            <label for="noticeTitle" class="form-label">Notice Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="noticeTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="noticeCategory" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="noticeCategory" required>
                                <option value="">Select Category</option>
                                <option value="important">Important</option>
                                <option value="event">Event</option>
                                <option value="general">General</option>
                                <option value="academic">Academic</option>
                                <option value="holiday">Holiday</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="targetAudience" class="form-label">Target Audience <span class="text-danger">*</span></label>
                            <select class="form-select" id="targetAudience" required>
                                <option value="">Select Audience</option>
                                <option value="all">Everyone</option>
                                <option value="students">All Students</option>
                                <option value="parents">All Parents</option>
                                <option value="teachers">All Teachers</option>
                                <option value="class_specific">Specific Class</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="noticeContent" class="form-label">Notice Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="noticeContent" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="publishDate" class="form-label">Publish Date</label>
                            <input type="datetime-local" class="form-control" id="publishDate">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="noticeForm" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Save Notice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        $('#noticeForm').on('submit', function(e) {
            e.preventDefault();
            alert('Notice published successfully!');
            $('#addNoticeModal').modal('hide');
        });
    </script>
</body>
</html>