<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
						<div class="hide">
							<div class="popup-content--add">
								<div class="exercises-list__item-desc">
									<div class="exercises-list__item-detal-btn">
										<div class="popup__add-to-left">
											<a class="btn"><?php echo lang('add');?></a>
										</div>
										<a class="btn" href="<?php echo site_url('admin/programs/'.$exercise->hash);?>"><?php echo lang('edit');?></a>
										<a class="btn popup__close"><?php echo lang('close');?></a>
									</div>
									<div class="exercises-list__item-detal clr">
										<?php if($exercise->image):?>
										<img src="<?php echo site_url('images/'.$exercise->image);?>" alt="<?php echo $exercise->name;?>">
										<?php endif;?>
									</div>
									<h3><?php echo $exercise->name;?></h3>
									<?php echo $exercise->description;?>
								</div>
							</div>
						</div>