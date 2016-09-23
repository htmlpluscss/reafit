<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<h1><?php echo $header;?></h1>
<div class="clr list-tags">
	<?php echo form_open('admin/seo/'.$hash); ?>
	<div>
		<label><?php echo lang('page');?></label>
		<select name="page">
			<?php if(!empty($types)):?>
				<option value="none"><?php echo lang('_select');?></option>
			<?php foreach ($types as $key => $type) :?>
				<option value="<?php echo $key;?>"<?php echo (isset($_type) && $_type == $key) ? ' selected="selected"' : '';?>><?php echo $type;?></option>
			<?php endforeach;?>
			<?php endif;?>
		</select>
	</div>
	<div>
		<label><?php echo lang('mata_title');?><input class="input" name="title" value="<?php echo $_title;?>"></label>
	</div>
	<div>
		<label><?php echo lang('mata_description');?><textarea class="input" name="description"><?php echo $_description;?></textarea></label>
	</div>
	<div>
		<label><?php echo lang('mata_keywords');?><textarea class="input" name="keywords"><?php echo $_keywords;?></textarea></label>
	</div>
	<button type="submit" class="btn pull-right"><?php echo lang('save_change');?></button>
	<?php echo form_close(); ?>
</div>