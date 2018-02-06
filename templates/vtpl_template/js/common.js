jQuery(function ($) {
    $(document).ready(function () {
//	alert(123);
        $('#menu li.item3').append($('#megamenu1').html());
        $('#megamenu1').remove();


        $('#menu li.item3').hover(

        function () {
          $(this).find('.megamenu-wrapper').stop().slideDown();
        },

        function () {
         $(this).find('.megamenu-wrapper').stop().slideUp();
        });



        $("#panelHandle").click(function () {
            var sidePanel = $("#sidePanel").css('right');
            //alert(sidePanel);
            if (sidePanel == '0px') {
                $("#sidePanel").animate({
                    'right': '-200px'
                }, 1000);
            } else {
                $("#sidePanel").animate({
                    'right': '0px'
                }, 1000);
            }
        });
        
        

        $('#slider-wrapper').slidesjs({
            navigation: {
                active: true
            },

            play: {
                auto: true,
                interval: 10000,
                effect: "slide"
            },

        });

        $('#testimonials-section').slidesjs({
            navigation: false,
            play: {
                auto: true,
                interval: 10000,
                effect: "slide"
            }
        });

        $('#featured-pumps-section').slidesjs({
            navigation: false,
            play: {
                auto: true,
                interval: 8000,
                effect: "slide"
            }

        });
        
//        $('.featured-pumps li:last').css('margin-right','0px');
        
        $('.featured-pumps').each(function(){
           $(this).find('li').last().css('margin-right','0px');
        });
        
        $('#menu ul li').last().css('background-image','none');
        
        $('.footlinks-block:last').css('margin-right','0px');
        $('.footlinks-block:last').css('width','165px');
        
        $('.default-value').each(function () {
            var default_value = this.value;
            $(this).focus(function () {
                if (this.value == default_value) {
                    this.value = '';
                }
            });
            $(this).blur(function () {
                if (this.value == '') {
                    this.value = default_value;
                }
            });
        });

        $('#component-cta').center();

    });
});
function ppcconversion(filename) {
    var iframe = document.createElement('iframe');
    iframe.style.width = '0px';
    iframe.style.height = '0px';
    document.body.appendChild(iframe);
    iframe.src = 'http://sandogroup.com/'+filename+'.html';
}
function formSubmit(formID, displayMssgID) {
    jQuery(function ($) {
        var val = $('#' + formID + ' :input').validateForm();
        var CDT = '&' + getTimeStamp();
        var qstring = $('#' + formID).serialize() + CDT;
        //alert(val);
        if (val) {
	if(formID === 'component-cta')
               {
                   $('#overlay').fadeIn();
                   $('#'+ displayMssgID).fadeIn();
               }	

            $('#' + displayMssgID).html('<div class="process_img"> Registering your Request ... Please Wait ...</div> ');
            $.ajax({
                url: "index.php",
                data: qstring,
                success: function (data) {
                    // Use this method to invoke saveLead after your Ajax call is completed. 
					// the below function invocation should ideally be present in your ajax success.
					// console.log(qstring);
					//saveLead({
						//name: ($('#' + formID + ' input[name="Name"]').val()),
						//email: $('#' + formID + ' input[name="EmailID"]').val(),
						//mobile: $('#' + formID + ' input[name="Mobile"]').val(),
						//prospectCapturingPoint: $('#' + formID + ' input[name="Source"]').val(),
						//description: ''
					//});
                    ppcconversion('conversionCode');
                    $('#' + displayMssgID).html('');
                    $('#' + displayMssgID).append(data);
                    window.setTimeout(function () {
			 if(formID === 'component-cta')
                             {    
                                $('#overlay').fadeOut();
                                $('#'+ displayMssgID).fadeOut();
                             }
                        $('#' + displayMssgID).html('');
                    }, 4000);
                }
            });
        }
    });
}


function getTimeStamp() {
    var currentTime = new Date();
    var day = currentTime.getDate();
    var month = currentTime.getMonth() + 1;
    var year = currentTime.getFullYear();
    var hours = currentTime.getHours() + 1;
    var miniutes = currentTime.getMinutes() + 1;
    var seconds = currentTime.getSeconds() + 1;
    return (day + "-" + month + "-" + "-" + year + " " + hours + ":" + miniutes + ":" + seconds);
}

jQuery(function ($) {
    jQuery.fn.center = function () {
        this.css("position", "fixed");
        this.css("bottom", "0px");
        this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) + $(window).scrollLeft()) + "px");
        return this;
    }

});
