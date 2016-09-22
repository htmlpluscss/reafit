/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

(function($){

	var navTab = $('.tabs__nav'), // вкладки
		navTabActive, // активная вкладка
		navTabXscroll, // смеещение вкладок
		widthTab, // общая ширина вкладок
		countTab, // количество вкладок
		pageResizeApp, // resize приложения
		resizeTimeoutIdApp,
		leftScroller, // активный скролл
		rightScroller = $('.app-right .r-h__inner'), // активный скролл
		formProgramm = $('form.save-form'), // форма программы
		formProgrammChange = false, // программа(упражнение) изменина
		templateAdd = $('.templates__add').children(), // добавить упражнение
		templateAddSet = $('.templates__add-set').children(), // добавить программу
		templateEdit = $('.templates__edit').children(), // редактировать упражнение
		templateImgName = $('.templates__img-name').children(), // упражнение картинка и название
		templateImgNameWidth, // ширина шаблона
		templateLeft = $('.templates__item-left').children(), // упражнение в программе
		templateSet = $('.templates__set').children(), // набор упражнений (программа справа)
		ExercisesOne = [],  // массив упражнений
		ExercisesSet = [],  // массив программ
		searchExercises = [],  // массив названий упражнений и программ
		searchExercisesId = [],  // массив id упражнений и программ
		searchExercisesTag = [],  // массив поиковых тегов упражнений и программ
		targetPopup,     // упражнение вызвавшее popup
		list = $('.exercises-list'), // выборка упражнений и программ (справа)
		listMy = $('.exercises-my'), // выборка вкладок упражнений (слева)
		listOne = list.children().not('.exercises-list__item--set'), // упражнения
		listSet = list.children('.exercises-list__item--set'); // программы

var start = new Date();


// создаем массив упражнений
	listOne.each(function(){
		var t = $(this);
		var id = t.attr('data-id');
		var img = t.attr('data-images').split('|');
		var params = [
			t.attr('data-name'),
			t.attr('data-favorite'),
			t.children('.var__exercise-description').html(),
			t.attr('data-video'),
			img[0],
			img[1],
			img[2],
			t.attr('data-filter'),
			t.attr('data-related'),
			t.attr('data-progress'),
			t.attr('data-name_desc')
		];
		ExercisesOne[id] = params;

	// строим DOM
		t.html(itemHmltImgName(id,params));

	// массивы для поиска
		searchExercises.push(t.attr('data-name'));
		searchExercisesId.push(t.attr('data-id'));

	});

// создаем массив программ
	listSet.each(function(){
		var t = $(this);
		var id = t.attr('data-id');
		var params = [
			t.attr('data-name'),
			t.attr('data-favorite'),
			t.children('.var__exercise-description').html(),
			t.attr('data-video'),
			t.attr('data-images'),
			t.attr('data-exercises')
		];
		ExercisesSet[t.attr('data-id')] = params;

	// строим DOM
		t.html(itemHmltImgName(id,params,true));

	// массивы для поиска
		searchExercises.push(t.attr('data-name'));
		searchExercisesId.push(t.attr('data-id'));

	});

	function itemHmltImgName(id,params,set){
		var template = templateImgName.clone(true);
		var icons = template.find('.item-img_name__icons').children();

		if(!params){
			params = ExercisesOne[id];
		}

		template.attr('data-id',id);

		template.find('.item-img_name__title').text(params[0]);

		if(params[1].length>0)
			icons.filter('.ico--star').addClass('ico--star--active');

		params[4] === undefined ?
			template.find('.item-img_name__img').remove(): // это тормозит !!!!!!!!!
			template.find('.item-img_name__img').attr('src','/images/'+params[5]); // временно, должно быть "главное"

		if(set){
			template.addClass('item-img_name--set');
			icons.filter('.ico--play-white').remove();
			icons.filter('.ico--related-white').remove();
			icons.filter('.ico--progress-white').remove();
			icons.filter('.ico--star').attr('data-url','/programs/favorite/'+id);
		}
		else {
			params[3].length > 0 ?
				icons.filter('.ico--play-white').attr('data-video',params[3]):
				icons.filter('.ico--play-white').remove();
			if(params[8].length==0)
				icons.filter('.ico--related-white').remove();
			if(params[9].length==0)
				icons.filter('.ico--progress-white').remove();
			icons.filter('.ico--star').attr('data-url','/exercises/favorite/'+id);
		}
		return template;
	}

//	console.log(ExercisesOne);
//	console.log(ExercisesSet);

var end = new Date();

	console.log('Скорость ' + (end.getTime()-start.getTime()) + ' мс');



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

			templateImgNameWidth = list.children().filter(':visible').first().width();
		}
	}

	widthTab = function(){
		var ul = navTab.find('ul');
		var li = ul.children();
		if(li.length<2) return;
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

// сохранить программу, сохранить и отправить емайл, сохранить как
	$('.btn-save').on('click', function(){
		// redirect
		var action = $(this).hasClass('btn-save--redirect') ? $(this).data('action') : '';
		formProgramm.find('input[name="redirect"]').val(action);

		// send email
		if($(this).hasClass('btn-save--send-email')) {
			var email = formProgramm.find('.name-programme--email');
			if(testEmail(email.val())){
				// отправка емайла, хотя по идее достаточно строки ниже: name="send" value="1"
				// тогда и форму отпавки емайла удалить
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
				return false;
			}
//			formProgramm.append('<input type="hidden" name="send" value="1">');
		}

		// save-as
		if($(this).hasClass('btn-save--save-as')) {
			if($('.form-save-as__name').val()==""){
				$('.form-save-as__name').focus();
				return false;
			}
			else{
				$('.name-programme--input').val($('.form-save-as__name').val());
				$('.name-programme--category').val($('.form-save-as__category').val());
				$('.name-programme--email').val($('.form-save-as__email').val());
				$('.name-programme--textarea').val($('.form-save-as__description').val());
				formProgramm.attr('action', $(this).data('action'));
			}
		}

console.log(formProgramm.serializeArray());
		formProgramm.submit();
	});

// сохранить при выходе?
	// изменение формы программы
	formProgramm.on('change', function() {
		formProgrammChange = true;
	});
	// клик по ссылкам переадресаций
	$('#header a, .open-program-link, .btn-new, .btn-to-list').on('click', function(){
		var url = $(this).attr('href');
		if(url === undefined) {
			$('.save-exit-redirect').removeAttr('data-action');
		} else {
			$('.link-exit-redirect').attr('href', url);
			$('.save-exit-redirect').attr('data-action', url);
		}
		if(formProgrammChange){
			popupShow('close');
			return false;
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
		var dt = navTab.find('.placeholder').removeClass('placeholder').children();
		if(dt.length==0) return;
		var dd = $('.tabs__dd--start').clone(true);
		countTab = $('.tabs__dt').length + 1;
		dd.removeClass('tabs__dd--start').addClass('tabs__dd--' + countTab);
		formProgramm.append(dd);
		dt.attr('data-tab',countTab);
		$(this).attr('data-tab-id', countTab);

		formProgrammChange = true;

		dd.find('.l-h__inner')
			.attr('data-type', 'exercises['+countTab+'][data]')
			.append('<input id="tabs-exercises-'+countTab+'" type="hidden" name="exercises['+countTab+'][name]" value="">');
		setTimeout(function(){
			dt.trigger('click');
			dd.find('.input').focus();
		});
		dd.find('.input').on('keyup',function(){
			var name = $(this).val();
			dt.text(name);
			$('#tabs-exercises-'+countTab).val(name);
			widthTab();
		});
		dd.find('.add-tab-form__btn').one('click',function(){
			dd.find('.l-h__inner').append('<input type="hidden" name="params[access][]" class="access-tab-' + parseInt(countTab - 8) + '" value="1">');
			$('.access-tabs').append('<li><label class="checkbox"><input type="checkbox" class="access" value="' + parseInt(countTab - 8) + '" checked="checked"> ' + dt.text() + '<i></i></label></li>');
		});
		if(countTab>8){
			$('.programme-body').removeClass('programme-body--one-tab');
		}
		widthTab();
	});

// инициализация редактора
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
            });
		});

		$('.btn.app-add-note').text($('.btn.app-add-note').attr('data-alt-text'));
		var altText = $('.ico--note.app-add-note').attr('data-alt-text')+'<i></i>';
		$(this).hasClass('btn')?
			$('.ico--note.app-add-note').children().html(altText):
			body.children('.title_up').html(altText).css('left',$('.ico--note.app-add-note').offset().left + $('.ico--note.app-add-note').outerWidth() / 2 - body.children('.title_up').outerWidth() / 2);


	});
	$('.editor').on('tbwchange', function(){
		formProgrammChange = true;
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

// создание новой вкладки
	$('.add-tab-form__btn').on('click',function(){
		var f = $(this).closest('.add-tab-form');
		var i = f.find('.add-tab-form__name');
		if($(this).hasClass('add-tab-form__btn__only')) {
			$('.programme-body').addClass('programme-body--one-tab');
			// создаем одноименную вкладку программы
			i.val($('.programme-head__title').text()).trigger('keyup');
		}
		if(i.val()=="") {
			i.focus();
			return;
		}
		else {
			var ul = $('<ul class="exercises-my">');
			ul.attr('data-type', 'exercises['+countTab+'][data]');
			f.after(ul);
			f.remove();

			$window.trigger('resize');
			draggable_droppable_sortable();
		}
		$('.add-tab-form__btn__only').remove();
	});
// создание вкладки на enter
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
		if(del.hasClass('tabs__dt--not-delete')) return;
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
		formProgrammChange = true;
	});

