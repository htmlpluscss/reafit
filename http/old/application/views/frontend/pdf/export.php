<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
	<style type="text/css">
		* {
		    margin: 0px;
		    padding: 0px;
		    box-sizing: border-box;
		}
		body {
		    font-style: normal;
		    font-variant: normal;
		    font-weight: normal;
		    font-stretch: normal;
		    font-size: 14px;
		    line-height: 22px;
		    font-family: 'PT Sans', sans-serif;
		    position: relative;
		    width: 100%;
		}
		.show {
		    transition: opacity 1s;
		    opacity: 1 !important;
		}
		.min-height {
		    overflow: inherit;
		}
		a {
		    color: rgb(153, 102, 51);
		    text-decoration: none;
		}
		a:hover {
		    cursor: pointer;
		    text-decoration: none !important;
		}
		:focus,
		:active {
		    outline: none;
		}
		img {
		    border: 0px;
		    max-width: 100%;
		    position: relative;
		    vertical-align: top;
		}
		li {
		    position: relative;
		    list-style: none;
		}
		header,
		main,
		nav,
		section,
		article,
		aside,
		footer {
			width: 100%;
		    display: block;
		}
		.clr::after {
		    clear: both;
		    content: "";
		    display: table;
		}
		::-webkit-input-placeholder {
		    opacity: 0.7;
		}
		header {
			height: 100px;
		}
		.btn {
		    display: inline-block;
		    cursor: pointer;
		    border: 1px solid rgb(51, 51, 51);
		    text-align: center;
		    font-style: normal;
		    font-variant: normal;
		    font-weight: normal;
		    font-stretch: normal;
		    font-size: 13px;
		    line-height: 28px;
		    font-family: 'PT Sans';
		    padding: 0px 10px;
		    height: 30px;
		    overflow: hidden;
		    position: relative;
		    border-radius: 3px;
		    color: rgb(51, 51, 51);
		    background: rgb(255, 255, 255);
		}
		.btn:hover {} select {
		    display: none;
		}
		table {
		    border: 0px;
		    border-collapse: collapse;
		}
		td {
		    vertical-align: top;
		}
		h1,
		h2,
		h3,
		h4,
		b {
		    font-weight: 400;
		}
		hr {
		    border: 0px;
		    height: 1px;
		    margin: 10px 0px 18px;
		    opacity: 0.25;
		    background: rgb(102, 102, 102);
		}
		.hide {
		    display: none;
		}
		.pull-left {
		    float: left;
		}
		.logo {
			width: 100%;
			display: block;
			padding-top: 10px;
			padding-bottom: 10px;
			text-align: center;
		}
		.logo img {
		    display: inline-block;
		    height: 72px;
		}
		body > .title_up {
		    display: block;
		}
		.tabs__dt {
		    float: left;
		    padding: 4px 8px;
		    cursor: pointer;
		    margin-right: 3px;
		    position: relative;
		    white-space: nowrap;
		}
		.tabs__dt--active {
		    top: 1px;
		    z-index: 1;
		}
		.tabs__dd {
		    display: none;
		}
		.tabs__dd--active {
		    display: block;
		}
		.tabs__nav {
		    height: 30px;
		}
		.page-login .btn {
		    margin: 20px 0px;
		}
		.exercises-list__item-desc h3 {
		    font-weight: 700;
		}
		.exercises-list__item-desc ul {
		    margin: 8px 12px;
		}
		.exercises-list__item-desc p {
		    margin: 8px 0px;
		}
		.exercises-list__item-desc p em {
		    padding-right: 5px;
		    font-size: 16px;
		}
		.exercises-list__item-desc .ahtung b {
		    padding-right: 5px;
		    font-size: 16px;
		    font-weight: 700;
		}
		.exercises-list__item-detal img {
		    float: left;
		    height: 140px;
		}
		.exercises-list__item-detal table {
		    margin: 20px 0px 20px 0px;
		}
		.exercises-list__item-detal th {
		    line-height: 12px;
		    font-size: 13px;
		}
		.exercises-list__item-detal .input {
		    width: 50px;
		    margin: 5px;
		    padding: 2px;
		    font-size: 13px;
		    text-align: center;
		}
		.exercises-list__item-detal th[colspan] {
		    text-align: left;
		    padding-left: 8px;
		}
		.exercises-list__item-detal textarea.input {
		    width: 100%;
		    height: 58px;
		    padding: 2px 5px;
		    text-align: left;
		}
		.exercises-list__item-detal-btn .btn {
		    display: block;
		    margin-bottom: 8px;
		}
		body {
		    opacity: 0;
		    overflow-y: hidden;
		}
		header .name-programme {
		    font-size: 20px;
		    text-align: center;
		    margin-bottom: 20px;
		}
		.app-left {
		    width: 470px;
		}
		.app-left--view {
		    width: 100%;
		}
		.app-left h2 {
		    padding: 8px;
		}
		.l-h {
		    min-height: 300px;
		    overflow-y: auto;
		    overflow-x: hidden;
		    padding: 8px;
		    position: static;
		}
		.app-left--view .exercises-my__item {
		    cursor: auto;
		}
		.exercises-my__item img {
		    width: 100px;
		}
		.exercises-my__item .exercises-list-btn-block {
		    position: absolute;
		    bottom: 8px;
		    right: 3px;
		    display: block;
		    z-index: 2;
		}
		.exercises-my__item .exercises-list-btn-block a {
		    display: block;
		    margin: 0px 3px;
		    font-size: 18px;
		    float: left;
		}
		.exercises-my__item .exercises-list__img {
			display: block;
		    width: 100%;
		    position: relative;
		    padding-top: 10px;
		}
		.exercises-my__item .exercises-list__img img {
			display: inline-block;
			margin-right: 20px;
		    text-align: center;
		}
		.exercises-my__item .exercises-list-btn-block .icon-left-bold,
		.exercises-my__item .exercises-list-btn-block .icon-plus,
		.exercises-my__item .exercises-list-btn-block .icon-info:not(.exercise),
		.exercises-my__item .exercises-list-btn-block .icon-star {
		    display: none;
		}
		.exercises-my__item .exercises-list__name {
		    right: 10px;
		}
		.form-tabs .btn {
		    margin-left: 128px;
		}
		.exercises-list__name {
		    font-size: 12px;
		    line-height: 14px;
		    font-weight: 700;
		    padding-top: 10px;
		    padding-left: 10px;
		    padding-right: 10px;
		    display: block;
		}
		body {
		    overflow: auto;
		    opacity: 1;
		}
		.exercises-list__item-detal {
			display: block;
			position: relative;
		    margin-top: 20px;
		    margin-bottom: 20px;
		}
		.exercises-list__item-detal table {
			width: 50%;
		}
		.popup-content--add {
		    margin-top: 10px;
		}
		.tabs__dt--active {
		    font-weight: 700;
		    font-size: 18px;
		}
		.tabs__dd--active {
		    margin-bottom: 30px;
		}
		img {
		  display: -dompdf-image !important;
		}
	</style>
