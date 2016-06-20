<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<article class="page page-login">
				<h1>Регистрация отключена</h1>
<?php /*
			<?php echo form_open('registration'); ?>
				<h1><?php echo lang('register_lbl');?></h1>
				<label for="mail"><?php echo lang('email');?> <sup>*</sup></label>
				<input id="mail" name="mail" class="input" type="email" value="<?php echo (isset($mail) && !empty($mail)) ? $mail : '';?>" required="required">
				<label for="pass"><?php echo lang('password');?> <sup>*</sup></label>
				<input id="pass" name="pass" class="input" type="password" value="" required="required">
				<label for="surname"><?php echo lang('surname');?></label>
				<input id="surname" name="surname" class="input" value="<?php echo (isset($surname) && !empty($surname)) ? $surname : '';?>">
				<label for="name"><?php echo lang('user_name');?></label>
				<input id="name" name="name" class="input" value="<?php echo (isset($name) && !empty($name)) ? $name : '';?>">
				<label for="middle_name"><?php echo lang('middle_name');?></label>
				<input id="middle_name" name="middle_name" class="input" value="<?php echo (isset($middle_name) && !empty($middle_name)) ? $middle_name : '';?>">
				<label for="region"><?php echo lang('region');?></label>
				<select id="region" name="region">
					<option value="none"><?php echo lang('_select');?></option>
					<?php if(!empty($regions)):?>
					<?php foreach ($regions as $key => $value) :?>
					<option value="<?php echo $value;?>"<?php echo (isset($region) && $region == $value) ? ' selected="selected"' : '';?>><?php echo $value;?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				<label for="phone"><?php echo lang('phone');?></label>
				<input id="phone" name="phone" class="input" type="tel" value="<?php echo (isset($phone) && !empty($phone)) ? $phone : '';?>">
				<label for="type"><?php echo lang('type');?></label>
				<select id="type" name="type">
					<option value="none"><?php echo lang('_select');?></option>
					<?php if(!empty($statuses)):?>
					<?php foreach ($statuses as $key => $value) :?>
					<option value="<?php echo $value;?>"<?php echo (isset($status) && $status == $value) ? ' selected="selected"' : '';?>><?php echo $value;?></option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				<label><?php echo lang('categories');?></label>
				<?php $categories = explode("\n", str_replace("\r\n", "\n", $this->settings->categories));?>
				<?php if(!empty($categories)):?>
				<?php foreach ($categories as $key => $category) :?>
				<label class="checkbox"><input type="checkbox" checked="checked" value="<?php echo $category;?>" name="params[categories][]"><?php echo $category;?></label>
				<?php endforeach;?>
				<?php endif;?>

				<label class="btn"><?php echo lang('register_btn');?><input type="submit" class="hide"></label>

				<p><?php echo lang('register_desc');?></p>

			<?php echo form_close();*/ ?>

		</article>