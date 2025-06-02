<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="auth-form-container">
    <div class="text-center mb-4">
        <h3 class="mb-2">Create Account</h3>
        <p class="text-muted">Join SmartSchool and start your educational journey</p>
    </div>
    
    <?= form_open('auth/register', ['class' => 'auth-form', 'id' => 'registerForm']) ?>
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="first_name" class="form-label">
                        <i class="fas fa-user me-2"></i>First Name
                    </label>
                    <input type="text" name="first_name" id="first_name" class="form-control" 
                           placeholder="Enter your first name" required 
                           value="<?= old('first_name') ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="last_name" class="form-label">
                        <i class="fas fa-user me-2"></i>Last Name
                    </label>
                    <input type="text" name="last_name" id="last_name" class="form-control" 
                           placeholder="Enter your last name" required 
                           value="<?= old('last_name') ?>">
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
            </label>
            <input type="email" name="email" id="email" class="form-control" 
                   placeholder="Enter your email address" required 
                   value="<?= old('email') ?>">
        </div>
        
        <div class="form-group">
            <label for="phone" class="form-label">
                <i class="fas fa-phone me-2"></i>Phone Number
            </label>
            <input type="tel" name="phone" id="phone" class="form-control" 
                   placeholder="Enter your phone number" required 
                   value="<?= old('phone') ?>">
        </div>
        
        <div class="form-group">
            <label for="role" class="form-label">
                <i class="fas fa-user-tag me-2"></i>Role
            </label>
            <select name="role" id="role" class="form-control" required>
                <option value="">Select your role</option>
                <option value="student" <?= old('role') === 'student' ? 'selected' : '' ?>>Student</option>
                <option value="teacher" <?= old('role') === 'teacher' ? 'selected' : '' ?>>Teacher</option>
                <option value="parent" <?= old('role') === 'parent' ? 'selected' : '' ?>>Parent</option>
                <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Administrator</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="password" class="form-label">
                <i class="fas fa-lock me-2"></i>Password
            </label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" 
                       placeholder="Create a strong password" required>
                <button type="button" class="input-group-text password-toggle">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div id="password-strength"></div>
        </div>
        
        <div class="form-group">
            <label for="confirm_password" class="form-label">
                <i class="fas fa-lock me-2"></i>Confirm Password
            </label>
            <div class="input-group">
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" 
                       placeholder="Confirm your password" required>
                <button type="button" class="input-group-text password-toggle">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        
        <div class="form-check mb-4">
            <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
            <label for="terms" class="form-check-label">
                I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> 
                and <a href="#" class="text-decoration-none">Privacy Policy</a>
            </label>
        </div>
        
        <div class="form-check mb-4">
            <input type="checkbox" name="newsletter" id="newsletter" class="form-check-input">
            <label for="newsletter" class="form-check-label">
                Subscribe to our newsletter for updates and announcements
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 mb-3">
            <i class="fas fa-user-plus me-2"></i>Create Account
        </button>
    <?= form_close() ?>
    
    <div class="divider">
        <span>or sign up with</span>
    </div>
    
    <div class="social-login">
        <button type="button" class="btn btn-social btn-google">
            <i class="fab fa-google me-2"></i>Sign up with Google
        </button>
        <button type="button" class="btn btn-social btn-facebook">
            <i class="fab fa-facebook-f me-2"></i>Sign up with Facebook
        </button>
    </div>
</div>

<div class="auth-links">
    <p class="mb-0">
        Already have an account? 
        <a href="<?= base_url('auth/login') ?>">Sign In</a>
    </p>
</div>
<?= $this->endSection() ?>