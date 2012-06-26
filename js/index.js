$(document).ready(function() {

// Initialization of fancybox with id bind
$("#registerBtn").fancybox({
	'beforeShow' : function () {
        // Disable right click
        $.fancybox.wrap.bind("contextmenu", function (e) {
            return false; 
        });
    },
	'scrolling'		: 'no',
	'titleShow'		: false,
	'openEffect'	: 'fade',
	'closeEffect'	: 'fade',
	'afterClose'	: function() {
	    $("#login_error").hide();
	}
});

// bind on submit to load ajax after user register submit
$("#register_form").bind("submit", function() {
	if (
	$("#username").val().length < 1 || 
	$("#password").val().length < 1 ||
	$("#confirmPassword").val().length < 1 ||
	$("#email").val().length < 1
	) { $("#login_error").show();
	return false;
	}

	$.ajax({
		type : "POST",
		cache : false,
		url : "php/register.php",
		data : $(this).serializeArray(),
		success: function(data) {
			$.fancybox(data);
			}
		});
	return false;
});

// end of onDocument Ready
});