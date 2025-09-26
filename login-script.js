// === FORM HANDLING ===
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.querySelector('.login-btn');
    const inputs = document.querySelectorAll('input');

    // Handle form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        
        // Basic validation
        if (!username || !password) {
            showMessage('Please fill in all fields', 'error');
            return;
        }

        if (username.length < 3) {
            showMessage('Username must be at least 3 characters long', 'error');
            return;
        }

        if (password.length < 6) {
            showMessage('Password must be at least 6 characters long', 'error');
            return;
        }

        // Simulate login process
        loginBtn.textContent = 'LOGGING IN...';
        loginBtn.disabled = true;
        
        // Simulate API call delay
        setTimeout(() => {
            // Here you would normally send the data to your server
            // For demo purposes, we'll just show a success message
            
            // Example of successful login:
            showMessage('Login successful! Redirecting...', 'success');
            
            setTimeout(() => {
                // Redirect to dashboard or main page
                window.location.href = 'index.html'; // Change this to your main page
            }, 1500);
            
            // Reset button state (in case redirect fails)
            loginBtn.textContent = 'LOGIN';
            loginBtn.disabled = false;
            
        }, 2000);
    });

    // Handle Sign Up button
    document.querySelector('.signup-btn').addEventListener('click', function() {
        window.location.href = 'SignUp.html'; // Make sure this file exists
    });

    // Handle social login buttons
    document.querySelector('.google-btn').addEventListener('click', function() {
        showMessage('Google login would be implemented here', 'info');
        // Implement Google OAuth here
    });

    document.querySelector('.facebook-btn').addEventListener('click', function() {
        showMessage('Facebook login would be implemented here', 'info');
        // Implement Facebook OAuth here
    });

    // Handle forgot password link
    document.querySelector('.forgot-password a').addEventListener('click', function(e) {
        e.preventDefault();
        showMessage('Password reset functionality would be implemented here', 'info');
        // You could redirect to a password reset page or show a modal
    });

    // Add interactive effects to inputs
    inputs.forEach(input => {
        const wrapper = input.parentElement;
        
        input.addEventListener('focus', function() {
            wrapper.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            wrapper.classList.remove('focused');
        });

        // Real-time validation feedback
        input.addEventListener('input', function() {
            removeInputError(input);
        });
    });
});

// === UTILITY FUNCTIONS ===

// Show messages to user
function showMessage(message, type = 'info') {
    // Remove existing messages
    const existingMessage = document.querySelector('.message');
    if (existingMessage) {
        existingMessage.remove();
    }

    // Create message element
    const messageDiv = document.createElement('div');
    messageDiv.className = `message message-${type}`;
    messageDiv.textContent = message;
    
    // Style the message
    messageDiv.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        z-index: 1000;
        min-width: 250px;
        text-align: center;
        animation: slideIn 0.3s ease;
    `;

    // Set colors based on type
    switch(type) {
        case 'success':
            messageDiv.style.backgroundColor = '#28a745';
            break;
        case 'error':
            messageDiv.style.backgroundColor = '#dc3545';
            break;
        case 'info':
        default:
            messageDiv.style.backgroundColor = '#17a2b8';
            break;
    }

    // Add CSS animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);

    // Add to page
    document.body.appendChild(messageDiv);

    // Auto remove after 4 seconds
    setTimeout(() => {
        messageDiv.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 300);
    }, 4000);
}

// Add error styling to input
function addInputError(input, message) {
    input.style.borderColor = '#dc3545';
    input.style.boxShadow = '0 0 10px rgba(220, 53, 69, 0.3)';
    
    // Add error message below input
    let errorMsg = input.parentElement.querySelector('.error-message');
    if (!errorMsg) {
        errorMsg = document.createElement('div');
        errorMsg.className = 'error-message';
        errorMsg.style.cssText = `
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        `;
        input.parentElement.appendChild(errorMsg);
    }
    errorMsg.textContent = message;
}

// Remove error styling from input
function removeInputError(input) {
    input.style.borderColor = '';
    input.style.boxShadow = '';
    
    const errorMsg = input.parentElement.querySelector('.error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
}

// === NAVIGATION HELPERS ===

// Handle navigation links
document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-links a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // If it's a hash link (starts with #), prevent default and handle smooth scroll
            if (this.getAttribute('href').startsWith('#')) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);
                
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});

// === KEYBOARD SHORTCUTS ===
document.addEventListener('keydown', function(e) {
    // Enter key submits form when focused on inputs
    if (e.key === 'Enter' && (e.target.id === 'username' || e.target.id === 'password')) {
        e.preventDefault();
        document.getElementById('loginForm').dispatchEvent(new Event('submit'));
    }
    
    // Escape key clears form
    if (e.key === 'Escape') {
        document.getElementById('username').value = '';
        document.getElementById('password').value = '';
        document.getElementById('username').focus();
    }
});