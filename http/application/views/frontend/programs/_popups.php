<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	<?php if(isset($_filter)):?>
	<div class="popup popup--filter">
		<div class="popup__box">
			<form class="popup__body">
				<div class="popup__inner baron clr">
					<?php echo $_filter;?>
					<div class="baron__track">
						<div class="baron__free">
							<a class="baron__bar"></a>
						</div>
					</div>
				</div>
				<hr>
				<a class="btn app-filter-search pull-right"><?php echo lang('apply');?></a>
				<a class="btn btn--gray popup__close pull-right"><?php echo lang('cancel');?></a>
				<label class="btn btn--white pull-right"><input type="reset" class="hide"><?php echo lang('clear');?></label>
				<span class="fast-result-search pull-left"><?php echo lang('search_result');?>:<b><?php echo $total_exercises;?></b></span>
			</form>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>
	<?php endif;?>

	<div class="popup popup--close">
		<div class="popup__box">
			<div class="popup__body">
				<p><?php echo lang('program_not_saved');?></p>
				<a class="btn btn--gray link-exit-redirect" href="<?php echo site_url('programs');?>"><?php echo lang('dont_save');?></a>
				<a class="btn btn-save btn-save--redirect link-exit-redirect"><?php echo lang('save_change');?></a>
			</div>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>