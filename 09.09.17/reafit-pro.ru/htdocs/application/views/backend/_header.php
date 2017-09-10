<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<body>

	<header id="header">
		<div class="center">
			<a href="<?php echo base_url('admin');?>" class="logo">
				<img src="<?php echo base_url('assets/images/logo.png');?>" alt="<?php echo $this->settings->site_name;?>">
			</a>
			<ul class="menu_top">
				<li<?php if (site_url('admin/exercises') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('admin/exercises');?>"><?php echo lang('exercises');?></a></li>
				<?php if($this->user->is_admin ==  1):?>
				<li<?php if (site_url('admin/exercises/users') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('admin/exercises/users');?>"><?php echo lang('user_exercises');?></a></li>
				<?php endif;?>
				<li<?php if (site_url('admin/programs') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('admin/programs');?>"><?php echo lang('programs');?></a></li>
				<?php if($this->user->is_admin ==  1):?>
				<li class="menu_top__sep<?php if (site_url('admin/programs/users') == '/'.$this->uri->uri_string) echo ' active';?>"><a href="<?php echo site_url('admin/programs/users');?>"><?php echo lang('user_programs');?></a></li>
				<li<?php if (site_url('admin/tags') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('admin/tags');?>"><?php echo lang('tags');?></a></li>
				<li class="menu_top__sep<?php if (site_url('admin/users') == '/'.$this->uri->uri_string) echo ' active';?>"><a href="<?php echo site_url('admin/users');?>"><?php echo lang('users');?></a></li>
				<li<?php if (site_url('admin/seo') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('admin/seo');?>"><?php echo lang('meta');?></a></li>
				<li<?php if (site_url('admin/settings') == '/'.$this->uri->uri_string) echo ' class="active"';?>><a href="<?php echo site_url('admin/settings');?>"><?php echo lang('settings');?></a></li>
				<?php endif;?>
				<?php if(!empty($this->user)):?>
				<li><a href="<?php echo site_url('logout');?>" class="menu_top__exit ico ico--exit"></a></li>
				<?php endif;?>
			</ul>
		</div>
	</header>

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

	<main id="main" class="center clr">