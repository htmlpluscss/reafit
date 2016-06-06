<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

	<section>

		<div class="programme-head">
			<h1 class="programme-head__title"><?php echo $header;?></h1>
		</div>

		<div id="programme-body" class="programme-body programme-body--print">

			<?php if(isset($_nav) && !empty($_nav)) echo $_nav; ?>

			<?php if(!empty($tabs)):?>

			<?php foreach ($tabs as $key => $tab) :?>

				<div class="programme-body--print__group">

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

					<article class="programme-body__item">
						<h2 class="programme-body__name">
							<span class="programme-body__name-b"><?php echo $exercise_key + 1; ?>. <?php echo $exercise->name;?></span>
							<?php echo $exercise->name_desc;?>
						</h2>
						<div class="programme-body__box clr">
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
							<div class="programme-body__detal">
								<table class="programme-table">
									<tr>
										<th class="programme-table__th programme-table__bt0"><?php echo lang('times');?></th>
										<td class="programme-table__td programme-table__bl0 programme-table__bt0"><?php echo $exercise->quantity;?></td>
										<td class="programme-table__td programme-table__bt0 programme-table__td--coment" rowspan="3">
											<div class="programme-table__td--coment-box">
												<div class="programme-table__td--coment-b"><?php echo lang('coment');?></div>
												<?php echo $exercise->comment;?>
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
							<div class="programme-description">
								<?php echo $exercise->description;?>
							</div>
						</div>
					</article>
					<?php endforeach;?>

			<?php endif;?>
			<?php endif;?>
					<a class="ico ico--hidden programme-body--print__group-toggle" title="<?php echo lang('hidden');?>"></a>
					<a class="ico ico--visible programme-body--print__group-toggle" title="<?php echo lang('visible');?>"></a>
				</div>
			<?php endforeach;?>
			<?php endif;?>

		</div>

	</section>