function openPopoutDialog() {
    jQuery(function($) {
        $('.overlay').fadeIn('fast', function() {
            $('#box').css('display', 'block');
            // default 30%
            $('#box').animate( {
                'left' : '28%'
            }, 500);
        });
    });
}

function closePopoutDialog(prospectElementID) {
    jQuery(function($) {
        $(document).ready(function() {
            Set_Cookie('popout', 'it works', '', '/', '', '');
            $('#' + prospectElementID).animate( {
                'left' : '-100%'
            }, 500, function() {
                $('#' + prospectElementID).css('left', '100%');
                $('.overlay').fadeOut('fast');
            });
        });
    });
}

function closeSecPopoutDialog(prospectElementID) {
    jQuery(function($) {
        $(document).ready(function() {
            $('#' + prospectElementID).animate( {
                'left' : '-100%'
            }, 500, function() {
                $('#' + prospectElementID).css('left', '100%');
                $('.overlay').fadeOut('fast');
            });
        });
    });
}


/** ************Default text hide for imput types ************* */
jQuery(function($) {
    $(document).ready(function() {
        window.setTimeout(function() {
            //check for popup cookie if set don't open the dialog.
            if (!Get_Cookie('popout')) {
                // possible parameters for Set_Cookie: name, value, expires, path, domain, secure
                openPopoutDialog();
            }
        }, 20000);
    });
});

