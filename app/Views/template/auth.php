<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School ERP - <?= $title ?? 'Authentication' ?></title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">School ERP</h1>
                <p class="text-gray-600"><?= $title ?? 'Authentication' ?></p>
            </div>
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <!-- Custom Scripts -->
    <script src="/assets/js/auth.js"></script>
</body>
</html>
