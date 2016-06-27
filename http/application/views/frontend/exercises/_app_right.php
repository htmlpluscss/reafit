<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

			<div class="exercises-body app-right pull-right">

				<div class="search-exercises">

					<div class="search-exercises__filter clr">

						<div class="search-exercises__input pull-left">
							<a class="search-exercises__clear-input hide ico ico--close"></a>
							<a class="ico ico--search hide"></a>
							<input id="autocomplete-exercises" class="input" placeholder="<?php echo lang('exercise_search');?>">
						</div>

						<a class="btn pull-right search-exercises__btn filter-show"><?php echo lang('filter');?></a>

					</div>

				</div>

				<div class="relative">
					<div class="r-h">
						<div class="r-h__inner baron">
							<ul class="exercises-list clr">
								<?php echo $this->load->view('frontend/'.$this->router->class.'/_item', array('exercises'=>$exercises,'type'=>false), TRUE);?>
							</ul>
							<div class="baron__track">
								<div class="baron__free">
									<a class="baron__bar"></a>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>