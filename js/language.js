/**
 * AgroInnovate - Language Switcher JavaScript
 * Handles the language switching functionality
 */

// Document ready function
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Feather icons if available
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
    
    // Set dropdown to current language
    const languageDropdown = document.getElementById('language-dropdown');
    if (languageDropdown) {
        // When dropdown changes - simplified direct approach
        languageDropdown.addEventListener('change', function() {
            const selectedLang = this.value;
            // Redirect with language parameter
            window.location.href = 'includes/set_language.php?lang=' + selectedLang + '&redirect=' + encodeURIComponent(window.location.href);
        });
    }
    
    // Set up button-based language switchers if present
    document.querySelectorAll('[data-language]').forEach(button => {
        button.addEventListener('click', function() {
            const lang = this.getAttribute('data-language');
            window.location.href = 'includes/set_language.php?lang=' + lang + '&redirect=' + encodeURIComponent(window.location.href);
        });
    });
});

/**
 * Toggles between languages
 * 
 * @param {string} lang - The language code to switch to
 */
function toggleLanguage(lang) {
    // Show loading indicator
    showLanguageLoadingIndicator();
    
    // Store in localStorage for persistence
    localStorage.setItem('language', lang);
    
    // Update language via AJAX
    fetch(`includes/set_language.php?lang=${lang}`, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Cache-Control': 'no-cache'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Language changed successfully to: ' + lang);
            document.documentElement.lang = lang;
            // Reload the page to ensure all content is updated
            window.location.reload();
        } else {
            console.error('Language change failed:', data.error);
            hideLanguageLoadingIndicator();
            // Show error message
            alert('Failed to change language. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error changing language:', error);
        hideLanguageLoadingIndicator();
    });
}

/**
 * Shows a loading indicator while changing language
 */
function showLanguageLoadingIndicator() {
    // Create loading indicator if it doesn't exist
    if (!document.getElementById('language-loading')) {
        const loader = document.createElement('div');
        loader.id = 'language-loading';
        loader.innerHTML = `
            <div class="language-loading-overlay">
                <div class="language-loading-spinner"></div>
                <div class="language-loading-text">Changing language...</div>
            </div>
        `;
        document.body.appendChild(loader);
        
        // Add styles
        const style = document.createElement('style');
        style.textContent = `
            .language-loading-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }
            .language-loading-spinner {
                border: 4px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top: 4px solid #ffffff;
                width: 40px;
                height: 40px;
                animation: spin 1s linear infinite;
                margin-bottom: 10px;
            }
            .language-loading-text {
                color: white;
                font-size: 16px;
                font-weight: bold;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    } else {
        document.getElementById('language-loading').style.display = 'block';
    }
}

/**
 * Hides the language loading indicator
 */
function hideLanguageLoadingIndicator() {
    const loader = document.getElementById('language-loading');
    if (loader) {
        loader.style.display = 'none';
    }
}

/**
 * Shows a notification when language is changed
 * 
 * @param {string} lang - The language code that was switched to
 */
function showLanguageChangeNotification(lang) {
    // Language names mapping
    const langNames = {
        'en': 'English',
        'hi': 'हिन्दी',
        'pa': 'ਪੰਜਾਬੀ'
    };
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'language-notification';
    notification.innerHTML = `Language changed to ${langNames[lang] || lang}`;
    
    // Add styles
    const style = document.createElement('style');
    style.textContent = `
        .language-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            animation: fadeInOut 3s forwards;
        }
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(20px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
    `;
    document.head.appendChild(style);
    
    // Add to document
    document.body.appendChild(notification);
    
    // Remove after animation completes
    setTimeout(() => {
        document.body.removeChild(notification);
    }, 3000);
}
