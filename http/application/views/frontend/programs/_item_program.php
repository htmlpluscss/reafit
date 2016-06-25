<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
			<?php foreach ($programs as $key => $program): ?>
				<?php if(!empty($program->is_admin) || !empty($program->favorite)):?>
				<?php
					if($program->tabs) {
						$_exercises = array();

						foreach ($program->tabs as $key => $tab) {
							if($tab->exercises) {
								foreach ($tab->exercises as $key => $exercise) {
									$_exercises[] = $exercise->hash;
								}
							}
						}
						if(!empty($_exercises)) {
							$_exercises = implode('|', $_exercises);
						} else {
							$_exercises = '';
						}
					} else {
						$_exercises = '';
					}
				?>
				<li
					id="set-<?php echo $program->hash;?>"
					data-id="<?php echo $program->hash;?>"
					class="exercises-list__item exercises-list__item--set app-right__item hide"
					data-exercises="<?php echo $_exercises;?>"
					data-name="<?php echo $program->name;?>"
					data-images="<?php if($program->image) echo $program->image;?>"
					data-favorite="<?php echo $program->favorite;?>"
					>
					<div class="var__exercise-description hide"><?php echo $program->description;?></div>
					<div class="item-img_name"></div>
				</li>
				<?php endif;?>
			<?php endforeach ?>