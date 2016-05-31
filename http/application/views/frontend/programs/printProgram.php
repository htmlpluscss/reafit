<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

	<section>

		<h1 class="programme-head"><?php echo $header;?></h1>

		<div id="programme-body" class="programme-body programme-body--print clr">

			<?php if(isset($_nav) && !empty($_nav)) echo $_nav; ?>

			<?php if(!empty($tabs)):?>
			<?php foreach ($tabs as $key => $tab) :?>

					<?php
						$acces_val = true;
						if(isset($params->access) && isset($params->access[$key])) {
							$acces_val = (bool) $params->access[$key];
						}
					?>
					<?php if($acces_val):?>
					<h2 class="programme-body__h2"><?php echo $tab->name;?></h2>
					<?php endif;?>

			<?php if(!empty($tab->exercises)):?>
			<?php
				$acces_val = true;
				if(isset($params->access) && isset($params->access[$key])) {
					$acces_val = (bool) $params->access[$key];
				}
			?>
			<?php if($acces_val):?>

					<?php foreach ($tab->exercises as $exercise_key => $exercise) : ?>

					<article class="programme-body--print__item<?php if ($exercise_key + 1 == count($tab->exercises)) echo ' programme-body--print__item--last';?>">
						<h2 class="programme-body--print__name"><span><?php echo $exercise_key + 1; ?>. <?php echo $exercise->name;?></span> <?php echo $exercise->name_desc;?></h2>
						<div class="programme-body--print__box clr">
							<div class="programme-body--print__img">
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
							<div class="programme-body--print__detal">
								<table>
									<tr>
										<th><?php echo lang('times');?></th>
										<td><?php echo $exercise->quantity;?></td>
										<th rowspan="3">
											<b><?php echo lang('coment');?></b>
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
							<div class="programme-body--print__description">
								<?php echo $exercise->description;?>
							</div>
						</div>
					</article>
					<?php endforeach;?>

			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			<?php endif;?>

		</div>

	</section>