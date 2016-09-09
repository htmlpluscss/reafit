<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php echo form_open_multipart('admin/exercises/add', array('class'=>'app-left pull-left tabs save-form')); ?>
		<div class="tabs__nav clr">
			<ul>
				<li><span class="tabs__dt tabs__dt--active" data-tab="1"><?php echo lang('name');?></span></li>
				<li><span class="tabs__dt tabs__dt" data-tab="2"><?php echo lang('media');?></span></li>
				<li><span class="tabs__dt tabs__dt" data-tab="3"><?php echo lang('description');?></span></li>
				<li><span class="tabs__dt tabs__dt" data-tab="4"><?php echo lang('filter');?></span></li>
				<li><span class="tabs__dt tabs__dt" data-tab="5"><?php echo lang('same');?></span></li>
				<li><span class="tabs__dt tabs__dt" data-tab="6"><?php echo lang('progress');?></span></li>
			</ul>
		</div>
		<div class="tabs__dd tabs__dd--1 tabs__dd--active">
			<div class="l-h form-tabs form-tabs--input100p">
				<h2><?php echo lang('exercise_name');?></h2>
				<p class="clr">
					<label><input class="input" name="name" value="<?php echo $name;?>"> <a class="icon-help" title="<?php echo lang('exercise_name_title');?>"></a></label>
				</p>
				<p class="clr">
					<label><?php echo lang('exercise_desc');?> <input class="input" name="name_desc" value="<?php echo $name_desc;?>"><a class="icon-help" title="<?php echo lang('exercise_desc_title');?>"></a></label>
				</p>
				<p class="clr">
					<label>
						<span><?php echo lang('exercise_order');?></span>
						<input class="input w50" name="order" value="<?php echo $order;?>">
						<a class="icon-help" title="<?php echo lang('exercise_order_title');?>"></a>
					</label>
				</p>
				<p>
					<label>
						<span><?php echo lang('category');?></span>
						<?php $categories = explode("\n", str_replace("\r\n", "\n", $this->settings->categories));?>
						<div class="select-block">
							<select name="category">
								<option value="none"><?php echo lang('_select');?></option>
							<?php if(!empty($categories)):?>
							<?php $one_cat = (count($categories) == 1) ? true : false;?>
							<?php foreach ($categories as $key => $category) :?>
								<option value="<?php echo $category;?>"<?php echo ($one_cat) ? ' selected="selected"' : '';?>><?php echo $category;?></option>
							<?php endforeach;?>>
							<?php endif;?>
							</select>
							<a class="icon-help" title="<?php echo lang('exercise_category_help');?>"></a>
						</div>
					</label>
				</p>
				<p class="clr"></p>
			</div>
		</div>
		<div class="tabs__dd tabs__dd--2">
			<div class="l-h form-tabs form-tabs--180">
				<h2><?php echo lang('image');?></h2>
				<p class="clr">
					<label>
						<span><?php echo lang('exercise_image_1');?>:</span> <input type="file" name="image_1">
						<?php if($image_1):?>
							<img src="<?php echo $image_1;?>" height="100" alt="<?php echo $name;?>">
						<?php endif;?>
					</label>
				</p>
				<p class="clr">
					<label>
						<span><?php echo lang('exercise_image_2');?>:</span> <input type="file" name="image_2">
						<?php if($image_2):?>
							<img src="<?php echo $image_2;?>" height="100" alt="<?php echo $name;?>">
						<?php endif;?>
					</label>
				</p>
				<p class="clr">
					<label>
						<span><?php echo lang('exercise_image_3');?>:</span> <input type="file" name="image_3">
						<?php if($image_3):?>
							<img src="<?php echo $image_3;?>" height="100" alt="<?php echo $name;?>">
						<?php endif;?>
					</label>
				</p>
				<h2><?php echo lang('video');?></h2>
				<p class="clr">
					<label><span><?php echo lang('exercise_video_id');?></span> <input class="input" name="video" value="<?php echo $video;?>"></label>
					<a class="icon-help" title="<?php echo lang('video_desc');?>"></a>
					<?php if($video):?>
					<iframe width="430" height="281" src="https://www.youtube.com/embed/<?php echo $video;?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
					<?php endif;?>
				</p>
			</div>
		</div>
		<div class="tabs__dd tabs__dd--3">
			<div class="l-h form-tabs">
				<h2><?php echo lang('exercise_description');?></h2>
				<textarea name="description" class="editor"><?php echo $description_text;?></textarea>
			</div>
		</div>
		<div class="tabs__dd tabs__dd--4">
			<div class="l-h form-tabs form-tabs--filter">
			<?php if($tags):?>
			<table>
				<tr>
				<?php $colum = 0;?>
				<?php $group = '';?>
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
						<label class="checkbox"><input type="checkbox" name="tags[]" value="<?php echo $tag->id;?>"<?php if(!empty($tags_data) && in_array($tag->id, $tags_data)) {echo ' checked="checked"';}?>><?php echo $tag->tag;?></label>
						<?php if($tag->subtags):?>
						<?php foreach ($tag->subtags as $key => $subtag) :?>
						<label class="checkbox"><input type="checkbox" name="tags[]" value="<?php echo $subtag->id;?>"<?php if(!empty($tags_data) && in_array($subtag->id, $tags_data)) {echo ' checked="checked"';}?>>- <?php echo $subtag->tag;?></label>
						<?php endforeach;?>
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
			</div>
		</div>
		<div class="tabs__dd tabs__dd--5">
			<ul class="l-h exercises-my" data-type="related">
			<?php if($related):?>
			<?php echo $this->load->view('backend/'.$this->router->class.'/_item', array('exercises'=>$related, 'type'=> 'related'), TRUE);?>
			<?php endif;?>
			</ul>
		</div>
		<div class="tabs__dd tabs__dd--6">
			<ul class="l-h exercises-my" data-type="progress">
			<?php echo $this->load->view('backend/'.$this->router->class.'/_item', array('exercises'=>$progress, 'type'=> 'progress'), TRUE);?>
			</ul>
		</div>
		<input type="hidden" name="redirect" value="" />
	<?php echo form_close(); ?>

		<div class="app-right pull-right">

			<div class="search-exercises">

				<div class="search-exercises__filter clr">

					<div class="search-exercises__input pull-left">
						<input id="autocomplete-exercises" class="input" placeholder="<?php echo lang('exercise_search');?>">
						<a class="icon-cancel search-exercises__clear-input"></a>
					</div>

					<a class="btn pull-right filter-show"><?php echo lang('filter');?></a>

				</div>
			</div>
			<?php if($exercises):?>
			<ul class="exercises-list clr">
				<?php echo $this->load->view('backend/'.$this->router->class.'/_item', array('exercises'=>$exercises, 'class'=>'exercises-list__item popup-box', 'type' => false), TRUE);?>
			</ul>
			<?php endif;?>

		</div>

		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('backend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>