// custom.js
function alert_toast(message, type) {
    var toast = $('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true"></div>');
    toast.addClass('bg-' + type);
    toast.text(message);

    $('.toast-container').append(toast);
    var bsToast = new bootstrap.Toast(toast[0]);
    bsToast.show();
}
