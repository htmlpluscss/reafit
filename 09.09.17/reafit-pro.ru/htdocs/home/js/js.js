/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

(function($){

	var windowWidth,
		windowHeight,
		windowScrollTop,
		resizeTimeoutId,
		$window = $(window),
		body = $('body'),
		parallax = $('.parallax');

	$window.on({
		resize: function(){
			clearTimeout(resizeTimeoutId);
			resizeTimeoutId = setTimeout(function(){
				pageResize();
			}, 100);
		},
		scroll: function(){
			windowScrollTop = $window.scrollTop();

			// parallax
			parallax.each(function(){
				var p = $(this);
				var top = p.offset().top + p.outerHeight() - windowScrollTop;
				var delta = p.outerHeight();

				delta += p.offset().top < windowHeight ? p.offset().top : windowHeight;
				top /= delta;
				top = 100 * (1 - top);
				if(top<0)
					top = 0;
				if(top>100)
					top = 100;
				p.css('background-position','center '+ (100-top) + '%');
			});
		}
	});

	function pageResize(){
		windowWidth = $window.width();
		windowHeight = $window.height();
	}
	pageResize();

	$window.trigger('scroll');

	// img-cover
	$('.img-cover').each(function(){
		var src = $(this).attr('data-img');
		$(this).css('background-image','url('+src+')');
	});


// menu
	$('.header__menu a').on('click',function(){
		var t = $($(this).attr('href')).offset().top;
		body.removeClass('menu-mobile-show');
		$('body, html').animate({scrollTop : t}, windowWidth < 960 ? 0 : 1000);
		return false;
	});
	$('.menu-mobile-toggle').on('click',function(){
		body.toggleClass('menu-mobile-show');
		return false;
	});
	body.on('click',function(){
		body.removeClass('menu-mobile-show');
	});

	var initialPoint;
	document.addEventListener('touchstart', function(event) {
		initialPoint = event.touches[0].pageY;
	}, false);
	document.addEventListener('touchmove', function(event) {
		if (initialPoint - event.touches[0].pageY > 10)
			body.removeClass('menu-mobile-show');
	}, false);

// form
	$('.block-form').on('submit',function() {
		$('.block-form .btn').find('input').attr('disabled','disabled');
		var data = '&name=' + $('.block-form__name').val() + '&tel=' + $('.block-form__tel').val();
		$.ajax({
			url: '/home/mail.php',
			data: data,
			success: function(){
				$('.block-form').addClass('block-form--send');
			},
			complete: function(){
				$('.block-form btn').find('input').removeAttr('disabled');
			}
		});
		return false;
	});

// video
	if(windowWidth<960){
		$('.btn--video').attr({
			'target' : '_blank',
			'href'   : $('.btn--video').attr('data-src')
		});
	};

})(jQuery);