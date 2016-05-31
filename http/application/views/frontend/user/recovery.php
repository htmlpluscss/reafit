<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<article class="page-login">
			<?php echo form_open('recovery'); ?>
				<h1><?php echo lang('recovery');?></h1>
				<label><?php echo lang('email_lbl');?></label>
				<input name="mail" class="input" type="email" value="<?php echo $mail;?>">
				<p><button class="btn" type="submit"><?php echo lang('recovery_btn');?></button></p>
				<p><?php echo lang('recovery_desc');?></p>
			<?php echo form_close(); ?>

		</article>