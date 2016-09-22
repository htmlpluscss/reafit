<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="pull-left">
			<a class="btn" href="<?php echo site_url('admin/exercises/add');?>"><?php echo lang('create_exercise');?></a>
		</div>
		<form class="pull-right input-block" action="<?php echo $action;?>" method="GET">
			<input class="input pull-left input-block__first" name="search" value="<?php echo (!empty($search)) ? $search : '';?>">
			<?php if(!empty($per_page) && isset($per_page_list[0]) && !empty($per_page_list[0])):?>
			<input type="hidden" name="items" value="<?php echo $per_page;?>" />
			<?php endif;?>
			<label class="btn pull-left input-block__last"><?php echo lang('find');?><input type="submit" class="hide"></label>
			<?php if(!empty($search)):?>
			<a class="btn pull-left ml-10 btn--gray btn--reset"><?php echo lang('clear');?></a>
			<?php endif;?>
		</form>

		<div class="col-hide clear-both">
			<p><?php echo lang('hide_colums');?>:</p>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="1"><?php echo lang('id');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="11"><?php echo lang('order');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="2"><?php echo lang('exercise_image_1');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="3"><?php echo lang('exercise_image_2');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="4"><?php echo lang('exercise_image_3');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="8"><?php echo lang('tags');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="9"><?php echo lang('same');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="10"><?php echo lang('progress');?></label>
			<label class="checkbox"><input type="checkbox" data-id="exercises" value="12"><?php echo lang('category');?></label>
		</div>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page' => $per_page, 'search'=>$search), TRUE);?>
		<table class="table100 table100--list">
			<?php if($items):?>
			<thead>
				<tr>
					<th class="col-hide-1"><?php echo lang('id');?></th>
					<th class="col-hide-11"><?php echo lang('order');?></th>
					<th><?php echo lang('name');?></th>
					<th class="col-hide-2"><?php echo lang('exercise_image_1');?></th>
					<th class="col-hide-3"><?php echo lang('exercise_image_2');?></th>
					<th class="col-hide-4"><?php echo lang('exercise_image_3');?></th>
					<th class="col-hide-8"><?php echo lang('tags');?></th>
					<th class="col-hide-9"><?php echo lang('same');?></th>
					<th class="col-hide-10"><?php echo lang('progress');?></th>
					<th class="col-hide-12"><?php echo lang('category');?></th>
					<th><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="align-center"><?php echo $item->id;?></td>
					<td><input value="<?php echo $item->order;?>" class="input table100--list__item" data-url="<?php echo base_url('admin/exercises/order/'.$item->hash);?>"></td>
					<td><b><?php echo $item->name;?></b> <?php echo $item->name_desc;?></td>
					<td>
						<?php if($item->image_1):?>
						<img src="<?php echo site_url('images/'.$item->image_1);?>" height="100" alt="<?php echo $item->name;?>">
						<?php endif;?>
					</td>
					<td>
						<?php if($item->image_2):?>
						<img src="<?php echo site_url('images/'.$item->image_2);?>" height="100" alt="<?php echo $item->name;?>">
						<?php endif;?>
					</td>
					<td>
						<?php if($item->image_3):?>
						<img src="<?php echo site_url('images/'.$item->image_3);?>" height="100" alt="<?php echo $item->name;?>">
						<?php endif;?>
					</td>
					<td class="tags">
						<?php if(!empty($item->tags)):?>
						<?php foreach ($item->tags as $key => $tag) :?>
						<small><?php echo $tag->tag;?></small>
						<?php endforeach;?>
						<?php endif;?>
					</td>
					<td class="tags">
						<?php if(!empty($item->related)):?>
						<?php foreach ($item->related as $key => $related) :?>
						<small><?php echo $related->name;?></small>
						<?php endforeach;?>
						<?php endif;?>
					</td>
					<td class="tags">
						<?php if(!empty($item->progress)):?>
						<?php foreach ($item->progress as $key => $progress) :?>
						<small><?php echo $progress->name;?></small>
						<?php endforeach;?>
						<?php endif;?>
					</td>
					<td>
						<?php if(in_array($item->category, $category_list)):?>
							<?php echo $item->category;?>
						<?php endif;?>
					</td>
					<td>
						<ul class="one-event">
							<li><a class="ico-mini ico-open" href="<?php echo site_url('admin/exercises/'.$item->hash);?>"></a></li>
<?php /*
							<li><a class="ico-mini ico-delete one-event__delete" href="<?php echo site_url('admin/exercises/delete/'.$item->hash.'?return=admin/exercises');?>" data-text="<?php echo lang('delete_exercidse');?>"></a></li>
*/;?>
							<li><a class="ico-mini ico-info one-event__detal"></a></li>
							<?php if(!empty($item->video)):?>
							<li><a class="ico-mini ico--play play-video" data-video="<?php echo $item->video;?>"></a></li>
							<?php endif;?>
						</ul>
						<?php echo $this->load->view('backend/'.$this->router->class.'/_item_detail', array('exercise'=>$item), TRUE);?>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
			<?php else:?>
			<tbody>
				<tr>
					<td><?php echo lang('no_exercises');?></td>
				</tr>
			</tbody>
			<?php endif;?>
		</table>

		<?php echo $this->load->view('backend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page, 'search'=>$search), TRUE);?>