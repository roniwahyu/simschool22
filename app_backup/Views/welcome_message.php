<?= $this->extend('template/default') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 py-8">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-blue-600 mb-4">Welcome to School ERP</h1>
        <p class="text-lg text-gray-700 mb-6">A modern school management system</p>
        <div class="flex justify-center space-x-4">
            <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Login
            </a>
            <a href="/register" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Register
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
