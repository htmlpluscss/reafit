<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<article class="page page-login">
			<?php echo form_open('recovery'); ?>
				<h1><?php echo lang('recovery');?></h1>
				<label for="mail"><?php echo lang('email_lbl');?></label>
				<input id="mail" name="mail" class="input" type="email" value="<?php echo $mail;?>">
				<p><label class="btn"><?php echo lang('recovery_btn');?><input type="submit" class="hide"></label></p>
				<p><?php echo lang('recovery_desc');?></p>
			<?php echo form_close(); ?>

		</article>