<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="auth-form-container">
    <div class="auth-tabs mb-4">
        <ul class="nav nav-pills nav-fill" id="loginTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="email-tab" data-bs-toggle="pill" data-bs-target="#email-login" type="button" role="tab">
                    <i class="fas fa-envelope me-2"></i>Email
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="qr-tab" data-bs-toggle="pill" data-bs-target="#qr-login" type="button" role="tab">
                    <i class="fas fa-qrcode me-2"></i>QR Code
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="otp-tab" data-bs-toggle="pill" data-bs-target="#otp-login" type="button" role="tab">
                    <i class="fas fa-mobile-alt me-2"></i>OTP
                </button>
            </li>
        </ul>
    </div>
    
    <div class="tab-content" id="loginTabContent">
        <!-- Email Login -->
        <div class="tab-pane fade show active" id="email-login" role="tabpanel">
            <?= form_open('auth/login', ['class' => 'auth-form', 'id' => 'loginForm']) ?>
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope me-2"></i>Email Address
                    </label>
                    <input type="email" name="email" id="email" class="form-control" 
                           placeholder="Enter your email address" required 
                           value="<?= old('email') ?>">
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock me-2"></i>Password
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control" 
                               placeholder="Enter your password" required>
                        <button type="button" class="input-group-text password-toggle">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>
                    <a href="<?= base_url('auth/forgot-password') ?>" class="text-decoration-none">
                        Forgot Password?
                    </a>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mb-3">
                    <i class="fas fa-sign-in-alt me-2"></i>Sign In
                </button>
            <?= form_close() ?>
            
            <div class="divider">
                <span>or continue with</span>
            </div>
            
            <div class="social-login">
                <button type="button" class="btn btn-social btn-google">
                    <i class="fab fa-google me-2"></i>Continue with Google
                </button>
                <button type="button" class="btn btn-social btn-facebook">
                    <i class="fab fa-facebook-f me-2"></i>Continue with Facebook
                </button>
            </div>
        </div>
        
        <!-- QR Code Login -->
        <div class="tab-pane fade" id="qr-login" role="tabpanel">
            <div class="qr-code-container">
                <h5 class="mb-3">Scan QR Code to Login</h5>
                <p class="text-muted mb-4">Use your mobile app to scan this QR code and login instantly</p>
                <div id="qr-code" class="qr-code"></div>
                <p class="text-muted mt-3">
                    <i class="fas fa-mobile-alt me-2"></i>
                    Open the SmartSchool mobile app and scan this code
                </p>
            </div>
        </div>
        
        <!-- OTP Login -->
        <div class="tab-pane fade" id="otp-login" role="tabpanel">
            <div class="otp-login-container">
                <h5 class="mb-3 text-center">Login with OTP</h5>
                <p class="text-muted text-center mb-4">Enter your phone number to receive a one-time password</p>
                
                <?= form_open('auth/send-otp', ['class' => 'auth-form', 'id' => 'otpRequestForm']) ?>
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="phone" class="form-label">
                            <i class="fas fa-phone me-2"></i>Phone Number
                        </label>
                        <input type="tel" name="phone" id="phone" class="form-control" 
                               placeholder="Enter your phone number" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-paper-plane me-2"></i>Send OTP
                    </button>
                <?= form_close() ?>
                
                <div id="otp-verification" class="d-none mt-4">
                    <h6 class="text-center mb-3">Enter Verification Code</h6>
                    <p class="text-muted text-center mb-3">We've sent a 6-digit code to your phone</p>
                    <div id="otp-container"></div>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-outline btn-sm" id="resendOtp">
                            Resend Code
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="auth-links">
    <p class="mb-0">
        Don't have an account? 
        <a href="<?= base_url('auth/register') ?>">Create Account</a>
    </p>
</div>
<?= $this->endSection() ?>