<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
			<?php foreach ($exercises as $key => $exercise): ?>
				<?php
					$class = (!empty($class)) ? $class : 'exercises-my__item l-h__width popup-box clr';
					$_progress = '';
					if($exercise->progress) {
						$_progress = array();
						foreach ($exercise->progress as $key => $value) {
							$_progress[] = $value->hash;
						}
						$_progress = implode(',', $_progress);
					} else {
						$_progress = '';
					}

					$_related = '';
					if($exercise->related) {
						$_related = array();
						foreach ($exercise->related as $key => $value) {
							$_related[] = $value->hash;
						}
						$_related = implode(',', $_related);
					} else {
						$_related = '';
					}

				?>

<?php //echo $this->load->view('frontend/'.$this->router->class.'/_item_detail', array('exercise'=>$exercise, 'key'=>$key, 'tab'=>isset($tab)? $tab : false, 'type' => (!isset($type)) ? false : $type ), TRUE);?>

<?php if(isset($type) && !empty($type)):?>
				<li class="exercises-my__item l-h__width clr popup-box" data-id="<?php echo $exercise->hash;?>">

					<input type="hidden" name="<?php echo $type;?>[]" value="<?php echo $exercise->hash;?>" class="var__id">
					<input type="hidden" name="<?php echo $type;?>[quantity][]" value="<?php if (isset($exercise->quantity)) echo $exercise->quantity;?>" class="var__quantity">
					<input type="hidden" name="<?php echo $type;?>[approaches][]" value="<?php if (isset($exercise->approaches)) echo $exercise->approaches;?>" class="var__approaches">
					<input type="hidden" name="<?php echo $type;?>[weight][]" value="<?php if (isset($exercise->weight)) echo $exercise->weight;?>" class="var__weight">
					<input type="hidden" name="<?php echo $type;?>[comment][]" value="<?php if (isset($exercise->comment)) echo $exercise->comment;?>" class="var__comment">

					<div class="programme-body__box clr">
						<div class="programme-body__box-head">
							<div class="programme-body__box-name">
								<span class="programme-body__box-title"><?php echo $exercise->name;?></span>
								<span><?php echo $exercise->name_desc;?></span>
							</div>
							<div class="programme-body__box-icons">
								<?php if(!empty($exercise->video)):?>
								<a class="ico ico--play play-video not-drop" data-video="<?php echo $exercise->video; ?>"></a>
								<?php endif;?>
								<a class="ico ico--info popup__btn popup__btn--edit not-drop"></a>
								<?php if($exercise->progress):?>
								<a class="ico ico--progress popup__btn popup__btn--progress not-drop"></a>
								<?php endif;?>
								<?php if($exercise->related):?>
								<a class="ico ico--related popup__btn popup__btn--related not-drop"></a>
								<?php endif;?>
								<a class="ico ico--delete exercises-my__item-delete not-drop"></a>
							</div>
						</div>
						<div class="programme-img">
							<?php if($exercise->image_1):?>
							<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
							<?php if($exercise->image_3):?>
							<img src="<?php echo site_url('images/'.$exercise->image_3);?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
						</div>
					</div>
<?php else:?>
				<li
					id="one-<?php echo $exercise->hash;?>"
					data-id="<?php echo $exercise->hash;?>"
					class="exercises-list__item app-right__item"
					data-filter="<?php echo (!empty($exercise->tags)) ? implode(',', $exercise->tags) . ',' . $exercise->category : $exercise->category;?>"
					data-favorite="<?php echo $exercise->favorite;?>"
					data-video="<?php echo $exercise->video;?>"
					data-related="<?php echo $_related;?>"
					data-progress="<?php echo $_progress;?>"
					data-images="<?php if($exercise->image_1) echo $exercise->image_1; ?>|<?php if($exercise->image_2) echo $exercise->image_2;?>|<?php if($exercise->image_3) echo $exercise->image_3;?>"
					data-name="<?php echo $exercise->name;?>"
					data-name_desc="<?php echo $exercise->name_desc;?>"
					>
					<div class="var__exercise-description hide"><?php echo $exercise->description;?></div>
					<div class="item-img_name"></div>
<?php endif;?>
				</li>
			<?php endforeach ?>