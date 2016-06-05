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
				<li <?php echo (!isset($hide_id) || (isset($hide_id) && empty($hide_id))) ? 'id="one-'. $exercise->hash .'" ' : '';?> class="<?php echo $class;?>" data-filter="<?php echo (!empty($exercise->tags)) ? implode(',', $exercise->tags) . ',' . $exercise->category : $exercise->category;?>" data-video="<?php echo $exercise->video;?>" data-related="<?php echo $_related;?>" data-progress="<?php echo $_progress;?>" data-id="<?php echo $exercise->hash;?>">

					<div class="programme-body__box clr">
						<div class="programme-body__box-head">
							<div class="programme-body__box-name">
								<span class="programme-body__box-title"><?php echo $exercise->name;?></span>
								<?php echo $exercise->name_desc;?>
							</div>

<div class="exercises-list-btn-block exercises-list-btn-block--one hide"></div>
							<div class="programme-body__box-icons not-drop">
<?php if(false):?>
								<?php if(!empty($exercise->video)):?>
								<a class="ico ico--play play-video" data-popup="play"></a>
								<?php endif;?>
								<a class="ico ico--info popup__btn" data-popup="info_item"></a>

								<?php if(isset($type) && !empty($type)):?>
								<a class="ico ico--edit exercise popup__btn" data-popup="add"></a>
								<?php else:?>
								<a class="ico ico--info exercise popup__btn" data-popup="add"></a>
								<?php endif;?>
								<a class="ico ico--add-item exercises-list__add-to-left"></a>
								<?php if($exercise->progress):?>
								<a class="ico ico--progress popup__btn" data-popup="progress"></a>
								<?php endif;?>
								<a class="ico ico--delete ico-delete-item"></a>
								<?php if($exercise->related):?>
								<a class="ico ico--related popup__btn" data-popup="related"></a>
								<?php endif;?>
								<a class="ico ico--star icon-toggle-favorite<?php echo (!empty($exercise->favorite)) ? ' active':'';?>" data-url="<?php echo base_url('exercises/favorite/'.$exercise->hash);?>"></a>

								<a class="icon-down-bold ico-move-item"></a>
								<a class="icon-up-bold ico-move-item"></a>

								<a class="ico ico--related popup__btn" data-popup="related"></a>
								<a class="ico ico--info exercise popup__btn" data-popup="add"></a>
<?php endif;?>
								<a class="ico ico--play play-video" data-popup="play"></a>
								<a class="ico ico--progress popup__btn" data-popup="progress"></a>
								<a class="ico ico--delete ico-delete-item"></a>
								<a class="ico ico--related popup__btn" data-popup="related"></a>
								<a class="ico ico--info exercise popup__btn" data-popup="add"></a>
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

					<?php //echo $this->load->view('frontend/'.$this->router->class.'/_item_detail', array('exercise'=>$exercise, 'key'=>$key, 'tab'=>isset($tab)? $tab : false, 'type' => (!isset($type)) ? false : $type ), TRUE);?>

					<?php if(isset($type) && !empty($type)):?>
					<input type="hidden" name="<?php echo $type;?>[]" value="<?php echo $exercise->hash;?>">
					<?php endif;?>
				</li>
			<?php endforeach ?>