<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

		<div class="programme-head">
			<p class="name-programme"><?php echo $header;?></p>
		</div>

		<div class="programme-body clr">

			<div class="app-left pull-left tabs app-left--view">

				<?php if(isset($_nav) && !empty($_nav)) echo $_nav; ?>

				<div class="tabs__nav clr">
						<ul>
						<?php if(!empty($tabs)):?>
						<?php foreach ($tabs as $key => $tab) :?>
						<?php
							$acces_val = true;
							if(isset($params->access) && isset($params->access[$key])) {
								$acces_val = (bool) $params->access[$key];
							}
						?>
						<?php if($acces_val):?>
							<li><span class="tabs__dt tabs__dt<?php if($key == 0) { echo ' tabs__dt--active';}?>" data-tab="<?php echo $key+1;?>"><?php echo $tab->name;?></span></li>
						<?php endif;?>
						<?php endforeach;?>
						<?php endif;?>
						</ul>
				</div>
				<?php if(!empty($tabs)):?>
				<?php foreach ($tabs as $key => $tab) :?>
				<?php
					$acces_val = true;
					if(isset($params->access) && isset($params->access[$key])) {
						$acces_val = (bool) $params->access[$key];
					}
				?>
				<?php if($acces_val):?>
				<div class="tabs__dd tabs__dd--<?php echo $key + 1;?><?php if($key == 0) { echo ' tabs__dd--active';}?>">
					<ul class="l-h">
						<?php if(!empty($tab->exercises)):?>
						<?php foreach ($tab->exercises as $exercise_key => $exercise) :?>
						<li id="one-<?php echo $key.'-'.$exercise_key;?>" class="exercises-my__item popup-box clr" data-video="<?php echo $exercise->video;?>">
							<div class="exercises-list__desc">
								<div class="exercises-list__desc-text">
									<span class="exercises-list__name"><?php echo $exercise->name;?></span>
									<?php echo $exercise->name_desc;?>
								</div>
								<div class="exercises-list-btn-block exercises-list-btn-block--one hide not-drop">
									<a class="ico ico--info popup__btn exercise" data-popup="add"></a>
									<?php //if(!empty($exercise->video)):?>
									<a class="ico ico--play play-video" data-popup="play"></a>
									<?php //endif;?>
								</div>
							</div>
							<div class="exercises-list__img">
								<?php if($exercise->image_1):?>
								<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
								<?php endif;?>
								<?php if($exercise->image_2):?>
								<img class="exercises-list__img-second" src="<?php echo site_url('images/'.$exercise->image_2);?>" alt="<?php echo $exercise->name;?>">
								<?php endif;?>
								<?php if($exercise->image_3):?>
								<img src="<?php echo site_url('images/'.$exercise->image_3);?>" alt="<?php echo $exercise->name;?>">
								<?php endif;?>
							</div>
							<div class="exercises-list__item-detal clr">
								<table>
									<tr>
										<th><?php echo lang('times');?></th>
										<td><?php echo $exercise->quantity;?></td>
										<th rowspan="3">
											<b><?php echo lang('coment');?>:</b>
											<div class="exercises-list__item-detal-coment">
												<div class="exercises-list__item-detal-coment__bg">
													<?php echo $exercise->comment;?>
												</div>
											</div>
										</th>
									</tr>
									<tr>
										<th><?php echo lang('approaches');?></th>
										<td><?php echo $exercise->approaches;?></td>
									</tr>
									<tr>
										<th><?php echo lang('weight');?></th>
										<td><?php echo $exercise->weight;?></td>
									</tr>
								</table>
							</div>
							<div class="hide">
								<div class="popup-content--add">
									<div class="exercises-list__item-desc">
										<div class="exercises-list__item-detal-btn">
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
						</li>
						<?php endforeach;?>
						<?php endif;?>
					</ul>
				</div>
				<?php endif;?>
				<?php endforeach;?>
				<?php endif;?>
			</div>
		</div>

		<ul class="hide icon-fullscreen">
			<?php  echo $this->load->view('frontend/'.$this->router->class.'/_menu_view_print', array('fullscreen'=>true), TRUE);?>
		</ul>