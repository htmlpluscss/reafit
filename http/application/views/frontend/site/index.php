<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php if(!$this->user):?>
		<article>
			<?php if(!empty($header)):?>
			<h1><?php echo $header;?></h1>
			<?php endif;?>

			<?php if(!empty($text)):?>
			<?php echo $text;?>
			<?php endif;?>

			<?php if(!empty($video)):?>
			<?php echo $video;?>
			<?php endif;?>

			<?php if(!empty($end_text)):?>
			<?php echo $end_text;?>
			<?php endif;?>
		</article>
	<?php else:?>
		<article class="users-stat">
			<?php if(!empty($header)):?>
			<h1><?php echo $header;?></h1>
			<?php endif;?>

			<ul>
				<li><?php echo lang('total_users_programs');?>: <?php echo $users_programs;?></li>
				<li><?php echo lang('total_users_exercises');?>: <?php echo $users_exercises;?></li>
			</ul>

			<span><?php echo lang('last_10_programs');?>:</span>
			<?php if(!empty($last_programs)):?>
			<ul>
				<?php foreach ($last_programs as $key => $program) :?>
				<li>
					<a href="<?php echo base_url('programs/'.$program->hash);?>"><?php echo $program->name;?></a>
				</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>

			<span><?php echo lang('last_10_exercises');?>:</span>
			<?php if(!empty($last_exercises)):?>
			<ul>
				<?php foreach ($last_exercises as $key => $exercise) :?>
				<li>
					<a href="<?php echo base_url('exercises/'.$exercise->hash);?>"><?php echo $exercise->name;?></a>
				</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>

			<h2><a href="<?php echo site_url('programs/add');?>"><?php echo lang('main_add_prog');?> <span class="icon-right-big"></span></a></h2>
			<?php if($add_prog):?>
			<?php echo $add_prog;?>
			<?php endif;?>

			<h2><a href="<?php echo site_url('programs');?>"><?php echo lang('main_open_prog');?> <span class="icon-right-big"></span></a></h2>
			<?php if($open_prog):?>
			<?php echo $open_prog;?>
			<?php endif;?>

			<h2><a href="<?php echo site_url('exercises/add');?>"><?php echo lang('main_add_app');?> <span class="icon-right-big"></span></a></h2>
			<?php if($add_app):?>
			<?php echo $add_app;?>
			<?php endif;?>

			<h2><a href="<?php echo site_url('exercises');?>"><?php echo lang('main_open_app');?> <span class="icon-right-big"></span></a></h2>
			<?php if($open_app):?>
			<?php echo $open_app;?>
			<?php endif;?>

		</article>
	<?php endif;?>