<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="clr">
			<a class="btn pull-left" href="<?php echo site_url('programs/add');?>"><?php echo lang('create_program');?></a>
			<form class="pull-right search-form input-block" action="<?php echo $action;?>" method="GET">
				<input class="input input--border-white pull-left input-block__first" name="search" value="<?php echo (!empty($search)) ? $search : '';?>">
				<?php if(!empty($per_page) && isset($per_page_list[0]) && !empty($per_page_list[0])):?>
				<input type="hidden" name="items" value="<?php echo $per_page;?>">
				<?php endif;?>
				<label class="btn pull-left input-block__last"><?php echo lang('find');?><input type="submit" class="hide"></label>
				<?php if(!empty($search)):?>
				<a class="btn pull-left ml-10 btn--gray btn--reset"><?php echo lang('clear');?></a>
				<?php endif;?>
				<?php if(isset($category) && !empty($category) && isset($category_list) && !empty($category_list)):?>
				<input type="hidden" name="category" value="<?php echo $category;?>">
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
		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'category_list' => $category_list), TRUE);?>
		<table class="table100 table100--list">
			<?php if($items):?>
			<thead>
				<tr>
					<th class="hide"><?php echo lang('id');?></th>
					<th class="bt0 bl0">
						<?php echo lang('name');?>
						<a href="#" class="ico-mini ico-down sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'name') ? ' active' : '';?>" data-order="name" data-sort="asc"></a>
						<a class="ico-mini ico-up sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'name') ? ' active' : '';?>" data-order="name" data-sort="desc"></a>
					</th>
					<th class="bt0 col-hide-2"><?php echo lang('description');?></th>
					<th class="bt0 col-hide-9">
						<?php echo lang('category');?>
						<a href="#" class="ico-mini ico-down sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'category') ? ' active' : '';?>" data-order="category" data-sort="asc"></a>
						<a class="ico-mini ico-up sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'category') ? ' active' : '';?>" data-order="category" data-sort="desc"></a>
					</th>
					<th class="bt0 col-hide-3">
						<?php echo lang('created');?>
						<a href="#" class="ico-mini ico-down sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'created') ? ' active' : '';?>" data-order="created" data-sort="asc"></a>
						<a class="ico-mini ico-up sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'created') ? ' active' : '';?>" data-order="created" data-sort="desc"></a>
					</th>
					<th class="bt0 col-hide-4">
						<?php echo lang('edited');?>
						<a href="#" class="ico-mini ico-down sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'asc' && $order == 'edited') ? ' active' : '';?>" data-order="edited" data-sort="asc"></a>
						<a class="ico-mini ico-up sort-btn<?php echo (isset($sort) && isset($order) && $sort == 'desc' && $order == 'edited') ? ' active' : '';?>" data-order="edited" data-sort="desc"></a>
					</th>
					<th class="bt0 col-hide-8"><?php echo lang('favorite');?></th>
					<th class="bt0 br0"><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody class="last-bb0">
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="hide">1</td>
					<td class="bl0"><a href="<?php echo base_url('programs/'.$item->hash);?>"><?php echo $item->name;?></a></td>
					<td><?php echo $item->description;?></td>
					<td class="align-middle align-center">
						<?php if(in_array($item->category, $category_list)):?>
						<?php echo $item->category;?>
						<?php endif;?>
					</td>
					<td class="align-middle align-center">
						<?php if($item->created):?>
						<?php echo date('d.m.Y', strtotime($item->created));?>
						<?php endif;?>
					</td>
					<td class="align-middle align-center">
						<?php if($item->edited):?>
						<?php echo date('d.m.Y', strtotime($item->edited));?>
						<?php endif;?>
					</td>
					<td class="align-middle align-center">
						<?php if(!empty($item->favorite)):?>
						<a class="ico-mini ico-star-orange" href="<?php echo base_url('programs/favorite/'.$item->hash);?>" data-type="0" title="<?php echo lang('delete_from_exercise');?>"></a>
						<?php else:?>
						<a class="ico-mini ico-star-black" href="<?php echo base_url('programs/favorite/'.$item->hash);?>" data-type="1" title="<?php echo lang('add_too_exercise');?>"></a>
						<?php endif;?>
					</td>
					<td class="br0 align-center align-middle nowrap">
						<a class="ico-mini ico-link" target="_blank" href="<?php echo base_url($item->hash);?>" title="<?php echo lang('oublic_link');?>"></a>
						<a class="ico-mini ico-open" href="<?php echo base_url('programs/'.$item->hash)?>" title="<?php echo lang('open_for_edit');?>"></a>
						<a class="ico-mini ico-delete one-event__delete" href="<?php echo site_url('programs/delete/'.$item->hash);?>" data-text="<?php echo lang('delete_program');?>" title="<?php echo lang('delete');?>"></a>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
			<?php else:?>
			<tbody>
				<tr>
					<td><?php echo lang('no_programs');?></td>
				</tr>
			</tbody>
			<?php endif;?>
		</table>


		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page, 'category_list' => $category_list), TRUE);?>