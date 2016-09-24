<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<?php if($this->router->method == 'viewProgram') :?>
<li><a class="ico <?php echo (!$fullscreen) ? 'ico--fullscreen' : 'ico--fullscreen-exit';?> app-fullscreen"<?php echo (!$fullscreen) ? ' title="'.lang('fullscreen').'"' : '';?>></a></li>
<li><a class="ico ico--print" target="_blank" href="<?php echo site_url('print/'.$hash);?>"<?php echo (!$fullscreen) ? ' title="'.lang('print').'"' : '';?>></a></li>
<?php else:?>
<li><a class="ico ico--print" onclick="window.print()" href="#"<?php echo (!$fullscreen) ? ' title="'.lang('print').'"' : '';?>></a></li>
<li><a class="ico ico--hidden" title="<?php echo lang('hide_description');?>" onClick="$('#programme-body').addClass('programme-body--description-hide')"></a></li>
<li><a class="ico ico--visible" title="<?php echo lang('show_description');?>" onClick="$('#programme-body').removeClass('programme-body--description-hide')"></a></li>
<?php endif;?>