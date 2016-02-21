<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<form class="pull-right" action="<?php echo $action;?>" method="GET">
			<input class="input" name="search" value="<?php echo (!empty($search)) ? $search : '';?>">
			<?php if(!empty($per_page) && isset($per_page_list[0]) && $per_page_list[0] != $per_page):?>
			<input type="hidden" name="items" value="<?php echo $per_page;?>" />
			<?php endif;?>
			<button type="submit" class="btn align-middle"><?php echo lang('find');?></button>
			<?php if(!empty($search)):?>
			<button type="reset" class="btn align-middle btn-search"><?php echo lang('clear');?></button>
			<?php endif;?>
		</form>

		<div class="col-hide clear-both">
			<p><?php echo lang('hide_colums');?>:</p>
			<label class="checkbox"><input type="checkbox" data-id="programs-user" value="1"><?php echo lang('id');?></label>
			<label class="checkbox"><input type="checkbox" data-id="programs-user" value="4"><?php echo lang('image');?></label>
		</div>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page' => $per_page, 'search'=>$search), TRUE);?>
		<table class="table100 table100--list">
			<thead>
				<tr>
					<th class="col-hide-1"><?php echo lang('id');?></th>
					<th><?php echo lang('name');?></th>
					<th><?php echo lang('author');?></th>
					<th class="col-hide-4"><?php echo lang('image');?></th>
					<th><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody>
			<?php if($items):?>
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="align-center"><?php echo $item->id;?></td>
					<td><b><?php echo $item->name;?></b></td>
					<td>
						<a href="<?php echo site_url('admin/users/'.$item->user_url);?>" target="_blank">
						<?php if(empty($item->user_surname) && empty($item->user_name) && empty($item->user_middle_name)):?>
							<?php echo $item->user_mail;?>
						<?php elseif(empty($item->user_surname) || empty($item->user_name) || empty($item->user_middle_name)):?>
							<?php echo $item->user_surname.' '.$item->user_name.' '.$item->user_middle_name . ' ('.$item->user_mail.')';?>
						<?php else : ?>
							<?php echo $item->user_surname.' '.$item->user_name.' '.$item->user_middle_name;?>
						<?php endif;?>
						</a>
					</td>
					<td>
						<?php if($item->image):?>
						<img src="<?php echo site_url('images/'.$item->image);?>" height="100" alt="<?php echo $item->name;?>">
						<?php endif;?>
					</td>
					<td>
						<ul class="one-event">
							<li><a class="icon-edit" href="<?php echo site_url('admin/programs/'.$item->hash);?>"></a></li>
							<li><a class="icon-trash-empty one-event__delete" href="<?php echo site_url('admin/programs/delete/'.$item->hash.'?return=admin/programs/users');?>" data-text="<?php echo lang('delete_program');?>"></a></li>
							<li><a class="icon-info one-event__detal"></a></li>
							<li><a class="icon-link" target="_blank" href="<?php echo site_url($item->hash);?>"></a></li>
						</ul>
						<?php echo $this->load->view('backend/'.$this->router->class.'/_item_detail_program', array('exercise'=>$item), TRUE);?>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
				<tr>
					<td colspan="5"><?php echo lang('no_programs');?></td>
				</tr>
			<?php endif;?>
			</tbody>
		</table>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page, 'search'=>$search), TRUE);?>