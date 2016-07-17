<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
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
								<div class="programme-description">
									<p class="programme-body__name">
										<span class="programme-body__name-b"><?php echo $exercise->name;?></span>
										<?php echo $exercise->name_desc;?>
									</p>
									<?php echo $exercise->description;?>
								</div>
							</div>
						</div>