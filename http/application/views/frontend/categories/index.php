<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="clr">
			<div class="pull-left">
				<a class="btn" id="btn-create-cat" data-type="create"><?php echo lang('create_category_btn');?></a>
			</div>
			<form class="pull-right search-form input-block" action="<?php echo $action;?>" method="GET">
				<input class="input pull-left input-block__first" name="search" value="<?php echo (!empty($search)) ? $search : '';?>">
				<?php if(!empty($per_page) && isset($per_page_list[0]) && !empty($per_page_list[0])):?>
				<input type="hidden" name="items" value="<?php echo $per_page;?>" />
				<?php endif;?>
				<label class="btn pull-left input-block__last"><?php echo lang('find');?><input type="submit" class="hide"></label>
				<?php if(!empty($search)):?>
				<a class="btn pull-left ml-10 btn--gray btn--reset"><?php echo lang('clear');?></a>
				<?php endif;?>
				<?php if(isset($sort) && isset($order) && !empty($sort) && !empty($order)):?>
				<input type="hidden" name="order" value="<?php echo $order;?>" />
				<input type="hidden" name="sort" value="<?php echo $sort;?>" />
				<?php else:?>
				<input type="hidden" name="order" value="" />
				<input type="hidden" name="sort" value="" />
				<?php endif;?>
			</form>
		</div>
		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action), TRUE);?>
		<table class="table100 table100--list">
			<?php if($items):?>
			<thead>
				<tr>
					<th class="hide"><?php echo lang('id');?></th>
					<th><?php echo lang('name');?> <a href="#" class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'name') ? ' active' : '';?>" data-order="name" data-sort="asc">&#8595;</a><a href="#" class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'name') ? ' active' : '';?>" data-order="name" data-sort="desc">&#8593;</a></th>
					<th class="col-hide-2"><?php echo lang('description');?></th>
					<th class="col-hide-3"><?php echo lang('created');?> <a href="#" class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'created') ? ' active' : '';?>" data-order="created" data-sort="asc">&#8595;</a><a href="#" class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'created') ? ' active' : '';?>" data-order="created" data-sort="desc">&#8593;</a></th>
					<th class="col-hide-4"><?php echo lang('total_programs');?></th>
					<th class="col-hide-8"><?php echo lang('total_exercises');?></th>
					<th><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="hide">1</td>
					<td><a class="edit-cat-btn" href="#" data-id="<?php echo $item->id;?>" data-type="update"><?php echo $item->name;?></a></td>
					<td><?php echo $item->description;?></td>
					<td class="align-middle align-center">
						<?php if($item->created):?>
						<?php echo date('d.m.Y', strtotime($item->created));?>
						<?php endif;?>
					</td>
					<td class="align-middle align-center">
						<?php echo $item->programs;?>
					</td>
					<td class="align-middle align-center">
						<?php echo $item->exercises;?>
					</td>
					<td class="align-center align-middle nowrap">
						<a class="icon-edit edit-cat-btn" href="#" data-id="<?php echo $item->id;?>" data-type="update" title="<?php echo lang('edit_category');?>"></a>
						<a class="icon-folder-open-empty" href="<?php echo base_url('programs?category='.$item->name)?>" title="<?php echo lang('open_category_programs');?>"></a>
						<a class="icon-folder-open-empty" href="<?php echo base_url('exercises?category='.$item->name)?>" title="<?php echo lang('open_category_exercises');?>"></a>
						<a class="icon-trash-empty one-event__delete" href="<?php echo site_url('categories/delete/'.$item->id);?>" data-text="<?php echo lang('delete_category');?>" title="<?php echo lang('delete');?>"></a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
			<?php else:?>
			<tbody>
				<tr>
					<td colspan="7"><?php echo lang('no_categories');?></td>
				</tr>
			</tbody>
			<?php endif;?>
		</table>


		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page), TRUE);?>