// JavaScript Document
jQuery(document).ready(function($){

// custom action so that default text will not be accepted
jQuery.validator.addMethod("defaultName", function(value, element) {
	return value != "Name";
}, "");
jQuery.validator.addMethod("defaultEmail", function(value, element) {
	return value != "Email";
}, "");
jQuery.validator.addMethod("defaultPhone", function(value, element) {
	return value != "Phone";
}, "");

// custom validation to only allow certain characters
jQuery.validator.addMethod("accept", function(value, element, param) {
  return value.match(new RegExp("^" + param + "$"));
});


//Clear default fields values for all input fields with a class of "clear-default"
$.fn.clearDefault = function(){
	return this.each(function(){
		var default_value = $(this).val();
		$(this).focus(function(){
			if ($(this).val() == default_value) $(this).val("");
		});
		$(this).blur(function(){
			if ($(this).val() == "") $(this).val(default_value);
		});
	});
};
$('input.clear-default').clearDefault();



	// validate signup form on keyup and submit
	$("#rsvp-form").validate({
		
		onfocusout: function(element) {
			$(element).valid();
		},
		
		rules: {
			name: {
				required: true,
				defaultName: true,
				accept: "[a-zA-Z '-.]+"
			},
			email: {
				required: true,
				defaultEmail: true,
				email: true
			},
			phone: { 
				required: true,
				defaultPhone: true,
				accept: "[0-9 ()-.]+",
				minlength: 10
        	}
		},
		messages: {
			name: {
				required: "Please enter your Name.",
				defaultFirstName: "Please enter your Name.",
				accept: "Only characters in Name." 
			},
			email: {
				required: "Please enter your email address.",
				email: "Please enter a valid email address."
			},
			phone: {
				required: "Please enter your Phone Number.",
				defaultPhone: "Please enter your Phone Number.",
				accept: "Please do not enter letters in Phone Number.",
				minlength: "Please enter at least 10 Digits for your Phone Number."
			}
		},
        errorElement: "p",
        wrapper: "div",  // a wrapper around the error message
		errorPlacement: function (error, element) {
		
			
			 /******* Uncomment the code below to show error messages for specific fields in a specific div. In most cases this isn't needed. *******/
/*			 if (element.attr("name") == "first_name" || element.attr("name") == "last_name") {
				$("#namemessage").append(error);
				$("#namemessage").fadeIn('slow');
			 }
			 else*/
			 
			 
			 /******* Uncomment the code below to show error messages. *******/
			 /* error.fadeIn('200').insertAfter(element);*/
		}
	});
	
	
});