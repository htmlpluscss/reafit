<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<h1><?php lang('statistics');?></h1>

<ul>
	<li><?php echo lang('total_users');?>: <?php echo $users;?></li>
	<li><?php echo lang('total_users_programs');?>: <?php echo $users_programs;?></li>
	<li><?php echo lang('total_users_exercises');?>: <?php echo $users_exercises;?></li>
</ul>

<ul>
	<li>
		<span><?php echo lang('last_10_reg_users');?>:</span>
		<?php if(!empty($last_reg_users)):?>
		<ul>
			<?php foreach ($last_reg_users as $key => $user) :?>
			<li>
				<a href="<?php echo base_url('admin/users/'.$user->url);?>">
				<?php if(empty($user->surname) && empty($user->name) && empty($user->middle_name)):?>
				<?php echo $user->email;?>
				<?php elseif(empty($user->surname) || empty($user->name) || empty($user->middle_name)):?>
				<?php echo $user->surname.' '.$user->name.' '.$user->middle_name . ' ('.$user->email.')';?>
				<?php else:?>
				<?php echo $user->surname.' '.$user->name.' '.$user->middle_name;?>
				<?php endif;?>
				</a>
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
	</li>
	<li>
		<span><?php echo lang('last_10_active_users');?>:</span>
		<?php if(!empty($last_active_users)):?>
		<ul>
			<?php foreach ($last_active_users as $key => $user) :?>
			<li>
				<a href="<?php echo base_url('admin/users/'.$user->url);?>">
				<?php if(empty($user->surname) && empty($user->name) && empty($user->middle_name)):?>
				<?php echo $user->email;?>
				<?php elseif(empty($user->surname) || empty($user->name) || empty($user->middle_name)):?>
				<?php echo $user->surname.' '.$user->name.' '.$user->middle_name . ' ('.$user->email.')';?>
				<?php else:?>
				<?php echo $user->surname.' '.$user->name.' '.$user->middle_name;?>
				<?php endif;?>
				</a>
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
	</li>
	<li>
		<span><?php echo lang('last_10_programs');?>:</span>
		<?php if(!empty($last_programs)):?>
		<ul>
			<?php foreach ($last_programs as $key => $program) :?>
			<li>
				<a href="<?php echo base_url('admin/programs/'.$program->hash);?>"><?php echo $program->name;?></a>
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
	</li>
	<li>
		<span><?php echo lang('last_10_exercises');?>:</span>
		<?php if(!empty($last_exercises)):?>
		<ul>
			<?php foreach ($last_exercises as $key => $exercise) :?>
			<li>
				<a href="<?php echo base_url('admin/exercises/'.$exercise->hash);?>"><?php echo $exercise->name;?></a>
			</li>
			<?php endforeach;?>
		</ul>
		<?php endif;?>
	</li>
</ul>

<ul>
	<li><?php echo lang('total_admin_programs');?>: <?php echo $admin_programs;?></li>
	<li><?php echo lang('total_admin_exercises');?>: <?php echo $admin_exercises;?></li>
</ul>