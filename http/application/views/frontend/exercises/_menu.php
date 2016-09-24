<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<?php if($fullscreen) :?>
<li><a class="ico ico--fullscreen-exit app-fullscreen"></a></li>
<?php endif;?>

<li><a class="ico ico--save<?php if ($fullscreen) echo '-white';?> btn-save"<?php echo (!$fullscreen) ? ' title="'.lang('save').'"' : '';?>></a></li>
<li><a class="ico ico--save-plus<?php if ($fullscreen) echo '-white';?> btn-save btn-save--redirect"<?php if (!$fullscreen) echo ' title="'.lang('save_and_create').'"';?> data-action="<?php echo base_url('exercises/add');?>"></a></li>
<li><a class="ico ico--save-exit<?php if ($fullscreen) echo '-white';?> btn-save btn-save--redirect"<?php if (!$fullscreen) echo ' title="'.lang('save_and_close').'"';?> data-action="<?php echo base_url('exercises');?>"></a></li>
<li><a class="ico ico--exit-app<?php if ($fullscreen) echo '-white';?> btn-to-list" href="<?php echo site_url('exercises');?>"<?php echo (!$fullscreen) ? ' title="'.lang('exercise_to_list').'"' : '';?>></a></li>

<?php /*

<li><a class="icon-logout btn-to-list" href="<?php echo site_url('exercises');?>"<?php echo (!$fullscreen) ? ' title="'.lang('exercise_to_list').'"' : '';?> data-action="<?php echo site_url('exercises');?>"></a></li>
<li><a class="icon-floppy btn-save"<?php echo (!$fullscreen) ? ' title="'.lang('save').'"' : '';?> data-change="<?php echo ($this->router->method == 'edit')? '0' : 1;?>"></a></li>
<li><a class="icon-floppy btn-save-action"<?php echo (!$fullscreen) ? ' title="'.lang('save_and_create').'"' : '';?> data-action="<?php echo base_url('exercises/add');?>"></a></li>
<li><a class="icon-floppy btn-save-action"<?php echo (!$fullscreen) ? ' title="'.lang('save_and_close').'"' : '';?> data-action="<?php echo base_url('exercises');?>"></a></li>
<li><a class="<?php echo (!$fullscreen) ? 'icon-resize-full-alt app-fullscreen' : 'icon-resize-small app-fullscreen';?>"<?php echo (!$fullscreen) ? ' title="'.lang('fullscreen').'"' : '';?>></a></li>

*/?>