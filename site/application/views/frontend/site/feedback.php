<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<article class="page-login">

			<?php echo form_open('feedback'); ?>
				<h1><?php echo lang('feedback_lbl');?></h1>
				<label><?php echo lang('subject_lbl');?></label>
				<input name="subject" class="input subject" data-partner="<?php echo lang('commerce_purpose');?>" value="<?php echo (isset($subject) && !empty($subject)) ? $subject : '';?>">
				<label><?php echo lang('email_lbl');?></label>
				<input name="mail" class="input" type="email" value="<?php echo (isset($mail) && !empty($mail)) ? $mail : '';?>">
				<label><?php echo lang('phone_lbl');?></label>
				<input name="phone" class="input" type="tel" value="<?php echo (isset($phone) && !empty($phone)) ? $phone : '';?>">
				<label><?php echo lang('message_lbl');?></label>
				<textarea name="message" class="input"><?php echo (isset($message) && !empty($message)) ? $message : '';?></textarea>
				<p><button class="btn" type="submit"><?php echo lang('_send');?></button></p>
			<?php echo form_close(); ?>

		</article>