<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

		<div class="programme-head">
			<h1 class="programme-head__title"><?php echo $header;?></h1>
			<a class="ico ico--detal pull-left data-tab-link" data-tab="detal" title="<?php echo lang('program_detal');?>" data-change="0"></a>
			<div class="programme-head__icons">
				<a class="ico ico--fullscreen app-fullscreen" title="<?php echo lang('fullscreen');?>"></a>
			</div>
		</div>

		<div class="app clr">
			<div class="programme-body programme-body--app tabs app-left">

					<?php if(isset($_nav) && !empty($_nav)) echo $_nav; ?>

			<?php $active_tab = (isset($params->tab)) ? (int) $params->tab : 0; ?>
			<?php
				if($active_tab == 0) {
					$active_tab = 8;
				}
			?>
			<?php (isset($tab)) ? $tab : false;?>
				<div class="tabs__nav clr">
					<div class="box">
						<ul>
						<?php if(!empty($tabs)):?>
						<?php $_tab_key = 8;?>
						<?php foreach ($tabs as $key => $tab) :?>
							<li<?php if($key == 0) echo ' class="tabs__li-first"';?>>
								<span class="tabs__dt<?php if($_tab_key == $active_tab) echo ' tabs__dt--active';?>" data-tab="<?php echo $_tab_key++;?>"><?php echo $tab->name;?></span>
							</li>
						<?php endforeach;?>
						<?php endif;?>
						</ul>
					</div>
					<a class="tabs__btn-select"></a>
					<div class="tabs__select"></div>
				</div>

				<?php include('_app_left.php');//echo $_app_left; ?>

				<?php echo form_open_multipart('programs/'.$hash, array('class'=>'save-form spy', 'data-program'=>$hash)); ?>
					<input type="hidden" name="name" class="name-programme--input" value="<?php echo $name;?>">
					<input type="hidden" name="category" class="name-programme--category" value="<?php echo $category;?>">
					<input type="hidden" name="mail" class="name-programme--email" value="<?php echo $mail;?>">
					<input type="hidden" name="description" class="name-programme--textarea" value="<?php echo $mail;?>">
					<input type="hidden" name="redirect" value="">
					<input type="hidden" name="params[tab]" value="">

					<div class="tabs__dd tabs__dd--note note">
						<div class="l-h">
							<div class="l-h__inner">
								<div class="l-h__width l-h__editor">
									<div class="programme-body__h3"><?php echo lang('note');?></div>
									<textarea class="editor" name="note"><?php echo $note;?></textarea>
								</div>
							</div>
						</div>
					</div>

					<?php if(!empty($tabs)):?>
					<?php $_tab_key = 8;?>
					<?php foreach ($tabs as $key => $tab) :?>
					<div class="tabs__dd<?php if($_tab_key == $active_tab) echo ' tabs__dd--active'; if($_tab_key == 8) echo ' tabs__dd--first';?> tabs__dd--<?php echo $_tab_key++;?>">
						<div class="l-h">
							<div class="l-h__inner">
								<input type="hidden" name="exercises[<?php echo $tab->hash;?>][name]" value="<?php echo $tab->name;?>">
								<ul class="exercises-my" data-type="exercises[<?php echo $tab->hash;?>][data]">

								<?php if(!empty($tab->exercises)):?>
									<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('program' => $hash, 'hide_id'=>true, 'exercises'=>$tab->exercises, 'key'=>$key, 'tab'=>$tab, 'type' => 'exercises['.$tab->hash.'][data]'), TRUE);?>
								<?php endif;?>

								</ul>
								<?php $acces_val = (isset($params->access) && isset($params->access[$key])) ? $params->access[$key] : 1; ?>
								<input type="hidden" name="params[access][]" class="access-tab-<?php echo $key;?>" value="<?php echo $acces_val;?>">
							</div>
						</div>
					</div>
					<?php endforeach;?>
					<?php endif;?>
				<?php echo form_close(); ?>

			</div>

			<div class="exercises-body app-right pull-right">

				<div class="search-exercises">

					<div class="search-exercises__filter clr">

						<div class="search-exercises__input pull-left">
							<input id="autocomplete-exercises" class="input" placeholder="<?php echo lang('exercise_search');?>">
							<a class="search-exercises__clear-input hide ico ico--close"></a>
							<a class="ico ico--search"></a>
						</div>

						<a class="btn pull-right tab-exercises-list tab-exercises-list--active ico ico--programs ml-10" title="<?php echo lang('programs');?>"></a>
						<a class="btn pull-right tab-exercises-list ico ico--exercises ml-10" title="<?php echo lang('exercises');?>"></a>
						<a class="btn pull-right search-exercises__btn filter-show"><?php echo lang('filter');?></a>

					</div>
				</div>
				<div class="r-h">
					<div class="r-h__inner">
						<ul class="exercises-list clr">
							<?php if($exercises):?>
							<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('exercises'=>$exercises, 'hide_id'=>false, 'class'=>'exercises-list__item app-right__item popup-box','type'=>false), TRUE);?>
							<?php endif;?>
							<?php if($programs):?>
							<?php //echo $this->load->view('frontend/'.$this->router->class.'/_item_program', array('programs'=>$programs), TRUE);?>
							<?php endif;?>
						</ul>
					</div>
				</div>

			</div>
		</div>

		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>