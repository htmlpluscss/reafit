<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<article class="page-login">
			<?php echo form_open('registration'); ?>
				<h1><?php echo lang('register_lbl');?></h1>
				<p><?php echo lang('_required');?></p>
				<label><?php echo lang('email');?> *</label>
				<input name="mail" class="input" type="email" value="<?php echo (isset($mail) && !empty($mail)) ? $mail : '';?>" required="required">
				<label><?php echo lang('password');?> *</label>
				<input name="pass" class="input" type="password" value="" required="required">
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
					<option value="<?php echo lang('user_type_1');?>"<?php echo (isset($type) && $type == lang('user_type_1')) ? ' selected="selected"' : '';?>><?php echo lang('user_type_1');?></option>
					<option value="<?php echo lang('user_type_2');?>"<?php echo (isset($type) && $type == lang('user_type_2')) ? ' selected="selected"' : '';?>><?php echo lang('user_type_2');?></option>
				</select>

				<p class="clr"><button class="btn pull-right" type="submit"><?php echo lang('register_btn');?></button></p>

				<p><?php echo lang('register_desc');?></p>

			<?php echo form_close(); ?>

		</article>