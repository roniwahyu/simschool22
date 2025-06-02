// Modern Auth JavaScript with React Components
class AuthManager {
    constructor() {
        this.baseUrl = window.baseUrl || '';
        this.csrfToken = window.csrfToken || '';
        this.csrfTokenName = window.csrfTokenName || 'csrf_test_name';
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.initializeComponents();
        this.setupFormValidation();
    }

    setupEventListeners() {
        // Password visibility toggle
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('password-toggle')) {
                this.togglePasswordVisibility(e.target);
            }
        });

        // Form submissions
        document.addEventListener('submit', (e) => {
            if (e.target.classList.contains('auth-form')) {
                this.handleFormSubmit(e);
            }
        });

        // OTP input handling
        document.addEventListener('input', (e) => {
            if (e.target.classList.contains('otp-input')) {
                this.handleOtpInput(e);
            }
        });

        // Auto-dismiss alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                if (alert.classList.contains('auto-dismiss')) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);
    }

    initializeComponents() {
        // Initialize QR Code if container exists
        const qrContainer = document.getElementById('qr-code');
        if (qrContainer) {
            this.generateQRCode();
        }

        // Initialize 2FA setup if needed
        const twoFAContainer = document.getElementById('two-fa-setup');
        if (twoFAContainer) {
            this.setup2FA();
        }

        // Add animation classes
        const authCard = document.querySelector('.auth-card');
        if (authCard) {
            authCard.classList.add('fade-in');
        }
    }

    togglePasswordVisibility(button) {
        const input = button.previousElementSibling;
        const icon = button.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    async handleFormSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
        submitBtn.disabled = true;
        
        try {
            const formData = new FormData(form);
            formData.append(this.csrfTokenName, this.csrfToken);
            
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const result = await response.json();
            
            if (result.success) {
                this.showSuccess(result.message || 'Operation successful!');
                if (result.redirect) {
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1500);
                }
            } else {
                this.showError(result.message || 'An error occurred. Please try again.');
            }
        } catch (error) {
            console.error('Form submission error:', error);
            this.showError('Network error. Please check your connection and try again.');
        } finally {
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    }

    handleOtpInput(e) {
        const input = e.target;
        const value = input.value;
        
        // Only allow numbers
        if (!/^[0-9]$/.test(value)) {
            input.value = '';
            return;
        }
        
        // Move to next input
        const nextInput = input.nextElementSibling;
        if (nextInput && nextInput.classList.contains('otp-input')) {
            nextInput.focus();
        }
        
        // Check if all inputs are filled
        const allInputs = document.querySelectorAll('.otp-input');
        const allFilled = Array.from(allInputs).every(inp => inp.value !== '');
        
        if (allFilled) {
            const otpValue = Array.from(allInputs).map(inp => inp.value).join('');
            this.verifyOTP(otpValue);
        }
    }

    async generateQRCode() {
        const qrContainer = document.getElementById('qr-code');
        if (!qrContainer) return;
        
        try {
            // Generate a unique session ID for QR login
            const sessionId = this.generateSessionId();
            const qrData = `${this.baseUrl}/auth/qr-login?session=${sessionId}`;
            
            // Clear container
            qrContainer.innerHTML = '';
            
            // Generate QR code
            await QRCode.toCanvas(qrContainer, qrData, {
                width: 200,
                margin: 2,
                color: {
                    dark: '#1f2937',
                    light: '#ffffff'
                }
            });
            
            // Start polling for QR scan
            this.pollQRStatus(sessionId);
            
        } catch (error) {
            console.error('QR Code generation error:', error);
            qrContainer.innerHTML = '<p class="text-danger">Failed to generate QR code</p>';
        }
    }

    async pollQRStatus(sessionId) {
        const maxAttempts = 60; // 5 minutes
        let attempts = 0;
        
        const poll = async () => {
            if (attempts >= maxAttempts) {
                this.showError('QR code expired. Please refresh the page.');
                return;
            }
            
            try {
                const response = await fetch(`${this.baseUrl}/auth/qr-status?session=${sessionId}`);
                const result = await response.json();
                
                if (result.authenticated) {
                    this.showSuccess('Login successful!');
                    window.location.href = result.redirect || '/dashboard';
                    return;
                }
                
                attempts++;
                setTimeout(poll, 5000); // Poll every 5 seconds
                
            } catch (error) {
                console.error('QR polling error:', error);
                attempts++;
                setTimeout(poll, 5000);
            }
        };
        
        poll();
    }

    async verifyOTP(otp) {
        try {
            const response = await fetch(`${this.baseUrl}/auth/verify-otp`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    otp: otp,
                    [this.csrfTokenName]: this.csrfToken
                })
            });
            
            const result = await response.json();
            
            if (result.success) {
                this.showSuccess('OTP verified successfully!');
                if (result.redirect) {
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1500);
                }
            } else {
                this.showError(result.message || 'Invalid OTP. Please try again.');
                this.clearOtpInputs();
            }
        } catch (error) {
            console.error('OTP verification error:', error);
            this.showError('Verification failed. Please try again.');
            this.clearOtpInputs();
        }
    }

    clearOtpInputs() {
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach(input => {
            input.value = '';
        });
        if (inputs.length > 0) {
            inputs[0].focus();
        }
    }

    async setup2FA() {
        try {
            const response = await fetch(`${this.baseUrl}/auth/setup-2fa`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    [this.csrfTokenName]: this.csrfToken
                })
            });
            
            const result = await response.json();
            
            if (result.success) {
                // Display QR code for 2FA setup
                const qrContainer = document.getElementById('two-fa-qr');
                if (qrContainer) {
                    await QRCode.toCanvas(qrContainer, result.qr_code, {
                        width: 200,
                        margin: 2
                    });
                }
                
                // Display backup codes
                const backupContainer = document.getElementById('backup-codes');
                if (backupContainer && result.backup_codes) {
                    backupContainer.innerHTML = result.backup_codes
                        .map(code => `<code class="backup-code">${code}</code>`)
                        .join('');
                }
            }
        } catch (error) {
            console.error('2FA setup error:', error);
            this.showError('Failed to setup 2FA. Please try again.');
        }
    }

    setupFormValidation() {
        const forms = document.querySelectorAll('.auth-form');
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', () => this.validateField(input));
                input.addEventListener('input', () => this.clearFieldError(input));
            });
        });
    }

    validateField(field) {
        const value = field.value.trim();
        const type = field.type;
        let isValid = true;
        let message = '';
        
        // Required validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            message = 'This field is required';
        }
        
        // Email validation
        else if (type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                isValid = false;
                message = 'Please enter a valid email address';
            }
        }
        
        // Password validation
        else if (field.name === 'password' && value) {
            if (value.length < 8) {
                isValid = false;
                message = 'Password must be at least 8 characters long';
            }
        }
        
        // Confirm password validation
        else if (field.name === 'confirm_password' && value) {
            const passwordField = document.querySelector('input[name="password"]');
            if (passwordField && value !== passwordField.value) {
                isValid = false;
                message = 'Passwords do not match';
            }
        }
        
        this.showFieldValidation(field, isValid, message);
        return isValid;
    }

    showFieldValidation(field, isValid, message) {
        // Remove existing validation
        this.clearFieldError(field);
        
        if (!isValid) {
            field.classList.add('is-invalid');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = message;
            field.parentNode.appendChild(errorDiv);
        } else {
            field.classList.add('is-valid');
        }
    }

    clearFieldError(field) {
        field.classList.remove('is-invalid', 'is-valid');
        const errorDiv = field.parentNode.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    generateSessionId() {
        return 'qr_' + Math.random().toString(36).substr(2, 9) + Date.now().toString(36);
    }

    showSuccess(message) {
        toastr.success(message);
    }

    showError(message) {
        toastr.error(message);
    }

    showInfo(message) {
        toastr.info(message);
    }

    showWarning(message) {
        toastr.warning(message);
    }
}

