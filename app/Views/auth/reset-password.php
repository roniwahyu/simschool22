<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="auth-form-container">
    <div class="text-center mb-4">
        <div class="reset-password-icon mb-3">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="auth-form-title">Reset Password</h3>
        <p class="text-muted">Enter your new password below</p>
    </div>
    
    <?= form_open('auth/reset-password', ['id' => 'resetPasswordForm', 'class' => 'auth-form']) ?>
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= $token ?? '' ?>">
        
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
            <label for="password"><i class="fas fa-lock me-2"></i>New Password</label>
            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirm Password</label>
            <button type="button" class="password-toggle" onclick="togglePassword('confirm_password')">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        
        <div class="password-strength mb-3">
            <div class="password-strength-bar">
                <div class="strength-indicator" id="strengthIndicator"></div>
            </div>
            <small class="text-muted" id="strengthText">Password strength</small>
        </div>
        
        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
            <i class="fas fa-check me-2"></i>Reset Password
        </button>
    <?= form_close() ?>
    
    <div class="auth-footer text-center mt-4">
        <a href="<?= base_url('auth/login') ?>" class="text-decoration-none">
            <i class="fas fa-arrow-left me-2"></i>Back to Login
        </a>
    </div>
</div>
<?= $this->endSection() ?>
