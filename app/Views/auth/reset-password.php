<?= $this->extend('template/auth') ?>

<?= $this->section('content') ?>
<form action="/reset-password" method="post" class="space-y-4">
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
        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
        <input type="password" name="password" id="password" required 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Enter your new password">
    </div>

    <div>
        <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
            placeholder="Confirm your new password">
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
