<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php if(!$this->user):?>
		<article class="page">
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
		<article class="page users-stat">
			<?php if(!empty($header)):?>
			<h1><?php //echo $header;?></h1>
			<?php endif;?>

			<table>
				<tr>
					<td>
						<?php if(!empty($last_programs)):?>
						<h3><?php echo lang('last_10_programs');?>:</h3>
						<ul>
							<?php foreach ($last_programs as $key => $program) :?>
							<li>
								<a href="<?php echo base_url('programs/'.$program->hash);?>"><?php echo $program->name;?></a>
							</li>
							<?php endforeach;?>
						</ul>
						<?php endif;?>
					</td>
					<td>
						<?php if(!empty($last_exercises) && false):?>
						<h3><?php echo lang('last_10_exercises');?>:</h3>
						<ul>
							<?php foreach ($last_exercises as $key => $exercise) :?>
							<li>
								<a href="<?php echo base_url('exercises/'.$exercise->hash);?>"><?php echo $exercise->name;?></a>
							</li>
							<?php endforeach;?>
						</ul>
						<?php endif;?>
					</td>
				</tr>
				<tr>
					<td>
						<a class="users-stat__screenshot" href="<?php echo site_url('programs/add');?>">
							<span class="users-stat__screenshot-text"><?php echo lang('main_add_prog');?></span>
							<img src="assets/images/add-app.png" width="460" alt="">
						</a>
						<?php if($add_prog):?>
						<?php echo $add_prog;?>
						<?php endif;?>
					</td>
					<td>
						<a class="users-stat__screenshot" href="<?php echo site_url('programs');?>">
							<span class="users-stat__screenshot-text"><?php echo lang('main_open_prog');?></span>
							<img src="assets/images/edit-app.png" width="460" alt="">
						</a>
						<?php if($open_prog):?>
						<?php echo $open_prog;?>
						<?php endif;?>
					</td>
				</tr>
				<tr>
					<td>
						<a class="users-stat__screenshot" href="<?php echo site_url('exercises/add');?>">
							<span class="users-stat__screenshot-text"><?php echo lang('main_add_app');?></span>
							<img src="assets/images/add-item.png" width="460" alt="">
						</a>
						<?php if($add_app):?>
						<?php echo $add_app;?>
						<?php endif;?>
					</td>
					<td>
						<a class="users-stat__screenshot" href="<?php echo site_url('exercises');?>">
							<span class="users-stat__screenshot-text"><?php echo lang('main_open_app');?></span>
							<img src="assets/images/edit-item.png" width="460" alt="">
						</a>
						<?php if($open_app):?>
						<?php echo $open_app;?>
						<?php endif;?>
					</td>
				</tr>
			</table>

			<ul>
				<li><?php echo lang('total_users_programs');?>: <a style="padding-left:5px" href="<?php echo site_url('programs');?>"><?php echo $users_programs;?></a></li>
				<li><?php echo lang('total_users_exercises');?>: <?php echo 0//$users_exercises;?></li>
			</ul>

		</article>
	<?php endif;?>