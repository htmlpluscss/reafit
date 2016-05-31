<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<form class="pull-right input-block" action="<?php echo $action;?>" method="GET">
			<input class="input pull-left input-block__first" name="search" value="<?php echo (!empty($search)) ? $search : '';?>">
			<?php if(!empty($per_page) && isset($per_page_list[0]) && $per_page_list[0] != $per_page):?>
			<input type="hidden" name="items" value="<?php echo $per_page;?>" />
			<?php endif;?>
			<label class="btn pull-left input-block__last"><?php echo lang('find');?><input type="submit" class="hide"></label>
			<?php if(!empty($search)):?>
			<a class="btn pull-left ml-10 btn--gray btn--reset"><?php echo lang('clear');?></a>
			<?php endif;?>
		</form>

		<div class="col-hide clear-both">
			<p><?php echo lang('hide_colums');?>:</p>
			<label class="checkbox"><input type="checkbox" data-id="users" value="1"><?php echo lang('id');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="2"><?php echo lang('registration_date');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="3"><?php echo lang('last_login_date');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="5"><?php echo lang('num_of_programs');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="6"><?php echo lang('num_of_exercises');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="7"><?php echo lang('email');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="8"><?php echo lang('phone');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="9"><?php echo lang('region');?></label>
			<label class="checkbox"><input type="checkbox" data-id="users" value="10"><?php echo lang('type');?></label>
		</div>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page' => $per_page, 'search'=>$search), TRUE);?>
		<table class="table100 table100--list">
			<?php if($items):?>
			<thead>
				<tr>
					<th class="col-hide-1"><?php echo lang('id');?></th>
					<th><?php echo lang('fio');?></th>
					<th class="col-hide-2"><?php echo lang('registration_date');?></th>
					<th class="col-hide-3"><?php echo lang('last_login_date');?>
					<th class="col-hide-5"><?php echo lang('num_of_programs');?></th>
					<th class="col-hide-6"><?php echo lang('num_of_exercises');?></th>
					<th class="col-hide-7"><?php echo lang('email');?></th>
					<th class="col-hide-8"><?php echo lang('phone');?></th>
					<th class="col-hide-9"><?php echo lang('region');?></th>
					<th class="col-hide-10"><?php echo lang('type');?></th>
					<th><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="align-center"><?php echo $item->id;?></td>
					<td>
						<?php if(empty($item->surname) && empty($item->name) && empty($item->middle_name)):?>
						<?php echo lang('not_set');?>
						<?php else : ?>
						<b><?php echo $item->surname.' '.$item->name.' '.$item->middle_name;?></b>
						<?php endif;?>
					</td>
					<td class="align-center"><?php echo date('d.m.Y', strtotime($item->registration));?></td>
					<td class="align-center"><?php echo date('d.m.Y', strtotime($item->last_login));?></td>
					<td class="align-center"><?php echo $item->programs;?></td>
					<td class="align-center"><?php echo $item->exercises;?></td>
					<td>
						<a href="mailto:<?php echo $item->email;?>"><?php echo $item->email;?></a>
					</td>
					<td>
						<?php if($item->phone):?>
						<a href="tel:<?php echo $item->phone;?>"><?php echo $item->phone;?></a>
						<?php else : ?>
						<?php echo lang('not_set');?>
						<?php endif;?>
					</td>
					<td>
						<?php if($item->region):?>
						<?php echo $item->region;?>
						<?php else : ?>
						<?php echo lang('not_set');?>
						<?php endif;?>
					</td>
					<td>
						<?php if($item->type):?>
						<?php echo $item->type;?>
						<?php else : ?>
						<?php echo lang('not_set');?>
						<?php endif;?>
					</td>
					<td class="one-event one-event--line">
						<a class="icon-folder-open-empty" href="<?php echo base_url('admin/users/'.$item->url);?>" target="_blank"></a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
			<?php else:?>
			<tbody>
				<tr>
					<td colspan="11"><?php echo lang('no_users');?></td>
				</tr>
			</tbody>
			<?php endif;?>
		</table>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page, 'search'=>$search), TRUE);?>