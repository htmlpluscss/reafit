/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

var windowHeight,
	windowScrollTop,
	pageResize,
	resizeTimeoutId,
	scrollTimeoutId,
//	ScrollBarWidth,
	body = $('body'),
	$window = $(window);

pageResize = function(){
	windowHeight = $window.height();
//	ScrollBarWidth = getScrollBarWidth();
	$('#main').css('min-height',windowHeight-$('#header').height()-$('#footer').height());
}
pageResize();

$window.on({
	resize: function(){
		clearTimeout(resizeTimeoutId);
		resizeTimeoutId = setTimeout(function(){
			pageResize();
		},1);
	},
	scroll: function(){
		windowScrollTop = $window.scrollTop();
	}
});

$window.ready(function(){

	$window.trigger('resize').trigger('scroll');

});

	// избранное
	$('.icon-star:not(.icon-toggle-favorite), .icon-star-empty').on('click',function(e){
		e.preventDefault();
		var url = $(this).attr('href');
		var type = parseInt($(this).data('type'));
		$.ajax({
			type:     'POST',
			dataType: 'json',
			cache:    false,
			url:      url,
			data: {
				type : type
			},
			success: $.proxy(function(data){
				if(data['success'].length != 0) {
					if(type == 0) {
						$(this).attr('class', 'icon-star-empty');
						$(this).attr('data-type', 1);
					} else {
						$(this).attr('class', 'icon-star');
						$(this).attr('data-type', 0);
					}
				}
			}, this)
		});
	});

// checkbox
	$('.checkbox').addClass('notsel').append('<i></i>');
	$('.checkbox-star input').on('change',function(){
		var id = $(this).closest('tr').children().first().text();
		var status = $(this).prop('checked') ? 'favorite' : 'personal';
		console.log('send server: ' + id + ' ' + status);
	});


	$('.play-video').on('click',function(){
		var id = $(this).attr('data-video');
		if(id==undefined)
			id = $(this).closest('.popup-box').attr('data-video');
		var video =	'<iframe src="http://www.youtube.com/embed/'+id+'?autoplay=1" width="608" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		popupShow('content',video);
	});

			// убрал проверку, сделать ее в слечае отправки емайла
// email
/*
	$('.input').filter('[type="email"]')
		.on('change blur',function(){
			var f = $(this).closest('form');
			errorEmail($(this)) || $(this).val() == '' ? f.removeClass('not-valid-form') : f.addClass('not-valid-form');
 		})
		.on('keyup',function(){
			var val = $(this).val();
			if($(this).hasClass('not-required')) {
				if(val.length != 0) {
					if(testEmail(val)) {
						$(this).next('.error').addClass('hide');
					}
				}
			} else {
				if(testEmail(val)) {
					$(this).next('.error').addClass('hide');
				}
			}
		});
*/
// info-message
	$('.info-message__close').one('click',function(){
		$(this).parent().fadeOut(function(){
			$window.trigger('resize').trigger('scroll');
		});
	});

// input-placeholder
	$('.input-placeholder').children('.input').on('keyup blur',function(){
		var t = $(this);
		setTimeout(function(){
			t.parent().toggleClass('input-placeholder--active',Boolean(t.val()));
		});
	}).trigger('blur');


(function($){

	$.fn.mySelect = function(){

		var select = function(){
			var select = $(this);
			select.wrap('<span class="select notsel"></span>');
			var select_box = select.parent();
			var c = '<span class="value"><span></span></span><span class="box"><ul>';
			select.children('option').each(function(i) {
				if($(this).val()!='none')
					c += '<li tabindex="'+i+'" data-value="' + $(this).val() + '">' + $(this).text() + '</li>';
			});
			c += '</ul></span>';
			select.before(c);

			var clss = select.attr('data-class');
			var box_ul = select.siblings('.box');
			var visible = select.siblings('.value').children();

			if(clss !== undefined)
				select_box.addClass(clss);

			select_box.on('click', function() {
				select_box.hasClass('focus') ? box_ul.hide() : box_ul.show();
				select_box.toggleClass('focus');
			});

			box_ul.on('click','li', function() {
				select.val($(this).attr('data-value')).trigger('change');
			});
			select.on('change',function(){
				var o = select.children(':selected');
				visible.text(o.text());
				$(this).addClass('changed');
			}).trigger('change');

			select.on('focus',function(event){
				select_box.trigger('click');
				select.blur();
			});

			if(select.attr('data-required-sup') !== undefined && select.val() == 'none')
				visible.append('<sup>*</sup>');

		}

		$(document).on('click', function(event) {
			$('.select.focus').not($(event.target).closest('.select')).removeClass('focus').find('.box').hide();
		});

		return this.each(select);

	};

	$.fn.Title = function(){

		var set = function(){
			var t = $(this);
			var titleUp = $('<p class="title_up">');
			titleUp.text(t.attr('title'));
			titleUp.append('<i></i>');
			t.removeAttr('title');
			titleUp.appendTo(t);
			titleUp.css({
				'top':  t.offset().top,
				'left': t.offset().left + t.outerWidth() / 2 - titleUp.outerWidth() / 2
			});
			t.hover(function(){
				titleUp.appendTo(body);
				titleUp.css({
					'top':  t.offset().top,
					'left': t.offset().left + t.outerWidth() / 2 - titleUp.outerWidth() / 2
				});
			},function(){
				titleUp.appendTo(t);
			});
		}

		return this.each(set);

	};

// select
	$('select').mySelect();

// title
	$('[title]').Title();

// цели метрики
	$('.page-login').find('form').on('click',function(){
		var id = $(this).attr('action').substr(1);
		yaCounter35342380.reachGoal(id)
	});

})(jQuery);

