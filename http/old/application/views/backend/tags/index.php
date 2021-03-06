<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="clr list-tags">
	<?php echo form_open('admin/tags'); ?>
	<?php if(!empty($tags)):?>
	<?php foreach ($tags as $key => $group) :?>
		<h3><?php echo $group->name;?> <a class="icon-plus" data-id="<?php echo $group->id;?>"></a></h3>
		<?php if(!empty($group->tags)):?>
		<ul class="sort-remove">
		<?php foreach ($group->tags as $key => $tag) :?>
			<li><?php echo $tag->tag;?> <a class="icon-trash" data-id="<?php echo $tag->id;?>"></a>
				<input type="hidden" name="tag[<?php echo $group->id;?>][]" value="<?php echo $tag->id;?>" />
			</li>
		<?php endforeach;?>
		</ul>
		<?php endif;?>
	<?php endforeach;?>
	<?php endif;?>
	<button type="submit" class="btn pull-right"><?php echo lang('save_change');?></button>
	<?php echo form_close(); ?>
</div>