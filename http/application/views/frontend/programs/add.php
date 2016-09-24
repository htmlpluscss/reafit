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
							<li class="tabs__li-first placeholder"><span class="tabs__dt"><i class="ico ico--plusik"></i></span></li>
						</ul>
					</div>
					<a class="tabs__btn-select"></a>
					<div class="tabs__select"></div>
				</div>

<?php /* ?>
				<form class="send-email-form hide" action="{{programs/mail/'.$hash'}}">
					<input name="mail[]" class="send-email-form__email">
					<div class="send-email-form__error-text msg-popup"><?php echo lang('msg_send_email');?></div>
				</form>
<?php */ ?>

				<?php include('_templates.php'); ?>

				<?php echo form_open_multipart('programs/add', array('class'=>'save-form spy')); ?>

					<input type="hidden" name="redirect" value="">
					<input type="hidden" name="params[tab]" value="">

					<?php include('_app_left.php');//echo $_app_left; ?>

				<?php echo form_close(); ?>

			</div>

			<?php include('_app_right.php'); ?>

		</div>

		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>