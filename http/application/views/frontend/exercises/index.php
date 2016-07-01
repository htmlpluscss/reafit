<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="clr">
			<a class="btn pull-left" href="<?php echo site_url('exercises/add');?>"><?php echo lang('create_exercise');?></a>
			<form class="pull-right input-block" action="<?php echo $action;?>" method="GET">
				<input class="input input--border-white pull-left input-block__first" name="search" value="<?php echo (!empty($search)) ? $search : '';?>">
				<?php if(!empty($per_page) && isset($per_page_list[0]) && !empty($per_page_list[0])):?>
				<input type="hidden" name="items" value="<?php echo $per_page;?>" />
				<?php endif;?>
				<label class="btn pull-left input-block__last"><?php echo lang('find');?><input type="submit" class="hide"></label>
				<?php if(!empty($search)):?>
				<a class="btn pull-left ml-10 btn--gray btn--reset"><?php echo lang('clear');?></a>
				<?php endif;?>
			</form>
		</div>
		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action), TRUE);?>
		<table class="table100 table100--list">
			<?php if($items):?>
			<thead>
				<tr>
					<th class="hide"><?php echo lang('id');?></th>
					<th class="bt0 bl0"><?php echo lang('name');?></th>
					<th class="bt0 col-hide-2"><?php echo lang('exercise_image_1');?></th>
					<th class="bt0 col-hide-3"><?php echo lang('exercise_image_2');?></th>
					<th class="bt0 col-hide-4"><?php echo lang('exercise_image_3');?></th>
					<th class="bt0 col-hide-8"><?php echo lang('tags');?></th>
					<th class="bt0 col-hide-9"><?php echo lang('category');?></th>
					<th class="bt0 br0"><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody class="last-bb0">
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="hide">1</td>
					<td class="bl0"><b><?php echo $item->name;?></b> <?php echo $item->name_desc;?></td>
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
					<td class="align-middle align-center">
						<?php if(in_array($item->category, $category_list)):?>
						<?php echo $item->category;?>
						<?php endif;?>
					</td>
					<td class="br0">
						<ul class="one-event">
							<li><a class="ico-mini ico-open" href="<?php echo site_url('exercises/'.$item->hash);?>" title="<?php echo lang('edit');?>"></a></li>
							<li><a class="ico-mini ico-delete one-event__delete" href="<?php echo site_url('exercises/delete/'.$item->hash);?>" data-text="<?php echo lang('delete_exercidse');?>" title="<?php echo lang('delete');?>"></a></li>
							<li><a class="ico-mini ico-info one-event__detal" title="просмотреть"></a></li>
							<li>
								<?php if(!empty($item->video)):?>
								<a class="ico-mini ico-play play-video" data-video="<?php echo $item->video;?>" title="<?php echo lang('open_video');?>"></a>
								<?php endif;?>
							</li>
						</ul>
						<?php echo $this->load->view('frontend/'.$this->router->class.'/_item_detail', array('exercise'=>$item), TRUE);?>
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


		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page), TRUE);?>