<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="templates hide">

	<ul class="templates__item-left">
		<li class="exercises-my__item l-h__width clr">
			<input type="hidden" name="exercises[{{tab}}][data][]" value="{{$exercise->hash}}" class="var__id">
			<input type="hidden" name="exercises[{{tab}}][quantity][]" value="{{$exercise->quantity}}" class="var__quantity">
			<input type="hidden" name="exercises[{{tab}}][approaches][]" value="{{$exercise->approaches}}" class="var__approaches">
			<input type="hidden" name="exercises[{{tab}}][weight][]" value="{{$exercise->weight}}" class="var__weight">
			<input type="hidden" name="exercises[{{tab}}][comment][]" value="{{$exercise->comment}}" class="var__comment">
			<div class="programme-body__box clr">
				<div class="programme-body__box-head">
					<div class="programme-body__box-name">
						<span class="var__exercise-name programme-body__box-title"></span>
						<span class="var__exercise-name_desc"></span>
					</div>
					<div class="programme-body__box-icons">
						<a class="ico ico--play play-video not-drop" data-popup="play"></a>
						<a class="ico ico--info popup__btn not-drop" data-popup="add"></a>
						<a class="ico ico--progress popup__btn not-drop" data-popup="progress"></a>
						<a class="ico ico--related popup__btn not-drop" data-popup="related"></a>
						<a class="ico ico--delete ico-delete-item not-drop"></a>
					</div>
				</div>
				<div class="programme-img"></div>
			</div>
		</li>
	</ul>

	<div class="templates__item-right">
	</div>

	<div class="templates__set">
	</div>

	<div class="templates__add">

		<div class="popup-content--add">
			<div class="programme-img"></div>
			<div class="programme-body__detal">
				<table class="programme-table programme-table--input">
					<tr>
						<td>
							<input class="input" placeholder="<?php echo lang('times');?>" name="quantity" class="var__quantity">
						</td>
						<td rowspan="2">
							<textarea class="input" placeholder="<?php echo lang('coment');?>" name="coment" class="var__comment"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input class="input" placeholder="<?php echo lang('approaches');?>" name="approaches" class="var__approaches">
						</td>
					</tr>
					<tr>
						<td>
							<input class="input" placeholder="<?php echo lang('weight');?>" name="weight" class="var__weight">
						</td>
						<td>
							<a class="btn programme-table__btn-add popup__add-to-left"><?php echo lang('add');?></a>
						</td>
					</tr>
				</table>
			</div>
			<div class="programme-description">
				<p class="programme-body__name">
					<span class="var__exercise-name programme-body__name-b"></span>
					<span class="var__exercise-name_desc"></span>
				</p>
				<div class="var__exercise-description"></div>
			</div>
		</div>

	</div>

	<div class="templates__edit">

		<div class="popup-content--add">
			<div class="programme-img"></div>
			<div class="programme-body__detal">
				<table class="programme-table programme-table--input">
					<tr>
						<td>
							<input class="input" placeholder="<?php echo lang('times');?>" name="exercises[{{tab}}][quantity][]">
						</td>
						<td rowspan="2">
							<textarea class="input" placeholder="<?php echo lang('coment');?>" name="exercises[{{tab}}][coment][]"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input class="input" placeholder="<?php echo lang('approaches');?>" name="exercises[{{tab}}][approaches][]">
						</td>
					</tr>
					<tr>
						<td>
							<input class="input" placeholder="<?php echo lang('weight');?>" name="exercises[{{tab}}][weight][]">
						</td>
						<td>
							<a class="btn programme-table__btn-save pull-left exercises-my__save"><?php echo lang('save');?></a>
							<a class="btn btn--next pull-right ml-10 exercises-my__save exercises-my__save--next"></a>
							<a class="btn btn--prev pull-right exercises-my__save exercises-my__save--prev"></a>
						</td>
					</tr>
				</table>
			</div>
			<div class="programme-description">
				<p class="programme-body__name">
					<span class="var__exercise-name programme-body__name-b"></span>
					<span class="var__exercise-name_desc"></span>
				</p>
				<div class="var__exercise-description"></div>
			</div>
		</div>

	</div>

	<div class="templates__related">
	</div>

</div>