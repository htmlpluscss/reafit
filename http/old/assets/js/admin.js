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
		var id = t.data('id');
		th.closest('thead').siblings('tbody').children().each(function(){
			var td = $(this).children().eq(col);
			t.prop('checked') ?
				td.addClass('hide'):
				td.removeClass('hide');
		});
		if(t.prop('checked')){
			th.addClass('hide');
			$.cookie(id+'-colHide-'+v, 1);
		}
		else{
			th.removeClass('hide');
			$.removeCookie(id+'-colHide-'+v);
		}
	});

	$('.col-hide input').each(function(){
		var checked = $.cookie($(this).data('id')+'-colHide-'+$(this).val());
		$(this).prop('checked',checked==1).trigger('change');
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
		var group = $(this).data('id');
		var input = $('<input class="input">');
		if(h3.next().is('input')) return;
		input.on('blur',function(){
			if(input.val()!=""){
				var tag = input.val();
				li.text(tag);
				li.append('<a class="icon-trash"></a>');
				li.append('<input type="hidden" name="tag['+group+'][][new]" value="'+tag+'" />');
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

	// table100--list__item
	$('.table100--list__item').on('change',function(){
		var order = parseInt($(this).val());
		var url = $(this).data('url');
		$.ajax({
			type:     'POST',
			dataType: 'json',
			cache:    false,
			url:      url,
			data: {
				order : order
			},
			success: $.proxy(function(data){
				if(data['success'].length != 0) {
					location.reload();
				}
			}, this)
		});
	});
