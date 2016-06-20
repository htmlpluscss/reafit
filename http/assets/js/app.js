/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

(function($){

	var navTab = $('.tabs__nav'),
		navTabActive,
		navTabXscroll,
		widthTab,
		pageResizeApp,
		resizeTimeoutIdApp,
		leftScroller,
		rightScroller = $('.app-right .r-h__inner'),
		formProgramm = $('form.save-form'),
		templates = $('.templates').children();


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
// left
		leftScroller = $('.tabs__dd--active .l-h__inner');
		var h = windowHeight - $('.tabs__dd--active .l-h').offset().top;
		h < 300 ? body.addClass('min-height') : body.removeClass('min-height');

		leftScroller.height(h-62); // p-b:20 .programme-body + .l-h p-b:20px + p-t:20px + b-t:1px + b-b:1px
		leftScroller.baron({
			update: true,
			bar: '.baron__bar'
		}).controls({
			track: '.baron__free'
		});
// right
		if(rightScroller.length>0){
			h = windowHeight - rightScroller.offset().top;
			rightScroller.height(h);
			rightScroller.baron({
				bar: '.baron__bar'
			}).controls({
				track: '.baron__free'
			});
		}
	}

	widthTab = function(){
		var ul = navTab.find('ul');
		var li = ul.children();
		var last = li.last();
		var liActive = navTabActive.parent();
		var liActiveWidth = liActive.outerWidth();
		var UlWidth = last.position().left + last.outerWidth();
		var boxWidth = navTab.find('.box').width();
		if(boxWidth - 4 < UlWidth) {
			navTab.addClass('tabs__nav--mini');
			boxWidth = navTab.find('.box').width();
			var X = liActive.position().left;
			if(liActive.hasClass('tabs__li-first')){
				navTabXscroll = 0;
			}
			else if(navTab.offset().left >= liActive.offset().left){
				navTabXscroll = X - 6; // ml:-6
			}
			else if(navTab.find('.tabs__btn-select').offset().left < liActive.offset().left + liActiveWidth){
				navTabXscroll = X + liActiveWidth - boxWidth;
			}
			else if(UlWidth - boxWidth < navTabXscroll){
				navTabXscroll = X + last.outerWidth() - boxWidth;
			}
			navTab.find('.tabs__select').html(li.children().clone().removeAttr('data-tab').attr('class','tabs__select-span'));
		}else {
			navTab.removeClass('tabs__nav--mini');
			navTabXscroll = 0;
			$('.tabs__select').hide();
		}
		if(navTabXscroll<0)
			navTabXscroll = 0;
		ul.css('left',-navTabXscroll);
	}

	$('#main').addClass('show');

// tabs
	(function(tabs){

		tabs.on('click','.tabs__dt',function(){
			navTabActive = $(this);
			navTabActive.addClass('tabs__dt--active');
			tabs.find('.tabs__dt').not(navTabActive).removeClass('tabs__dt--active');
			tabs.find('.tabs__dd').removeClass('tabs__dd--active').filter('.tabs__dd--'+navTabActive.attr('data-tab')).addClass('tabs__dd--active');
			formProgramm.find('input[name="params[tab]"]').val(navTabActive.data('tab'));
			pageResize();
			pageResizeApp();
			widthTab();
		});
		tabs.on('click','.tabs__select-span',function(){
			$('.tabs__select').hide();
			tabs.find('.tabs__dt').eq($(this).index()).trigger('click');
		});
		tabs.find('.tabs__dt--active').trigger('click');

		tabs.find('.tabs__btn-select').on('click',function(){
			$('.tabs__select').show();
			setTimeout(function(){
				if($('.tabs__select').is(':visible')){
					$(document).one('click', function(){
						$('.tabs__select').hide();
					});
				}
			},1);
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
	$('.btn-save').on('click', function(){
		var action = $(this).data('action');
		$('.btn-save').data('change', 0);
		if(action != undefined) {
			formProgramm.find('input[name="redirect"]').val(action);
		} else {
			formProgramm.find('input[name="redirect"]').val('');
		}
//		console.log(formProgramm.serialize())
		formProgramm.submit();
	});


/*
	$('.btn-save:not(.data-tab-link), .btn-save-popup').on('click', function(e){
		e.preventDefault();
		var action = $(this).data('action');
		$('.btn-save').data('change', 0);
		if(action != undefined) {
			$('form.save-form input[name="redirect"]').val(action);
		} else {
			$('form.save-form input[name="redirect"]').val('');
		}
		$('form.save-form').submit();
	});

*/
// сoхранить и отправить
	$('.app-save-and-send').on('click', function(e){
		e.preventDefault();
		var action = $(this).data('action');
		$('.btn-save').data('change', 0);
		if(action != undefined) {
			formProgramm.find('input[name="redirect"]').val(action);
		} else {
			formProgramm.find('input[name="redirect"]').val('');
		}
//		changesProgramSave();

		formProgramm.append('<input type="hidden" name="send" value="1">');
		formProgramm.submit();
	});

	$('.btn-save-action').on('click', function(e){
		var action = $(this).data('action');
		e.preventDefault();
		if(action != undefined) {
			formProgramm.find('input[name="redirect"]').val(action);
			formProgramm.submit();
		}
	});
/*
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
*/
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
// разобраться
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
					formProgramm.get(0).setAttribute('action', action);
				}
				if(submit) {
					formProgramm.submit();
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
		var program = formProgramm.data('program');
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
		formProgramm.append(dd);
		dt.attr('data-tab',dataTab);
		$(this).attr('data-tab-id', dataTab);
		$('.btn-save').attr('data-change', 1);
		dd.find('.l-h__inner')
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
		dd.find('.add-tab-form__btn').one('click',function(){
			dd.find('.l-h__inner').append('<input type="hidden" name="params[access][]" class="access-tab-' + parseInt(dataTab - 8) + '" value="1">');
			$('.access-tabs').append('<li><label class="checkbox"><input type="checkbox" class="access" value="' + parseInt(dataTab - 8) + '" checked="checked"> ' + dt.text() + '<i></i></label></li>');
		});
		widthTab();
	});
	$('.app-add-note').on('click', function() {

		if($('.editor').is('.trumbowyg-textarea'))
			return;

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

		$('.btn-save').attr('data-change', 1);

		$('.btn.app-add-note').text($('.btn.app-add-note').attr('data-alt-text'));
		var altText = $('.ico--note.app-add-note').attr('data-alt-text')+'<i></i>';
		$(this).hasClass('btn')?
			$('.ico--note.app-add-note').children().html(altText):
			body.children('.title_up').html(altText).css('left',$('.ico--note.app-add-note').offset().left + $('.ico--note.app-add-note').outerWidth() / 2 - body.children('.title_up').outerWidth() / 2);


	});
	loadCSS = function(href) {
	    var cssLink = $("<link rel='stylesheet' href='"+href+"'>");
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
	$('.add-tab-form__btn').on('click',function(){
		var f = $(this).closest('.add-tab-form');
		var i = f.find('.add-tab-form__name');
		if(i.val()=="")
			i.focus();
		else {
			f.remove();

//			if(listMy.hasClass('ui-sortable'))
//				listMy.sortable('destroy');
//			list.children().draggable('destroy').droppable('destroy');
//			draggable_droppable_sortable();
//			$window.trigger('resize');
			$('.btn-save').attr('data-change', 1);
		}
	});
	$('.add-tab-form__name').on('keyup',function(event){
		if(event.keyCode == 13)
			$('.add-tab-form__btn').trigger('click');
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

// Доступно пациенту
	$('.access-tabs__item').on('change', function(){
		var tab = $(this).val();
		var value = $(this).prop('checked') ? 1 : 0;
		formProgramm.find('.access-tab-' + tab).val(value);

// добавить в шаблон новой вкладки
//		formProgramm.append('<input type="hidden" name="params[access][]" class="access-tab-' + idx + '" value="' + value + '">');

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
	$('.app-left, .app-right').on('click','.popup__btn',function(){// не надо будет делигировать, т.к. шаблоны наследуют события
		var box = $(this).closest('.popup-box').addClass('popup-box--active'); // удалить, не важно чье окно, события в окне
		var p = $(this).attr('data-popup');
		var w = false;
		$('.popup-box').not(box).removeClass('popup-box--active'); // но может быть слева важно, для навигации
		// related & progress
		if(p == 'related' || p == 'progress'){
			var item = box.attr('data-'+p).split(',');
			var id = box.attr('data-id');
			box = $('<ul class="related_progress clr">');
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
		if(p == 'add' || p == 'edit'){
			w = 826;

// переделываю на шаблон
			var template = templates.filter('.templates__' + p).children().clone(true);
			if(p=='edit'){
				box = $('#one-'+ box.children('.var__id').val());
				template.find('.var__quantity').val(box.find('.var__quantity').val());
				template.find('.var__approaches').val(box.find('.var__approaches').val());
				template.find('.var__weight').val(box.find('.var__weight').val());
				template.find('.var__comment').text(box.find('.var__comment').val());
			}
			var img = box.attr('data-images').split('|');
			for (var i = 0; i < img.length; i++) {
				template.find('.programme-img').append('<img src="/images/'+img[i]+'">');
			}
			template.attr('data-id',box.attr('data-id'));
			template.find('.var__exercise-name').text(box.attr('data-name'));
			template.find('.var__exercise-name_desc').text(box.attr('data-name_desc'));
			template.find('.var__exercise-description').html(box.find('.var__exercise-description').children().clone());
			popupShow('content',template,'template',w);
			return false;
		}
		popupShow('content',box,p,w);
	});

// события в шаблонах

// add
	// Добавить
	function addItemAppLeft(id,data,index) {
		var item = $('#one-'+id);
		var datatType = leftScroller.children('ul').attr('data-type') + '[data]';
		var template = templates.filter('.templates__item-left').children().clone(true);
		var img = item.attr('data-images').split('|');
		var icons = template.find('.programme-body__box-icons').children();
		if(data===undefined)
			data=['quantity','approaches','weight','coment'];

		if(img[0].length>0)
			template.find('.programme-img').append('<img src="/images/'+img[0]+'">');
		if(img[2].length>0)
			template.find('.programme-img').append('<img src="/images/'+img[2]+'">');

		template.find('.var__id').val(item.attr('data-id')).attr('name',datatType+'[]');
		template.find('.var__quantity').val(data['quantity']).attr('name',datatType+'[quantity][]');
		template.find('.var__approaches').val(data['approaches']).attr('name',datatType+'[approaches][]');
		template.find('.var__weight').val(data['weight']).attr('name',datatType+'[weight][]');
		template.find('.var__comment').val(data['coment']).attr('name',datatType+'[comment][]');
		template.find('.var__exercise-name').text(item.attr('data-name'));
		template.find('.var__exercise-name_desc').text(item.attr('data-name_desc'));

		if(item.attr('data-progress').length==0)
			icons.filter('.ico--progress').remove();
		if(item.attr('data-related').length==0)
			icons.filter('.ico--related').remove();
		if(item.attr('data-video').length==0)
			icons.filter('.ico--play').remove();

		if(index === undefined){
			leftScroller.children('ul').append(template);
			leftScroller.animate({scrollTop : leftScroller.children('ul').height()}, 1000);
		}
		else {
			leftScroller.children('ul').children().eq(index).before(template);
		}

	}
	function addSetAppLeft(id) {
		var item = $('#one-'+id);
		console.log('спросить: развернуть по вкладкам или в текущую вкладку?');
	}

	// добавить из app-right
	$('.exercises-list__add-to-left').on('click',function(){
		var id = $(this).closest('li').attr('data-id');
		if($(this).hasClass('exercises-list__add-to-left--set')){
			addSetAppLeft(id);
		} else {
			addItemAppLeft(id);
		}
	});

	// Добавить из popup
	$('.popup__add-to-left').on('click',function(){
		if($(this).hasClass('popup__add-to-left--set')){

		} else {
			var id = $(this).closest('.popup-content--add').attr('data-id');
			var data = [];
			$(this).closest('.programme-table').find('.input').each(function(){
				data[$(this).attr('name')] = $(this).val();
			});
			addItemAppLeft(id,data);
		}
		$('.popup').trigger('click');
	});



// edit (pедактируем в popup)
	// input
	$('.templates__edit').find('.input').on('keyup blur change',function(){

	});

	// next & prev
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

/*
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
					_li.append('<input type="hidden" name="'+name+'[]" value="'+_li.data('id')+'">');
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

			_li.append('<input type="hidden" name="'+name+'[]" value="'+_li.data('id')+'">');

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
					_li.append('<input type="hidden" name="'+name+'[]" value="'+_li.data('id')+'">');
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
*/
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
	listOne.find('.programme-body__box-title').each(function () {
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

			listOne.addClass('hide').children('.programme-body__box-title').each(function(){
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
			containment: "#main",
			scroll: false
		});

		listMy.sortable({
			cancel: '.not-drop',
			placeholder: 'exercises-my__plus l-h__width programme-body__box',
			containment: "#main",
			scroll: false,
			tolerance:"pointer",
 			activate: function(event, ui) {
				if(!ui.helper.hasClass('ui-draggable-dragging')) {
					ui.placeholder.height(ui.item.height());
					$('.btn-save').attr('data-change', 1);
				}
			},
			receive: function(event, ui) {
				addItemAppLeft(ui.helper.attr('data-id'),false,ui.helper.index());
				ui.helper.remove();
				$('.btn-save').attr('data-change', 1);
			}
		});
	}
	draggable_droppable_sortable();

	function addMyItem(li){
/*			li.find('.exercises-my__save').on('click',function(){
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
*/
//			li.find('.popup__add-to-left').addClass('hide').siblings('.hide').removeClass('hide');
//			li.find('.popup__add-to-left').remove();

			li.removeAttr('style id').attr('class','exercises-my__item l-h__width popup-box clr');
			li.find('.programme-body__box-icons').children().each(function(){
				$(this).attr('class',$(this).attr('class').replace('-white',''));
			});

			var name = $('.tabs__dd--active .exercises-my').data('type');
			var data = li.find('input[type="hidden"]');
			data.remove();
			li.append('<input type="hidden" name="'+name+'[]" value="'+li.data('id')+'">');

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
	$('.new-program-form').on('submit',function(e){
		e.preventDefault();
		var f = $(this);
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
// потуму что создать -> перезагрузка *
//*		navTab.find('.tabs__dt').each(function(){
//*			$(this).add($('.tabs__dd--'+$(this).attr('data-tab'))).remove();
//*		});
//*		$('.popup--create').removeClass('popup--lock').trigger('click');

//* в шаблоне сразу так сделать:
//*		navTab.find('ul').append('<li class="placeholder"><span class="tabs__dt"></span></li>');
//*		$('.app-add-tab').trigger('click');

		saveDesc(v,e.val(),t.val(),c.val());

		f.closest('.popup').remove();
//*		i.add(e).add(t).val('');
	});
	$('.popup--create__name').on('keyup',function(){
		$('title').text($(this).val());
	});

	// save proggramm
	function saveDesc(n,e,t,c){
		$('.programme-head__title').text(n);
		formProgramm.find('.name-programme--input').val(n);
		formProgramm.find('.name-programme--email').val(e);
		formProgramm.find('.name-programme--textarea').text(t);
		formProgramm.find('.name-programme--category').val(c).trigger('change');
	}

	// send email
	$('.send-email-form__btn').on('click',function(){

		var email = formProgramm.find('.name-programme--email');
		if(testEmail(email.val())){
			$('.send-email-form__email').val(email.val()).parent().trigger('submit');
		}
		else {
			var msg = $('.send-email-form__error-text').clone();
			msg.find('.btn').on('click',function(){
				$('.tabs__dt').filter('[data-tab="detal"]').trigger('click');
				setTimeout(function(){
					email.focus();
					email.selectionStart = email.val().length;
				});
			});
			popupShow('content',msg);
		}

/*
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
*/	});

})(jQuery);