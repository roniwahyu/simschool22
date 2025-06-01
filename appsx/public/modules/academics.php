<?php
$currentPage = 'Class Timetable';
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
                                            <i class="fas fa-calendar-alt me-2"></i><?= $currentPage ?>
                                        </h4>
                                        <div>
                                            <select class="form-select me-2" style="width: auto; display: inline-block;">
                                                <option>Class 5 - Section A</option>
                                                <option>Class 4 - Section A</option>
                                                <option>Class 3 - Section B</option>
                                            </select>
                                            <button class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i>Add Schedule
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Time</th>
                                                    <th>Monday</th>
                                                    <th>Tuesday</th>
                                                    <th>Wednesday</th>
                                                    <th>Thursday</th>
                                                    <th>Friday</th>
                                                    <th>Saturday</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="fw-bold">8:00 - 8:45</td>
                                                    <td class="bg-light-blue">
                                                        <strong>Mathematics</strong><br>
                                                        <small>Sarah Johnson</small>
                                                    </td>
                                                    <td class="bg-light-green">
                                                        <strong>English</strong><br>
                                                        <small>Emily Davis</small>
                                                    </td>
                                                    <td class="bg-light-orange">
                                                        <strong>Science</strong><br>
                                                        <small>Michael Brown</small>
                                                    </td>
                                                    <td class="bg-light-purple">
                                                        <strong>History</strong><br>
                                                        <small>Robert Wilson</small>
                                                    </td>
                                                    <td class="bg-light-pink">
                                                        <strong>Geography</strong><br>
                                                        <small>Lisa Taylor</small>
                                                    </td>
                                                    <td class="bg-light-cyan">
                                                        <strong>Art</strong><br>
                                                        <small>Anna Miller</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">8:45 - 9:30</td>
                                                    <td class="bg-light-green">
                                                        <strong>English</strong><br>
                                                        <small>Emily Davis</small>
                                                    </td>
                                                    <td class="bg-light-blue">
                                                        <strong>Mathematics</strong><br>
                                                        <small>Sarah Johnson</small>
                                                    </td>
                                                    <td class="bg-light-pink">
                                                        <strong>Geography</strong><br>
                                                        <small>Lisa Taylor</small>
                                                    </td>
                                                    <td class="bg-light-orange">
                                                        <strong>Science</strong><br>
                                                        <small>Michael Brown</small>
                                                    </td>
                                                    <td class="bg-light-purple">
                                                        <strong>History</strong><br>
                                                        <small>Robert Wilson</small>
                                                    </td>
                                                    <td class="bg-light-yellow">
                                                        <strong>PE</strong><br>
                                                        <small>James Anderson</small>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">9:30 - 9:45</td>
                                                    <td colspan="6" class="text-center bg-light">
                                                        <strong>BREAK</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="fw-bold">9:45 - 10:30</td>
                                                    <td class="bg-light-orange">
                                                        <strong>Science</strong><br>
                                                        <small>Michael Brown</small>
                                                    </td>
                                                    <td class="bg-light-purple">
                                                        <strong>History</strong><br>
                                                        <small>Robert Wilson</small>
                                                    </td>
                                                    <td class="bg-light-blue">
                                                        <strong>Mathematics</strong><br>
                                                        <small>Sarah Johnson</small>
                                                    </td>
                                                    <td class="bg-light-green">
                                                        <strong>English</strong><br>
                                                        <small>Emily Davis</small>
                                                    </td>
                                                    <td class="bg-light-cyan">
                                                        <strong>Art</strong><br>
                                                        <small>Anna Miller</small>
                                                    </td>
                                                    <td class="bg-light-orange">
                                                        <strong>Science</strong><br>
                                                        <small>Michael Brown</small>
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
    <script src="assets/js/dashboard.js"></script>
    
    <style>
        .bg-light-blue { background-color: #e3f2fd !important; }
        .bg-light-green { background-color: #e8f5e8 !important; }
        .bg-light-orange { background-color: #fff3e0 !important; }
        .bg-light-purple { background-color: #f3e5f5 !important; }
        .bg-light-pink { background-color: #fce4ec !important; }
        .bg-light-cyan { background-color: #e0f2f1 !important; }
        .bg-light-yellow { background-color: #fffde7 !important; }
    </style>
</body>
</html>