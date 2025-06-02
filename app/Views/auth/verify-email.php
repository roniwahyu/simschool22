<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>
<div class="auth-form fade-in">
    <div class="text-center mb-4">
        <div class="auth-icon mb-3">
            <i class="fas fa-envelope-open" style="font-size: 3rem; color: var(--primary-color);"></i>
        </div>
        <h3 class="mb-2">Verify Your Email</h3>
        <p class="text-muted">We've sent a verification link to your email address</p>
    </div>
    
    <div class="verification-status text-center mb-4">
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle me-2"></i>
            Please check your email and click the verification link to activate your account.
        </div>
    </div>
    
    <div class="verification-actions">
        <button type="button" class="btn btn-primary w-100 mb-3