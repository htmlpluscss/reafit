/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

var windowWidth,
	windowHeight,
	windowScrollTop,
	resizeTimeoutId,
	ScrollBarWidth,
	$window = $(window);

$window.on({
	resize: function(){
		setTimeout(function(){
			windowWidth = $window.width();
			windowHeight = $window.height();
			ScrollBarWidth = getScrollBarWidth();

			$('main').css('min-height',windowHeight-$('header').outerHeight()-$('footer').outerHeight());

		},1);
	},
	scroll: function(){
		windowScrollTop = $window.scrollTop();
	}
});

$window.ready(function(){

	$window.trigger('resize').trigger('scroll');

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

// select
	$('select').mySelect();

// checkbox
	$('.checkbox').append('<i></i>');
	$('.checkbox-star input').on('change',function(){
		var id = $(this).closest('tr').children().first().text();
		var status = $(this).prop('checked') ? 'favorite' : 'personal';
		console.log('send server: ' + id + ' ' + status);
	});

// title
	$('[title]').Title();

// tabs
	$('.tabs').tabs();

	$('.play-video').on('click',function(){
		var id = $(this).attr('data-video');
		if(id==undefined)
			id = $(this).closest('.popup-box').attr('data-video');
		var video =	'<iframe src="http://www.youtube.com/embed/'+id+'?autoplay=1" width="616" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
		popupShow('content',video);
	});

// email
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

// info-message
	$('.info-message__close').one('click',function(){
		$(this).parent().fadeOut();
	});

});

;(function($){

	$.fn.mySelect = function(){

		var select = function(){
			var select = $(this);
			select.wrap('<div class="select notsel"></div>');
			var select_box = select.parent();
			var c = '<span class="value"><span></span></span><a class="icon-angle-down"></a><a class="icon-angle-up"></a><div class="box"><ul>';
			select.children('option').each(function() {
				if($(this).val()!='none')
					c += '<li data-value="' + $(this).val() + '">' + $(this).text() + '</li>';
			});
			c += '</ul></div>';
			select.before(c);

			var box_ul = select.siblings('.box');
			var visible = select.siblings('.value').children();

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
			}).trigger('change');

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
			t.removeAttr('title');
			titleUp.appendTo(t);
			titleUp.css({
				'top':  t.offset().top,
				'left': t.offset().left + t.outerWidth() / 2 - titleUp.outerWidth() / 2
			});
			t.hover(function(){
				titleUp.appendTo('body');
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


	$.fn.tabs = function(){

		var tab = function(){
			tabs = $(this);
			tabs.on('click','.tabs__dt',function(){
				var t = $(this);
				t.addClass('tabs__dt--active');
				tabs.find('.tabs__dt').not(t).removeClass('tabs__dt--active');
				tabs.find('.tabs__dd').removeClass('tabs__dd--active').filter('.tabs__dd--'+t.attr('data-tab')).addClass('tabs__dd--active');
			});
		}

		return this.each(tab);

	};


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

function getScrollBarWidth(){
	var div = $('<div class="scroolbarwidth">');
	div.append('<p></p>');
	$('body').append(div);
	var w = div.width() - div.children().width();
	div.remove();
	return w;
}

// popup
	(function(){
		var popup = $('.popup');
		popup.on('click',function(event){
			var t = $(event.target);
			if((t.is(popup) || t.is('.popup__close')) && !popup.is('.popup--lock')) {
				popup.removeClass('show');
				$('.popup-box--active').removeClass('popup-box--active');
				if(t.closest(popup).is('.popup--content'))
					t.closest(popup).find('.popup__body').children().remove();
			}
		});
	})();

	function popupShow(mod,b,s){
		var popup = $('.popup--'+mod);
		var box = popup.children('.popup__box');
		var body = box.children('.popup__body');
		if(mod=='content' && s == 'related_progress'){
			body.html(b);
			var h = body.height();
		}
		else if(mod=='content' && b != undefined && s==undefined){
			body.html(b);
			var h = body.height();
		}
		else if(mod=='content'){
			var content = b.find('.popup-content--'+s).clone(true);
			body.html(content);
			var h = content.height();
		}
		else {
			var h = body.height();
		}
		if(h > windowHeight - 40)
			h = windowHeight - 40;
		box.height(h);
		popup.addClass('show').siblings('.show').removeClass('show');

		var	top = windowHeight > h ? (windowHeight - h) / 2 : 0;
		box.css('top',top + windowScrollTop);
	}

// one-event of table100--list
	$('.one-event__delete').on('click',function(e){
		var tr = $(this).closest('tr');
		var text = $(this).data('text');
		if(confirm(text) == true) {
			tr.fadeOut(function(){
				tr.remove();
			});
		} else {
			e.preventDefault();
		}
	});
	$('.one-event__detal').on('click',function(){
		popupShow('content',$(this).closest('td'),'add');
	});

/*
 * Copyright 2012 Andrey тA.I.т Sitnik <andrey@sitnik.ru>,
 * sponsored by Evil Martians.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
(function(d){"use strict";d.Transitions={_names:{'transition':'transitionend','OTransition':'oTransitionEnd','WebkitTransition':'webkitTransitionEnd','MozTransition':'transitionend'},_parseTimes:function(b){var c,a=b.split(/,\s*/);for(var e=0;e<a.length;e++){c=a[e];a[e]=parseFloat(c);if(c.match(/\ds/)){a[e]=a[e]*1000}}return a},getEvent:function(){var b=false;for(var c in this._names){if(typeof(document.body.style[c])!='undefined'){b=this._names[c];break}}this.getEvent=function(){return b};return b},animFrame:function(c){var a=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame;if(a){this.animFrame=function(b){return a.call(window,b)}}else{this.animFrame=function(b){return setTimeout(b,10)}}return this.animFrame(c)},isSupported:function(){return this.getEvent()!==false}};d.extend(d.fn,{afterTransition:function(h,i){if(typeof(i)=='undefined'){i=h;h=1}if(!d.Transitions.isSupported()){for(var f=0;f<this.length;f++){i.call(this[f],{type:'aftertransition',elapsedTime:0,propertyName:'',currentTarget:this[f]})}return this}for(var f=0;f<this.length;f++){var j=d(this[f]);var n=j.css('transition-property').split(/,\s*/);var k=j.css('transition-duration');var l=j.css('transition-delay');k=d.Transitions._parseTimes(k);l=d.Transitions._parseTimes(l);var o,m,p,q,r;for(var g=0;g<n.length;g++){o=n[g];m=k[k.length==1?0:g];p=l[l.length==1?0:g];q=p+(m*h);r=m*h/1000;(function(b,c,a,e){setTimeout(function(){d.Transitions.animFrame(function(){i.call(b[0],{type:'aftertransition',elapsedTime:e,propertyName:c,currentTarget:b[0]})})},a)})(j,o,q,r)}}return this},transitionEnd:function(c){for(var a=0;a<this.length;a++){this[a].addEventListener(d.Transitions.getEvent(),function(b){c.call(this,b)})}return this}})}).call(this,jQuery);