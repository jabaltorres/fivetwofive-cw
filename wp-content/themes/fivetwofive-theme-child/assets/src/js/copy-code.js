/**
 * Copy Code Functionality
 * Adds copy buttons to <pre> tags and handles copying code to clipboard
 */

document.addEventListener('DOMContentLoaded', function() {
    initCopyCodeButtons();
});

/**
 * Initialize copy buttons for all <pre> tags
 */
function initCopyCodeButtons() {
    const preTags = document.querySelectorAll('pre');
    
    preTags.forEach(preTag => {
        // Skip if copy button already exists
        if (preTag.querySelector('.copy-code-btn')) {
            return;
        }
        
        // Create copy button
        const copyButton = createCopyButton();
        
        // Add button to pre tag
        preTag.style.position = 'relative';
        preTag.appendChild(copyButton);
        
        // Add click event listener
        copyButton.addEventListener('click', function(e) {
            e.preventDefault();
            copyCodeToClipboard(preTag, copyButton);
        });
    });
}

/**
 * Create copy button element
 */
function createCopyButton() {
    const button = document.createElement('button');
    button.className = 'copy-code-btn';
    button.setAttribute('aria-label', 'Copy code to clipboard');
    button.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
        </svg>
        <span class="copy-text">Copy</span>
    `;
    return button;
}

/**
 * Copy code content to clipboard
 */
async function copyCodeToClipboard(preTag, button) {
    // Look for <code> tag inside <pre>, fallback to <pre> content if no <code> found
    const codeElement = preTag.querySelector('code');
    const codeContent = codeElement ? (codeElement.textContent || codeElement.innerText) : (preTag.textContent || preTag.innerText);
    const copyText = button.querySelector('.copy-text');
    const originalText = copyText.textContent;
    
    try {
        // Use modern clipboard API if available
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(codeContent);
        } else {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = codeContent;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
        }
        
        // Show success feedback
        showCopyFeedback(button, copyText, 'Copied!', true);
        
    } catch (err) {
        console.error('Failed to copy code: ', err);
        showCopyFeedback(button, copyText, 'Failed!', false);
    }
}

/**
 * Show copy feedback to user
 */
function showCopyFeedback(button, copyText, message, isSuccess) {
    const originalText = copyText.textContent;
    
    // Update button appearance
    button.classList.add(isSuccess ? 'copy-success' : 'copy-error');
    copyText.textContent = message;
    
    // Reset after 2 seconds
    setTimeout(() => {
        button.classList.remove('copy-success', 'copy-error');
        copyText.textContent = originalText;
    }, 2000);
}

/**
 * Re-initialize copy buttons (useful for dynamic content)
 */
function reinitCopyCodeButtons() {
    initCopyCodeButtons();
}

// Export for potential external use
window.reinitCopyCodeButtons = reinitCopyCodeButtons;
