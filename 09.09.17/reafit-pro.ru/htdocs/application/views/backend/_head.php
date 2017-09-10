<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>
	<meta name="viewport" content="width=1200">
	<link href="<?php echo base_url('assets/css/default.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/fontello.css');?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">
	<?php if(isset($this->styles) && !empty($this->styles)):?>
	<?php foreach ($this->styles as $key => $style) :?>
	<link href="<?php echo $style;?>" rel="stylesheet">
	<?php endforeach;?>
	<?php endif;?>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,700,700italic,900&amp;subset=latin,cyrillic" rel="stylesheet">
	<link rel="shortcut icon" href="<?php echo base_url('assets/favicon.ico');?>" type="image/x-icon">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets/favicon.png');?>">
</head>