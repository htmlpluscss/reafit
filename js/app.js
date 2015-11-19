
/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

(function($){

	var list = $('.exercises-list');
	var listOne = list.children().not('.exercises-list__item--set');
	var listSet = list.children('.exercises-list__item--set');
	var listMy = $('.exercises-my');

	$window.on({
		resize: function(){
			setTimeout(function(){

				var f = $('body').hasClass('fullscreen') ? 0 : $('footer').height();
				var h = windowHeight - list.offset().top - f;
				list.height(h);
				h = windowHeight - $('.tabs__dd--active .l-h').offset().top - f;
				$('.l-h').height(h-16);
				h < 300 ? $('body').addClass('min-height') : $('body').removeClass('min-height');

			},1);
		}
	});

	$('body').addClass('show');

/* Иконки в шапке ---------- */

	// fullscreen
	$('.app-fullscreen').on('click',function(){
		$('body').toggleClass('fullscreen');
		setTimeout(function(){
			$window.trigger('resize');
		});
	});

	// создать
	$('.btn-new').on('click',function(){
		popupShow('close');
	});

	// сохранить при выходе?
	$('.popup--close .btn').on('click',function(){
		popupShow('create');
	});

	// tab вне tabs
	$('.data-tab-link').on('click',function(){
		var tab = $(this).attr('data-tab');
		$('.tabs__dt').filter('[data-tab="'+tab+'"]').trigger('click');
		if(tab == 'save-as'){
			setTimeout(function(){
				$('.tabs__dd--save-as .input').val('').first().focus();
			});
		}
	});

	// save as && title
	$('.form-name-proggram').each(function(){
		var f = $(this);
		var i = f.find('.input').first();
		var e = f.find('.input[type="email"]');
		var t = f.find('textarea');
		var b = f.find('.btn');
		b.on('click',function(){
			if(i.val()=="")
				i.focus();
			else{
				$('title').text(i.val());
				$('.name-programme').text(i.val());
				saveDesc(i.val(),e.val(),t.val());
				popupShow('save');
			}
		});
	});

	// add tab
	$('.app-add-tab').hover(function(){
		var placeholder = $('<li class="placeholder">');
		placeholder.html('<span class="tabs__dt">+</span>');
		$('.tabs__slider ul').append(placeholder);
	},function(){
		$('.tabs__slider .placeholder').remove();
	});
	$('.app-add-tab').on('click',function(){
		var dt = $('.tabs__slider .placeholder').removeClass('placeholder').children();
		if(dt.length==0) return;
		var dd = $('.tabs__dd--start').clone(true);
		var dataTab = $('.tabs__dt').size() + 1;
		dd.removeClass('tabs__dd--start').addClass('tabs__dd--' + dataTab);
		$('.tabs__dd--start').after(dd);
		dt.attr('data-tab',dataTab);
		setTimeout(function(){
			dt.trigger('click');
			dd.find('.input').focus();
		});
		dd.find('.input').on('keyup',function(){
			dt.text($(this).val());
		});
	});
	// форма вкладки
	$('.add-tab-form__btn').on('click',function(){
		var f = $(this).closest('.add-tab-form');
		var i = f.find('.add-tab-form__name');
		if(i.val()=="")
			i.focus();
		else {
			f.parent().addClass('exercises-my');
			f.remove();
			if(listMy.hasClass('ui-sortable'))
				listMy.sortable('destroy');
			list.children().draggable('destroy').droppable('destroy');
			draggable_droppable_sortable();
			$window.trigger('resize');
			$('.tabs__slider').sliderTab();
		}
	});

	// delete tab
	$('.app-delete-tab').hover(function(){
		var del = $('.tabs__dt--active');
		if(del.hasClass('tabs__dt--not-delete')) return;
		del.addClass('tabs__dt--delete');
		$('.tabs__dd--active').addClass('tabs__dd--delete');
	},function(){
		$('.tabs__dt--delete').removeClass('tabs__dt--delete');
		$('.tabs__dd--delete').removeClass('tabs__dd--delete');
	});
	$('.app-delete-tab').on('click',function(){
		var del = $('.tabs__dt--active');
		if(del.hasClass('tabs__dt--not-delete')) return;
		var li = del.parent().siblings();
		del.add('.tabs__dd--active').fadeOut(1000,function(){
			del.parent().add('.tabs__dd--active').remove();
			setTimeout(function(){
				li.last().children().trigger('click');
			});
		});
	});

	// tab right
	$('.tab-exercises-list').on('click',function(){
		if($(this).hasClass('icon-th-large')){
			listOne.addClass('hide');
			listSet.removeClass('hide');
		}
		else {
			listOne.removeClass('hide');
			listSet.addClass('hide');
		}
		setTimeout(function(){
			$window.trigger('resize');
		});
	});

/* Иконки в упражнении ---------- */

	// вверх\вниз
	$('.app-left').on('click','.ico-move-item',function(){
		var t = $(this);
		var li = t.closest('.exercises-my__item');
		var up = t.hasClass('icon-up-bold');
		var n = up ? li.prev() : li.next();
		if(n.length==0) return;
		var top = li.position().top - n.position().top;
		var h = li.height() - n.height();
		var h_up = 0;
		var h_down = 0;
		up ? h_up = h : h_down = h;
		li.add(n).css('top',0).addClass('transition');
		setTimeout(function(){
			li.css('top', -top - h_down);
			n.css('top', top + h_up);
			li.afterTransition(function(){
				li.add(n).removeClass('transition').css('top',0);
				up ? li.after(n) : li.before(n);
			});
		});
	});

	// удалить
	$('.app-left').on('click','.ico-delete-item',function(){
		var li = $(this).closest('.exercises-my__item');
		li.fadeOut(1000,function(){
			li.remove();
		});
	});

	// popup__btn
	$('.app-left, .app-right').on('click','.popup__btn',function(){
		var box = $(this).closest('.popup-box').addClass('popup-box--active');
		var p = $(this).attr('data-popup');
		$('.popup-box').not(box).removeClass('popup-box--active');
		// related & progress
		if(p == 'related' || p == 'progress'){
			var item = box.attr('data-'+p).split(',');
			var id = box.attr('id');
			box = $('<ul class="related_progress">');
			for(var i=0; i<item.length; i++){
				var selector = '#one-'+item[i];
				var li = $(selector).clone();
				li.removeAttr('id').attr('data-id',selector);
				if(id==selector)
					li.addClass('related_progress__current');
				li.on('click',function(event){
					var id = $(this).attr('data-id');
					var selector = $(event.target).attr('class').split(' ');
					$(id).find('.'+selector[0]).trigger('click');
				});
				box.append(li);
			}
			p = 'related_progress';
		}
		popupShow('content',box,p);
	});

	// добавить
	$('.exercises-list__add-to-left').on('click',function(event,detal){
		if($(this).hasClass('exercises-list__add-to-left--set')){
			alert('set')
		}
		else {
			var li = $(this).closest('li').clone();
			if(detal!=undefined)
				li.find('.exercises-list__item-detal').html(detal);
			addMyItem(li);
			$('.tabs__dd--active .exercises-my').append(li);
		}
	});

	// Добавить из popup (плюс)
	$('.popup__add-to-left').on('click',function(){
		if($(this).hasClass('popup__add-to-left--set')){
			alert('set')
		}
		else {
			var detal = $(this).closest('.exercises-list__item-detal-btn').siblings('.exercises-list__item-detal');
			detal.find('.input').each(function(){
				$(this).is('textarea') ?
					$(this).text($(this).val()):
					$(this).attr('value',$(this).val());
			});
			$('.popup-box--active .exercises-list__add-to-left').trigger('click',detal.html());
		}
		$('.popup').trigger('click');
	});

	// избранное
	$('.icon-toggle-favorite').on('click',function(){
		$(this).toggleClass('active');
		console.log('избранные упражнения отображаются первыми')
	});

/* Список справа ---------- */
	listOne.append($('.exercises-list-btn-block--one').clone(true));
	listSet.append($('.exercises-list-btn-block--set').clone(true));

// фильтр
	$('.filter-show').on('click',function(){
		popupShow('filter');
	});
	$('.app-filter-search').on('click',function(){
		listOne.removeClass('hide');
		listSet.addClass('hide');
		$('.popup--filter input').filter(':checked').each(function(){
			var tag = $(this).val();
			listOne.not('.hide').each(function(){
				var tags = $(this).attr('data-filter');
				if(tags.indexOf(tag)==-1)
					$(this).addClass('hide');
			});
		});
		$('.popup--filter').trigger('click');
	});

	// быстрый результат
	$('.popup--filter input').on('change',function(){
		listOne.removeClass('fast-filter');
		$('.popup--filter input').filter(':checked').each(function(){
			var tag = $(this).val();
			listOne.not('.fast-filter').each(function(){
				var tags = $(this).attr('data-filter');
				if(tags.indexOf(tag)==-1)
					$(this).addClass('fast-filter');
			});
		});
		$('.fast-result-search b').text(listOne.size()-listOne.filter('.fast-filter').size());
	});

	// reset
	$('.popup--filter form').on('reset',function(){
		setTimeout(function(){
			$('.popup--filter input').first().trigger('change');
		})
	});

// поиск услуги
	var inputExercises = $('#autocomplete-exercises');
	var inputExercisesClear = $('.search-exercises__clear-input');
	var selectExercises = $('.search-exercises__select select');
	var searchExercises = [];
	listOne.find('.exercises-list__name').each(function () {
		searchExercises.push($(this).text());
	});

	inputExercises.autocomplete({
		source: searchExercises,
		select: function(event, ui){
			var v = ui.item.value;

			listOne.addClass('hide').children('.exercises-list__name').each(function(){
				if (v == $(this).text())
					$(this).closest('li').removeClass('hide');
			});
		}
	});

	inputExercisesClear.on('click',function(){
		inputExercises.val('');
		inputExercisesClear.removeClass('show');
		listOne.removeClass('hide');
	});

	inputExercises.on('change keyup',function(event){
		$(this).val().length > 0 ? inputExercisesClear.addClass('show') : inputExercisesClear.removeClass('show');
	});

// захват и перетаскиваний
	function draggable_droppable_sortable(){

		listMy = $('.exercises-my');

		list.children().draggable({
			helper: 'clone',
			opacity: 0.9,
			zIndex: 2,
			connectToSortable: listMy,
		})
		.droppable({
			accept: listMy
		});

		listMy.sortable({
			cancel: '.not-drop',
			placeholder: 'exercises-my__plus',
 			activate: function(event, ui) {
				if(!ui.helper.hasClass('ui-draggable-dragging'))
					ui.placeholder.height(ui.item.height());
			},
			receive: function(event, ui) {
				addMyItem(ui.helper);
			}
		});
	}
	draggable_droppable_sortable();

	function addMyItem(li){
		li.find('.exercises-my__save').on('click',function(){
			var detal = $(this).closest('.exercises-list__item-detal-btn').siblings('.exercises-list__item-detal');
			detal.find('.input').each(function(){
				$(this).is('textarea') ?
					$(this).text($(this).val()):
					$(this).attr('value',$(this).val());
			});
			$('.popup-box--active .exercises-list__item-detal').html(detal.html());
			if($(this).hasClass('exercises-my__prev')){
				var box = $('.popup-box--active').removeClass('popup-box--active').prev();
			}
			if($(this).hasClass('exercises-my__next')){
				var box = $('.popup-box--active').removeClass('popup-box--active').next();
			}
			if(box!=undefined && box.length>0){
				box.addClass('popup-box--active');
				popupShow('content',box,'add');
			}
			else
				$('.popup').trigger('click');
		});
		li.find('.popup__add-to-left').addClass('hide').siblings('.hide').removeClass('hide');
		li.removeAttr('style id').attr('class','exercises-my__item popup-box clr');
	}


// листание помещений
	$.fn.sliderTab = function(){

		var s = $(this);
		var b = s.children('.box');
		var ul = b.children();
		var li = ul.children();

		var xStart,
			abscissa = 0;
		var b_w = b.width();
		var ul_w = ul.width();
		var nextprev = $('.tabs__slider-nav-left, .tabs__slider-nav-right');

		ul_w > b_w ? nextprev.show() : nextprev.hide();

		nextprev.off().on('click',function(){
			var t = $(this);
			var a = li.filter('.active');
			if(a.length==0) a = li.first();
			var n = t.hasClass('tabs__slider-nav-right') ? a.next() : a.prev();
			if(n.length == 0 || t.hasClass('tabs__slider-nav-left--stop')) {
				t.addClass('tabs__slider-nav-left--stop');
				return;
			}
			else
				t.siblings().removeClass('tabs__slider-nav-left--stop');

			var l = n.position().left;
			b_w = b.width();
			ul_w = ul.width();
			if (l + b_w > ul_w) {
				t.addClass('tabs__slider-nav-left--stop');
			}
			n.addClass('active');
			a.removeClass('active');
			abscissa = -l;
			transformTranslate();
		});

		b.off().on('touchstart touchmove touchend',function(event){
			if (event.type == 'touchstart') {
				var touch = event.originalEvent.touches[0];
				xStart = abscissa - parseInt(touch.clientX);
				b.addClass('touch');
			}
			if (event.type == 'touchmove') {
				var touch = event.originalEvent.touches[0];
				abscissa = xStart + parseInt(touch.clientX);
				transformTranslate();
			}
			if (event.type == 'touchend') {
				b.removeClass('touch');
				if(abscissa>0)
					abscissa = 0;
				if (-abscissa + b_w > ul_w)
					abscissa = b_w - ul_w;
				transformTranslate();
			}
		});

		function transformTranslate() {
			ul.css({
				'-o-transform':'translate('+ abscissa +'px, 0px)',
				'-webkit-transform':'translate('+ abscissa +'px, 0)',
				'-webkit-transform':'translate3d('+ abscissa +'px, 0, 0)',
				'transform':'translate('+ abscissa +'px, 0)',
				'transform':'translate3d('+ abscissa +'px, 0, 0)'
			});
		}

	};

	$('.tabs__slider').sliderTab();

// create App
	// название программы
	$('.popup--create__btn').on('click',function(){
		var f = $(this).closest('form');
		if(f.hasClass('not-valid-form')) return;
		var i = $('.popup--create__name');
		var e = $('.popup--create__email');
		var t = $('.popup--create__textarea');
		var v = i.val();
		if(v=="")
			i.focus();
		else{
			$('.tabs__slider .tabs__dt').each(function(){
				$(this).add($('.tabs__dd--'+$(this).attr('data-tab'))).remove();
			});
			$('.popup--create').removeClass('popup--lock').trigger('click');

			$('.tabs__slider ul').append('<li class="placeholder"><span class="tabs__dt"></span></li>');
			$('.app-add-tab').trigger('click');

			saveDesc(v,e.val(),t.val());
			i.add(e).add(t).val('');
		}
	});
	$('.popup--create__name').on('keyup',function(){
		$('title').text($(this).val());
	});

	// save proggramm
	function saveDesc(n,e,t){
		$('.name-programme').text(n);
		$('.name-programme--text').text(e);
		$('.name-programme--input').val(n);
		$('.name-programme--email').val(e);
		$('.name-programme--textarea').val(t);
		e ?
			$('.name-programme--email-true').removeClass('hide').siblings('.name-programme--email-false').addClass('hide'):
			$('.name-programme--email-true').addClass('hide').siblings('.name-programme--email-false').removeClass('hide');
	}

	// send email
	$('.send-email-form__btn').on('click',function(){
		var f = $(this).closest('.send-email-form');
		if(f.hasClass('not-valid-form')) return;
		var s = f.find('.send-email-form__subject').val();
		var e = f.find('.send-email-form__email').val();
		var e2 = f.find('.name-programme--email-true, .name-programme--email-false').not('.hide').find('.send-email-form__email-2').val();
		if (e.length==0 && e2.length>0) {
			alert('отправить '+s+' на '+e2);
		}
		else if (e.length==0 && e2.length==0){
			f.find('.name-programme--email-true, .name-programme--email-false').not('.hide').find('.send-email-form__email-2').focus();
		}
		else if (e2.length==0) {
			alert('отправить '+s+' на '+e);
		}
		else {
			alert('отправить '+s+' на '+e+', '+e2);
		}
	});

})(jQuery);