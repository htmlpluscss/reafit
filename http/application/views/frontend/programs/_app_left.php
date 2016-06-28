<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

				<div class="hide">
					<span class="tabs__dt tabs__dt--not-delete" data-tab="desc"></span>
					<span class="tabs__dt tabs__dt--not-delete" data-tab="detal"></span>
					<span class="tabs__dt tabs__dt--not-delete" data-tab="save-as"></span>
					<span class="tabs__dt tabs__dt--not-delete" data-tab="open"></span>
					<span class="tabs__dt tabs__dt--not-delete" data-tab="start"></span>
					<span class="tabs__dt tabs__dt--not-delete" data-tab="note"></span>
				</div>

				<div class="tabs__dd tabs__dd--detal">
					<div class="l-h">
						<div class="l-h__inner baron">
							<div class="l-h__width form-tabs form-name-proggram">

								<div class="programme-body__h3"><?php echo lang('program_detal');?></div>
								<label class="input-placeholder mb-14 w260">
									<input class="input name-programme--input" name="name" maxlength="40" value="<?php echo $name;?>">
									<span class="input-placeholder__label"><?php echo lang('name');?><sup>*</sup></span>
								</label>

								<div class="input-placeholder mb-14 w260">
									<select class="name-programme--category" name="category" data-required-sup>
										<option value="none"><?php echo lang('_select');?></option>
									<?php if(!empty($category_list)):?>
									<?php $one_cat = (count($category_list) == 1) ? true : false;?>
									<?php foreach ($category_list as $key => $cat) :?>
										<option value="<?php echo $cat;?>"<?php echo ($cat == $category || $one_cat) ? ' selected="selected"' : '';?>><?php echo $cat;?></option>
									<?php endforeach;?>
									<?php endif;?>
									</select>
								</div>

								<label class="input-placeholder mb-14 w260">
									<input class="input name-programme--email" name="mail" type="email" data-error="<?php echo lang('mail_not_correct');?>" value="<?php echo $mail;?>">
									<span class="input-placeholder__label"><?php echo lang('email');?></span>
								</label>
								<label class="input-placeholder mb-14 w260">
									<textarea class="input name-programme--textarea" name="description"><?php echo $description_text;?></textarea>
									<span class="input-placeholder__label"><?php echo lang('description');?></span>
								</label>

								<a class="btn save-program hide"><?php echo lang('save');?></a>
								<a class="btn app-save-and-send hide"><?php echo lang('save_and_send');?></a>

								<?php if($this->router->method == 'edit'):?>
								<div class="programme-body__h3"><?php echo lang('access_pacient');?></div>

								<ul class="access-tabs">
								<?php if(!empty($tabs)):?>
								<?php foreach ($tabs as $key => $tab) :?>
								<?php $acces_val = (isset($params->access) && isset($params->access[$key])) ? $params->access[$key] : 1; ?>
									<li>
										<label class="checkbox">
											<input type="checkbox" class="access-tabs__item" value="<?php echo $key;?>"<?php if ($acces_val == 1) echo ' checked="checked"';?>>
											<?php echo $tab->name;?>
										</label>
									</li>
								<?php endforeach;?>
								<?php endif;?>
								</ul>

								<div class="programme-body__h3"><?php echo lang('note');?></div>
								<?php if (empty(trim(strip_tags($note)))) { ?>

									<a class="btn app-add-note data-tab-link" data-tab="note" data-alt-text="<?php echo lang('edit_note');?>"><?php echo lang('add_note');?></a>

								<?php } else { ?>

									<div><?php echo $note;?></div>
									<a class="btn app-add-note data-tab-link" data-tab="note"><?php echo lang('edit_note');?></a>

								<?php } ?>
								<?php endif;?>
							</div>
							<div class="baron__track">
								<div class="baron__free">
									<a class="baron__bar"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tabs__dd tabs__dd--save-as">
					<div class="l-h">
						<div class="l-h__inner baron">
							<div class="l-h__width form-save-as">
								<div class="programme-body__h3"><?php echo lang('save_program_as');?></div>
								<label class="input-placeholder mb-14 w260">
									<input maxlength="40" class="input form-save-as__name">
									<span class="input-placeholder__label"><?php echo lang('name');?><sup>*</sup></span>
								</label>
								<div class="input-placeholder mb-14 w260">
									<select data-required-sup class="form-save-as__category">
										<option value="none"><?php echo lang('select_category');?></option>
									<?php if(!empty($category_list)):?>
									<?php $one_cat = (count($category_list) == 1) ? true : false;?>
									<?php foreach ($category_list as $key => $cat) :?>
										<option value="<?php echo $cat;?>"<?php echo ($cat == $category || $one_cat) ? ' selected="selected"' : '';?>><?php echo $cat;?></option>
									<?php endforeach;?>
									<?php endif;?>
									</select>
								</div>
								<label class="input-placeholder mb-14 w260">
									<input maxlength="40" class="input form-save-as__email" type="email">
									<span class="input-placeholder__label"><?php echo lang('email');?></span>
								</label>
								<div class="input-placeholder mb-14 w260">
									<textarea class="input form-save-as__description"></textarea>
									<span class="input-placeholder__label"><?php echo lang('description');?></span>
								</div>
								<a class="btn btn-save btn-save--save-as" data-action="<?php echo base_url('programs/add');?>"><?php echo lang('save');?></a>
							</div>
							<div class="baron__track">
								<div class="baron__free">
									<a class="baron__bar"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tabs__dd<?php if(empty($tabs)){ echo ' tabs__dd--active';}?> tabs__dd--start">
					<div class="l-h">
						<div class="l-h__inner baron">
							<div class="l-h__width add-tab-form">
								<div class="programme-body__h3"><?php echo lang('add_tab_title');?></div>
								<label class="input-placeholder mb-14 w260">
									<input class="input add-tab-form__name" maxlength="40">
									<span class="input-placeholder__label"><?php echo lang('tab__name_title');?> <sup>*</sup></span>
								</label>
								<?php if ($this->router->method == 'add') { ?>
								<a class="btn btn--gray mr-10 add-tab-form__btn add-tab-form__btn__only hide"><?php echo lang('not_tab');?></a>
								<?php } ?>
								<a class="btn add-tab-form__btn"><?php echo lang('add_tab');?></a>
							</div>
							<div class="baron__track">
								<div class="baron__free">
									<a class="baron__bar"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tabs__dd tabs__dd--open">
					<div class="l-h">
						<div class="l-h__inner baron">
							<div class="l-h__width">
								<div class="programme-body__h3"><?php echo lang('open_program');?></div>
								<?php if(empty($items)):?>
								<p><?php echo lang('no_programs');?></p>
								<?php else:?>
								<div class="table-border-radius">
									<table class="table100">
										<thead>
											<tr>
												<th class="bt0 bl0"><?php echo lang('name');?></th>
												<th class="bt0"><?php echo lang('created');?></th>
												<th class="bt0"><?php echo lang('edited');?></th>
												<th class="bt0 br0"><?php echo lang('actions');?></th>
											</tr>
										</thead>
										<tbody class="last-bb0">
											<?php foreach ($items as $key => $item) :?>
											<tr>
												<td class="bl0">
													<a href="<?php echo base_url('programs/'.$item->hash);?>" class="open-program-link"><?php echo $item->name;?></a>
												</td>
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
												<td class="br0 align-center align-middle nowrap">
													<a class="ico-mini ico-link" target="_blank" href="<?php echo base_url($item->hash);?>"></a>
													<a class="ico-mini ico-open open-program-link" href="<?php echo base_url('programs/'.$item->hash);?>"></a>
												</td>
											</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
								<?php endif;?>
							</div>
							<div class="baron__track">
								<div class="baron__free">
									<a class="baron__bar"></a>
								</div>
							</div>
						</div>
					</div>
				</div>