// test e-mail
function testEmail(v){
	var filterEmail = /^([a-z0-9_'&\.\-\+=])+\@(([a-z0-9\-])+\.)+([a-z0-9]{2,10})+$/i;
	return filterEmail.test(v);
}
function errorEmail(t){
	var e = t.next('.error');
	var test = testEmail(t.val());
	if(e.length==0){
		e = $('<i class="error">');
		e.text(t.attr('data-error'));
		t.after(e);
	}
	test || t.val().length==0 ? e.addClass('hide') : e.removeClass('hide');
	return test;
}
/*
function getScrollBarWidth(){
	var div = $('<div class="scroolbarwidth">');
	div.append('<p></p>');
	body.append(div);
	var w = div.width() - div.children().width();
	div.remove();
	return w;
}
*/
// popup
	(function(){
		var popup = $('.popup');
		popup.on('click',function(event){
			var t = $(event.target);
			if((t.is(popup) || t.is('.popup__close')) && !popup.is('.popup--lock')) {
				popup.removeClass('show');
				$('.popup-box--active').removeClass('popup-box--active');
				if(t.closest(popup).is('.popup--content'))
					t.closest(popup).find('.popup__box').removeAttr('style').children('.popup__body').html('<div class="popup__inner"></div>');
			}
		});
	})();

	function popupShow(mod,b,s,w){
		var popup = $('.popup--'+mod);
		var box = popup.children('.popup__box');
		var popupBody = box.find('.popup__inner');
		if(w !== undefined){
			box.width(w);
		}
		if (
			(s == 'template') 			||
			(s == 'related_progress')
//			(mod=='content' && b != undefined && s==undefined) // пиши правила для каждого случая
			)
		{
			popupBody.html(b);
			var h = popupBody.height();
		}
		else if(mod=='content'){
			var content = b.find('.popup-content--'+s).clone(true);
			popupBody.html(content);
			var h = content.height();
		}
		else {
			var h = popupBody.height();
		}
		if(h > windowHeight - 100) {
			if(content){
				box.width(box.width()+18); // 18 ширрина скрола + отступ
				content.css('padding-right',18);
				popupBody.append('<div class="baron__track"><div class="baron__free"><a class="baron__bar"></a></div></div>');
			}
			h = windowHeight - 100;
			popupBody.height(h);
			setTimeout(function(){
				popupBody.baron({
					bar: '.baron__bar'
				}).controls({
					track: '.baron__free'
				});
			});
		}
		if(!popup.hasClass('popup--height-auto'))
			box.height(h);
		popup.addClass('show').siblings('.popup.show').removeClass('show');
	}

// one-event of table100--list
	$('.one-event__delete').on('click',function(e){
		var text = $(this).data('text');
		$('.popup--msg .popup__inner').html(text);
		$('.popup--msg a.btn-cancel-popup').removeClass('hide');
		if(!$('.popup--msg a.btn-no-popup').hasClass('has')) {
			$('.popup--msg a.btn-no-popup').addClass('hide');
		}
		$('.popup--msg a.btn-yes-popup').attr('href', $(this).attr('href'));
		$('.popup--msg a.btn-yes-popup').removeClass('hide');
		popupShow('msg');
		e.preventDefault();
	});

	$('.one-event__detal').on('click',function(){
		popupShow('content',$(this).closest('td'),'add');
	});

	$('.btn--reset').on('click', function(){
		var form = $(this).closest('form');
		form.find('input[name="search"]').val('');
		form.submit();
	});

	if($('a.sort-btn').length != 0) {
		$('a.sort-btn').on('click', function(e){
			e.preventDefault();
			var sort = $(this).data('sort');
			var order = $(this).data('order');
			$(document).find('input[name="sort"]').val(sort);
			$(document).find('input[name="order"]').val(order);
			$('form.search-form').submit();
		});
	}

	if($('.pagination-items').length != 0) {
		$('.pagination-items').change(function() {
			if($(this).hasClass('changed')) {
				$(this).closest('form').submit();
			}

		});
	}

	$('#btn-create-cat, .edit-cat-btn').on('click', function(){
		var type = $(this).data('type');
		if(type === undefined) {
			type = 'create';
		}
		console.log($('.popup--create-cat h3'))

		if(type == 'create' || type == 'update') {

			if(type == 'create') {
				$('.popup--create-cat form').attr('action', $('.popup--create-cat form').data(type));
				$('.popup--create-cat').find('.popup--create__cat_name').val('');
				$('.popup--create-cat').find('.popup--create__cat_textarea').val('');
			} else {
				var id = $(this).data('id');
				var action = $('.popup--create-cat form').data(type) + '/' + id;
				$('.popup--create-cat form').attr('action', action);
				$.ajax({
					type:     'POST',
					dataType: 'json',
					cache:    false,
					url:      action,
					success: $.proxy(function(data){
						if(data['success'].length != 0 && data['data'].length != 0) {
							if(data['data']['name'].length != 0) {
								$('.popup--create-cat').find('.popup--create__cat_name').val(data['data']['name']).trigger('blur');
							}
							if(data['data']['description'].length != 0) {
								$('.popup--create-cat').find('.popup--create__cat_textarea').val(data['data']['description']).trigger('blur');
							}
						}
					}, this),
					error: function(data) {
						console.log('error load category!');
						return false;
					}
				});
			}

			$('.popup--create_cat .input').trigger('blur');
			$('.popup--create-cat h3').text($('.popup--create-cat h3').data(type));
			$('.popup--create-cat__btn').text($('.popup--create-cat__btn').data(type));
		}
		popupShow('create-cat');
	});

	$('.popup--create-cat__btn').on('click', function(){
		if ($('.popup--create__cat_name').val().length == 0){
			$('.popup--create__cat_name').focus();
			return false;
		}
	});