/* UTF-8

© kovrigin
Все права разрешены
красивый дизайн должен иметь красивый код®

http://htmlpluscss.ru

*/

	$('.col-hide input').on('change',function(){
		var t = $(this);
		var v = t.val();
		var th = $('.col-hide-'+v);
		var col = th.index();
		var href = location.pathname;
		th.closest('thead').siblings('tbody').children().each(function(){
			var td = $(this).children().eq(col);
			t.prop('checked') ?
				td.addClass('hide'):
				td.removeClass('hide');
		});
		if(t.prop('checked')){
			th.addClass('hide');
			$.cookie('colHide-'+v+href, 1);
		}
		else{
			th.removeClass('hide');
			$.removeCookie('colHide-'+v+href);
		}
	});

	$('.col-hide input').each(function(){
		var checked = $.cookie('colHide-'+$(this).val()+location.pathname);
		$(this).prop('checked',checked==1).trigger('change');
	});


// one
	$('.add-related').on('click',function(){
		alert('список всех упражнений с чекбоксом');
	});
	$('.add-progress').on('click',function(){
		alert('список всех упражнений с чекбоксом');
	});
	$('.one-event__delete').on('click',function(){
		var tr = $(this).closest('tr');
		if(confirm('Удалить упражнение?'))
			tr.fadeOut(function(){
				tr.remove();
				alert('удалено. отправка на сервер.')
			});
	});
	$('.one-event__video').on('click',function(){
		var video = $(this).attr('data-video');
		alert('воспроизвести '+video);
	});
	$('.one-event__detal').on('click',function(){
		alert('as +');
	});

// list-tags
	$('.sort-remove').on('click','a',function(){
		var li = $(this).parent();
		li.fadeOut(function(){
			li.remove();
		});
	});
	$('.list-tags h3 a').on('click',function(){
		var h3 = $(this).parent();
		var li = $('<li>');
		var input = $('<input class="input">');
		if(h3.next().is('input')) return;
		input.on('blur',function(){
			if(input.val()!=""){
				li.text(input.val());
				li.append('<a class="icon-trash"></a>');
				input.next().prepend(li);
			}
			input.remove();
		});
		h3.after(input);
		setTimeout(function(){
			input.focus();
		});
	});

	$('.sort-remove').sortable({
		cancel: 'a',
		placeholder: 'sort-remove__placeholder'
	});