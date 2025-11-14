// utils.js

/**
 * Show a toast message
 * @param {string} message - The main message
 * @param {string} [title] - Optional title
 * @param {string} [type] - success, info, warning, error
 */
function showToast(message, title = '', type = 'success') {
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    switch (type) {
        case 'success':
            toastr.success(message, title);
            break;
        case 'error':
            toastr.error(message, title);
            break;
        case 'info':
            toastr.info(message, title);
            break;
        case 'warning':
            toastr.warning(message, title);
            break;
        default:
            toastr.info(message, title);
    }
}

// Add other reusable functions here
// e.g. updateSessionStatus, confirmDialog, etc.
