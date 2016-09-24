<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

					<input type="hidden" name="redirect" value="">

					<div class="tabs__dd tabs__dd--name tabs__dd--active">
						<div class="l-h">
							<div class="l-h__inner">
								<div class="l-h__width">

									<div class="programme-body__h3"><?php echo lang('exercise_name');?></div>
									<label class="input-placeholder mb-14">
										<input class="input name-programme--input" name="name" maxlength="40" value="<?php echo $name;?>">
										<span class="input-placeholder__label"><?php echo lang('name');?><sup>*</sup></span>
									</label>

									<div class="programme-body__h3"><?php echo lang('category');?></div>
									<div class="input-placeholder mb-14">
										<?php $category_list = explode("\n", str_replace("\r\n", "\n", $this->settings->categories));?>
										<select class="name-programme--category" name="category" data-required-sup>
											<option value="none"><?php echo lang('_select');?></option>
										<?php if(!empty($category_list)):?>
										<?php $one_cat = (count($category_list) == 1) ? true : false;?>
										<?php foreach ($category_list as $key => $cat) :?>
											<option value="<?php echo $cat;?>"<?php echo ($cat == $category || $one_cat) ? ' selected="selected"' : '';?>><?php echo $cat;?></option>
										<?php endforeach;?>
										<?php if(!in_array($category, $categories)):?>
											<option value="<?php echo $category;?>" selected="selected"><?php echo $category;?></option>
										<?php endif;?>
										<?php endif;?>
										</select>
									</div>

									<label class="input-count w200 clr">
										<span class="input-count__label"><?php echo lang('exercise_order');?></span>
										<div class="input-count__box notsel">
											<input class="input" type="tel" name="order" value="<?php echo $order;?>">
											<a class="input-count__up"></a>
											<a class="input-count__down"></a>
										</div>
									</label>

								</div>

							</div>
						</div>
					</div>

					<div class="tabs__dd tabs__dd--media">
						<div class="l-h">
							<div class="l-h__inner">
								<div class="l-h__width">

									<div class="programme-body__h3"><i class="ico ico--img-pic"></i><?php echo lang('image');?></div>
									<label class="input-file<?php if($image) echo ' input-file--active'; ?> mb-10 clr">
										<span class="input-file__label pull-left"><?php echo lang('image-program');?></span>
										<?php if($image):?>
											<img class="input-file__img" src="<?php echo $image;?>" alt="<?php echo $name;?>">
										<?php endif;?>
										<input type="file" name="image" class="hide">
										<a class="btn pull-right"><?php echo lang('_select');?></a>
										<span class="input-file__input pull-right"><span class="input-file__value"><?php echo ($image) ? lang('file_change') : lang('file_not_select');?></span></span>
									</label>

								</div>

							</div>
						</div>
					</div>

					<div class="tabs__dd tabs__dd--description">
						<div class="l-h">
							<div class="l-h__inner baron">

								<div class="l-h__width">

									<div class="programme-body__h3"><?php echo lang('exercise_description');?></div>
									<textarea name="description" class="editor"><?php echo $description_text;?></textarea>

								</div>

								<div class="baron__track">
									<div class="baron__free">
										<a class="baron__bar"></a>
									</div>
								</div>

							</div>
						</div>
					</div>

					<?php if(!empty($tabs)):?>
						<?php foreach ($tabs as $key => $tab) :?>
					<div class="tabs__dd tabs__dd--<?php echo $tab->hash;?>">
						<div class="l-h">
							<div class="l-h__inner baron">

								<ul class="exercises-my" data-type="exercises[<?php echo $tab->hash;?>][data]">
									<?php if(($tab->exercises) && !empty($tab->exercises)):?>
									<?php echo $this->load->view('backend/'.$this->router->class.'/_item', array('program' => $hash, 'exercises'=>$tab->exercises, 'key'=>$key, 'tab'=>$tab, 'type' => 'exercises['.$tab->hash.'][data]'), TRUE);?>
									<?php endif;?>
								</ul>

								<div class="baron__track">
									<div class="baron__free">
										<a class="baron__bar"></a>
									</div>
								</div>

							</div>
						</div>
					</div>
						<?php endforeach;?>
					<?php endif;?>