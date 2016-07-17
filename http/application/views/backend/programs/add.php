<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

		<div class="programme-head">
			<h1 class="programme-head__title"><?php echo $header;?></h1>
			<a class="ico ico--detal pull-left data-tab-link" data-tab="detal" title="<?php echo lang('program_detal');?>"></a>
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
							<li><span class="tabs__dt tabs__dt" data-tab="exercises"><?php echo lang('exercises');?></span></li>
						</ul>
					</div>
				</div>

				<?php include('_templates.php'); ?>

				<?php echo form_open_multipart('admin/programs/add', array('class'=>'save-form')); ?>

					<input type="hidden" name="redirect" value="">
					<input type="hidden" name="params[tab]" value="">

					<?php include('_app_left.php'); ?>

					<div class="tabs__dd tabs__dd--exercises">
						<div class="l-h">
							<div class="l-h__inner baron">

								<input type="hidden" name="exercises[1][name]" value="<?php echo lang('exercises');?>" />
								<ul class="exercises-my" data-type="exercises[1][data]">

								<div class="baron__track">
									<div class="baron__free">
										<a class="baron__bar"></a>
									</div>
								</div>

							</div>
						</div>
					</div>

				<?php echo form_close(); ?>

			</div>

			<?php include('_app_right.php'); ?>

		</div>

		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('backend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>