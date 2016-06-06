/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

(function($){

	var navTab = $('.tabs__nav'),
		widthTab,
		pageResizeApp,
		resizeTimeoutIdApp;


	var list = $('.exercises-list');
	var listOne = list.children().not('.exercises-list__item--set');
	var listSet = list.children('.exercises-list__item--set');
	var listMy = $('.exercises-my');

	$window.on({
		resize: function(){
			clearTimeout(resizeTimeoutId);
			clearTimeout(resizeTimeoutIdApp);
			resizeTimeoutIdApp = setTimeout(function(){
				pageResize();
				pageResizeApp();
			},1);
		}
	});

	pageResizeApp = function(){
//		var f = body.hasClass('fullscreen') ? 0 : $('footer').height();
		if(list.length>0){
			var h = windowHeight - list.offset().top// - f;
//			list.height(h);
		}
		var h = windowHeight - $('.tabs__dd--active .l-h').offset().top// - f;
		$('.l-h__inner').not('.l-h--height-auto').height(h-62); // p-b:20 .programme-body + .l-h p-b:20px + p-t:20px + b-t:1px + b-b:1px
		h < 300 ? body.addClass('min-height') : body.removeClass('min-height');

		$('.tabs__dd--active .l-h__inner').jScrollPane({
			verticalGutter : 0
		});

// right
		h = windowHeight - $('.exercises-body .l-h').offset().top;
		$('.exercises-body .l-h').height(h-62); // p-b:20 .programme-body + .l-h p-b:20px + p-t:20px + b-t:1px + b-b:1px
		$('.exercises-body .l-h__inner').jScrollPane({
			verticalGutter : 0
		});
	}

	widthTab = function(){
		var li = navTab.find('li');
		var last = li.last();
		var width = last.position().left + last.outerWidth();
		if(navTab.width()-10 < width) {
			navTab.addClass('tabs__nav--mini');
		}else {
			navTab.removeClass('tabs__nav--mini');
		}
		console.log(width)
	}

	$('#main').addClass('show');

// tabs
	(function(tabs){

		tabs.on('click','.tabs__dt',function(){
			var t = $(this);
			var tab_id = t.data('tab');
			t.addClass('tabs__dt--active');
			tabs.find('.tabs__dt').not(t).removeClass('tabs__dt--active');
			tabs.find('.tabs__dd').removeClass('tabs__dd--active').filter('.tabs__dd--'+t.attr('data-tab')).addClass('tabs__dd--active');

				pageResize();
				pageResizeApp();

				widthTab();



// разобрать //
			if(tab_id != undefined && $('form.save-form input[name="params[tab]"]').length > 0) {
				$('form.save-form input[name="params[tab]"]').val(tab_id);
			}
		});

	}($('.tabs')));

/* load img ---------- */
/*
	list.on('scroll',function(){
		clearTimeout(scrollTimeoutId);
		scrollTimeoutId = setTimeout(function(){
			var scrollList = list.scrollTop();
			var listVisible = listOne.hasClass('hide') ? listSet : listOne;
			listVisible.not('.load-img').each(function(){
				var t = $(this);
				if(t.position().top > windowHeight + 300)
					return false;
				var img = $('<img>');
				img.addClass('load-img').on('load',function()}{
					t.html(img);
				});
				img.attr('src',$(this).attr('data-img-1'));
			});
		}, 100);
	}).trigger('scroll');
*/

	// высота комментариев
	$('.programme-table__td--coment-box').hover(function(){
		if($(this).children().outerHeight() > $(this).parent().height())
			$(this).addClass('programme-table__td--coment-show');
	},function(){
		$(this).removeClass('programme-table__td--coment-show');
	});

// скрыть показать блок для печати
	$('.programme-body--print__group-toggle').on('click',function () {
		$(this).parent().toggleClass('programme-body--print__group-hidden');
	});

/* Иконки в шапке ---------- */

	// fullscreen
	$('.app-fullscreen').on('click',function(){
		body.toggleClass('fullscreen');
		setTimeout(function(){
			$window.trigger('resize');
		},1);
	});

	// save
	$('.btn-save:not(.data-tab-link), .btn-save-popup').on('click', function(e){
		e.preventDefault();
		var action = $(this).data('action');
		$('.btn-save').data('change', 0);
		if(action != undefined) {
			$('form.save-form input[name="redirect"]').val(action);
		} else {
			$('form.save-form input[name="redirect"]').val('');
		}
		var tab_id = navTab.find('.tabs__dt--active').data('tab');
		if(tab_id != undefined && $('form.save-form input[name="params[tab]"]').length > 0) {
			$('form.save-form input[name="params[tab]"]').val(tab_id);
		}

		$('form.save-form').submit();
	});

	$('.app-save-and-send').on('click', function(e){
		e.preventDefault();
		var action = $(this).data('action');
		$('.btn-save').data('change', 0);
		if(action != undefined) {
			$('form.save-form input[name="redirect"]').val(action);
		} else {
			$('form.save-form input[name="redirect"]').val('');
		}
		var tab_id = navTab.find('.tabs__dt--active').data('tab');
		if(tab_id != undefined && $('form.save-form input[name="params[tab]"]').length > 0) {
			$('form.save-form input[name="params[tab]"]').val(tab_id);
		}
		changesProgramSave();

		$('form.save-form').append('<input type="hidden" name="send" value="1" />');
		$('form.save-form').submit();
	});

	$('.btn-save-action').on('click', function(e){
		var action = $(this).data('action');
		e.preventDefault();
		if(action != undefined) {
			var tab_id = navTab.find('.tabs__dt--active').data('tab');
			if(tab_id != undefined && $('form.save-form input[name="params[tab]"]').length > 0) {
				$('form.save-form input[name="params[tab]"]').val(tab_id);
			}
			$('form.save-form input[name="redirect"]').val(action);
			$('form.save-form').submit();
		}
	});

	function changesProgramSave() {
		var name = $('form.form-name-proggram').find('.name-programme--input').val();
		if(name != undefined && name.length != 0) {
			$('form.save-form').find('input[type=hidden].name-programme--input').val(name);
			$('.name-programme').text(name);
		}

		var mail = $('form.form-name-proggram').find('.name-programme--email').val();
		if(mail != undefined && mail.length != 0) {
			$('form.save-form').find('input[type=hidden].name-programme--email').val(mail);
		}

		var desc = $('form.form-name-proggram').find('.name-programme--textarea').val();
		if(desc != undefined && desc.length != 0) {
			$('form.save-form').find('input[type=hidden].name-programme--textarea').val(desc);
		}

		var category = $('form.form-name-proggram').find('select').val();
		if(category != undefined && category.length != 0) {
			$('form.save-form').find('input[type=hidden].name-programme--category').val(category);
		}
	}

	$('.btn-to-list, .icon-link, .icon-docs, .icon-print, .icon-mail, .btn-new, .icon-mail, .open-program-link').on('click', function(e){
		var saved = parseInt($('.btn-save').data('change'));
		var action = $(this).data('action');
		var changed_desc = parseInt($('.btn-save').data('change-desc'));
		var url = $(this).attr('href');
		var target = $(this).attr('target');
		if(saved !=  undefined && saved == 1) {
			e.preventDefault();
			if(changed_desc !=  undefined && changed_desc == 1) {
				changesProgramSave();
			}
			if(url == undefined) {
				url = '#';
			}
			if(target != undefined) {
				$('.popup--close a.btn:not(.btn-save-popup)').attr('target', target);
			} else {
				$('.popup--close a.btn:not(.btn-save-popup)').attr('target', '');
			}
			$('.popup--close a.btn:not(.btn-save-popup)').attr('href', url);
			if(action != undefined) {
				$('.popup--close .popup__body a.btn-save-popup').attr('data-action', action);
			}
			popupShow('close');
		}
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
		var c = f.find('select');
		var b = f.find('.btn:not(.app-save-and-send):not(.app-add-note)');
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
				saveDesc(i.val(),e.val(),t.val(),c.val());
				if(action != false) {
					$('form.save-form').get(0).setAttribute('action', action);
				}
				var tab_id = navTab.find('.tabs__dt--active').data('tab');
				if(tab_id != undefined && $('form.save-form input[name="params[tab]"]').length > 0) {
					$('form.save-form input[name="params[tab]"]').val(tab_id);
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
		placeholder.html('<span class="tabs__dt"><i class="ico ico--plusik"></i></span>');
		navTab.find('ul').append(placeholder);
	},function(){
		navTab.find('.placeholder').remove();
	});
	$('.app-add-tab').on('click',function(){
		var program = $('form.save-form').data('program');
		var count = 1;
		if ($(this).attr('data-count') !== undefined) {
            count =  parseInt($(this).attr('data-count'));
            count++;
        }
		var dt = navTab.find('.placeholder').removeClass('placeholder').children();
		if(dt.length==0) return;
		var dd = $('.tabs__dd--start').clone(true);
		var dataTab = parseInt($('.tabs__dt').length + count);
		dd.removeClass('tabs__dd--start').addClass('tabs__dd--' + dataTab);
		$('.tabs__dd--start').after(dd);
		dt.attr('data-tab',dataTab);
		$(this).attr('data-tab-id', dataTab);
		$('.btn-save').attr('data-change', 1);
		dd.find('.l-h')
			.attr('data-type', 'exercises['+dataTab+'][data]')
			.append('<input id="tabs-exercises-'+dataTab+'" type="hidden" name="exercises['+dataTab+'][name]" value="">');
		setTimeout(function(){
			dt.trigger('click');
			dd.find('.input').focus();
		});
		dd.find('.input').on('keyup',function(){
			var name = $(this).val();
			dt.text(name);
			$('#tabs-exercises-'+dataTab).val(name);
			widthTab();
		});
		dd.find('.add-tab-form__btn').on('click',function(){
			var name = dt.text();
			dd.find('.l-h').append('<input type="hidden" name="params[access][]" class="access-tab-' + parseInt(dataTab - 8) + '" value="1">');
			$('form.form-name-proggram ul.access-tabs').append('<li class="clr access--' + parseInt(dataTab - 8) + '"><label class="checkbox"><input type="checkbox" class="hide access" value="' + parseInt(dataTab - 8) + '" checked> ' + name + '<i></i></label></li>');
		});
		widthTab();
	});
	$('.app-add-note').on('click', function(e) {
		e.preventDefault();
		var exist = $('.save-form .tabs__dd.note').length;
		if(exist > 0) {
			navTab.find('.tabs__dt--active').removeClass('tabs__dt--active');
			$('.tabs__dd--active').removeClass('tabs__dd--active');
			$('.tabs__dd.note').addClass('tabs__dd--active');
		} else {
			count = 0;
			body.children('.title_up').html('Заметка').css({
					'top':  $('a.icon-plus-outline.app-add-note').offset().top,
					'left': $('a.icon-plus-outline.app-add-note').offset().left + $('a.icon-plus-outline.app-add-note').outerWidth() / 2 - body.children('.title_up').outerWidth() / 2
				});
			loadCSS('/assets/css/editor/editor.css');
			$.getScripts(['/assets/js/editor/langs/ru.js','/assets/js/editor/trumbowyg.js']).done(function() {
				$('.editor').trumbowyg({
	                fullscreenable: false,
	                lang: 'ru',
	                btns: [
	                    'btnGrp-design',
	                    '|', 'btnGrp-justify',
	                    '|', 'btnGrp-lists'
	                ],
	                removeformatPasted: true,
	                semantic: true
	            }).on('tbwchange', function(){
	                $('.btn-save').attr('data-change', 1);
	            });
			});
			$('.app-add-tab').attr('data-count', count);
			navTab.find('.tabs__dt--active').removeClass('tabs__dt--active');
			$('.tabs .tabs__dd--active').removeClass('tabs__dd--active');
			$('form.save-form').prepend('<div class="tabs__dd tabs__dd--' + count + ' tabs__dd--active note"><div class="l-h"><h2>Заметка</h2><textarea class="editor" name="note"></textarea></div></div>');
			$('.btn-save').attr('data-change', 1);
			$('form.form-name-proggram .app-add-note').text('Изменить заметку');
		}
	});
	loadCSS = function(href) {
	    var cssLink = $("<link rel='stylesheet' type='text/css' href='"+href+"'>");
	    $("head").append(cssLink);
	};
	$.getScripts = function(arr) {
	    var _arr = $.map(arr, function(scr) {
	        return $.getScript( scr );
	    });

	    _arr.push($.Deferred(function( deferred ){
	        $( deferred.resolve );
	    }));

	    return $.when.apply($, _arr);
	}
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
//			$('.tabs__nav').sliderTab();
			$('.btn-save').attr('data-change', 1);
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
/*		if(!del.hasClass('note')) {
			var rem_idx = $('.tabs__dt--active').data('tab');
			$('form.form-name-proggram ul.access-tabs li.access--'+rem_idx).remove();
		}
*/		if(del.hasClass('tabs__dt--not-delete')) return;
		var li = del.parent().siblings();
		del.add('.tabs__dd--active').fadeOut(1000,function(){
			if($(this).hasClass('tabs__dd--active')){
				del.parent().add('.tabs__dd--active').remove();
				setTimeout(function(){
					if(li.length>0){
						li.last().children().trigger('click');
						li.first().addClass('tabs__li-first');
					}
					else {
						navTab.find('ul').append('<li class="tabs__li-first placeholder"><span class="tabs__dt"><i class="ico ico--plusik"></i></span></li>');
						$('.app-add-tab').trigger('click');
					}
				});
			}
		});
		$('.btn-save').attr('data-change', 1);
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
		list.scrollTop(0);
		setTimeout(function(){
			$window.trigger('resize');
		});
	});

	$(document).on('click', 'form.form-name-proggram input[type="checkbox"].access', function(){
		var idx = $(this).parent().parent().index();
		var tab = $(this).val();
		var value = $(this).is(':checked');
		if(value == true) {
			value = 1;
		} else {
			value = 0;
		}
		if($('form.save-form input[type="hidden"].access-tab-' + idx).length > 0) {
			$('form.save-form input[type="hidden"].access-tab-' + idx).val(value);
		} else {
			$('form.save-form').append('<input type="hidden" name="params[access][]" class="access-tab-' + idx + '" value="' + value + '"/>');
		}
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
		$('.btn-save').attr('data-change', 1);
	});

	// удалить
	$('.app-left').on('click','.ico-delete-item',function(){
		var li = $(this).closest('.exercises-my__item');
		$('.btn-save').attr('data-change', 1);
		li.fadeOut(1000,function(){
			li.remove();
		});
	});


	// popup__btn
	$('.app-left, .app-right').on('click','.popup__btn',function(){
		var box = $(this).closest('.popup-box').addClass('popup-box--active');
		var p = $(this).attr('data-popup');
		var w = false;
		$('.popup-box').not(box).removeClass('popup-box--active');
		// related & progress
		if(p == 'related' || p == 'progress'){
			var item = box.attr('data-'+p).split(',');
			var id = box.attr('data-id');
			box = $('<ul class="related_progress">');
			for(var i=0; i<item.length; i++){
				var selector = '#one-'+item[i];
				var li = $(selector).clone();
				li.removeAttr('id').attr('data-id',selector);
				if('#one-'+id==selector)
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
		if(p == 'add'){
			w = 826;
		}
		popupShow('content',box,p,w);
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
		$('.btn-save').attr('data-change', 1);
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
		$('.btn-save').attr('data-change', 1);
	});

	$('form.form-name-proggram').on('change', function() {
		$('.btn-save').attr('data-change', 1);
		$('.btn-save').attr('data-change-desc', 1);
	});

/* Список справа ---------- */


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
		open: function(event, ui) {
			console.log(event)
			console.log(ui)
		},
		close: function(event, ui) {
			console.log(event)
			console.log(ui)
		},
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
			placeholder: 'exercises-my__plus l-h__width programme-body__box',
 			activate: function(event, ui) {
				if(!ui.helper.hasClass('ui-draggable-dragging')) {
					ui.placeholder.height(ui.item.height());
					$('.btn-save').attr('data-change', 1);
				}
			},
			receive: function(event, ui) {
				addMyItem(ui.helper);
				$('.btn-save').attr('data-change', 1);
			}
		});
	}
	draggable_droppable_sortable();

	function addMyItem(li){
			li.find('.exercises-my__save').on('click',function(){
		alert(859)
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


// create App
	// название программы
	$('.popup--create__btn').on('click',function(){
		var f = $(this).closest('form');
		if(f.hasClass('not-valid-form')) return;
		var i = $('.popup--create__name');
		var e = $('.popup--create__email');
		var c = $('.popup--create__category');
		var t = $('.popup--create__textarea');
		var v = i.val();
		if(v.length == 0 || c.val() == 'none') {
			if(v.length == 0) {
				i.focus();
			}
			else if(c.val() == 'none' && !c.closest('.select').hasClass('focus')) {
				c.focus();
			}
			return false;
		}
		navTab.find('.tabs__dt').each(function(){
			$(this).add($('.tabs__dd--'+$(this).attr('data-tab'))).remove();
		});
		$('.popup--create').removeClass('popup--lock').trigger('click');

		navTab.find('ul').append('<li class="placeholder"><span class="tabs__dt"></span></li>');
		$('.app-add-tab').trigger('click');

		saveDesc(v,e.val(),t.val(),c.val());

		$('form.save-form').append('<input type="hidden" name="name" value="'+v+'">');
		$('form.save-form').append('<input type="hidden" name="mail" value="'+e.val()+'">');
		$('form.save-form').append('<input type="hidden" name="description" value="'+t.val()+'">');
		$('form.save-form').append('<input type="hidden" name="category" value="'+c.val()+'">');
		i.add(e).add(t).val('');
	});
	$('.popup--create__name').on('keyup',function(){
		$('title').text($(this).val());
	});

	// save proggramm
	function saveDesc(n,e,t,c){
		$('.name-programme').text(n);
		$('.name-programme--text').text(e);
		$('.name-programme--input').val(n);
		$('.name-programme--email').val(e);
		$('.name-programme--textarea').val(t);
		$('.name-programme--category').val(c);
		$('.name-programme--category select').val(c);
		$('.name-programme--category select').trigger('change');
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
					$('.popup--msg .popup__inner').html('Программа отправлена');
					$('.popup--msg a.btn-no-popup').removeClass('hide');
					if(!$('.popup--msg a.btn-cancel-popup').hasClass('hide')) {
						$('.popup--msg a.btn-cancel-popup').addClass('hide');
					}
					if(!$('.popup--msg a.btn-yes-popup').hasClass('hide')) {
						$('.popup--msg a.btn-yes-popup').addClass('hide');
					}
					popupShow('msg');
				}
			}, this)
		});
	});

	$('.exercises-my__save').on('click',function(){
		var activeItem = $('.popup-box--active');
		var inputArr = $(this).closest('.programme-table').find('.input');
		activeItem.find('.input').each(function(i){
			$(this).val(inputArr.eq(i).val());
			if($(this).is('textarea'))
				$(this).text(inputArr.eq(i).val());
		});
		if($(this).hasClass('exercises-my__save--prev')){
			var box = activeItem.removeClass('popup-box--active').prev();
		}
		if($(this).hasClass('exercises-my__save--next')){
			var box = activeItem.removeClass('popup-box--active').next();
		}
		$('.popup').trigger('click');
		if(box!=undefined && box.length>0){
			box.addClass('popup-box--active');
			popupShow('content',box,'add',826);
		}
	});

})(jQuery);