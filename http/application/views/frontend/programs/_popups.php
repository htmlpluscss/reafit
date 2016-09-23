<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php if(isset($_filter)):?>
	<div class="popup popup--filter">
		<div class="popup__box">
			<div class="popup__body clr">
				<form>
					<?php echo $_filter;?>
					<a class="btn app-filter-search pull-right"><?php echo lang('apply');?></a>
					<a class="btn popup__close pull-right"><?php echo lang('cancel');?></a>
					<label class="btn pull-right"><input type="reset" class="hide"><?php echo lang('clear');?></label>
					<span class="fast-result-search"><?php echo lang('search_result');?>:&nbsp;<b><?php echo $total_exercises;?></b></span>
				</form>
			</div>
			<a class="icon-cancel-outline popup__close"></a>
		</div>
	</div>
	<?php endif;?>

	<div class="popup popup--close">
		<div class="popup__box">
			<div class="popup__body">
				<p><?php echo lang('program_not_saved');?></p>
				<a class="btn" href="<?php echo site_url('programs');?>"><?php echo lang('dont_save');?></a>
				<a class="btn btn-save-popup"><?php echo lang('save');?></a>
			</div>
			<a class="icon-cancel-outline popup__close"></a>
		</div>
	</div>

	<?php if($this->router->method == 'add'):?>
	<div class="popup popup--create popup--lock show">
		<div class="popup__box">
			<div class="popup__body">
				<?php echo form_open_multipart('programs/add', array('class'=>'new-program-form')); ?>

					<h3><?php echo lang('new_program_title');?></h3>
					<p class="clr">
						<label><span><?php echo lang('name');?>:<sup>*</sup></span> <input class="input popup--create__name" maxlength="40" name="name" value=""></label>
						<a class="icon-help" title="<?php echo lang('required_tooltip');?>"></a>
					</p>
					<p class="clr p-sel-input">
						<label>
							<span><?php echo lang('category');?>:<sup>*</sup></span>
							<div class="select-block">
								<select name="category" class="popup--create__category">
									<option value="none"><?php echo lang('_select');?></option>
								<?php if(!empty($category_list)):?>
								<?php $one_cat = (count($category_list) == 1) ? true : false;?>
								<?php foreach ($category_list as $key => $cat) :?>
									<option value="<?php echo $cat;?>"<?php echo ($cat == $category || $one_cat) ? ' selected="selected"' : '';?>><?php echo $cat;?></option>
								<?php endforeach;?>
								<?php endif;?>
								</select>
							</div>
						</label>
						<a class="icon-help" title="<?php echo lang('program_category_help');?>"></a>
						<p class="clr"></p>
					</p>

					<p class="clr">
						<label><span><?php echo lang('email');?>:</span> <input  name="mail" class="input popup--create__email" type="email" data-error="<?php echo lang('mail_not_correct');?>"></label>
						<a class="icon-help" title="<?php echo lang('new_program_email_help');?>"></a>
					</p>
					<p class="clr">
						<label><span><?php echo lang('description');?>:</span> <textarea name="description" class="input popup--create__textarea"></textarea></label>
						<a class="icon-help" title="<?php echo lang('program_des_help');?>"></a>
					</p>
					<p><a class="btn popup--create__btn"><?php echo lang('create');?></a></p>
				<?php echo form_close(); ?>
			</div>
			<a class="icon-cancel-outline popup__close" onClick="history.back();return false;"></a>
		</div>
	</div>
	<?php endif;?>