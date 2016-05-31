<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<div class="clr list-tags">
	<?php echo form_open('admin/settings'); ?>
	<?php if(!empty($settings)):?>
	<?php foreach ($settings as $key => $setting) :?>
		<div>
		<?php echo form_label(lang($setting->key), $setting->key);?>
		<?php  $input = 'form_'.$setting->type;
				echo $input($setting->key, $setting->value, array('class'=>'input w100p mb-20', 'id'=>$setting->key));
		?>
		</div>
	<?php endforeach;?>
	<?php endif;?>
	<label class="btn pull-right mt-10"><?php echo lang('save_change');?><input type="submit" class="hide"></label>
	<?php echo form_close(); ?>
</div>