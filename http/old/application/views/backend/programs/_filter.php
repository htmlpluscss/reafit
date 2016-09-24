<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if($tags):?>
<table>
	<tr>
	<?php $colum = 0;?>
	<?php $group = '';?>
	<?php $last = end($tags);?>
	<?php foreach ($tags as $key => $tag) :?>
	<?php if($colum != $tag->colum):?>
		<td>
	<?php endif;?>
	<?php if($group != $tag->group):?>
			<h3><?php echo $tag->group;?></h3>
	<?php endif;?>
	<?php
		$colum = $tag->colum;
		$group = $tag->group;
	?>
			<label class="checkbox"><input type="checkbox" value="<?php echo $tag->id;?>"><?php echo $tag->tag;?></label>
			<?php if($tag->subtags):?>
			<?php foreach ($tag->subtags as $key => $subtag) :?>
			<label class="checkbox"><input type="checkbox" value="<?php echo $subtag->id;?>">- <?php echo $subtag->tag;?></label>
			<?php endforeach;?>
			<?php endif;?>
			<?php if($colum == 3 && $tag->id == $last->id):?>
				<h3><?php echo lang('categories');?></h3>
				<?php $categories = explode("\n", str_replace("\r\n", "\n", $this->settings->categories));?>
				<?php if(!empty($categories)):?>
				<?php foreach ($categories as $c_key => $category) :?>
					<label class="checkbox"><input type="checkbox" value="<?php echo $category;?>"><?php echo $category;?></label>
				<?php endforeach;?>
				<?php endif;?>
			<?php endif;?>
	<?php if($colum != $tag->colum):?>
		</td>
	<?php endif;?>
	<?php endforeach;?>
	</tr>
</table>
	<?php unset($colum);?>
	<?php unset($group);?>
<?php endif;?>