// переключение програм/упражнений
	$('.tab-exercises-list').on('click',function(){
		$(this).addClass('tab-exercises-list--active').siblings().removeClass('tab-exercises-list--active');
		if($(this).hasClass('tab-exercises-list--set')){
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

// Доступно пациенту (вклвадка детали)
	$('.access-tabs__item').on('change', function(){
		var tab = $(this).val();
		var value = $(this).prop('checked') ? 1 : 0;
		formProgramm.find('.access-tab-' + tab).val(value);

// добавить в шаблон новой вкладки
//		formProgramm.append('<input type="hidden" name="params[access][]" class="access-tab-' + idx + '" value="' + value + '">');
		formProgrammChange = true;
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
		formProgrammChange = true;
	});

// удалить упражнение
	$('.exercises-my__item-delete').on('click',function(){
		var li = $(this).closest('.exercises-my__item');
		li.fadeOut(1000,function(){
			li.remove();
		});
		formProgrammChange = true;
	});


// popup__btn
	$('.popup__btn').on('click',function(){
		var t = $(this);
		targetPopup = t.closest('.popup-box');
		var id = targetPopup.attr('data-id');
		var item = ExercisesOne[id];
		var width = false;

	// related & progress
		if(t.hasClass('popup__btn--related') || t.hasClass('popup__btn--progress')){
			var template = $('<div class="related_progress clr">');
			var items = t.hasClass('popup__btn--related') ? item[8].split(',') : item[9].split(',');

			width = items.length < 4 ? (templateImgNameWidth + 10) * items.length : (templateImgNameWidth + 10) * 4; // 10 это margin-left
			width -= 10;

			for(var i = 0; i < items.length; i++){

				var siblings = items[i];
				if(ExercisesOne[siblings] !== undefined) { // временно, пока попадает несуществаующие(неподкюченные) упражнения
					siblings == id ?
						template.append(itemHmltImgName(siblings).addClass('item-img_name--current-in-progress')):
						template.append(itemHmltImgName(siblings));
				}

			}
		}
		// add set
		if(targetPopup.hasClass('item-img_name--set')){
			var template = templateAddSet.clone(true);
			item = ExercisesSet[id];

			if(item[4] !== undefined)
				template.find('.programme-img').append('<img src="/images/'+item[4]+'">');

			template.attr('data-id',id);
			template.find('.var__exercise-name').text(item[0]);
			template.find('.var__exercise-description').html(item[2]);
		}
		// add one & edit
		else if(t.hasClass('popup__btn--add') || t.hasClass('popup__btn--edit')){
			var template = templateAdd.clone(true);

			if(t.hasClass('popup__btn--edit')){
				template = templateEdit.clone(true);
				template.find('.popup__input--quantity').val(targetPopup.find('.var__quantity').val());
				template.find('.popup__input--approaches').val(targetPopup.find('.var__approaches').val());
				template.find('.popup__input--weight').val(targetPopup.find('.var__weight').val());
				template.find('.popup__input--comment').text(targetPopup.find('.var__comment').val());
			}

			if(item[4] !== undefined)
				template.find('.programme-img').append('<img src="/images/'+item[4]+'">');
			if(item[5] !== undefined)
				template.find('.programme-img').append('<img src="/images/'+item[5]+'">');
			if(item[6] !== undefined)
				template.find('.programme-img').append('<img src="/images/'+item[6]+'">');

			template.attr('data-id',id);
			template.find('.var__exercise-name').text(item[0]);
			template.find('.var__exercise-name_desc').text(item[10]);
			template.find('.var__exercise-description').html(item[2]);

			width = 826;
		}
		// view
		else if(t.hasClass('popup__btn--view')){
			var template = targetPopup.clone();
			template.find('.popup-hidden').addClass('hide');
			template.find('.popup-visible').removeClass('hide');
		}
		popupShow('content',template,width);
	});


// события в шаблонах

// add
	// Добавить
	function addItemAppLeft(id,data,index) {

		var item = ExercisesOne[id];
		var template = templateLeft.clone(true);
		var icons = template.find('.programme-body__box-icons').children();

		template.attr('data-id',id);
		template.find('.var__exercise-name').text(item[0]);
		template.find('.var__exercise-name_desc').text(item[10]);

		item[3].length > 0 ?
			icons.filter('.ico--play').attr('data-video',item[3]):
			icons.filter('.ico--play').remove();

		if(item[4] !== undefined)
			template.find('.programme-img').append('<img src="/images/'+item[4]+'">');
		if(item[6] !== undefined)
			template.find('.programme-img').append('<img src="/images/'+item[6]+'">');

		if(item[9].length==0)
			icons.filter('.ico--progress').remove();
		if(item[8].length==0)
			icons.filter('.ico--related').remove();

		// упражнения, добавляем похожии и прогресс
		var type = navTabActive.data('tab');
		if(type=='related' || type=='progress'){

			template.find('.var__type').val(id).attr('name',type+'[]');

		}
		// программа
		else {

			var datatType = leftScroller.children('ul').attr('data-type');
			if(data===undefined)
				data=['quantity','approaches','weight','comment'];

			template.find('.var__id').val(id).attr('name',datatType+'[]');
			template.find('.var__quantity').val(data['quantity']).attr('name',datatType+'[quantity][]');
			template.find('.var__approaches').val(data['approaches']).attr('name',datatType+'[approaches][]');
			template.find('.var__weight').val(data['weight']).attr('name',datatType+'[weight][]');
			template.find('.var__comment').val(data['comment']).attr('name',datatType+'[comment][]');

			formProgrammChange = true;

		}

		if(index === undefined){
			leftScroller.children('ul').append(template);
			leftScroller.stop().animate({scrollTop : leftScroller.children('ul').height()}, 1000);
		}
		else {
			leftScroller.children('ul').children().eq(index).before(template);
		}

	}
	function addSetAppLeft(id,index) {
		var items = ExercisesSet[id][5].split('|');
		for(var i = 0; i < items.length; i++){
			index === undefined ?
				addItemAppLeft(items[i]):
				addItemAppLeft(items[i],false,index+i);
		}
		console.log('спросить: развернуть по вкладкам или в текущую вкладку?');
	}

	// добавить из app-right
	$('.exercises-list__add-to-left').on('click',function(){
		var id = $(this).closest('.popup-box').attr('data-id');
		$(this).closest('.popup-box').hasClass('item-img_name--set') ? addSetAppLeft(id) : addItemAppLeft(id);
	});

	// Добавить из popup
	$('.popup__add-to-left').on('click',function(){
		var id = $(this).closest('.popup-content--add').attr('data-id');
		if($(this).hasClass('popup__add-to-left--set')){
			addSetAppLeft(id);
		} else {
			var data = [];
			$(this).closest('.programme-table').find('.input').each(function(){
				data[$(this).attr('name')] = $(this).val();
			});
			addItemAppLeft(id,data);
		}
		$('.popup').trigger('click');
	});



// popup__input
	$('.popup__input').on('change keyup blur',function(){
		targetPopup.children('.var__' + $(this).attr('name')).val($(this).val()).trigger('change');
	});

// popup__prev & popup__next
	$('.popup__prev, .popup__next').on('click',function(){
		var next = $(this).hasClass('popup__next') ? targetPopup.next() : targetPopup.prev();
		$('.popup').trigger('click');
		if(next.length>0){
			next.find('.popup__btn--edit').trigger('click');
		}
	});


// избранное
	$('.icon-toggle-favorite').on('click',function(){
		var url = $(this).data('url');
		var type = $(this).hasClass('ico--star--active') ? 0 : 1;
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
					$(this).toggleClass('ico--star--active');
				}
			}, this)
		});
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

	inputExercises.autocomplete({
		source: searchExercises,
		select: function(event, ui){
			var v = ui.item.value;
			var id = searchExercises.indexOf(ui.item.value);
			listOne.removeClass('hide').not('#one-'+searchExercisesId[id]).addClass('hide');
		}
	});

	inputExercisesClear.on('click',function(){
		inputExercises.val('');
		inputExercisesClear.addClass('hide');
		listOne.removeClass('hide');
		$('.app-filter-search').trigger('click');
	});

	inputExercises.on('change keyup blur',function(event){
		inputExercisesClear.toggleClass('hide',$(this).val().length == 0);
	});

