<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="clr list-tags">
	<?php echo form_open('admin/settings'); ?>
	<?php if(!empty($settings)):?>
	<?php foreach ($settings as $key => $setting) :?>
		<div>
		<?php echo form_label(lang($setting->key), $setting->key);?>
		<?php  $input = 'form_'.$setting->type;
				echo $input($setting->key, $setting->value, array('class'=>'input', 'id'=>$setting->key));
		?>
		</div>
	<?php endforeach;?>
	<?php endif;?>
	<button type="submit" class="btn pull-right"><?php echo lang('save_change');?></button>
	<?php echo form_close(); ?>
</div>