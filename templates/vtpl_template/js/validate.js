/**
* jQuery Form Validator V1.0.0  -  10/22/2012
*
* Description : This plugin is a simple validation plugin for forms, specially for ajax forms. This is still in a BETA VERSION, currently it only * validates INPUT fields. More features are under development.
*
* Copyright (c) 2012 Niraj Chauhan
*/
jQuery(function($) {
    $.fn.validateForm = function() {
        var values = new Array();
        var retval = true;
        this.each(function() {
            $(this).removeClass('error');
            if($(this).hasClass('required'))
            {
                if($(this).hasClass('number'))
                {
                    number = $(this).val();
                    if(number == '' || number.length < 9 || number.length > 13 || isNaN(number))
                    {
                        $(this).addClass('error');
                        retval = false;
                    }
					
                }
                if($(this).hasClass('eminumber'))
                {
                    eminumber = $(this).val();
                    if(eminumber == '' || isNaN(eminumber))
                    {
                        $(this).addClass('error');
                        retval = false;
                    }
					
                }
                if($(this).hasClass('name'))
                {
                    name = $(this).val();
                    if(name == '' || name == 'Name')
                    {
                        $(this).addClass('error');
                        retval = false;
                    }
					
                }
                if($(this).hasClass('email'))
                {
                    email = $(this).val();
                    if(email == '' || !IsEmail(email))
                    {
                        $(this).addClass('error');
                        retval = false;
                    }
					
                }
				
                if($(this).hasClass('required'))
                {
                    textField = $(this).val();
                    if(textField == '')
                    {
                        $(this).addClass('error');
                        retval = false;
                    }
					
                }
				
            }
        });
        return retval;
		
        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            return regex.test(email);
        }
		
    }
});