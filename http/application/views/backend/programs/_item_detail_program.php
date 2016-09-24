<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
						<div class="hide">
							<div class="popup-content--add">
								<?php if($exercise->image):?>
								<div class="programme-img">
									<img src="<?php echo site_url('images/'.$exercise->image);?>" alt="<?php echo $exercise->name;?>">
								</div>
								<?php endif;?>
								<div class="programme-body__detal w200">
									<a class="btn btn--popup" href="<?php echo site_url('admin/programs/'.$exercise->hash);?>"><?php echo lang('edit');?></a>
									<a class="btn btn--gray btn--popup popup__close"><?php echo lang('close');?></a>
								</div>
								<div class="programme-description">
									<p class="programme-body__name">
										<span class="var__exercise-name programme-body__name-b"><?php echo $exercise->name;?></span>
									</p>
									<div class="var__exercise-description"><?php echo $exercise->description;?></div>
								</div>
							</div>
						</div>