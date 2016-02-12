<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="pull-left">
			<a class="btn" href="<?php echo site_url('programs/add');?>"><?php echo lang('create_program');?></a>
		</div>
		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action), TRUE);?>
		<table class="table100 table100--list">
			<thead>
				<tr>
					<th class="hide"><?php echo lang('id');?></th>
					<th><?php echo lang('name');?></th>
					<th class="col-hide-2"><?php echo lang('description');?></th>
					<th class="col-hide-3"><?php echo lang('created');?></th>
					<th class="col-hide-4"><?php echo lang('edited');?></th>
					<th class="col-hide-8"><?php echo lang('favorite');?></th>
					<th><?php echo lang('actions');?></th>
				</tr>
			</thead>
			<tbody>
			<?php if($items):?>
			<?php foreach ($items as $key => $item) :?>
				<tr>
					<td class="hide">1</td>
					<td><a href="<?php echo base_url('programs/'.$item->hash);?>"><?php echo $item->name;?></a></td>
					<td><?php echo $item->description;?></td>
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
						<a class="icon-star" href="<?php echo base_url('programs/favorite/'.$item->hash);?>" data-type="0"></a>
						<?php else:?>
						<a class="icon-star-empty" href="<?php echo base_url('programs/favorite/'.$item->hash);?>" data-type="1"></a>
						<?php endif;?>
					</td>
					<td class="align-center align-middle nowrap">
						<a class="icon-link" target="_blank" href="<?php echo base_url($item->hash);?>"></a>
						<a class="icon-folder-open-empty" href="<?php echo base_url('programs/'.$item->hash)?>"></a>
						<a class="icon-trash-empty one-event__delete" href="<?php echo site_url('programs/delete/'.$item->hash);?>" data-text="<?php echo lang('delete_program');?>"></a>
					</td>
				</tr>
			<?php endforeach;?>
			<?php else:?>
				<tr>
					<td colspan="7"><?php echo lang('no_programs');?></td>
				</tr>
			<?php endif;?>
			</tbody>
		</table>


		<?php echo $this->load->view('frontend/_pagination', array('pagination'=>$pagination, 'action' => $action, 'per_page_list' => $per_page_list, 'per_page' => $per_page), TRUE);?>