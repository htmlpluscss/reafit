<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<body>
	<header id="header">
		<div class="center">
			<a href="<?php echo base_url();?>" class="logo">
				<img src="<?php echo base_url('assets/images/logo.png');?>" alt="<?php echo $this->settings->site_name;?>">
			</a>
			<nav>
				<ul class="menu_top">
					<?php if(!empty($this->user)):?>
					<?php
						$profile_lbl = (!empty($this->user->email)) ? $this->user->email : lang('profile');
						if(!empty($this->user->surname) && !empty($this->user->name)) {
							$profile_lbl = $this->user->surname.' '.mb_substr($this->user->name, 0, 1).'.';
						} elseif(!empty($this->user->name)) {
							$profile_lbl = $this->user->name;
						} elseif(!empty($this->user->surname)) {
							$profile_lbl = $this->user->surname;
						}
					?>
					<li<?php if (site_url('programs') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('programs');?>"><?php echo lang('my_programs');?></a></li>
					<li<?php if (site_url('categories') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('categories');?>"><?php echo lang('my_categories');?></a></li>
					<li class="menu_top__sep<?php if (site_url('exercises') == '/'.$this->uri->uri_string) echo ' active';?>" style="padding:0"><a style="padding:0" href="<?php echo site_url('exercises');?>"><?php //echo lang('my_exercises');?></a></li>
					<?php else:?>
					<li<?php if (site_url('login') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('login');?>"><?php echo lang('login');?></a></li>
					<li<?php if (site_url('registration') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('registration');?>"><?php echo lang('registration');?></a></li>
					<?php endif;?>
					<?php if(!empty($this->settings->forum_url)):?>
					<li><a href="<?php echo $this->settings->forum_url;?>" target="_blank"><?php echo lang('forum');?></a></li>
					<?php endif; ?>
					<li<?php if (site_url('feedback') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('feedback');?>"><?php echo lang('feedback');?></a></li>
					<?php if(!empty($this->user)):?>
					<li class="menu_top__sep<?php if (site_url('profile') == '/'.$this->uri->uri_string) echo ' active';?>"><a href="<?php echo site_url('profile');?>"><?php echo $profile_lbl;?></a></li>
					<li><a href="<?php echo site_url('logout');?>" class="menu_top__exit ico ico--exit"></a></li>
					<?php endif;?>
				</ul>
			</nav>
		</div>
	</header>

<?php if($this->router->class == 'programs' && $this->router->method == 'add'):?>
	<div class="popup popup--create popup--lock show">
		<div class="popup__box">
			<div class="popup__body">
				<?php echo form_open_multipart('programs/add', array('class'=>'new-program-form')); ?>

					<h3><?php echo lang('new_program_title');?></h3>
					<div class="w260 pull-left">
						<label class="input-placeholder">
							<input class="input popup--create__name" name="name" maxlength="40">
							<span class="input-placeholder__label"><?php echo lang('name');?> <sup>*</sup></span>
						</label>
						<div class="popup__select">
							<select name="category" class="popup--create__category" data-required-sup>
								<option value="none"><?php echo lang('select_category');?></option>
							<?php if(!empty($category_list)):?>
							<?php $one_cat = (count($category_list) == 1) ? true : false;?>
							<?php foreach ($category_list as $key => $cat) :?>
								<option value="<?php echo $cat;?>"<?php echo ($cat == $category || $one_cat) ? ' selected="selected"' : '';?>><?php echo $cat;?></option>
							<?php endforeach;?>
							<?php endif;?>
							</select>
						</div>
						<label class="input-placeholder">
							<input class="input popup--create__email" name="mail" type="email" data-error="<?php echo lang('mail_not_correct');?>">
							<span class="input-placeholder__label"><?php echo lang('email');?></span>
						</label>
						<p class="popup__required_notification"><sup>*</sup> <?php echo lang('required_notification');?></p>
					</div>
					<div class="w260 pull-right">
						<div class="input-placeholder">
							<textarea class="input popup--create__textarea" name="description"></textarea>
							<span class="input-placeholder__label"><?php echo lang('description');?></span>
						</div>
						<label class="btn popup--create__btn"><?php echo lang('create');?><input type="submit" class="hide"></label>
					</div>

				<?php echo form_close(); ?>
			</div>
			<a class="ico ico--close popup__close" onClick="history.back();return false;"></a>
		</div>
	</div>
<?php endif;?>

<?php if(isset($info)):?>
	<div class="popup info-message info-message--warning show">
		<div class="popup__box">
			<div class="popup__inner">
				<?php echo $info;?>
			</div>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>
<?php endif;?>

<?php if(isset($success)):?>
	<div class="popup info-message info-message--success show">
		<div class="popup__box">
			<div class="popup__inner">
				<?php echo $success;?>
			</div>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>
<?php endif;?>

<?php if(isset($error)):?>
	<div class="popup info-message info-message--error show">
		<div class="popup__box">
			<div class="popup__inner">
				<?php echo $error;?>
			</div>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>
<?php endif;?>

<?php if(function_exists('validation_errors') && validation_errors()):?>
	<div class="popup info-message info-message--error show">
		<div class="popup__box">
			<div class="popup__inner">
				<?php echo validation_errors();?>
			</div>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>
<?php endif;?>

	<main id="main">
		<div class="center clr">