// React Components for Interactive Elements
const { useState, useEffect } = React;

// OTP Input Component
function OTPInput({ length = 6, onComplete }) {
    const [otp, setOtp] = useState(new Array(length).fill(''));
    
    const handleChange = (element, index) => {
        if (isNaN(element.value)) return false;
        
        setOtp([...otp.map((d, idx) => (idx === index ? element.value : d))]);
        
        // Focus next input
        if (element.nextSibling) {
            element.nextSibling.focus();
        }
    };
    
    useEffect(() => {
        if (otp.join('').length === length) {
            onComplete(otp.join(''));
        }
    }, [otp]);
    
    return React.createElement('div', { className: 'otp-inputs' },
        otp.map((data, index) => {
            return React.createElement('input', {
                key: index,
                type: 'text',
                maxLength: '1',
                className: 'otp-input',
                value: data,
                onChange: (e) => handleChange(e.target, index),
                onFocus: (e) => e.target.select()
            });
        })
    );
}

// Password Strength Indicator
function PasswordStrength({ password }) {
    const [strength, setStrength] = useState(0);
    const [feedback, setFeedback] = useState('');
    
    useEffect(() => {
        const calculateStrength = (pwd) => {
            let score = 0;
            let messages = [];
            
            if (pwd.length >= 8) score += 1;
            else messages.push('At least 8 characters');
            
            if (/[a-z]/.test(pwd)) score += 1;
            else messages.push('Lowercase letter');
            
            if (/[A-Z]/.test(pwd)) score += 1;
            else messages.push('Uppercase letter');
            
            if (/[0-9]/.test(pwd)) score += 1;
            else messages.push('Number');
            
            if (/[^A-Za-z0-9]/.test(pwd)) score += 1;
            else messages.push('Special character');
            
            setStrength(score);
            setFeedback(messages.join(', '));
        };
        
        calculateStrength(password);
    }, [password]);
    
    const getStrengthColor = () => {
        if (strength <= 2) return '#ef4444';
        if (strength <= 3) return '#f59e0b';
        if (strength <= 4) return '#10b981';
        return '#059669';
    };
    
    const getStrengthText = () => {
        if (strength <= 2) return 'Weak';
        if (strength <= 3) return 'Fair';
        if (strength <= 4) return 'Good';
        return 'Strong';
    };
    
    if (!password) return null;
    
    return React.createElement('div', { className: 'password-strength mt-2' },
        React.createElement('div', { className: 'strength-bar mb-1' },
            React.createElement('div', {
                className: 'strength-fill',
                style: {
                    width: `${(strength / 5) * 100}%`,
                    height: '4px',
                    backgroundColor: getStrengthColor(),
                    borderRadius: '2px',
                    transition: 'all 0.3s ease'
                }
            })
        ),
        React.createElement('div', {
            className: 'strength-text',
            style: { fontSize: '0.875rem', color: getStrengthColor() }
        }, `Password strength: ${getStrengthText()}`),
        feedback && React.createElement('div', {
            className: 'strength-feedback',
            style: { fontSize: '0.75rem', color: '#6b7280', marginTop: '0.25rem' }
        }, `Missing: ${feedback}`)
    );
}

// Initialize Auth Manager when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.authManager = new AuthManager();
    
    // Mount React components if containers exist
    const otpContainer = document.getElementById('otp-container');
    if (otpContainer) {
        ReactDOM.render(
            React.createElement(OTPInput, {
                length: 6,
                onComplete: (otp) => window.authManager.verifyOTP(otp)
            }),
            otpContainer
        );
    }
    
    const passwordInput = document.getElementById('password');
    const strengthContainer = document.getElementById('password-strength');
    if (passwordInput && strengthContainer) {
        const updateStrength = () => {
            ReactDOM.render(
                React.createElement(PasswordStrength, {
                    password: passwordInput.value
                }),
                strengthContainer
            );
        };
        
        passwordInput.addEventListener('input', updateStrength);
        updateStrength();
    }
});

// Export for global access
window.AuthManager = AuthManager;
window.OTPInput = OTPInput;
window.PasswordStrength = PasswordStrength;