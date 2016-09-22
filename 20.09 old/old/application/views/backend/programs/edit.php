<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php echo form_open_multipart('admin/programs/'.$hash, array('class'=>'app-left pull-left tabs spy save-form')); ?>
		<input type="hidden" name="redirect" value="" />
		<div class="tabs__nav tabs__slider clr">
			<div class="tabs__slider-nav pull-right">
				<a class="tabs__slider-nav-left tabs__slider-nav-left--stop icon-collapse-left"></a>
				<a class="tabs__slider-nav-right icon-expand-right"></a>
			</div>
			<div class="box">
				<ul>
					<li><span class="tabs__dt tabs__dt--active" data-tab="1"><?php echo lang('name');?></span></li>
					<li><span class="tabs__dt tabs__dt" data-tab="2"><?php echo lang('media');?></span></li>
					<li><span class="tabs__dt tabs__dt" data-tab="3"><?php echo lang('description');?></span></li>
					<?php if(!empty($tabs)):?>
					<?php foreach ($tabs as $key => $tab) :?>
					<li><span class="tabs__dt tabs__dt" data-tab="<?php echo $tab->hash;?>"><?php echo $tab->name;?></span></li>
					<?php endforeach;?>
					<?php endif;?>
				</ul>
			</div>
		</div>
		<div class="tabs__dd tabs__dd--1 tabs__dd--active">
			<div class="l-h form-tabs form-tabs--input100p">
				<h2><?php echo lang('exercise_name');?>:</h2>
				<p class="clr">
					<label><input class="input" name="name" value="<?php echo $name;?>"> <a class="icon-help" title="<?php echo lang('exercise_name_title');?>"></a></label>
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
							<?php foreach ($categories as $key => $cat) :?>
								<option value="<?php echo $cat;?>"<?php echo ($cat == $category || $one_cat) ? ' selected="selected"' : '';?>><?php echo $cat;?></option>
							<?php endforeach;?>
							<?php if(!in_array($category, $categories)):?>
								<option value="<?php echo $category;?>" selected="selected"><?php echo $category;?></option>
							<?php endif;?>
							<?php endif;?>
							</select>
							<a class="icon-help" title="<?php echo lang('program_category_help');?>"></a>
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
						<span><?php echo lang('image');?>:</span> <input type="file" name="image">
						<?php if($image):?>
							<img src="<?php echo $image;?>" height="100" alt="<?php echo $name;?>">
						<?php endif;?>
					</label>
				</p>
			</div>
		</div>
		<div class="tabs__dd tabs__dd--3">
			<div class="l-h form-tabs">
				<h2><?php echo lang('exercise_description');?></h2>
				<p><?php echo lang('exercise_description_t');?></p>
				<textarea name="description" class="editor"><?php echo $description_text;?></textarea>
			</div>
		</div>
		<?php if(!empty($tabs)):?>
		<?php foreach ($tabs as $key => $tab) :?>
			<div class="tabs__dd tabs__dd--<?php echo $tab->hash;?>">
				<ul class="l-h exercises-my" data-type="exercises[<?php echo $tab->hash;?>][data]">
				<?php if(($tab->exercises) && !empty($tab->exercises)):?>
				<?php echo $this->load->view('backend/'.$this->router->class.'/_item', array('program' => $hash, 'exercises'=>$tab->exercises, 'key'=>$key, 'tab'=>$tab, 'type' => 'exercises['.$tab->hash.'][data]'), TRUE);?>
				<?php endif;?>
				</ul>
			</div>
		<?php endforeach;?>
		<?php endif;?>
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