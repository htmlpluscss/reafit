<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<body>
	<header>
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
					<li><a href="<?php echo site_url('programs');?>"><?php echo lang('programs');?></a></li>
					<li><a href="<?php echo site_url('categories');?>"><?php echo lang('my_categories');?></a></li>
					<li class="menu_top__sep"><a href="<?php echo site_url('exercises');?>"><?php echo lang('my_exercises');?></a></li>
					<?php else:?>
					<li><a href="<?php echo site_url('login');?>"><?php echo lang('login');?></a></li>
					<li><a href="<?php echo site_url('registration');?>"><?php echo lang('registration');?></a></li>
					<?php endif;?>
					<?php if(!empty($this->settings->forum_url)):?>
					<li><a href="<?php echo $this->settings->forum_url;?>" target="_blank"><?php echo lang('forum');?></a></li>
					<?php endif; ?>
					<li><a href="<?php echo site_url('feedback');?>"><?php echo lang('feedback');?></a></li>
					<?php if(!empty($this->user)):?>
					<li class="menu_top__sep"><a href="<?php echo site_url('profile');?>"><?php echo $profile_lbl;?></a></li>
					<li><a href="<?php echo site_url('logout');?>" title="<?php echo lang('logout');?>" class="menu_top__exit ico ico--exit"></a></li>
					<?php endif;?>
				</ul>
			</nav>
		</div>
	</header>
	<main class="center clr">
		<?php if(isset($info)):?>
		<div class="info-message info-message--warning">
			<p><?php echo $info;?></p>
			<a class="info-message__close"></a>
		</div>
		<?php endif;?>

		<?php if(isset($success)):?>
		<div class="info-message info-message--success">
			<p><?php echo $success;?></p>
			<a class="info-message__close"></a>
		</div>
		<?php endif;?>

		<?php if(isset($error)):?>
		<div class="info-message info-message--error">
			<p><?php echo $error;?></p>
			<a class="info-message__close"></a>
		</div>
		<?php endif;?>

		<?php if(function_exists('validation_errors') && validation_errors()):?>
		<div class="info-message info-message--error">
			<p><?php echo validation_errors();?></p>
			<a class="info-message__close"></a>
		</div>
		<?php endif;?>