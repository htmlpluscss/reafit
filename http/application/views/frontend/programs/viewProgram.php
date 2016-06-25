<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

		<div class="programme-head">
			<h1 class="programme-head__title"><?php echo $header;?></h1>
			<div class="programme-head__icons">
				<a class="ico ico--fullscreen app-fullscreen" title="<?php echo lang('fullscreen');?>"></a>
			</div>
		</div>

		<div class="programme-body tabs app-left">

				<?php if(isset($_nav) && !empty($_nav)) echo $_nav; ?>

				<div class="tabs__nav clr">
					<div class="box">
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
							<li<?php if($key == 0) echo ' class="tabs__li-first"';?>><span class="tabs__dt tabs__dt<?php if($key == 0) { echo ' tabs__dt--active';}?>" data-tab="<?php echo $key+1;?>"><?php echo $tab->name;?></span></li>
						<?php endif;?>
						<?php endforeach;?>
						<?php endif;?>
						</ul>
					</div>
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
					<div class="l-h">
					<div class="l-h__inner baron">
						<ul>
							<?php if(!empty($tab->exercises)):?>
							<?php foreach ($tab->exercises as $exercise_key => $exercise) :?>
							<li class="exercises-my__item">
								<div class="programme-body__box clr">
									<div class="popup-box">
										<div class="popup-hidden programme-body__box-head">
											<div class="programme-body__box-name">
												<span class="programme-body__box-title"><?php echo $exercise->name;?></span>
												<?php echo $exercise->name_desc;?>
											</div>
											<div class="programme-body__box-icons">
												<a class="ico ico--info popup__btn popup__btn--view"></a>
												<?php if(!empty($exercise->video)):?>
												<a class="ico ico--play play-video" data-video="<?php echo $exercise->video; ?>"></a>
												<?php endif;?>
											</div>
										</div>
										<div class="programme-img">
											<?php if($exercise->image_1):?>
											<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
											<?php endif;?>
											<?php if($exercise->image_2):?>
											<span class="popup-visible hide">
												<img src="<?php echo site_url('images/'.$exercise->image_2);?>" alt="<?php echo $exercise->name;?>">
											</span>
											<?php endif;?>
											<?php if($exercise->image_3):?>
											<img src="<?php echo site_url('images/'.$exercise->image_3);?>" alt="<?php echo $exercise->name;?>">
											<?php endif;?>
										</div>
										<div class="popup-hidden programme-body__detal">
											<table class="programme-table">
												<tr>
													<th class="programme-table__th programme-table__bt0"><?php echo lang('times');?></th>
													<td class="programme-table__td programme-table__bl0 programme-table__bt0"><?php echo $exercise->quantity;?></td>
													<td class="programme-table__td programme-table__bt0 programme-table__td--coment" rowspan="3">
														<div class="programme-table__td--coment-box">
															<div class="programme-table__td--coment-inner">
																<div class="programme-table__td--coment-b"><?php echo lang('coment');?></div>
																<?php echo $exercise->comment;?>
															</div>
														</div>
													</td>
												</tr>
												<tr>
													<th class="programme-table__th programme-table__bg"><?php echo lang('approaches');?></th>
													<td class="programme-table__td programme-table__bl0 programme-table__bg"><?php echo $exercise->approaches;?></td>
												</tr>
												<tr>
													<th class="programme-table__th"><?php echo lang('weight');?></th>
													<td class="programme-table__td programme-table__bl0"><?php echo $exercise->weight;?></td>
												</tr>
											</table>
										</div>
										<div class="popup-visible hide">
											<div class="programme-description">
												<p class="programme-body__name">
													<span class="programme-body__name-b"><?php echo $exercise->name;?></span>
													<?php echo $exercise->name_desc;?>
												</p>
												<?php echo $exercise->description;?>
											</div>
										</div>
									</div>
								</div>
							</li>
							<?php endforeach;?>
							<?php endif;?>
						</ul>
						<div class="baron__track">
							<div class="baron__free">
								<a class="baron__bar"></a>
							</div>
						</div>
					</div>
					</div>
				</div>
				<?php endif;?>
				<?php endforeach;?>
				<?php endif;?>

		</div>

		<ul class="hide icon-fullscreen">
			<?php  echo $this->load->view('frontend/'.$this->router->class.'/_menu_view_print', array('fullscreen'=>true), TRUE);?>
		</ul>