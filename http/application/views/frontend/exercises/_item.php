<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
			<?php
				$current = false;
				$insert = false;
				if(!isset($type)) {
					$type = false;
				}
			?>
			<?php if($exercises):?>
			<?php foreach ($exercises as $key => $exercise): ?>
				<?php
					$class = (!empty($class)) ? $class : 'exercises-my__item l-h__width popup-box clr';
					if($exercise->progress) {
						$_progress = array();
						foreach ($exercise->progress as $key => $value) {
							$_progress[] = $value->hash;
						}
						$_progress = implode(',', $_progress);
					} else {
						$_progress = '';
					}

					if($exercise->related) {
						$_related = array();
						foreach ($exercise->related as $key => $value) {
							$_related[] = $value->hash;
						}
						$_related = implode(',', $_related);
					} else {
						$_related = '';
					}
					if(isset($hash) && $exercise->hash == $hash) {
						$current = true;
					}
				?>
				<?php if($type == 'progress' && $current):?>
				<li class="exercises-my__item exercises-my__item--current-progress l-h__width clr">
					<span class="exercises-list__name"><?php echo $name;?></span>
					<input type="hidden" name="<?php echo $type;?>[]" value="<?php echo $hash;?>">
				</li>
				<?php $current = false; $insert = true;?>
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
				</li>
				<?php endif;?>
			<?php endforeach ?>
			<?php endif;?>
			<?php if(!$current && !$insert && $type == 'progress'):?>
				<li class="exercises-my__item exercises-my__item--current-progress l-h__width clr">
					<span class="exercises-list__name"><?php echo lang('current_exercise_name');?></span>
					<?php if(!empty($type)):?>
					<input type="hidden" name="<?php echo $type;?>[]" value="current">
					<?php endif;?>
				</li>
			<?php endif;?>