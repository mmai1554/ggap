jQuery(document).ready(function ($) {
    var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
    if (isFirefox) {
        $('#HomeStatic').addClass('mi-show');
        $('#HomeVideo').hide('mi-hide');
    }
});