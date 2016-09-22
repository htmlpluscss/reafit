<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		<div class="app-left pull-left tabs">
		<?php $active_tab = (isset($params->tab)) ? (int) $params->tab : 0; ?>
		<?php
			if($active_tab == 0) {
				$active_tab = 8;
			}
		?>
		<?php (isset($tab)) ? $tab : false;?>
			<div class="tabs__nav tabs__slider clr">
				<div class="tabs__slider-nav pull-right">
					<a class="tabs__slider-nav-left tabs__slider-nav-left--stop icon-collapse-left"></a>
					<a class="tabs__slider-nav-right icon-expand-right"></a>
				</div>
				<div class="box">
					<ul>
					<?php if(!empty($tabs)):?>
					<?php $_tab_key = 8;?>
					<?php foreach ($tabs as $key => $tab) :?>
						<li><span class="tabs__dt tabs__dt<?php if($_tab_key == $active_tab) { echo ' tabs__dt--active';}?>" data-tab="<?php echo $_tab_key++;?>"><?php echo $tab->name;?></span></li>
					<?php endforeach;?>
					<?php endif;?>
					</ul>
				</div>
			</div>

			<div class="hide">
				<span class="tabs__dt tabs__dt--not-delete" data-tab="send-email"></span>
				<span class="tabs__dt tabs__dt--not-delete" data-tab="desc"></span>
				<span class="tabs__dt tabs__dt--not-delete" data-tab="save"></span>
				<span class="tabs__dt tabs__dt--not-delete" data-tab="save-as"></span>
				<span class="tabs__dt tabs__dt--not-delete" data-tab="open"></span>
				<span class="tabs__dt tabs__dt--not-delete" data-tab="start"></span>
			</div>

			<div class="tabs__dd tabs__dd--send-email">
				<form class="l-h send-email-form" data-url="<?php echo base_url('programs/mail/'.$hash);?>">
					<h2><?php echo lang('send_program_mail');?></h2>
					<div class="name-programme--email-false">
						<p class="mb10"><?php echo lang('program');?> <span class="name-programme"><?php echo $name;?></span> <?php echo lang('will_be_sent_to');?> <?php echo lang('email');?>:</p>
						<p class="mb10"><input class="input send-email-form__email-2" name="mail[]" type="email" placeholder="<?php echo lang('enter_mail');?>" data-error="<?php echo lang('mail_not_correct');?>" value="<?php echo $mail;?>"></p>
					</div>
					<a class="btn send-email-form__btn"><?php echo lang('send');?></a>
				</form>
			</div>
			<div class="tabs__dd tabs__dd--save">
				<form class="l-h form-tabs form-name-proggram" data-submit="1">
					<h2><?php echo lang('save_program');?></h2>
					<p class="clr">
						<label><span><?php echo lang('name');?>:<sup>*</sup></span> <input class="input name-programme--input" maxlength="40" value="<?php echo $name;?>"></label>
					</p>
					<p>
						<label>
							<span><?php echo lang('category');?>:<sup>*</sup></span>
							<div class="select-block">
								<select name="category name-programme--category">
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
					</p>
					<p class="clr"></p>
					<p class="clr">
						<label><span><?php echo lang('email');?>:</span> <input class="input name-programme--email" type="email" data-error="<?php echo lang('mail_not_correct');?>" value="<?php echo $mail;?>"></label>
					</p>
					<p class="clr">
						<label><span><?php echo lang('description');?>:</span> <textarea class="input name-programme--textarea"><?php echo $description_text;?></textarea></label>
					</p>
					<p><a class="btn save-program"><?php echo lang('save');?></a></p>
					<p><a class="btn app-save-and-send"><?php echo lang('save_and_send');?></a></p>
					<h2><?php echo lang('access_pacient');?></h2>
					<ul class="access-tabs">
					<?php if(!empty($tabs)):?>
					<?php foreach ($tabs as $key => $tab) :?>
					<?php $acces_val = (isset($params->access) && isset($params->access[$key])) ? $params->access[$key] : 1; ?>
						<li class="clr access--<?php echo $key + 8;?>">
							<label class="checkbox">
								<input type="checkbox" class="hide access" value="<?php echo $key;?>"<?php echo ($acces_val == 1) ? ' checked' : '';?>> <?php echo $tab->name;?>
							</label>
						</li>
					<?php endforeach;?>
					<?php endif;?>
					</ul>
					<p class="clr">
						<a class="btn app-add-note"><?php echo (empty(trim(strip_tags($note)))) ? lang('add_note') : lang('edit_note');?></a>
					</p>
				</form>
			</div>
			<div class="tabs__dd tabs__dd--save-as">
				<form class="l-h form-tabs form-name-proggram" data-action="<?php echo base_url('programs/add');?>" data-submit="1">
					<h2><?php echo lang('save_program_as');?></h2>
					<p class="clr">
						<label><span><?php echo lang('name');?>:<sup>*</sup></span> <input class="input" maxlength="40"></label>
					</p>
					<p class="clr">
						<label><span><?php echo lang('email');?>:</span> <input class="input" type="email" data-error="<?php echo lang('mail_not_correct');?>"></label>
					</p>
					<p class="clr">
						<label><span><?php echo lang('description');?>:</span> <textarea class="input"></textarea></label>
					</p>
					<p><a class="btn save-program-as"><?php echo lang('save');?></a></p>
				</form>
			</div>
			<div class="tabs__dd<?php if(empty($tabs)){ echo ' tabs__dd--active';}?> tabs__dd--start">
				<div class="l-h">
					<form class="form-tabs add-tab-form">
						<h2><?php echo lang('add_tab_title');?></h2>
						<p class="clr"><label><span><?php echo lang('tab__name_title');?>:</span> <input class="input add-tab-form__name" maxlength="40"></label></p>
						<p><a class="btn add-tab-form__btn"><?php echo lang('save');?></a></p>
					</form>
				</div>
			</div>
			<div class="tabs__dd tabs__dd--open">
				<div class="l-h">
					<h2><?php echo lang('open_program');?></h2>
					<?php if(empty($items)):?>
					<p><?php echo lang('no_programs');?></p>
					<?php else:?>
					<table class="table100">
						<thead>
							<tr>
								<th><?php echo lang('name');?></th>
								<th><?php echo lang('created');?></th>
								<th><?php echo lang('edited');?></th>
								<th><?php echo lang('actions');?></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($items as $key => $item) :?>
							<tr>
								<td><a href="<?php echo base_url('programs/'.$item->hash);?>" class="open-program-link"><?php echo $item->name;?></a></td>
								<td class="align-middle">
								<?php if($item->created):?>
								<?php echo date('d.m.Y', strtotime($item->created));?>
								<?php endif;?>
								</td>
								<td class="align-middle">
								<?php if($item->edited):?>
								<?php echo date('d.m.Y', strtotime($item->edited));?>
								<?php endif;?>
								</td>
								<td class="align-center align-middle nowrap">
									<a class="icon-link" target="_blank" href="<?php echo base_url($item->hash);?>"></a>
									<a class="icon-folder-open-empty open-program-link" href="<?php echo base_url('programs/'.$item->hash);?>"></a>
								</td>
							</tr>
							<?php endforeach;?>
						</tbody>
					</table>
					<?php endif;?>
				</div>
			</div>
			<?php echo form_open_multipart('programs/'.$hash, array('class'=>'save-form spy', 'data-program'=>$hash)); ?>
				<input type="hidden" name="name" class="name-programme--input" value="<?php echo $name;?>" />
				<input type="hidden" name="category" class="name-programme--category" value="<?php echo $category;?>" />
				<input type="hidden" name="mail" class="name-programme--email" value="<?php echo $mail;?>" />
				<input type="hidden" name="description" class="name-programme--textarea" value="<?php echo $mail;?>" />
				<input type="hidden" name="redirect" value="" />
				<input type="hidden" name="params[tab]" value="" />
				<?php if(!empty($note)):?>
				<div class="tabs__dd tabs__dd--0 note">
					<div class="l-h"><h2><?php echo lang('note');?></h2><textarea class="editor" name="note"><?php echo $note;?></textarea></div>
				</div>
				<?php endif;?>
				<?php if(!empty($tabs)):?>
				<?php $_tab_key = 8;?>
				<?php foreach ($tabs as $key => $tab) :?>
				<div class="tabs__dd<?php if($_tab_key == $active_tab) { echo ' tabs__dd--active';}?> tabs__dd--<?php echo $_tab_key++;?>">
					<input type="hidden" name="exercises[<?php echo $tab->hash;?>][name]" value="<?php echo $tab->name;?>" />
					<ul class="l-h exercises-my" data-type="exercises[<?php echo $tab->hash;?>][data]">
					<?php if(!empty($tab->exercises)):?>
						<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('program' => $hash, 'hide_id'=>true, 'exercises'=>$tab->exercises, 'key'=>$key, 'tab'=>$tab, 'type' => 'exercises['.$tab->hash.'][data]'), TRUE);?>
					<?php endif;?>
					</ul>
					<?php $acces_val = (isset($params->access) && isset($params->access[$key])) ? $params->access[$key] : 1; ?>
					<input type="hidden" name="params[access][]" class="access-tab-<?php echo $key;?>" value="<?php echo $acces_val;?>" />
				</div>
				<?php endforeach;?>
				<?php endif;?>
			<?php echo form_close(); ?>

		</div>

		<div class="app-right pull-right">

			<div class="search-exercises">

				<div class="search-exercises__filter clr">

					<div class="search-exercises__input pull-left">
						<input id="autocomplete-exercises" class="input" placeholder="<?php echo lang('exercise_search');?>">
						<a class="icon-cancel search-exercises__clear-input"></a>
					</div>

					<a class="icon-th-large pull-left tab-exercises-list" title="<?php echo lang('programs');?>"></a>
					<a class="icon-th pull-left tab-exercises-list" title="<?php echo lang('exercises');?>"></a>

					<a class="btn pull-right filter-show"><?php echo lang('filter');?></a>

				</div>
			</div>
			<ul class="exercises-list clr">
				<?php if($exercises):?>
				<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('exercises'=>$exercises, 'hide_id'=>false, 'type'=>false), TRUE);?>
				<?php endif;?>
				<?php if($programs):?>
				<?php echo $this->load->view('frontend/'.$this->router->class.'/_item_program', array('programs'=>$programs), TRUE);?>
				<?php endif;?>
			</ul>

		</div>
		<ul class="hide icon-fullscreen">
			<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu', array('fullscreen'=>true), TRUE);?>
		</ul>