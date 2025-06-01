<?php
$currentPage = 'WhatsApp Integration';
$currentModule = 'whatsapp';
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
                                        <i class="fab fa-whatsapp me-2"></i><?= $currentPage ?>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card border-success">
                                                <div class="card-header bg-success text-white">
                                                    <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Send Message</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form id="whatsappForm">
                                                        <div class="mb-3">
                                                            <label for="recipient" class="form-label">Send To</label>
                                                            <select class="form-select" id="recipient">
                                                                <option value="">Select Recipients</option>
                                                                <option value="all_students">All Students</option>
                                                                <option value="all_parents">All Parents</option>
                                                                <option value="all_teachers">All Teachers</option>
                                                                <option value="class_5a">Class 5A Students</option>
                                                                <option value="class_4b">Class 4B Students</option>
                                                                <option value="custom">Custom Group</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="message" class="form-label">Message</label>
                                                            <textarea class="form-control" id="message" rows="5" placeholder="Type your message here..."></textarea>
                                                            <div class="form-text">
                                                                <span id="charCount">0</span>/1000 characters
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="scheduleMessage">
                                                                <label class="form-check-label" for="scheduleMessage">
                                                                    Schedule Message
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3" id="scheduleOptions" style="display: none;">
                                                            <label for="scheduleDateTime" class="form-label">Schedule Date & Time</label>
                                                            <input type="datetime-local" class="form-control" id="scheduleDateTime">
                                                        </div>
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fab fa-whatsapp me-1"></i>Send Message
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card border-info">
                                                <div class="card-header bg-info text-white">
                                                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Message Statistics</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row text-center">
                                                        <div class="col-6 mb-3">
                                                            <div class="card bg-primary text-white">
                                                                <div class="card-body">
                                                                    <h3>124</h3>
                                                                    <p class="mb-0">Messages Sent Today</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <div class="card bg-success text-white">
                                                                <div class="card-body">
                                                                    <h3>98%</h3>
                                                                    <p class="mb-0">Delivery Rate</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <div class="card bg-warning text-white">
                                                                <div class="card-body">
                                                                    <h3>45</h3>
                                                                    <p class="mb-0">Pending Messages</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 mb-3">
                                                            <div class="card bg-danger text-white">
                                                                <div class="card-body">
                                                                    <h3>3</h3>
                                                                    <p class="mb-0">Failed Messages</p>
                                                                </div>
                                                            </div>
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
                                                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Message History</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Date</th>
                                                                    <th>Recipients</th>
                                                                    <th>Message</th>
                                                                    <th>Status</th>
                                                                    <th>Delivered</th>
                                                                    <th>Actions</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>2025-05-31 10:30</td>
                                                                    <td>Class 5A Parents</td>
                                                                    <td>Parent-Teacher meeting scheduled for tomorrow at 2 PM</td>
                                                                    <td><span class="badge bg-success">Sent</span></td>
                                                                    <td>25/25</td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-outline-primary">
                                                                            <i class="fas fa-eye"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2025-05-30 15:45</td>
                                                                    <td>All Teachers</td>
                                                                    <td>Staff meeting rescheduled to Friday 3 PM</td>
                                                                    <td><span class="badge bg-success">Sent</span></td>
                                                                    <td>12/12</td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-outline-primary">
                                                                            <i class="fas fa-eye"></i>
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    
    <script>
        // Character counter
        $('#message').on('input', function() {
            const count = $(this).val().length;
            $('#charCount').text(count);
            
            if (count > 1000) {
                $('#charCount').addClass('text-danger');
            } else {
                $('#charCount').removeClass('text-danger');
            }
        });
        
        // Schedule options toggle
        $('#scheduleMessage').on('change', function() {
            if ($(this).is(':checked')) {
                $('#scheduleOptions').show();
            } else {
                $('#scheduleOptions').hide();
            }
        });
        
        // Form submission
        $('#whatsappForm').on('submit', function(e) {
            e.preventDefault();
            
            const recipient = $('#recipient').val();
            const message = $('#message').val();
            
            if (!recipient) {
                alert('Please select recipients');
                return;
            }
            
            if (!message.trim()) {
                alert('Please enter a message');
                return;
            }
            
            if (message.length > 1000) {
                alert('Message too long. Maximum 1000 characters allowed.');
                return;
            }
            
            // Simulate sending
            alert('WhatsApp message sent successfully!');
            $('#message').val('');
            $('#charCount').text('0');
        });
    </script>
</body>
</html>