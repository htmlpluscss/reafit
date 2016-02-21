<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="pull-left">
			<a class="btn" href="<?php echo site_url('exercises/add');?>"><?php echo lang('create_exercise');?></a>
		</div>
		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action), TRUE);?>
		<table class="table100 table100--list">
			<thead>
				<tr>
					<th class="hide"><?php echo lang('id');?></th>
					<th><?php echo lang('name');?></th>
					<th class="col-hide-2"><?php echo lang('exercise_image_1');?></th>
					<th class="col-hide-3"><?php echo lang('exercise_image_2');?></th>
					<th class="col-hide-4"><?php echo lang('exercise_image_3');?></th>
					<th class="col-hide-8"><?php echo lang('tags');?></th>
					<th><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody>
			<?php if($items):?>
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="hide">1</td>
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
					<td>
						<ul class="one-event">
							<li><a class="icon-edit" href="<?php echo site_url('exercises/'.$item->hash);?>"></a></li>
							<li><a class="icon-trash-empty one-event__delete" href="<?php echo site_url('exercises/delete/'.$item->hash);?>" data-text="<?php echo lang('delete_exercidse');?>"></a></li>
							<li><a class="icon-info one-event__detal"></a></li>
							<li>
								<?php if(!empty($item->video)):?>
								<a class="icon-play play-video" data-video="<?php echo $item->video;?>"></a>
								<?php endif;?>
							</li>
						</ul>
						<?php echo $this->load->view('frontend/'.$this->router->class.'/_item_detail', array('exercise'=>$item), TRUE);?>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
				<tr>
					<td colspan="7"><?php echo lang('no_exercises');?></td>
				</tr>
			<?php endif;?>
			</tbody>
		</table>


		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page), TRUE);?>