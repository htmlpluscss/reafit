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
				if(list.length>0){
					var h = windowHeight - list.offset().top - f;
					list.height(h);
				}
				h = windowHeight - $('.tabs__dd--active .l-h').offset().top - f;
				$('.l-h').not('.l-h--height-auto').height(h-16);
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

	// save
	$('.btn-save:not(.data-tab-link), .btn-save-popup').on('click', function(e){
		e.preventDefault();
		$('.btn-save').data('change', 0);
		$('form.save-form').submit();
	});

	$('.btn-save-action').on('click', function(e){
		var action = $(this).data('action');
		e.preventDefault();
		if(action != undefined) {
			$('form.save-form input[name="redirect"]').val(action);
			$('form.save-form').submit();
		}
	});

	$('.btn-to-list, .icon-link, .icon-docs, .icon-print, .icon-mail, .btn-new, .icon-mail, .open-program-link').on('click', function(e){
		var saved = parseInt($('.btn-save').data('change'));
		var url = $(this).attr('href');
		var target = $(this).attr('target');
		if(saved !=  undefined && saved == 1) {
			e.preventDefault();
			if(url == undefined) {
				url = '#';
			}
			if(target != undefined) {
				$('.popup--close a.btn:not(.btn-save-popup)').attr('target', target);
			} else {
				$('.popup--close a.btn:not(.btn-save-popup)').attr('target', '');
			}
			$('.popup--close a.btn:not(.btn-save-popup)').attr('href', url);
			popupShow('close');
		}
	});

	// создать
	$('.btn-new').on('click',function(){
		//popupShow('close');
	});

	// сохранить при выходе?
	$('.popup--close .btn:not(.btn-save-popup)').on('click', function(e){
		var url = $(this).attr('href');
		if(url == '#') {
			e.preventDefault();
			$('.popup--close').removeClass('show');
		} else {
			popupShow('create');
		}
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
		var submit = f.data('submit');
		var action = f.data('action');
		if(submit == undefined) {
			submit = false;
		} else {
			submit = parseInt(submit);
			if(submit == 1) {
				submit = true;
			} else {
				submit = false;
			}
		}
		if(action == undefined) {
			action = false;
		}
		b.on('click',function(){
			if(i.val()=="")
				i.focus();
			else{
				$('title').text(i.val());
				$('.name-programme').text(i.val());
				saveDesc(i.val(),e.val(),t.val());
				if(action != false) {
					$('form.save-form').get(0).setAttribute('action', action);
				}
				if(submit) {
					$('form.save-form').submit();
				}
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
		var program = $('form.save-form').data('program');
		var count = 1;
		if ($(this).attr('data-count') !== undefined) {
            count =  parseInt($(this).attr('data-count'));
            count++;
        }
		var dt = $('.tabs__slider .placeholder').removeClass('placeholder').children();
		if(dt.length==0) return;
		var dd = $('.tabs__dd--start').clone(true);
		var dataTab = parseInt($('.tabs__dt').length + count);
		dd.removeClass('tabs__dd--start').addClass('tabs__dd--' + dataTab);
		$('.tabs__dd--start').after(dd);
		dt.attr('data-tab',dataTab);
		$(this).attr('data-tab-id', dataTab);
		$('body .btn-save').attr('data-change', 1);
		dd.find('.l-h')
			.attr('data-type', 'exercises['+dataTab+'][data]')
			.append('<input id="tabs-exercises-'+dataTab+'" type="hidden" name="exercises['+dataTab+'][name]" value="" />');
		//dd.find('.popup-content--add .exercises-list__item-desc').removeClass('in-exercises-list');
		setTimeout(function(){
			dt.trigger('click');
			dd.find('.input').focus();
		});
		dd.find('.input').on('keyup',function(){
			var name = $(this).val();
			dt.text(name);
			$('#tabs-exercises-'+dataTab).val(name);
		});
	});
	// форма вкладки
	$('.add-tab-form').on('submit',function(){
		$(this).find('.add-tab-form__btn').trigger('click');
		return false;
	});
	$('.add-tab-form__btn').on('click',function(){
		var f = $(this).closest('.add-tab-form');
		var i = f.find('.add-tab-form__name');
		if(i.val()=="")
			i.focus();
		else {
			f.parent().parent().appendTo('form.save-form');
			f.parent().addClass('exercises-my');
			f.remove();

			if(listMy.hasClass('ui-sortable'))
				listMy.sortable('destroy');
			list.children().draggable('destroy').droppable('destroy');
			draggable_droppable_sortable();
			$window.trigger('resize');
			$('.tabs__slider').sliderTab();
			$('body .btn-save').attr('data-change', 1);
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
		var count = 1;
		if ($('.app-add-tab').attr('data-count') !== undefined) {
            count = parseInt($('.app-add-tab').attr('data-count'));
            count++;
        }
		$('.app-add-tab').attr('data-count', count);
		var del = $('.tabs__dt--active');
		if(del.hasClass('tabs__dt--not-delete')) return;
		var li = del.parent().siblings();
		del.add('.tabs__dd--active').fadeOut(1000,function(){
			del.parent().add('.tabs__dd--active').remove();
			setTimeout(function(){
				li.last().children().trigger('click');
			});
		});
		$('body .btn-save').attr('data-change', 1);
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
		$('body .btn-save').attr('data-change', 1);
	});

	// удалить
	$('.app-left').on('click','.ico-delete-item',function(){
		var li = $(this).closest('.exercises-my__item');
		$('body .btn-save').attr('data-change', 1);
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
			var li = $(this).closest('li');
			var items = li.data('exercises').split(',');
			$.each(items , function(i, val) {
				var li = $(items[i]).clone();
				if(detal!=undefined)
					li.find('.exercises-list__item-detal').html(detal);
				addMyItem(li);

				var name = $('.tabs__dd--active .exercises-my').data('type');
				if(name == undefined) {
					name = $('.tabs__dt--active').attr('data-type');
				}

				var _li = $(li);
				var data = _li.find('input[type="hidden"]');
				if(data.length == 0) {
					_li.append('<input type="hidden" name="'+name+'[]" value="'+_li.data('id')+'" />');
				}

				var type = $('.tabs__dd--active .exercises-my').attr('data-type');
				if(type != 'related' && type != 'progress') {
					var detail = _li.find('.popup-content--add');
					if(detail.length != 0) {
						detail.find('.exercises-list__item-desc').removeClass('in-exercises-list');
						_li.find('a.icon-info').addClass('icon-pencil').removeClass('icon-info');
						var exercise_data = detail.find('.exercises-list__item-detal input, .exercises-list__item-detal textarea');
						$.each(exercise_data , function(i, val) {
							var new_name_suffix = $(this).attr('data-name');
							$(this).attr('name', name+'['+new_name_suffix+'][]');
						});
					}
				}

				$('.tabs__dd--active .exercises-my').append(li);
			});
		} else {
			var li = $(this).closest('li').clone();
			if(detal!=undefined)
				li.find('.exercises-list__item-detal').html(detal);
			addMyItem(li);

			var name = $('.tabs__dd--active .exercises-my').data('type');
			if(name == undefined) {
				name = $('.tabs__dt--active').attr('data-type');
			}

			var _li = $(li);
			var data = _li.find('input[type="hidden"]');
			data.remove();

			_li.append('<input type="hidden" name="'+name+'[]" value="'+_li.data('id')+'" />');

			var type = $('.tabs__dd--active .exercises-my').attr('data-type');
			if(type != 'related' && type != 'progress') {
				var detail = _li.find('.popup-content--add');
				if(detail.length != 0) {
					detail.find('.exercises-list__item-desc').removeClass('in-exercises-list');
					_li.find('a.icon-info').addClass('icon-pencil').removeClass('icon-info');
					var exercise_data = detail.find('.exercises-list__item-detal input, .exercises-list__item-detal textarea');
					$.each(exercise_data , function(i, val) {
						var new_name_suffix = $(this).attr('data-name');
						$(this).attr('name', name+'['+new_name_suffix+'][]');
					});
				}
			}

			$('.tabs__dd--active .exercises-my').append(li);
		}
		$('body .btn-save').attr('data-change', 1);
	});

	// Добавить из popup (плюс)
	$('.popup__add-to-left').on('click',function(){
		if($(this).hasClass('popup__add-to-left--set')){
			var id = $(this).data('id');
			var li = $(id);
			console.log(id);
			console.log(li.data('exercises'));
			console.log(li.attr('data-exercises'));
			var items = li.data('exercises').split(',');
			$.each(items , function(i, val) {
				var li = $(items[i]).clone();
				if(detal!=undefined)
					li.find('.exercises-list__item-detal').html(detal);
				addMyItem(li);

				var name = $('.tabs__dd--active .exercises-my').data('type');
				if(name == undefined) {
					name = $('.tabs__dt--active').attr('data-type');
				}

				var _li = $(li);
				var data = _li.find('input[type="hidden"]');
				if(data.length == 0) {
					_li.append('<input type="hidden" name="'+name+'[]" value="'+_li.data('id')+'" />');
				}

				var type = $('.tabs__dd--active .exercises-my').attr('data-type');
				if(type != 'related' && type != 'progress') {
					var detail = _li.find('.popup-content--add');
					if(detail.length != 0) {
						detail.find('.exercises-list__item-desc').removeClass('in-exercises-list');
						_li.find('a.icon-info').addClass('icon-pencil').removeClass('icon-info');
						var exercise_data = detail.find('.exercises-list__item-detal input, .exercises-list__item-detal textarea');
						$.each(exercise_data , function(i, val) {
							var new_name_suffix = $(this).attr('data-name');
							$(this).attr('name', name+'['+new_name_suffix+'][]');
						});
					}
				}

				$('.tabs__dd--active .exercises-my').append(li);
			});
		} else {
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
	$('.icon-toggle-favorite').click(function(e){
		e.preventDefault();
		var url = $(this).data('url');
		var active = $(this).hasClass('active');
		var type = 0;
		if(!active) {
			type = 1;
		}
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
					$(this).toggleClass('active');
				}
			}, this)
		});
	});



	// изменение формы
	$('form.spy').on('change', function() {
		$('body .btn-save').attr('data-change', 1);
	});

/* Список справа ---------- */
	//listOne.append($('.exercises-list-btn-block--one').clone(true));
	//listSet.append($('.exercises-list-btn-block--set').clone(true));

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
			helper: function() {
				var exercises = $(this).data('exercises');
				if(exercises != undefined) {
					var items = exercises.split(',');
					var html = '';
					$.each(items , function(i, val) {
						var item = $(items[i])[0].outerHTML;
						html = html + item;
					});
					console.log(html);
					return html;
				} else {
					return $(this).clone(true);
				}
    		},
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
				if(!ui.helper.hasClass('ui-draggable-dragging')) {
					ui.placeholder.height(ui.item.height());
					$('body .btn-save').attr('data-change', 1);
				}
			},
			receive: function(event, ui) {
				addMyItem(ui.helper);
				$('body .btn-save').attr('data-change', 1);
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

			var name = $('.tabs__dd--active .exercises-my').data('type');
			var data = li.find('input[type="hidden"]');
			data.remove();
			li.append('<input type="hidden" name="'+name+'[]" value="'+li.data('id')+'" />');

			var type = $('.tabs__dd--active .exercises-my').attr('data-type');
			if(type != 'related' && type != 'progress') {
				var detail = li.find('.popup-content--add');
				if(detail.length != 0) {
					detail.find('.exercises-list__item-desc').removeClass('in-exercises-list');
					li.find('a.icon-info').addClass('icon-pencil').removeClass('icon-info');
					var exercise_data = detail.find('.exercises-list__item-detal input, .exercises-list__item-detal textarea');
					$.each(exercise_data , function(i, val) {
						var new_name_suffix = $(this).attr('data-name');
						$(this).attr('name', name+'['+new_name_suffix+'][]');
					});
				}
			}
	}
