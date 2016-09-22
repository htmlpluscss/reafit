<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
		<article class="page-login">
			<?php echo form_open('login'); ?>
				<h1><?php echo lang('login');?></h1>
				<label><?php echo lang('email_lbl');?></label>
				<input name="mail" class="input" type="email" value="<?php echo $mail;?>">
				<label><?php echo lang('password_lbl');?></label>
				<input name="pass" class="input" type="password">
				<label class="checkbox"><input name="remember" type="checkbox" <?php echo ($remember)? 'checked="checked" ' : '';?>value="1"> <?php echo lang('remember');?></label>
				<p><button class="btn" type="submit"><?php echo lang('login_btn');?></button></p>
				<p><a href="<?php echo site_url('recovery');?>"><?php echo lang('restore_link');?></a></p>
				<p><a href="<?php echo site_url('registration');?>"><?php echo lang('register_link');?></a></p>
			<?php echo form_close(); ?>

		</article>