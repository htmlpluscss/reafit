<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<body>
	<header>
		<a href="<?php echo base_url('admin');?>" class="logo">
			<img src="<?php echo base_url('assets/images/logo.png');?>" alt="<?php echo $this->settings->site_name;?>">
		</a>
		<?php if(isset($_nav) && !empty($_nav)):?>
			<?php echo $_nav;?>
		<?php else:?>
		<nav>
			<ul class="menu_top">
				<li><a href="<?php echo site_url('admin/exercises');?>"><?php echo lang('exercises');?></a></li>
				<?php if($this->user->is_admin ==  1):?>
				<li><a href="<?php echo site_url('admin/exercises/users');?>"><?php echo lang('user_exercises');?></a></li>
				<?php endif;?>
				<li><a href="<?php echo site_url('admin/programs');?>"><?php echo lang('programs');?></a></li>
				<?php if($this->user->is_admin ==  1):?>
				<li><a href="<?php echo site_url('admin/programs/users');?>"><?php echo lang('user_programs');?></a></li>
				<li><a href="<?php echo site_url('admin/tags');?>"><?php echo lang('tags');?></a></li>
				<li><a href="<?php echo site_url('admin/users');?>"><?php echo lang('users');?></a></li>
				<li><a href="<?php echo site_url('admin/seo');?>"><?php echo lang('meta');?></a></li>
				<li><a href="<?php echo site_url('admin/settings');?>"><?php echo lang('settings');?></a></li>
				<?php endif;?>
				<?php if(!empty($this->user)):?>
				<li><a href="<?php echo site_url('logout');?>"><?php echo lang('logout');?></a></li>
				<?php endif;?>
			</ul>
		</nav>
		<?php endif;?>
	</header>
	<main class="clr">
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