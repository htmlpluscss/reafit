<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<?php if($this->router->method == 'viewProgram') :?>
<?php if($fullscreen) :?>
<li><a class="ico ico--fullscreen-exit app-fullscreen"></a></li>
<?php endif;?>
<li><a class="ico ico--print" target="_blank" href="<?php echo site_url('print/'.$hash);?>"<?php if (!$fullscreen) echo ' title="'.lang('print_page').'"';?>></a></li>
<?php else:?>
<li><a class="ico ico--print" onclick="window.print()" href="#"<?php if (!$fullscreen) echo ' title="'. lang('print') .'"';?>></a></li>
<li><a class="ico ico--hidden" title="<?php echo lang('hide_description');?>" onClick="$('#programme-body').addClass('programme-body--description-hide')"></a></li>
<li><a class="ico ico--visible" title="<?php echo lang('show_description');?>" onClick="$('#programme-body').removeClass('programme-body--description-hide')"></a></li>
<?php endif;?>