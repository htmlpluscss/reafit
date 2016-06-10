<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

		<div class="programme-head">
			<h1 class="programme-head__title"><?php echo $header;?></h1>
			<a class="ico ico--detal pull-left data-tab-link" data-tab="detal" title="<?php echo lang('program_detal');?>" data-change="0"></a>
			<div class="programme-head__icons">
				<a class="ico ico--fullscreen app-fullscreen" title="<?php echo lang('fullscreen');?>"></a>
			</div>
		</div>

		<div class="app clr">
			<div class="programme-body programme-body--app tabs app-left">

					<?php if(isset($_nav) && !empty($_nav)) echo $_nav; ?>

				<div class="tabs__nav clr">
					<div class="box">
						<ul></ul>
					</div>
					<a class="tabs__btn-select"></a>
					<div class="tabs__select"></div>
				</div>

				<?php include('_app_left.php');//echo $_app_left; ?>

			<?php echo form_open_multipart('programs/add', array('class'=>'save-form spy')); ?>
				<input type="hidden" name="redirect" value="" />
				<input type="hidden" name="params[tab]" value="" />
			<?php echo form_close(); ?>

		</div>

			<div class="exercises-body app-right pull-right">

				<div class="search-exercises">

					<div class="search-exercises__filter clr">

						<div class="search-exercises__input pull-left">
							<input id="autocomplete-exercises" class="input" placeholder="<?php echo lang('exercise_search');?>">
							<a class="search-exercises__clear-input hide ico ico--close"></a>
							<a class="ico ico--search"></a>
						</div>

						<a class="btn pull-right tab-exercises-list tab-exercises-list--active ico ico--programs ml-10" title="<?php echo lang('programs');?>"></a>
						<a class="btn pull-right tab-exercises-list ico ico--exercises ml-10" title="<?php echo lang('exercises');?>"></a>
						<a class="btn pull-right search-exercises__btn filter-show"><?php echo lang('filter');?></a>

					</div>
				</div>
				<div class="l-h">
					<div class="l-h__inner">
						<ul class="exercises-list clr">
							<?php if($exercises):?>
							<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('program'=>false, 'tab'=>false, 'exercises'=>$exercises, 'class'=>'exercises-list__item popup-box','type'=>false), TRUE);?>
							<?php endif;?>
							<?php if($programs):?>
							<?php echo $this->load->view('frontend/'.$this->router->class.'/_item_program', array('programs'=>$programs), TRUE);?>
							<?php endif;?>
						</ul>
					</div>
				</div>

			</div>
		</div>

		</div>
		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>