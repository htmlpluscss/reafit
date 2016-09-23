<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<?php if($this->router->method == 'viewProgram') :?>
<li><a class="<?php echo (!$fullscreen) ? 'icon-resize-full-alt app-fullscreen' : 'icon-resize-small app-fullscreen';?>"<?php echo (!$fullscreen) ? ' title="'.lang('fullscreen').'"' : '';?>></a></li>
<li><a class="icon-print" target="_blank" href="<?php echo site_url('print/'.$hash);?>"<?php echo (!$fullscreen) ? ' title="'.lang('print').'"' : '';?>></a></li>
<?php else:?>
<li><a class="icon-print" onclick="window.print()" href="#"<?php echo (!$fullscreen) ? ' title="'.lang('print').'"' : '';?>></a></li>
<li><a class="icon-eye-off" title="<?php echo lang('hide_description');?>" onClick="$('.popup-content--add').toggleClass('hide')"></a></li>
<?php endif;?>