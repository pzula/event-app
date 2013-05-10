$(document).ready(function() {
	
	$(".rsvp-button").fancybox({
		width	: 520,
		height  : 450,
		fitToView	: false,
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	

	if ($('body').hasClass('January')) {
		$('li').eq(0).addClass('current');
	} else if ($('body').hasClass('February')) {
		$('li').eq(1).addClass('current');
	} else if ($('body').hasClass('March')) {
		$('li').eq(2).addClass('current');
	} else if ($('body').hasClass('April')) {
		$('li').eq(3).addClass('current');
	} else if ($('body').hasClass('May')) {
		$('li').eq(4).addClass('current');
	} else if ($('body').hasClass('June')) {
		$('li').eq(5).addClass('current');
	} else if ($('body').hasClass('July')) {
		$('li').eq(6).addClass('current');
	} else if ($('body').hasClass('August')) {
		$('li').eq(7).addClass('current');
	} else if ($('body').hasClass('September')) {
		$('li').eq(8).addClass('current');
	} else if ($('body').hasClass('October')) {
		$('li').eq(9).addClass('current');
	} else if ($('body').hasClass('November')) {
		$('li').eq(10).addClass('current');
	} else if ($('body').hasClass('December')) {
		$('li').eq(11).addClass('current');
	}


	var date = new Date(),
    mon  = date.getMonth(); // 0 -> 11

	$('.month-list li:lt('+mon+')').each(function(){
	  $('a', this).contents().unwrap().parent('li').addClass('nolink');
	});

});

