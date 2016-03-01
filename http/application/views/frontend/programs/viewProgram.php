<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="app-left pull-left tabs app-left--view">

			<div class="tabs__nav clr">
					<ul>
					<?php if(!empty($tabs)):?>
					<?php foreach ($tabs as $key => $tab) :?>
						<li><span class="tabs__dt tabs__dt<?php if($key == 0) { echo ' tabs__dt--active';}?>" data-tab="<?php echo $key+1;?>"><?php echo $tab->name;?></span></li>
					<?php endforeach;?>
					<?php endif;?>
					</ul>
			</div>
			<?php if(!empty($tabs)):?>
			<?php foreach ($tabs as $key => $tab) :?>
			<div class="tabs__dd tabs__dd--<?php echo $key + 1;?><?php if($key == 0) { echo ' tabs__dd--active';}?>">
				<ul class="l-h">
					<?php if(!empty($tab->exercises)):?>
					<?php foreach ($tab->exercises as $exercise_key => $exercise) :?>
					<li id="one-<?php echo $key.'-'.$exercise_key;?>" class="exercises-my__item popup-box clr" data-video="<?php echo $exercise->video;?>">
						<span class="exercises-list__name"><?php echo $exercise->name;?> <span class="hide"><?php echo $exercise->name_desc;?></span></span>
						<span class="exercises-list__img">
							<?php if($exercise->image_1):?>
							<img src="<?php echo site_url('images/'.$exercise->image_1);?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
							<?php if($exercise->image_2):?>
							<img src="<?php echo site_url('images/'.$exercise->image_2);?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
							<?php if($exercise->image_3):?>
							<img src="<?php echo site_url('images/'.$exercise->image_3);?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
						</span>
						<div class="exercises-list__item-detal clr">
							<table>
								<tr>
									<th><?php echo lang('qty');?><br> <?php echo lang('times');?></th>
									<th><?php echo lang('qty');?><br> <?php echo lang('approaches');?></th>
									<th><?php echo lang('weight');?></th>
								</tr>
								<tr>
									<td><span><?php echo $exercise->quantity;?></span></td>
									<td><span><?php echo $exercise->approaches;?></span></td>
									<td><span><?php echo $exercise->weight;?></span></td>
								</tr>
							</table>
							<table>
								<tr>
									<th><?php echo lang('coment');?></th>
								</tr>
								<tr>
									<td><span><?php echo $exercise->comment;?></span></td>
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
						<div class="exercises-list-btn-block exercises-list-btn-block--one hide not-drop">
							<a class="icon-info popup__btn exercise" data-popup="add"></a>
							<?php if(!empty($exercise->video)):?>
							<a class="icon-play play-video" data-popup="play"></a>
							<?php endif;?>
						</div>
					</li>
					<?php endforeach;?>
					<?php endif;?>
				</ul>
			</div>
			<?php endforeach;?>
			<?php endif;?>
		</div>

		<ul class="hide icon-fullscreen">
			<?php  echo $this->load->view('frontend/'.$this->router->class.'/_menu_view_print', array('fullscreen'=>true), TRUE);?>
		</ul>