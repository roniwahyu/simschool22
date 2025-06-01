<?php
$currentPage = 'Library Management';
$currentModule = 'library';
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
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title mb-0">
                                            <i class="fas fa-book me-2"></i>Book Inventory
                                        </h4>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookModal">
                                            <i class="fas fa-plus me-1"></i>Add Book
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="booksTable">
                                            <thead>
                                                <tr>
                                                    <th>Book ID</th>
                                                    <th>Title</th>
                                                    <th>Author</th>
                                                    <th>Category</th>
                                                    <th>Available</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>LB001</td>
                                                    <td>Mathematics for Grade 5</td>
                                                    <td>Dr. Smith</td>
                                                    <td>Textbook</td>
                                                    <td><span class="badge bg-success">15</span></td>
                                                    <td>20</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-info" title="Issue">
                                                            <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>LB002</td>
                                                    <td>English Grammar</td>
                                                    <td>Jane Wilson</td>
                                                    <td>Reference</td>
                                                    <td><span class="badge bg-warning">3</span></td>
                                                    <td>10</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-info" title="Issue">
                                                            <i class="fas fa-arrow-right"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>LB003</td>
                                                    <td>Science Experiments</td>
                                                    <td>Prof. Johnson</td>
                                                    <td>Science</td>
                                                    <td><span class="badge bg-danger">0</span></td>
                                                    <td>8</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-secondary" disabled title="Out of Stock">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                        <button class="btn btn-sm btn-outline-success" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-pie me-2"></i>Library Statistics</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-6 mb-3">
                                            <div class="card bg-primary text-white">
                                                <div class="card-body">
                                                    <h4>1,250</h4>
                                                    <p class="mb-0">Total Books</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="card bg-success text-white">
                                                <div class="card-body">
                                                    <h4>890</h4>
                                                    <p class="mb-0">Available</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="card bg-warning text-white">
                                                <div class="card-body">
                                                    <h4>360</h4>
                                                    <p class="mb-0">Issued</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <div class="card bg-danger text-white">
                                                <div class="card-body">
                                                    <h4>45</h4>
                                                    <p class="mb-0">Overdue</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Recent Issues</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>John Doe</strong><br>
                                                <small>Mathematics Grade 5</small>
                                            </div>
                                            <span class="badge bg-primary">Today</span>
                                        </div>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>Jane Smith</strong><br>
                                                <small>English Grammar</small>
                                            </div>
                                            <span class="badge bg-secondary">Yesterday</span>
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

    <!-- Add Book Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="bookForm">
                        <div class="mb-3">
                            <label for="bookTitle" class="form-label">Book Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="bookTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">Author <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="author" required>
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" id="isbn">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" required>
                                <option value="">Select Category</option>
                                <option value="textbook">Textbook</option>
                                <option value="reference">Reference</option>
                                <option value="fiction">Fiction</option>
                                <option value="science">Science</option>
                                <option value="history">History</option>
                                <option value="biography">Biography</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="quantity" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="publisher" class="form-label">Publisher</label>
                            <input type="text" class="form-control" id="publisher">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="bookForm" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Add Book
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
            $('#booksTable').DataTable({
                responsive: true,
                pageLength: 25
            });
        });
        
        $('#bookForm').on('submit', function(e) {
            e.preventDefault();
            alert('Book added successfully!');
            $('#addBookModal').modal('hide');
        });
    </script>
</body>
</html>