</head>
<?
	$url = $this->config->item('host_url');

?>
<body>
	<header>
		<a href="<?php echo $url;?>" class="logo">
			<img src="<?php echo 'assets/images/logo.png';?>" alt="<?php echo $this->settings->site_name;?>">
		</a>
		<nav>
			<p class="name-programme"><?php echo $name;?></p>
		</nav>
	</header>
	<main class="clr">

		<div class="app-left pull-left tabs app-left--view">
			<?php if(!empty($tabs)):?>
			<?php foreach ($tabs as $key => $tab) :?>
			<div class="tabs__nav clr">
				<ul>
					<?php
						$acces_val = true;
						if(isset($params->access) && isset($params->access[$key])) {
							$acces_val = (bool) $params->access[$key];
						}
					?>
					<?php if($acces_val):?>
					<li><span class="tabs__dt tabs__dt--active"><?php echo $tab->name;?></span></li>
					<?php endif;?>
				</ul>
			</div>
			<?php if(!empty($tab->exercises)):?>
			<?php
				$acces_val = true;
				if(isset($params->access) && isset($params->access[$key])) {
					$acces_val = (bool) $params->access[$key];
				}
			?>
			<?php if($acces_val):?>
			<div class="tabs__dd tabs__dd--active">
				<ul class="l-h l-h--height-auto">
					<?php foreach ($tab->exercises as $exercise_key => $exercise) :?>
					<?php if($exercise) :?>
					<li class="exercises-my__item popup-box clr">
						<span class="exercises-list__name"><?php echo $exercise->name;?>&nbsp;<span class="hide"><?php echo $exercise->name_desc;?></span></span>
						<span class="exercises-list__img">
							<?php if($exercise->image_1):?>
							<img src="<?php echo 'images/'.$exercise->image_1;?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
							<?php if($exercise->image_2):?>
							<img src="<?php echo 'images/'.$exercise->image_2;?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
							<?php if($exercise->image_3):?>
							<img src="<?php echo 'images/'.$exercise->image_3;?>" alt="<?php echo $exercise->name;?>">
							<?php endif;?>
						</span>
						<div class="exercises-list__item-detal clr">
							<table>
								<tr>
									<th><?php echo lang('qty');?><br> <?php echo lang('times');?></th>
									<th><?php echo lang('qty');?><br> <?php echo lang('approaches');?></th>
									<th><?php echo lang('weight');?></th>
								</tr>
								<tr>
									<td><span><?php echo $exercise->quantity;?></span></td>
									<td><span><?php echo $exercise->approaches;?></span></td>
									<td><span><?php echo $exercise->weight;?></span></td>
								</tr>
							</table>
							<table>
								<tr>
									<th><?php echo lang('coment');?></th>
								</tr>
								<tr>
									<td><span><?php echo $exercise->comment;?></span></td>
								</tr>
							</table>
						</div>
						<?php if(isset($full) && !empty($full)):?>
						<div class="popup-content--add">
							<div class="exercises-list__item-desc">
								<h3><?php echo $exercise->name;?></h3>
								<?php echo $exercise->description;?>
							</div>
						</div>
						<?php endif;?>
					</li>
					<?php endif;?>
					<?php endforeach;?>
				</ul>
			</div>
			<?php endif;?>
			<?php endif;?>
			<?php endforeach;?>
			<?php endif;?>
		</div>

	</main>

</body>
</html>