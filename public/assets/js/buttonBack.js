
$(function(){
	$('.navButtonUp').click(function(){
		$('body', 'html').animate({
			scrollTop: '0px'
		}, 1000);
	});

	$(window).scroll(function(){
		if ( $(this).scrollTop() > 0) {
			$('.navButtonUp').slideDown(400);
			$('.navButtonLeft').slideDown(400);
		}else{
			$('.navButtonUp').slideUp(400);
			$('.navButtonLeft').slideUp(400);
		};


	});

});