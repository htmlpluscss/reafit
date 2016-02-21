<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
						<div class="hide">
							<div class="popup-content--add">
								<div class="exercises-list__item-desc">
									<div class="exercises-list__item-detal-btn">
										<?php if(isset($type) && empty($type)):?>
										<div class="popup__add-to-left">
											<a class="btn"><?php echo lang('add');?></a>
										</div>
										<?php endif;?>
										<a class="btn popup__close"><?php echo lang('close');?></a>
									</div>
									<div class="exercises-list__item-detal clr">
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
									<h3><?php echo $exercise->name;?></h3>
									<?php echo $exercise->description;?>
								</div>
							</div>
						</div>