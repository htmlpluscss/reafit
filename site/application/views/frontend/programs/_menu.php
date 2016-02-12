<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<li><a class="icon-logout btn-to-list" href="<?php echo site_url('programs');?>"<?php echo (!$fullscreen) ? ' title="'.lang('program_to_list').'"' : '';?>></a></li>
<li><a class="<?php echo (!$fullscreen) ? 'icon-resize-full-alt app-fullscreen' : 'icon-resize-small app-fullscreen';?>"<?php echo (!$fullscreen) ? ' title="'.lang('fullscreen').'"' : '';?>></a></li>
<li><a class="icon-folder-empty btn-new" href="<?php echo site_url('programs/add');?>"<?php echo (!$fullscreen) ? ' title="'.lang('create').'"' : '';?>></a></li>
<li><a class="icon-folder-open-empty data-tab-link" data-tab="open"<?php echo (!$fullscreen) ? ' title="'.lang('open').'"' : '';?>></a></li>
<li><a class="icon-floppy btn-save data-tab-link" data-tab="save"<?php echo (!$fullscreen) ? ' title="'.lang('save').'"' : '';?> data-change="<?php echo ($this->router->method == 'edit')? '0' : 1;?>"></a></li>
<li><a class="icon-docs data-tab-link" data-tab="save-as"<?php echo (!$fullscreen) ? ' title="'.lang('save_as').'"' : '';?>></a></li>
<?php if($this->router->method == 'edit'):?>
<li><a class="icon-print" target="_blank" href="<?php echo site_url('print/'.$hash);?>"<?php echo (!$fullscreen) ? ' title="'.lang('print').'"' : '';?>></a></li>
<li><a class="icon-link" target="_blank" href="<?php echo site_url($hash);?>"<?php echo (!$fullscreen) ? ' title="'.lang('public_link').'"' : '';?>></a></li>
<li><a class="icon-mail data-tab-link" data-tab="send-email"<?php echo (!$fullscreen) ? ' title="'.lang('to_email').'"' : '';?>></a></li>
<?php endif;?>
<li><a class="icon-plus-outline app-add-tab"<?php echo (!$fullscreen) ? ' title="'.lang('add_tab').'"' : '';?>></a></li>
<li><a class="icon-trash-empty app-delete-tab"<?php echo (!$fullscreen) ? ' title="'.lang('remove_tab').'"' : '';?>></a></li>