/* 
	$('.exercises-my__prev').click(function(e) {
		var box = $('.popup-box--active').removeClass('popup-box--active').prev();
		if(box!=undefined && box.length>0){
			box.addClass('popup-box--active');
			popupShow('content',box,'add');
		} else {
			$('.popup').trigger('click');
		}
	});

	$('.exercises-my__next').click(function(e) {
		var box = $('.popup-box--active').removeClass('popup-box--active').next();
		if(box!=undefined && box.length>0){
			box.addClass('popup-box--active');
			popupShow('content',box,'add');
		} else {
			$('.popup').trigger('click');
		}
	});

*/
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

			$('form.save-form').append('<input type="hidden" name="name" value="'+v+'" />');
			$('form.save-form').append('<input type="hidden" name="mail" value="'+e.val()+'" />');
			$('form.save-form').append('<input type="hidden" name="description" value="'+t.val()+'" />');
			//$('form.new-program-form').submit();
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
		var url = f.data('url');
		if(f.hasClass('not-valid-form')) return;
		var data = f.serialize();
		$.ajax({
			type:     'POST',
			dataType: 'json',
			cache:    false,
			url:      url,
			data:     data,
			success: $.proxy(function(data){
				if(data['success'].length != 0) {
					alert('Программа отправлена');
				}
			}, this)
		});
	});

	$('.exercises-my__save').on('click',function(){
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

})(jQuery);