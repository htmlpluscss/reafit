<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="clr">
			<a class="btn create-cat-btn"><?php echo lang('create_category_btn');?></a>
			<form class="pull-right search-form input-block" action="<?php echo $action;?>" method="GET">
				<input class="input input--border-white pull-left input-block__first" name="search" value="<?php echo (!empty($search)) ? $search : '';?>">
				<?php if(!empty($per_page) && isset($per_page_list[0]) && !empty($per_page_list[0])):?>
				<input type="hidden" name="items" value="<?php echo $per_page;?>">
				<?php endif;?>
				<label class="btn pull-left input-block__last"><?php echo lang('find');?><input type="submit" class="hide"></label>
				<?php if(!empty($search)):?>
				<a class="btn pull-left ml-10 btn--gray btn--reset"><?php echo lang('clear');?></a>
				<?php endif;?>
				<?php if(isset($sort) && isset($order) && !empty($sort) && !empty($order)):?>
				<input type="hidden" name="order" value="<?php echo $order;?>">
				<input type="hidden" name="sort" value="<?php echo $sort;?>">
				<?php else:?>
				<input type="hidden" name="order" value="">
				<input type="hidden" name="sort" value="">
				<?php endif;?>
			</form>
		</div>
		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action), TRUE);?>
		<table class="table100 table100--list">
			<?php if($items):?>
			<thead>
				<tr>
					<th class="hide"><?php echo lang('id');?></th>
					<th class="bt0 bl0"><?php echo lang('name');?> <a href="#" class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'name') ? ' active' : '';?>" data-order="name" data-sort="asc">&#8595;</a><a class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'name') ? ' active' : '';?>" data-order="name" data-sort="desc">&#8593;</a></th>
					<th class="bt0 col-hide-2"><?php echo lang('description');?></th>
					<th class="bt0 col-hide-3"><?php echo lang('created');?> <a href="#" class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'created') ? ' active' : '';?>" data-order="created" data-sort="asc">&#8595;</a><a href="#" class="sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'created') ? ' active' : '';?>" data-order="created" data-sort="desc">&#8593;</a></th>
					<th class="bt0 col-hide-4"><?php echo lang('total_programs');?></th>
					<th class="bt0 col-hide-8"><?php echo lang('total_exercises');?></th>
					<th class="bt0 br0"><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody class="last-bb0">
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="hide">1</td>
					<td class="bl0"><?php echo $item->name;?></td>
					<td><?php echo $item->description;?></td>
					<td class="align-middle align-center">
						<?php if($item->created):?>
						<?php echo date('d.m.Y', strtotime($item->created));?>
						<?php endif;?>
					</td>
					<td class="align-middle align-center">
						<?php if ($item->programs == '0') {?>
							<?php echo $item->programs;?>
						<?php } else { ?>
							<a href="<?php echo base_url('programs?category='.$item->name)?>"><?php echo $item->programs;?></a>
						<?php } ?>
					</td>
					<td class="align-middle align-center">
						<?php if ($item->exercises == '0') {?>
							<?php echo $item->exercises;?>
						<?php } else { ?>
							<a href="<?php echo base_url('exercises?category='.$item->name)?>"><?php echo $item->exercises;?></a>
						<?php } ?>
					</td>
					<td class="br0 align-center align-middle nowrap">
						<a class="icon-edit edit-cat-btn" data-id="<?php echo $item->id;?>" title="<?php echo lang('edit_category');?>"></a>
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
					<td><?php echo lang('no_categories');?></td>
				</tr>
			</tbody>
			<?php endif;?>
		</table>


		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page), TRUE);?>