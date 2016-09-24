<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="pull-left">
			<a class="btn" href="<?php echo site_url('admin/seo/add');?>"><?php echo lang('create_meta');?></a>
		</div>
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
			<label class="checkbox"><input type="checkbox" data-id="seo" value="1"><?php echo lang('id');?></label>
			<label class="checkbox"><input type="checkbox" data-id="seo" value="2"><?php echo lang('page');?></label>
			<label class="checkbox"><input type="checkbox" data-id="seo" value="3"><?php echo lang('mata_title');?></label>
			<label class="checkbox"><input type="checkbox" data-id="seo" value="4"><?php echo lang('mata_description');?></label>
			<label class="checkbox"><input type="checkbox" data-id="seo" value="5"><?php echo lang('mata_keywords');?></label>
		</div>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page' => $per_page, 'search'=>$search), TRUE);?>
		<table class="table100 table100--list">
			<?php if($items):?>
			<thead>
				<tr>
					<th class="col-hide-1"><?php echo lang('id');?></th>
					<th><?php echo lang('page_type');?></th>
					<th class="col-hide-2"><?php echo lang('page');?></th>
					<th class="col-hide-3"><?php echo lang('mata_title');?></th>
					<th class="col-hide-4"><?php echo lang('mata_description');?></th>
					<th class="col-hide-5"><?php echo lang('mata_keywords');?></th>
					<th><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="align-center"><?php echo $item->id;?></td>
					<td>
						<b>
						<?php
								if (strpos($item->key, 'programs/viewProgram/') !== false) {
								    echo lang('programs/viewProgram/');
								} else if(strpos($item->key, 'programs/printProgram/') !== false) {
									echo lang('programs/printProgram/');
								} else {
									echo lang($item->key);
								}
						?>
						</b>
					</td>
					<td>
						<?php if(!empty($item->name)):?>
						<?php echo $item->name.' ('.$item->user_surname.' '.$item->user_name.' '.$item->user_middle_name.')';?>
						<?php endif;?>
					</td>
					<td>
						<?php if(!empty($item->title)):?>
						<?php echo $item->title;?>
						<?php endif;?>
					</td>
					<td>
						<?php if(!empty($item->description)):?>
						<?php echo $item->description;?>
						<?php endif;?>
					</td>
					<td>
						<?php if(!empty($item->keywords)):?>
						<?php echo $item->keywords;?>
						<?php endif;?>
					</td>
					<td>
						<ul class="one-event">
							<li><a class="ico-mini ico-edit" href="<?php echo site_url('admin/seo/'.$item->hash);?>"></a></li>
							<li><a class="ico-mini ico-delete one-event__delete" href="<?php echo site_url('admin/seo/delete/'.$item->hash);?>" data-text="<?php echo lang('delete_meta');?>"></a></li>
						</ul>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
			<?php else:?>
			<tbody>
				<tr>
					<td><?php echo lang('no_meta');?></td>
				</tr>
			</tbody>
			<?php endif;?>
		</table>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page, 'search'=>$search), TRUE);?>