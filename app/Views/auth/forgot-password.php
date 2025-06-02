<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="auth-form-container">
    <div class="text-center mb-4">
        <div class="auth-icon mb-3">
            <i class="fas fa-key"></i>
        </div>
        <h3 class="mb-2">Forgot Password?</h3>
        <p class="text-muted">No worries! Enter your email and we'll send you a reset link</p>
    </div>
    
    <?= form_open('auth/forgot-password', ['class' => 'auth-form', 'id' => 'forgotPasswordForm']) ?>
        <?= csrf_field() ?>
        
        <div class="form-group">
            <label for="email" class="form-label">
                <i class="fas fa-envelope me-2"></i>Email Address
            </label>
            <input type="email" name="email" id="email" class="form-control" 
                   placeholder="Enter your registered email address" required 
                   value="<?= old('email') ?>">
            <small class="form-text text-muted">
                Please provide a valid email address.
            </small>
        </div>
        
        <button type="submit" class="btn btn-primary w-100 mb-3">
            <i class="fas fa-paper-plane me-2"></i>Send Reset Instructions
        </button>
    <?= form_close() ?>
</div>

<script type="text/babel">
    function ForgotPasswordHandler() {
        const handleFormSubmit = (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            
            // Simulate API call
            setTimeout(() => {
                document.getElementById('emailStep').classList.add('d-none');
                document.getElementById('successStep').classList.remove('d-none');
                document.getElementById('sentToEmail').textContent = email;
                
                toastr.success('Reset instructions sent to your email!');
            }, 1000);
        };
        
        React.useEffect(() => {
            const form = document.getElementById('forgotPasswordForm');
            form.addEventListener('submit', handleFormSubmit);
            
            return () => {
                form.removeEventListener('submit', handleFormSubmit);
            };
        }, []);
        
        return null;
    }
    
    ReactDOM.render(<ForgotPasswordHandler />, document.createElement('div'));
    
    function backToEmail() {
        document.getElementById('successStep').classList.add('d-none');
        document.getElementById('emailStep').classList.remove('d-none');
    }
    
    function resendResetEmail() {
        toastr.info('Resending reset instructions...');
        setTimeout(() => {
            toastr.success('Reset instructions sent again!');
        }, 2000);
    }
</script>
<?= $this->endSection() ?>
