<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php if(isset($_filter)):?>
	<div class="popup popup--filter">
		<div class="popup__box">
			<div class="popup__body clr">
				<form>
					<?php echo $_filter;?>
					<a class="btn app-filter-search pull-right"><?php echo lang('apply');?></a>
					<a class="btn btn--gray popup__close pull-right"><?php echo lang('cancel');?></a>
					<label class="btn btn--white pull-right"><input type="reset" class="hide"><?php echo lang('clear');?></label>
					<span class="fast-result-search"><?php echo lang('search_result');?>:<b><?php echo $total_exercises;?></b></span>
				</form>
			</div>
			<a class="ico ico--close popup__close"></a>
		</div>
	</div>
	<?php endif;?>

	<div class="popup popup--close">
		<div class="popup__box">
			<div class="popup__body">
				<p><?php echo lang('program_not_saved');?></p>
				<a class="btn btn--gray" href="<?php echo site_url('programs');?>"><?php echo lang('dont_save');?></a>
				<a class="btn btn-save-popup"><?php echo lang('save_change');?></a>
			</div>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>

	<?php if($this->router->method == 'add'):?>
	<div class="popup popup--create popup--lock show">
		<div class="popup__box">
			<div class="popup__body">
				<?php echo form_open_multipart('programs/add', array('class'=>'new-program-form')); ?>

					<h3><?php echo lang('new_program_title');?></h3>
					<div class="w260 pull-left">
						<label class="input-placeholder">
							<input class="input popup--create__name" name="name" maxlength="40">
							<span class="input-placeholder__label"><?php echo lang('name');?> <sup>*</sup></span>
						</label>
						<div class="popup__select">
							<select name="category" class="popup--create__category" data-required-sup>
								<option value="none"><?php echo lang('select_category');?></option>
							<?php if(!empty($category_list)):?>
							<?php $one_cat = (count($category_list) == 1) ? true : false;?>
							<?php foreach ($category_list as $key => $cat) :?>
								<option value="<?php echo $cat;?>"<?php echo ($cat == $category || $one_cat) ? ' selected="selected"' : '';?>><?php echo $cat;?></option>
							<?php endforeach;?>
							<?php endif;?>
							</select>
						</div>
						<label class="input-placeholder">
							<input class="input popup--create__email" name="mail" type="email" data-error="<?php echo lang('mail_not_correct');?>">
							<span class="input-placeholder__label"><?php echo lang('email');?></span>
						</label>
						<p class="popup__required_notification"><sup>*</sup> <?php echo lang('required_notification');?></p>
					</div>
					<div class="w260 pull-right">
						<div class="input-placeholder">
							<textarea class="input popup--create__textarea" name="description"></textarea>
							<span class="input-placeholder__label"><?php echo lang('description');?></span>
						</div>
						<a class="btn popup--create__btn"><?php echo lang('create');?></a>
					</div>

				<?php echo form_close(); ?>
			</div>
			<a class="ico ico--close popup__close" onClick="history.back();return false;"></a>
		</div>
	</div>
	<?php endif;?>