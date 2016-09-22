<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

	<?php $tabsHide = $header==$tabs[0]->name && count($tabs)==1 ? true : false; ?>

		<div class="programme-head">
			<h1 class="programme-head__title"><?php echo $header;?></h1>
			<a class="ico ico--detal pull-left data-tab-link" data-tab="detal" title="<?php echo lang('program_detal');?>" data-change="0"></a>
			<div class="programme-head__icons">
				<a class="ico ico--fullscreen app-fullscreen" title="<?php echo lang('fullscreen');?>"></a>
			</div>
		</div>

		<div class="app clr">

			<div class="programme-body programme-body--app tabs app-left<?php if ($tabsHide) echo ' programme-body--one-tab'; ?>">

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

				<form class="send-email-form hide" action="<?php echo base_url('programs/mail/'.$hash);?>">
					<input name="mail[]" class="send-email-form__email">
					<div class="send-email-form__error-text msg-popup"><?php echo lang('msg_send_email');?></div>
				</form>

				<?php include('_templates.php'); ?>

				<?php echo form_open_multipart('programs/'.$hash, array('class'=>'save-form spy', 'data-program'=>$hash)); ?>

					<input type="hidden" name="redirect" value="">
					<input type="hidden" name="params[tab]" value="">

					<?php include('_app_left.php');//echo $_app_left; ?>

					<div class="tabs__dd tabs__dd--note note">
						<div class="l-h">
							<div class="l-h__inner baron">
								<div class="l-h__width l-h__editor">
									<div class="programme-body__h3"><?php echo lang('note');?></div>
									<textarea class="editor" name="note"><?php echo $note;?></textarea>
								</div>
								<div class="baron__track">
									<div class="baron__free">
										<a class="baron__bar"></a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<?php if(!empty($tabs)):?>
					<?php $_tab_key = 8;?>
					<?php foreach ($tabs as $key => $tab) :?>
					<div class="tabs__dd<?php if($_tab_key == $active_tab) echo ' tabs__dd--active'; if($_tab_key == 8) echo ' tabs__dd--first';?> tabs__dd--<?php echo $_tab_key++;?>">
						<div class="l-h">
							<div class="l-h__inner baron">
								<input type="hidden" name="exercises[<?php echo $tab->hash;?>][name]" value="<?php echo $tab->name;?>">
								<?php $acces_val = (isset($params->access) && isset($params->access[$key])) ? $params->access[$key] : 1; ?>
								<input type="hidden" name="params[access][]" class="access-tab-<?php echo $key;?>" value="<?php echo $acces_val;?>">
								<ul class="exercises-my" data-type="exercises[<?php echo $tab->hash;?>][data]">

								<?php if(!empty($tab->exercises)):?>
									<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('program' => $hash, 'exercises'=>$tab->exercises, 'key'=>$key, 'tab'=>$tab, 'type' => 'exercises['.$tab->hash.'][data]'), TRUE);?>
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
					<?php endforeach;?>
					<?php endif;?>
				<?php echo form_close(); ?>

			</div>

			<?php include('_app_right.php'); ?>

		</div>

		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>