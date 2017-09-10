<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
		<article class="page page-login">
			<?php echo form_open('login'); ?>
				<h1><?php echo lang('login');?></h1>
				<label for="mail"><?php echo lang('email_lbl');?></label>
				<input id="mail" name="mail" class="input" type="email" value="<?php echo $mail;?>">
				<label for="pass"><?php echo lang('password_lbl');?></label>
				<input id="pass" name="pass" class="input" type="password">
				<label class="checkbox"><input name="remember" type="checkbox" <?php echo ($remember)? 'checked="checked" ' : '';?>value="1"> <?php echo lang('remember');?></label>
				<p><label class="btn"><?php echo lang('login_btn');?><input type="submit" class="hide"></label></p>
				<p class="clr"><a href="<?php echo site_url('recovery');?>" class="pull-right"><?php echo lang('restore_link');?></a><a href="<?php echo site_url('registration');?>" class="pull-left"><?php echo lang('register_link');?></a></p>
			<?php echo form_close(); ?>

		</article>