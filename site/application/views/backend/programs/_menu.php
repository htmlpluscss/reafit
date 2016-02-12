<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<li><a class="icon-logout btn-to-list" href="<?php echo $list_url;?>"<?php echo (!$fullscreen) ? ' title="'.lang('program_to_list').'"' : '';?>></a></li>
<li><a class="icon-floppy btn-save"<?php echo (!$fullscreen) ? ' title="'.lang('save').'"' : '';?> data-change="<?php echo ($this->router->method == 'edit')? '0' : 1;?>"></a></li>
<li><a class="<?php echo (!$fullscreen) ? 'icon-resize-full-alt app-fullscreen' : 'icon-resize-small app-fullscreen';?>"<?php echo (!$fullscreen) ? ' title="'.lang('fullscreen').'"' : '';?>></a></li>