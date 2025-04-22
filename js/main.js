/**
 * AgroInnovate - Main JavaScript file
 * Contains general functionality for the entire website
 */

// Document ready function
document.addEventListener('DOMContentLoaded', function() {
    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
    
    // Set up scroll behavior for navigation links
    setupSmoothScrolling();
    
    // Set up form validation
    setupFormValidation();
    
    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined' && typeof bootstrap.Tooltip !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
});

/**
 * Sets up smooth scrolling for anchor links
 */
function setupSmoothScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                window.scrollTo({
                    top: target.offsetTop - 80, // Offset for the fixed header
                    behavior: 'smooth'
                });
            }
        });
    });
}

/**
 * Sets up form validation for all forms
 */
function setupFormValidation() {
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        const submitButton = form.querySelector('button[type="submit"]');
        
        form.addEventListener('submit', function(e) {
            if (!validateForm(form)) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            form.classList.add('was-validated');
        });
        
        // Real-time validation as user types
        const inputs = form.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                validateInput(input);
                
                // Check if all inputs are valid to enable/disable submit button
                if (submitButton) {
                    const allValid = Array.from(inputs).every(input => validateInput(input, false));
                    submitButton.disabled = !allValid;
                }
            });
        });
    });
}

/**
 * Validates a specific form input
 * 
 * @param {HTMLElement} input - The input element to validate
 * @param {boolean} showFeedback - Whether to show feedback messages
 * @returns {boolean} - Whether the input is valid
 */
function validateInput(input, showFeedback = true) {
    let isValid = true;
    const feedbackElement = input.nextElementSibling?.classList.contains('invalid-feedback') ? 
        input.nextElementSibling : null;
    
    // Reset validation state
    input.classList.remove('is-invalid');
    if (feedbackElement) {
        feedbackElement.textContent = '';
    }
    
    // Check if required
    if (input.hasAttribute('required') && !input.value.trim()) {
        isValid = false;
        if (showFeedback) {
            input.classList.add('is-invalid');
            if (feedbackElement) {
                feedbackElement.textContent = 'This field is required';
            }
        }
        return isValid;
    }
    
    // Check email format
    if (input.type === 'email' && input.value.trim()) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(input.value)) {
            isValid = false;
            if (showFeedback) {
                input.classList.add('is-invalid');
                if (feedbackElement) {
                    feedbackElement.textContent = 'Please enter a valid email address';
                }
            }
            return isValid;
        }
    }
    
    // Check min length
    if (input.hasAttribute('minlength') && input.value.trim()) {
        const minLength = parseInt(input.getAttribute('minlength'));
        if (input.value.length < minLength) {
            isValid = false;
            if (showFeedback) {
                input.classList.add('is-invalid');
                if (feedbackElement) {
                    feedbackElement.textContent = `Minimum length is ${minLength} characters`;
                }
            }
            return isValid;
        }
    }
    
    // Check pattern
    if (input.hasAttribute('pattern') && input.value.trim()) {
        const pattern = new RegExp(input.getAttribute('pattern'));
        if (!pattern.test(input.value)) {
            isValid = false;
            if (showFeedback) {
                input.classList.add('is-invalid');
                if (feedbackElement) {
                    feedbackElement.textContent = input.getAttribute('data-error-message') || 'Invalid format';
                }
            }
            return isValid;
        }
    }
    
    return isValid;
}

/**
 * Validates all inputs in a form
 * 
 * @param {HTMLFormElement} form - The form to validate
 * @returns {boolean} - Whether the form is valid
 */
function validateForm(form) {
    const inputs = form.querySelectorAll('input, textarea, select');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateInput(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}

/**
 * Shows an alert message
 * 
 * @param {string} message - The message to display
 * @param {string} type - The type of alert (success, danger, warning, info)
 * @param {string} containerId - The ID of the container to put the alert in
 */
function showAlert(message, type = 'info', containerId = 'alert-container') {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    const alert = document.createElement('div');
    alert.className = `alert alert-${type} alert-dismissible fade show`;
    alert.role = 'alert';
    
    alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    container.appendChild(alert);
    
    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        alert.classList.remove('show');
        setTimeout(() => {
            alert.remove();
        }, 150);
    }, 5000);
}

/**
 * Formats a date object to a readable string
 * 
 * @param {Date} date - The date to format
 * @returns {string} - The formatted date string
 */
function formatDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    
    return date.toLocaleDateString('en-IN', options);
}

/**
 * Handles dynamic loading of content via AJAX
 * 
 * @param {string} url - The URL to load content from
 * @param {string} targetId - The ID of the element to load content into
 * @param {Function} callback - Optional callback function after content is loaded
 */
function loadContent(url, targetId, callback = null) {
    const target = document.getElementById(targetId);
    if (!target) return;
    
    // Show loading indicator
    target.innerHTML = '<div class="text-center my-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
    
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            target.innerHTML = html;
            if (callback && typeof callback === 'function') {
                callback();
            }
        })
        .catch(error => {
            target.innerHTML = `<div class="alert alert-danger" role="alert">
                Error loading content: ${error.message}
            </div>`;
        });
}
