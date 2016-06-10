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
								<span class="hide-app-right"><?php echo $exercise->name_desc;?></span>
							</div>

<div class="exercises-list-btn-block exercises-list-btn-block--one hide"></div>
							<div class="programme-body__box-icons not-drop">
<?php if(false):?>
								<a class="ico ico--info popup__btn" data-popup="info_item"></a>

								<?php if(isset($type) && !empty($type)):?>
								<a class="ico ico--edit exercise popup__btn" data-popup="add"></a>
								<?php else:?>
								<a class="ico ico--info exercise popup__btn" data-popup="add"></a>
								<?php endif;?>
								<a class="ico ico--add-item exercises-list__add-to-left"></a>

								<a class="ico ico--delete ico-delete-item"></a>

								<a class="ico ico--star icon-toggle-favorite<?php echo (!empty($exercise->favorite)) ? ' active':'';?>" data-url="<?php echo base_url('exercises/favorite/'.$exercise->hash);?>"></a>

								<a class="icon-down-bold ico-move-item"></a>
								<a class="icon-up-bold ico-move-item"></a>

								<a class="ico ico--related popup__btn" data-popup="related"></a>
								<a class="ico ico--info popup__btn" data-popup="add"></a>
<?php endif;?>
								<?php if(!empty($exercise->video)):?>
								<a class="ico ico--play play-video" data-popup="play"></a>
								<?php endif;?>
								<a class="ico ico--info popup__btn" data-popup="add"></a>
								<?php if($exercise->progress):?>
								<a class="ico ico--progress popup__btn" data-popup="progress"></a>
								<?php endif;?>
								<?php if($exercise->related):?>
								<a class="ico ico--related popup__btn" data-popup="related"></a>
								<?php endif;?>
								<a class="ico ico--delete ico-delete-item hide-app-right"></a>
							</div>
						</div>
						<div class="programme-img">
							<?php if($exercise->image_1):?>
							<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
							<?php if($exercise->image_3):?>
							<img class="hide-app-right" src="<?php echo site_url('images/'.$exercise->image_3);?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
						</div>
					</div>

					<?php //echo $this->load->view('frontend/'.$this->router->class.'/_item_detail', array('exercise'=>$exercise, 'key'=>$key, 'tab'=>isset($tab)? $tab : false, 'type' => (!isset($type)) ? false : $type ), TRUE);?>
					<div class="hide">
						<div class="popup-content--add">
							<div class="programme-img">
								<?php if($exercise->image_1):?>
								<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
								<?php endif;?>
								<?php if($exercise->image_2):?>
								<img src="<?php echo site_url('images/'.$exercise->image_2);?>" alt="<?php echo $exercise->name;?>">
								<?php endif;?>
								<?php if($exercise->image_3):?>
								<img src="<?php echo site_url('images/'.$exercise->image_3);?>" alt="<?php echo $exercise->name;?>">
								<?php endif;?>
							</div>
							<div class="programme-body__detal">
								<table class="programme-table programme-table--input">
									<tr>
										<td>
											<input data-name="quantity"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[quantity][]"' : '';?> class="input" value="<?php echo (isset($exercise->quantity) && $exercise->quantity != '0') ? $exercise->quantity : '';?>" placeholder="<?php echo lang('times');?>">
										</td>
										<td rowspan="2">
											<textarea data-name="comment"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[comment][]"' : '';?> class="input" placeholder="<?php echo lang('coment');?>"><?php echo (isset($exercise->comment)) ? $exercise->comment : '';?></textarea>
										</td>
									</tr>
									<tr>
										<td>
											<input data-name="approaches"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[approaches][]"' : '';?>  class="input" value="<?php echo (isset($exercise->approaches) && $exercise->approaches != '0') ? $exercise->approaches : '';?>" placeholder="<?php echo lang('approaches');?>">
										</td>
									</tr>
									<tr>
										<td>
											<input data-name="weight"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[weight][]"' : '';?>  class="input" value="<?php echo (isset($exercise->weight) && $exercise->weight != '0') ? $exercise->weight : '';?>" placeholder="<?php echo lang('weight');?>">
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
									<span class="programme-body__name-b"><?php echo $exercise->name;?></span>
									<?php echo $exercise->name_desc;?>
								</p>
								<?php echo $exercise->description;?>
							</div>


							<div class="hide exercises-list__item-desc<?php echo (!isset($type) || empty($type)) ? ' in-exercises-list' : '';?>">
								<div class="exercises-list__item-detal-btn">
									<div class="popup__add-to-left hide-not-in-list">
										<a class="btn"><?php echo lang('add');?></a>
									</div>
									<a class="btn exercises-my__save hide-in-list"><?php echo lang('save');?></a>
									<a class="btn exercises-my__save exercises-my__prev hide-in-list"><?php echo lang('prev');?></a>
									<a class="btn exercises-my__save exercises-my__next hide-in-list"><?php echo lang('next');?></a>
									<a class="btn popup__close"><?php echo lang('close');?></a>
								</div>
								<div class="exercises-list__item-detal">

								</div>
							</div>

						</div>
					</div>

					<?php if(isset($type) && !empty($type)):?>
					<input type="hidden" name="<?php echo $type;?>[]" value="<?php echo $exercise->hash;?>">
					<?php endif;?>
				</li>
			<?php endforeach ?>