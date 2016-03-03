<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="app-left pull-left tabs app-left--view">
			<?php if(!empty($tabs)):?>
			<?php foreach ($tabs as $key => $tab) :?>
			<div class="tabs__nav clr">
				<ul>
					<li><span class="tabs__dt tabs__dt--active"><?php echo $tab->name;?></span></li>
				</ul>
			</div>
			<?php if(!empty($tab->exercises)):?>
			<div class="tabs__dd tabs__dd--active">
				<ul class="l-h l-h--height-auto">
					<?php foreach ($tab->exercises as $exercise_key => $exercise) :?>
					<li class="exercises-my__item popup-box clr">
						<span class="exercises-list__name"><?php echo $exercise->name;?>&nbsp;<span class="hide"><?php echo $exercise->name_desc;?></span></span>
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
						<div class="popup-content--add">
							<div class="exercises-list__item-desc">
								<h3><?php echo $exercise->name;?></h3>
								<?php echo $exercise->description;?>
							</div>
						</div>
					</li>
					<?php endforeach;?>
				</ul>
			</div>
			<?php endif;?>
			<?php endforeach;?>
			<?php endif;?>
		</div>