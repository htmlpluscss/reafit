<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<div class="templates hide">

	<ul class="templates__item-left">
		<li class="exercises-my__item l-h__width popup-box clr" data-id="{{$exercise->hash}}">
			<input class="var__type" type="hidden" value="{{$exercise->hash}}" name="{{type}}">
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
							<a class="btn programme-table__btn w106 mb-14 popup__add-to-left"><?php echo lang('add');?></a>
							<a class="btn btn--gray programme-table__btn w106 popup__close"><?php echo lang('close');?></a>
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
					<a class="ico ico--star {{$exercise->favorite=ico--star--active}} icon-toggle-favorite" data-url="/exercises/favorite/{{$exercise->hash)}}"></a>
				</div>
			</div>
		</div>

	</div>

</div>