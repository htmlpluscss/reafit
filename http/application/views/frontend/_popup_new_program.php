<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<div class="popup popup--create">
		<div class="popup__box">
			<div class="popup__body">
				<form>
					<h3><?php echo lang('create_new_program');?></h3>
					<p class="clr">
						<label><span><?php echo lang('name');?>:<sup>*</sup></span> <input class="input popup--create__name" maxlength="40"></label>
						<a class="icon-help" title="<?php echo lang('required_tooltip');?>"></a>
					</p>
					<p class="clr">
						<label><span><?php echo lang('email');?>:</span> <input class="input popup--create__email" type="email" data-error="<?php echo lang('mail_not_corect');?>"></label>
						<a class="icon-help" title="<?php echo lang('program_mail_tooltip');?>"></a>
					</p>
					<p class="clr">
						<label><span><?php echo lang('description');?>:</span> <textarea class="input popup--create__textarea"></textarea></label>
						<a class="icon-help" title="<?php echo lang('program_desc_tooltip');?>"></a>
					</p>
					<p><a class="btn popup--create__btn"><?php echo lang('create');?></a></p>
				</form>
			</div>
			<a class="ico ico--close popup__close"></a>
		</div>
	</div>