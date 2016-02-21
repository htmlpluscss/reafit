<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
						<div class="hide">
							<div class="popup-content--add">
								<div class="exercises-list__item-desc<?php echo (!isset($type) || empty($type)) ? ' in-exercises-list' : '';?>">
									<div class="exercises-list__item-detal-btn">
										<div class="popup__add-to-left hide-not-in-list">
											<a class="btn"><?php echo lang('add');?></a>
										</div>
										<a class="btn exercises-my__save hide-in-list"><?php echo lang('save');?></a>
										<a class="btn exercises-my__save exercises-my__prev hide-in-list"><?php echo lang('prev');?></a>
										<a class="btn exercises-my__save exercises-my__next hide-in-list"><?php echo lang('next');?></a>
										<a class="btn popup__close"><?php echo lang('close');?></a>
									</div>
									<div class="exercises-list__item-detal clr">
										<?php if($exercise->image_1):?>
										<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
										<?php endif;?>
										<?php if($exercise->image_2):?>
										<img src="<?php echo site_url('images/'.$exercise->image_2);?>" alt="<?php echo $exercise->name;?>">
										<?php endif;?>
										<table>
											<tr>
												<th><?php echo lang('qty');?><br> <?php echo lang('times');?></th>
												<th><?php echo lang('qty');?><br> <?php echo lang('approaches');?></th>
												<th><?php echo lang('weight');?></th>
											</tr>
											<tr>
												<td><input data-name="quantity"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[quantity][]"' : '';?> class="input" value="<?php echo (isset($exercise->quantity)) ? $exercise->quantity : '';?>"></td>
												<td><input data-name="approaches"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[approaches][]"' : '';?>  class="input" value="<?php echo (isset($exercise->approaches)) ? $exercise->approaches : '';?>"></td>
												<td><input data-name="weight"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[weight][]"' : '';?>  class="input" value="<?php echo (isset($exercise->weight)) ? $exercise->weight : '';?>"></td>
											</tr>
											<tr>
												<th colspan="3"><?php echo lang('coment');?></th>
											</tr>
											<tr>
												<td colspan="3">
													<textarea data-name="comment"<?php echo (isset($tab) && isset($tab->hash)) ? ' name="'.$type.'[comment][]"' : '';?> class="input"><?php echo (isset($exercise->comment)) ? $exercise->comment : '';?></textarea>
												</td>
											</tr>
										</table>
									</div>
									<h3><?php echo $exercise->name;?></h3>
									<?php echo $exercise->description;?>
								</div>
							</div>
						</div>