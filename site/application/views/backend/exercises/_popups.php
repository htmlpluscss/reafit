<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<div class="popup popup--filter">
		<div class="popup__box">
			<div class="popup__body clr">
				<form>
					<?php echo $_filter;?>
					<a class="btn app-filter-search pull-right"><?php echo lang('apply');?></a>
					<a class="btn popup__close pull-right"><?php echo lang('cancel');?></a>
					<label class="btn pull-right"><input type="reset" class="hide"><?php echo lang('clear');?></label>
					<span class="fast-result-search"><?php echo lang('search_result');?>: <b><?php echo $total_exercises;?></b></span>
				</form>
			</div>
			<a class="icon-cancel-outline popup__close"></a>
		</div>
	</div>

	<div class="popup popup--close">
		<div class="popup__box">
			<div class="popup__body">
				<p><?php echo lang('exercise_not_saved');?></p>
				<a class="btn" href="<?php echo site_url('admin/exercises');?>"><?php echo lang('dont_save');?></a>
				<a class="btn btn-save-popup"><?php echo lang('save');?></a>
			</div>
			<a class="icon-cancel-outline popup__close"></a>
		</div>
	</div>