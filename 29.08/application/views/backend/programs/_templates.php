<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="templates hide">

	<ul class="templates__item-left">
		<li class="exercises-my__item l-h__width popup-box clr" data-id="{{$exercise->hash}}">
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
						<a class="ico ico--play play-video not-drop" data-video="{{$exercise->video}}"></a>
						<a class="ico ico--info popup__btn popup__btn--edit not-drop"></a>
						<a class="ico ico--progress popup__btn popup__btn--progress not-drop"></a>
						<a class="ico ico--related popup__btn popup__btn--related not-drop"></a>
						<a class="ico ico--delete exercises-my__item-delete not-drop"></a>
					</div>
				</div>
				<div class="programme-img"></div>
			</div>
		</li>
	</ul>

	<div class="templates__add">

		<div class="popup-content--add">
			<div class="programme-img"></div>
			<div class="programme-body__detal">
				<table class="programme-table programme-table--input">
					<tr>
						<td>
							<input tabindex="1" class="input" placeholder="<?php echo lang('times');?>" name="quantity">
						</td>
						<td rowspan="2">
							<textarea tabindex="4" class="input" placeholder="<?php echo lang('coment');?>" name="comment"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input tabindex="2" class="input" placeholder="<?php echo lang('approaches');?>" name="approaches">
						</td>
					</tr>
					<tr>
						<td>
							<input tabindex="3" class="input" placeholder="<?php echo lang('weight');?>" name="weight">
						</td>
						<td>
							<a class="btn programme-table__btn popup__add-to-left"><?php echo lang('add');?></a>
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

	<div class="templates__add-set">

		<div class="popup-content--add">
			<div class="programme-description">
				<p class="programme-body__name">
					<span class="var__exercise-name programme-body__name-b"></span>
				</p>
				<div class="var__exercise-description"></div>
				<a class="btn programme-table__btn programme-table__btn--set popup__add-to-left popup__add-to-left--set"><?php echo lang('add_set_in_program');?></a>
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
							<input tabindex="1" class="input popup__input popup__input--quantity" placeholder="<?php echo lang('times');?>" name="quantity">
						</td>
						<td rowspan="2">
							<textarea tabindex="4" class="input popup__input popup__input--comment" placeholder="<?php echo lang('coment');?>" name="comment"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input tabindex="2" class="input popup__input popup__input--approaches" placeholder="<?php echo lang('approaches');?>" name="approaches">
						</td>
					</tr>
					<tr>
						<td>
							<input tabindex="3" class="input popup__input popup__input--weight" placeholder="<?php echo lang('weight');?>" name="weight">
						</td>
						<td>
							<a class="btn btn--next popup__next pull-right ml-10"></a>
							<a class="btn btn--prev popup__prev pull-right"></a>
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

	<div class="templates__img-name">

		<div class="item-img_name popup-box" data-id="{{$exercise->hash}}">
			<img class="item-img_name__img" src="images/{{$exercise->image_1}}">
			<div class="item-img_name__bottom">
				<span class="item-img_name__title">{{$exercise->name}}</span>
			</div>
			<div class="item-img_name__hover">
				<div class="item-img_name__icons">
					<a class="ico ico--play-white play-video" data-video="{{$exercise->video}}"></a>
					<a class="ico ico--info-white popup__btn popup__btn--add"></a>
					<a class="ico ico--progress-white popup__btn popup__btn--progress"></a>
					<a class="ico ico--related-white popup__btn popup__btn--related"></a>
					<a class="ico ico--add-item exercises-list__add-to-left"></a>
				</div>
			</div>
		</div>

	</div>

</div>