document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.querySelector('.login-btn');
    const inputs = document.querySelectorAll('input');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        
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

        loginBtn.textContent = 'LOGGING IN...';
        loginBtn.disabled = true;
        
        setTimeout(() => {

            
            showMessage('Login successful! Redirecting...', 'success');
            
            setTimeout(() => {
                window.location.href = 'index.html'; 
            }, 1500);
            
            loginBtn.textContent = 'LOGIN';
            loginBtn.disabled = false;
            
        }, 2000);
    });

    document.querySelector('.signup-btn').addEventListener('click', function() {
        window.location.href = 'SignUp.html'; 
    });

    document.querySelector('.google-btn').addEventListener('click', function() {
        showMessage('Google login would be implemented here', 'info');
    });

    document.querySelector('.facebook-btn').addEventListener('click', function() {
        showMessage('Facebook login would be implemented here', 'info');
    });

    document.querySelector('.forgot-password a').addEventListener('click', function(e) {
        e.preventDefault();
        showMessage('Password reset functionality would be implemented here', 'info');
    });

    inputs.forEach(input => {
        const wrapper = input.parentElement;
        
        input.addEventListener('focus', function() {
            wrapper.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            wrapper.classList.remove('focused');
        });

        input.addEventListener('input', function() {
            removeInputError(input);
        });
    });
});


function showMessage(message, type = 'info') {
    const existingMessage = document.querySelector('.message');
    if (existingMessage) {
        existingMessage.remove();
    }

    const messageDiv = document.createElement('div');
    messageDiv.className = `message message-${type}`;
    messageDiv.textContent = message;
    
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

    document.body.appendChild(messageDiv);

    setTimeout(() => {
        messageDiv.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 300);
    }, 4000);
}

function addInputError(input, message) {
    input.style.borderColor = '#dc3545';
    input.style.boxShadow = '0 0 10px rgba(220, 53, 69, 0.3)';
    
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

function removeInputError(input) {
    input.style.borderColor = '';
    input.style.boxShadow = '';
    
    const errorMsg = input.parentElement.querySelector('.error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
}


document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-links a');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
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

document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && (e.target.id === 'username' || e.target.id === 'password')) {
        e.preventDefault();
        document.getElementById('loginForm').dispatchEvent(new Event('submit'));
    }
    
    if (e.key === 'Escape') {
        document.getElementById('username').value = '';
        document.getElementById('password').value = '';
        document.getElementById('username').focus();
    }
});