// захват и перетаскиваний
	function draggable_droppable_sortable(){

		listMy = $('.exercises-my');
		listMy.filter('.ui-sortable').sortable('destroy');
		list.children('.ui-draggable-handle').draggable('destroy');

		list.children().draggable({
			helper: 'clone',
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
			update: function() {
				formProgrammChange = true;
			},
 			activate: function(event, ui) {
				if(!ui.helper.hasClass('ui-draggable-dragging')) {
					ui.placeholder.height(ui.item.height());
				}
			},
			receive: function(event, ui) {
				ui.helper.is('[data-exercises]') ?
					addSetAppLeft(ui.helper.attr('data-id'),ui.helper.index()):
					addItemAppLeft(ui.helper.attr('data-id'),false,ui.helper.index());
				ui.helper.remove();
			}
		});
	}
	draggable_droppable_sortable();


// create App

	// название программы
	$('.new-program-form').on('submit',function(){
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

		f.closest('.popup').remove();
		saveDesc(v,e.val(),t.val(),c.val());
		$('.app-add-tab').trigger('click');
		return false;
	});
	$('.popup--create__name').on('keyup',function(){
		$('title').text($(this).val());
	});

	// save proggramm
	function saveDesc(n,e,t,c){
		$('.programme-head__title').text(n);
		formProgramm.find('.name-programme--input').val(n).trigger('blur');
		formProgramm.find('.name-programme--email').val(e).trigger('blur');
		formProgramm.find('.name-programme--textarea').text(t).trigger('blur');
		formProgramm.find('.name-programme--category').val(c).trigger('change');
	}

})(jQuery);