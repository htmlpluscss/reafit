<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<article class="page-login">
			<?php echo form_open('profile'); ?>
				<h1><?php echo lang('profile_lbl');?></h1>
				<label><?php echo lang('email');?> *</label>
				<input name="mail" class="input" type="email" value="<?php echo (isset($mail) && !empty($mail)) ? $mail : '';?>" required="required">
				<label><?php echo lang('password');?> *</label>
				<input name="pass" class="input" type="password" value="<?php echo (isset($pass) && !empty($pass)) ? $pass : '';?>" required="required">
				<label><?php echo lang('surname');?></label>
				<input class="input" name="surname" value="<?php echo (isset($surname) && !empty($surname)) ? $surname : '';?>">
				<label><?php echo lang('user_name');?></label>
				<input class="input" name="name" value="<?php echo (isset($name) && !empty($name)) ? $name : '';?>">
				<label><?php echo lang('middle_name');?></label>
				<input class="input" name="middle_name" value="<?php echo (isset($middle_name) && !empty($middle_name)) ? $middle_name : '';?>">
				<label><?php echo lang('region');?></label>
				<select name="region">
					<option value="none"><?php echo lang('_select');?></option>
					<?php if(!empty($regions)):?>
					<?php foreach ($regions as $key => $value) :?>
					<option value="<?php echo $value;?>"<?php echo (isset($region) && $region == $value) ? ' selected="selected"' : '';?>><?php echo $value;?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				<label><?php echo lang('phone');?></label>
				<input name="phone" class="input" type="tel" value="<?php echo (isset($phone) && !empty($phone)) ? $phone : '';?>">
				<label><?php echo lang('type');?></label>
				<select name="type">
					<option value="none"><?php echo lang('_select');?></option>
					<?php if(!empty($statuses)):?>
					<?php foreach ($statuses as $key => $value) :?>
					<option value="<?php echo $value;?>"<?php echo (isset($status) && $status == $value) ? ' selected="selected"' : '';?>><?php echo $value;?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>

				<p class="clr"><button class="btn pull-right" type="submit"><?php echo lang('_save');?></button></p>

				<p><?php echo lang('profile_desc');?></p>

			<?php echo form_close(); ?>

		</article>