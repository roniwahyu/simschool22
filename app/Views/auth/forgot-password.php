<?= $this->extend('template/auth') ?>

<?= $this->section('content') ?>
<form action="/forgot-password" method="post" class="space-y-4">
    <?= csrf_field() ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" name="email" id="email" required 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Enter your email">
    </div>

    <div>
        <button type="submit" 
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Reset Password
        </button>
    </div>

    <div class="text-sm text-center">
        <a href="/login" class="font-medium text-blue-600 hover:text-blue-500">
            Back to Login
        </a>
    </div>
</form>
<?= $this->endSection() ?>
