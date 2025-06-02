<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="auth-form-container">
    <div class="text-center mb-4">
        <div class="two-factor-icon mb-3">
            <i class="fas fa-shield-alt"></i>
        </div>
        <h3 class="auth-form-title">Two-Factor Authentication</h3>
        <p class="text-muted">Enter the 6-digit code from your authenticator app</p>
    </div>
    
    <?= form_open('auth/verify-2fa', ['id' => 'twoFactorForm', 'class' => 'auth-form']) ?>
        <?= csrf_field() ?>
        
        <div class="two-factor-input-group mb-4">
            <input type="text" class="two-factor-input" maxlength="1" data-index="0">
            <input type="text" class="two-factor-input" maxlength="1" data-index="1">
            <input type="text" class="two-factor-input" maxlength="1" data-index="2">
            <input type="text" class="two-factor-input" maxlength="1" data-index="3">
            <input type="text" class="two-factor-input" maxlength="1" data-index="4">
            <input type="text" class="two-factor-input" maxlength="1" data-index="5">
        </div>
        
        <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
            <i class="fas fa-check me-2"></i>Verify Code
        </button>
        
        <div class="text-center">
            <p class="text-muted mb-2">Having trouble?</p>
            <button type="button" class="btn btn-link p-0" onclick="showBackupCodes()">
                Use backup code
            </button>
        </div>
    <?= form_close() ?>
    
    <!-- Backup Codes Modal -->
    <div class="backup-codes-section d-none" id="backupCodesSection">
        <div class="text-center mb-3">
            <h5>Use Backup Code</h5>
            <p class="text-muted">Enter one of your backup codes</p>
        </div>
        
        <?= form_open('auth/verify-backup-code', ['id' => 'backupCodeForm']) ?>
            <?= csrf_field() ?>
            
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="backup_code" name="backup_code" placeholder="Backup Code" required>
                <label for="backup_code"><i class="fas fa-key me-2"></i>Backup Code</label>
            </div>
            
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-check me-2"></i>Verify Backup Code
            </button>
        <?= form_close() ?>
    </div>
    
    <div class="auth-footer text-center mt-4">
        <a href="<?= base_url('auth/logout') ?>" class="text-decoration-none">
            <i class="fas fa-sign-out-alt me-2"></i>Sign Out
        </a>
    </div>
</div>
<?= $this->endSection() ?>