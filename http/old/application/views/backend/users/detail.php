<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<?php if(empty($item->surname) && empty($item->name) && empty($item->middle_name)):?>
		<h1><?php echo lang('fio_not_set');?></h1>
		<?php else : ?>
		<h1><?php echo $item->surname.' '.$item->name.' '.$item->middle_name;?></h1>
		<?php endif;?>

		<hr>

		<p><?php echo lang('email');?>: <?php echo $user->email;?></p>
		<?php if(!empty($user->region)):?>
		<p><?php echo $user->region;?></p>
		<?php endif;?>
		<?php if(!empty($user->phone)):?>
		<p><?php echo $user->phone;?></p>
		<?php endif;?>
		<?php if(!empty($user->type)):?>
		<p><?php echo $user->type;?></p>
		<?php endif;?>
		<hr>

		<p><?php echo lang('num_of_programs').': '. $user->programs;?></p>
		<p><?php echo lang('num_of_exercises').': '. $user->exercises;?></p>