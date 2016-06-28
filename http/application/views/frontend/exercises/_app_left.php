<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

					<input type="hidden" name="redirect" value="">

					<div class="tabs__dd tabs__dd--description tabs__dd--active">
						<div class="l-h">
							<div class="l-h__inner baron">
								<div class="l-h__width">

									<div class="programme-body__h3"><?php echo lang('exercise_name');?></div>
									<label class="input-placeholder mb-14">
										<input class="input name-programme--input" name="name" maxlength="40" value="<?php echo $name;?>">
										<span class="input-placeholder__label"><?php echo lang('name');?><sup>*</sup></span>
									</label>

									<label class="input-placeholder mb-14">
										<input class="input name-programme--email" name="name_desc" value="<?php echo $name_desc;?>">
										<span class="input-placeholder__label"><?php echo lang('exercise_desc');?></span>
									</label>

									<div class="input-placeholder mb-14">
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

									<div class="programme-body__h3"><?php echo lang('description');?></div>
									<div class="mb-14">
										<textarea name="description" class="editor"><?php echo $description_text;?></textarea>
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
								<div class="baron__track">
									<div class="baron__free">
										<a class="baron__bar"></a>
									</div>
								</div>

							</div>
						</div>
					</div>

					<div class="tabs__dd tabs__dd--media">
						<div class="l-h">
							<div class="l-h__inner baron">
								<div class="l-h__width">

									<div class="programme-body__h3"><i class="ico ico--img-pic"></i><?php echo lang('image');?></div>
									<label class="input-file<?php if($image_1) echo ' input-file--active'; ?> mb-10 clr">
										<span class="input-file__label pull-left"><?php echo lang('exercise_image_1');?></span>
										<?php if($image_1):?>
											<img class="input-file__img" src="<?php echo $image_1;?>" alt="<?php echo $name;?>">
										<?php endif;?>
										<input type="file" name="image_1" class="hide">
										<a class="btn pull-right"><?php echo lang('_select');?></a>
										<span class="input-file__input pull-right"><span class="input-file__value"><?php echo ($image_1) ? lang('file_change') : lang('file_not_select');?></span></span>
									</label>
									<label class="input-file<?php if($image_2) echo ' input-file--active'; ?> mb-10 clr">
										<span class="input-file__label pull-left"><?php echo lang('exercise_image_2');?></span>
										<?php if($image_2):?>
											<img class="input-file__img" src="<?php echo $image_2;?>" alt="<?php echo $name;?>">
										<?php endif;?>
										<input type="file" name="image_2" class="hide">
										<a class="btn pull-right"><?php echo lang('_select');?></a>
										<span class="input-file__input pull-right"><span class="input-file__value"><?php echo ($image_2) ? lang('file_change') : lang('file_not_select');?></span></span>
									</label>
									<label class="input-file<?php if($image_3) echo ' input-file--active'; ?> mb-30 clr">
										<span class="input-file__label pull-left"><?php echo lang('exercise_image_3');?></span>
										<?php if($image_3):?>
											<img class="input-file__img" src="<?php echo $image_3;?>" alt="<?php echo $name;?>">
										<?php endif;?>
										<input type="file" name="image_3" class="hide">
										<a class="btn pull-right"><?php echo lang('_select');?></a>
										<span class="input-file__input pull-right"><span class="input-file__value"><?php echo ($image_3) ? lang('file_change') : lang('file_not_select');?></span></span>
									</label>

									<div class="programme-body__h3"><i class="ico ico--video-pic"></i><?php echo lang('video');?></div>
									<label class="input-file input-file--video mb-20 clr">
										<span class="input-file__label pull-left"><?php echo lang('exercise_video_id');?></span>
										<input class="input pull-right" name="video" value="<?php echo $video;?>">
									</label>
									<?php if($video):?>
									<iframe width="442" height="280" src="https://www.youtube.com/embed/<?php echo $video;?>?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
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

					<div class="tabs__dd tabs__dd--filter">
						<div class="l-h">
							<div class="l-h__inner baron">

								<div class="l-h__width form-tabs--filter">
									<?php if($tags):?>

										<?php $group = '';?>
										<?php foreach ($tags as $key => $tag) :?>
										<?php if($group != $tag->group):?>
												<h3><?php echo $tag->group;?></h3>
										<?php endif;?>
										<?php
											$group = $tag->group;
										?>
												<label class="checkbox"><input type="checkbox" name="tags[]" value="<?php echo $tag->id;?>"<?php if(!empty($tags_data) && in_array($tag->id, $tags_data)) {echo ' checked="checked"';}?>><?php echo $tag->tag;?></label><br>
												<?php if($tag->subtags):?>
												<?php foreach ($tag->subtags as $key => $subtag) :?>
												<label class="checkbox"><input type="checkbox" name="tags[]" value="<?php echo $subtag->id;?>"<?php if(!empty($tags_data) && in_array($subtag->id, $tags_data)) {echo ' checked="checked"';}?>>- <?php echo $subtag->tag;?></label><br>
												<?php endforeach;?>
												<?php endif;?>
										<?php endforeach;?>
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

					<div class="tabs__dd tabs__dd--related">
						<div class="l-h">
							<div class="l-h__inner baron">

								<ul class="exercises-my">
									<?php if($related):?>
									<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('exercises'=>$related, 'type' => 'related'), TRUE);?>
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

					<div class="tabs__dd tabs__dd--progress">
						<div class="l-h">
							<div class="l-h__inner baron">

								<ul class="exercises-my">
									<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('exercises'=>$progress, 'type' => 'progress'), TRUE);?>
								</ul>

								<div class="baron__track">
									<div class="baron__free">
										<a class="baron__bar"></a>
									</div>
								</div>

							</div>
						</div>
					</div>