<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<li><a class="icon-logout btn-to-list" href="<?php echo site_url('exercises');?>"<?php echo (!$fullscreen) ? ' title="'.lang('exercise_to_list').'"' : '';?> data-action="<?php echo base_url('admin/exercises');?>"></a></li>
<li><a class="icon-floppy btn-save"<?php echo (!$fullscreen) ? ' title="'.lang('save').'"' : '';?> data-change="<?php echo ($this->router->method == 'edit')? '0' : 1;?>"></a></li>
<li><a class="icon-floppy btn-save-action"<?php echo (!$fullscreen) ? ' title="'.lang('save_and_create').'"' : '';?> data-action="<?php echo base_url('admin/exercises/add');?>"></a></li>
<li><a class="icon-floppy btn-save-action"<?php echo (!$fullscreen) ? ' title="'.lang('save_and_close').'"' : '';?> data-action="<?php echo base_url('admin/exercises');?>"></a></li>
<li><a class="<?php echo (!$fullscreen) ? 'icon-resize-full-alt app-fullscreen' : 'icon-resize-small app-fullscreen';?>"<?php echo (!$fullscreen) ? ' title="'.lang('fullscreen').'"' : '';?>></a></li>