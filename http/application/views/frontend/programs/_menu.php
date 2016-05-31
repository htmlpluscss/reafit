<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	if(!isset($fullscreen)) {
		$fullscreen = false;
	}
?>
<li><a class="ico ico--plus app-add-tab"<?php echo (!$fullscreen) ? ' title="'.lang('add_tab').'"' : '';?>></a></li>
<li><a class="ico ico--open data-tab-link" data-tab="open"<?php echo (!$fullscreen) ? ' title="'.lang('open').'"' : '';?>></a></li>
<li><a class="ico ico--new btn-new" href="<?php echo site_url('programs/add');?>"<?php echo (!$fullscreen) ? ' title="'.lang('create').'"' : '';?> data-action="<?php echo site_url('programs/add');?>"></a></li>
<li><a class="ico ico--save data-tab-link" data-tab="save"<?php echo (!$fullscreen) ? ' title="'.lang('save').'"' : '';?> data-change="<?php echo ($this->router->method == 'edit')? '0' : 1;?>"></a></li>
<li><a class="ico ico--save-plus" <?php echo (!$fullscreen) ? ' title="'.lang('save_and_exit').'"' : '';?>></a></li>
<li><a class="ico ico--save-plus data-tab-link" data-tab="save-as"<?php echo (!$fullscreen) ? ' title="'.lang('save_as').'"' : '';?>></a></li>

<?php if($this->router->method == 'edit'):?>
<li><a class="ico ico--print" target="_blank" href="<?php echo site_url('print/'.$hash);?>"<?php echo (!$fullscreen) ? ' title="'.lang('print').'"' : '';?>></a></li>
<li><a class="ico ico--link" target="_blank" href="<?php echo site_url($hash);?>"<?php echo (!$fullscreen) ? ' title="'.lang('public_link').'"' : '';?>></a></li>
<?php endif;?>

<li><a class="ico ico--cart app-delete-tab"<?php echo (!$fullscreen) ? ' title="'.lang('remove_tab').'"' : '';?>></a></li>
<li><a class="ico ico--note app-add-note"<?php $_title = (!empty($note)) ? lang('note') : lang('add_note'); echo (!$fullscreen) ? ' title="'.$_title.'"' : '';?>></a></li>