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
					$class = (!empty($class)) ? $class : 'exercises-my__item popup-box clr';
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
				<li class="exercises-my__item exercises-my__item--current-progress popup-box clr" style="height:100px">
					<span class="exercises-list__name"><?php echo $name;?></span>
					<div class="exercises-list-btn-block exercises-list-btn-block--one hide not-drop">
						<a class="icon-down-bold ico-move-item"></a>
						<a class="icon-up-bold ico-move-item"></a>
					</div>
					<input type="hidden" name="<?php echo $type;?>[]" value="<?php echo $hash;?>" />
				</li>
				<?php $current = false; $insert = true;?>
				<?php else:?>
				<li id="one-<?php echo $exercise->hash;?>" class="<?php echo $class;?>" data-filter="<?php echo (!empty($exercise->tags)) ? implode(',', $exercise->tags) . ',' . $exercise->category : $exercise->category;?>" data-video="<?php echo $exercise->video;?>" data-related="<?php echo $_related;?>" data-progress="<?php echo $_progress;?>" data-id="<?php echo $exercise->hash;?>">
					<span class="exercises-list__name"><?php echo $exercise->name;?> <span class="hide"><?php echo $exercise->name_desc;?></span></span>
					<span class="exercises-list__img">
						<?php if($exercise->image_1):?>
						<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
						<?php endif;?>
						<?php if($exercise->image_2):?>
						<img src="<?php echo site_url('images/'.$exercise->image_2);?>" alt="<?php echo $exercise->name;?>">
						<?php endif;?>
					</span>
					<?php echo $this->load->view('backend/'.$this->router->class.'/_item_detail', array('exercise'=>$exercise, 'type' => $type), TRUE);?>
					<div class="exercises-list-btn-block exercises-list-btn-block--one hide not-drop">
						<?php if($exercise->video):?>
						<a class="icon-play play-video"></a>
						<?php endif;?>
						<a class="icon-info exercise popup__btn" data-popup="add"></a>
						<a class="icon-left-bold exercises-list__add-to-left"></a>
						<?php if($exercise->progress):?>
						<a class="icon-chart-line popup__btn" data-popup="progress"></a>
						<?php endif;?>
						<a class="icon-trash ico-delete-item"></a>
						<?php if($exercise->related):?>
						<a class="icon-share popup__btn" data-popup="related"></a>
						<?php endif;?>
						<a class="icon-star icon-toggle-favorite<?php echo (!empty($exercise->favorite)) ? ' active':'';?>" data-url="<?php echo base_url('exercises/favorite/'.$exercise->hash);?>"></a>
						<a class="icon-down-bold ico-move-item"></a>
						<a class="icon-up-bold ico-move-item"></a>
					</div>
					<?php if(!empty($type)):?>
					<input type="hidden" name="<?php echo $type;?>[]" value="<?php echo $exercise->hash;?>" />
					<?php endif;?>
				</li>
				<?php endif;?>
			<?php endforeach ?>
			<?php endif;?>
				<?php if(!$current && !$insert && $type == 'progress'):?>
				<li class="exercises-my__item exercises-my__item--current-progress popup-box clr" style="height:100px">
					<span class="exercises-list__name"><?php echo lang('current_exercise_name');?></span>
					<div class="exercises-list-btn-block exercises-list-btn-block--one hide not-drop">
						<a class="icon-down-bold ico-move-item"></a>
						<a class="icon-up-bold ico-move-item"></a>
					</div>
					<?php if(!empty($type)):?>
					<input type="hidden" name="<?php echo $type;?>[]" value="current" />
					<?php endif;?>
				</li>
				<?php endif;?>