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