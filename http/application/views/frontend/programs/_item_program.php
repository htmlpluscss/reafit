<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
			<?php foreach ($programs as $key => $program): ?>
				<?php if(!empty($program->is_admin) || !empty($program->favorite)):?>
				<?php
					if($program->tabs) {
						$_exercises = array();

						foreach ($program->tabs as $key => $tab) {
							if($tab->exercises) {
								foreach ($tab->exercises as $key => $exercise) {
									$_exercises[] = '#one-'.$exercise->hash;
								}
							}
						}
						if(!empty($_exercises)) {
							$_exercises = implode(',', $_exercises);
						} else {
							$_exercises = '';
						}
					} else {
						$_exercises = '';
					}
				?>
				<li id="set-<?php echo $program->hash;?>" class="exercises-list__item exercises-list__item--set popup-box" data-exercises="<?php echo $_exercises;?>">
					<span class="exercises-list__name"><?php echo $program->name;?></span>
					<span class="exercises-list__img">
						<?php if(!empty($program->image)):?>
						<img src="<?php echo site_url('images/'.$program->image);?>" alt="<?php echo $program->name;?>">
						<?php endif;?>
					</span>
					<div class="exercises-list-btn-block exercises-list-btn-block--set hide not-drop">
						<a class="icon-info popup__btn" data-popup="add"></a>
						<a class="icon-left-bold exercises-list__add-to-left exercises-list__add-to-left--set"></a>
						<a class="icon-star icon-toggle-favorite<?php echo (!empty($program->favorite)) ? ' active':'';?>" data-url="<?php echo base_url('programs/favorite/'.$program->hash);?>"></a>
					</div>
					<div class="hide">
						<div class="popup-content--add">
							<div class="exercises-list__item-desc">
								<div class="exercises-list__item-detal-btn">
									<div class="popup__add-to-left popup__add-to-left--set" data-id="#set-<?php echo $program->hash;?>">
										<a class="btn"><?php echo lang('add');?></a>
									</div>
									<a class="btn popup__close"><?php echo lang('close');?></a>
								</div>
								<?php if(!empty($program->image)):?>
								<div class="exercises-list__item-detal clr">
									<img src="<?php echo site_url('images/'.$program->image);?>" alt="<?php echo $program->name;?>">
								</div>
								<?php endif;?>
								<h3><?php echo $program->name;?></h3>
								<?php echo $program->description;?>
							</div>
						</div>
					</div>
				</li>
				<?php endif;?>
			<?php endforeach ?>