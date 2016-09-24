<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
						<div class="hide">
							<div class="popup-content--add">
								<div class="exercises-list__item-desc<?php echo (!isset($type) || empty($type)) ? ' in-exercises-list' : '';?>">
									<div class="exercises-list__item-detal-btn">
										<a class="btn exercises-my__save hide-in-list"><?php echo lang('save');?></a>
										<a class="btn exercises-my__save exercises-my__prev hide-in-list"><?php echo lang('prev');?></a>
										<a class="btn exercises-my__save exercises-my__next hide-in-list"><?php echo lang('next');?></a>
										<a class="btn popup__close hide-in-list"><?php echo lang('close');?></a>
									</div>
									<div class="exercises-list__item-detal clr">
										<div class="popup-content__images">
											<?php if($exercise->image_1):?>
											<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
											<?php endif;?>
											<?php if($exercise->image_2):?>
											<img src="<?php echo site_url('images/'.$exercise->image_2);?>" alt="<?php echo $exercise->name;?>" class="hide-in-list show-in-detail">
											<?php endif;?>
											<?php if($exercise->image_3):?>
											<img src="<?php echo site_url('images/'.$exercise->image_3);?>" alt="<?php echo $exercise->name;?>" class="hide-not-in-list hide-in-detail">
											<?php endif;?>
										</div>
										<table class="popup-content__table">
											<tr>
												<td>
													<input placeholder="<?php echo lang('times');?>" data-name="quantity"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[quantity][]"' : '';?> class="input" value="<?php echo (isset($exercise->quantity)) ? $exercise->quantity : '';?>">
													<input placeholder="<?php echo lang('approaches');?>" data-name="approaches"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[approaches][]"' : '';?>  class="input" value="<?php echo (isset($exercise->approaches)) ? $exercise->approaches : '';?>">
													<input placeholder="<?php echo lang('weight');?>" data-name="weight"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[weight][]"' : '';?>  class="input" value="<?php echo (isset($exercise->weight)) ? $exercise->weight : '';?>">
												</td>
												<td>
													<textarea placeholder="<?php echo lang('coment');?>" data-name="comment"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[comment][]"' : '';?> class="input"><?php echo (isset($exercise->comment)) ? $exercise->comment : '';?></textarea>
													<a class="btn"><?php echo lang('add');?></a>
												</td>
											</tr>
										</table>
									</div>
									<h4 class="popup-content__title"><?php echo $exercise->name;?></h4>
									<?php echo $exercise->description;?>
								</div>
							</div>
						</div>