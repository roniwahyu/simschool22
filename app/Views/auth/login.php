<?= $this->extend('template/auth') ?>

<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-2">Login</h2>
        <p class="text-gray-600 text-center mb-6">Enter your credentials to access your account</p>
        
        <?= form_open('auth/login', ['class' => 'space-y-6']) ?>
            <?= csrf_field() ?>
            
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Enter your email">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" required 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Enter your password">
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="/forgot-password" class="font-medium text-blue-600 hover:text-blue-500">
                        Forgot password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Sign in
                </button>
            </div>

            <div class="text-sm text-center">
                Don't have an account? 
                <a href="/register" class="font-medium text-blue-600 hover:text-blue-500">
                    Register here
                </a>
            </div>
        <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>