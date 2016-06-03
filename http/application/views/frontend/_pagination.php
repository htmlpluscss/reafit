<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
			<div class="pagin clr clear-both">
				<div class="pull-right">
					<?php if(!empty($per_page_list)):?>
					<form action="<?php echo $action;?>" method="get">
					<?php if(isset($category_list) && !empty($category_list)):?>
					<div class="pull-left">
						<select name="category" class="pagination-items" data-class="select--border-white">
							<option value=" "><?php echo lang('all_categories');?></option>
						<?php foreach ($category_list as $key => $item):?>
							<option value="<?php echo $item;?>"<?php if($category == $item) {echo ' selected="selected"';}?>><?php echo $item;?></option>
						<?php endforeach;?>
						</select>
					</div>
					<?php endif;?>
					<div class="pull-left ml-10">
						<select name="items" class="pagination-items" data-class="select--border-white">
							<?php foreach ($per_page_list as $key => $item) :?>
							<?php if(is_integer($item)):?>
							<option value="<?php echo $item;?>"<?php if($per_page == $item) {echo ' selected="selected"';}?>><?php echo $item;?></option>
							<?php else:?>
							<option value="<?php echo $item;?>"<?php if($per_page == $item) {echo ' selected="selected"';}?>><?php echo lang($item);?></option>
							<?php endif;?>
							<?php endforeach;?>
						</select>
					</div>
					<?php if(!empty($search)):?>
					<input type="hidden" name="search" value="<?php echo $search;?>" />
					<?php endif;?>
					<?php if(isset($sort) && isset($order) && !empty($sort) && !empty($order)):?>
					<input type="hidden" name="order" value="<?php echo $order;?>" />
					<input type="hidden" name="sort" value="<?php echo $sort;?>" />
					<?php endif;?>
					</form>
					<?php endif;?>
				</div>
				<?php echo $pagination;?>
			</div>