<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

		<div class="programme-head">
			<h1 class="programme-head__title"><?php echo $header;?></h1>
			<div class="programme-head__icons">
				<a class="ico ico--fullscreen app-fullscreen" title="<?php echo lang('fullscreen');?>"></a>
			</div>
		</div>

		<div class="app clr">

			<div class="programme-body programme-body--app tabs app-left">

				<?php if(isset($_nav) && !empty($_nav)) echo $_nav; ?>

				<div class="tabs__nav clr">
					<div class="box">
						<ul>
							<li class="tabs__li-first"><span class="tabs__dt tabs__dt--active" data-tab="name"><?php echo lang('name');?></span></li>
							<li><span class="tabs__dt tabs__dt" data-tab="media"><?php echo lang('media');?></span></li>
							<li><span class="tabs__dt tabs__dt" data-tab="description"><?php echo lang('description');?></span></li>
							<?php if(!empty($tabs)):?>
							<?php foreach ($tabs as $key => $tab) :?>
							<li><span class="tabs__dt tabs__dt" data-tab="<?php echo $tab->hash;?>"><?php echo $tab->name;?></span></li>
							<?php endforeach;?>
							<?php endif;?>
						</ul>
					</div>
					<a class="tabs__btn-select"></a>
					<div class="tabs__select"></div>
				</div>

				<?php include('_templates.php'); ?>

				<?php echo form_open_multipart('admin/programs/'.$hash, array('class'=>'save-form')); ?>

				<?php include('_app_left.php'); ?>

				<?php echo form_close(); ?>

			</div>

				<?php include('_app_right.php'); ?>

		</div>

		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('backend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>