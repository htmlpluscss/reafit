<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
		</div>
	</main>

<?php if(!($this->router->class == 'programs' && ($this->router->method == 'add' || $this->router->method == 'edit' || $this->router->method == 'viewProgram'))) :?>

	<footer id="footer">

		<p class="copyright">© <?php echo date('Y');?> «<?php echo $this->settings->site_name;?>»</p>
		<p class="copyright hide"><?php echo $this->router->class . ' | ' . $this->router->method . ' | ' . $this->router->default_controller;?></p>

	</footer>

<?php endif;?>

<?php if($this->router->class == 'programs' || $this->router->class == 'categories' || $this->router->class == 'exercises') :?>

	<div class="popup popup--msg popup--height-auto">
		<div class="popup__box">
			<div class="popup__body">
				<div class="popup__inner"></div>
				<a class="btn btn--gray popup__close btn-cancel-popup hide"><?php echo lang('cancel');?></a>
				<a class="btn popup__close btn-no-popup hide"><?php echo lang('close');?></a>
				<a class="btn btn-yes-popup hide"><?php echo lang('yes');?></a>
			</div>
			<a class="ico ico--close popup__close"></a>
		</div>
	</div>

<?php endif;?>

<?php if($this->router->class == 'programs') :?>

	<div class="popup popup--content">
		<div class="popup__box">
			<div class="popup__body">
				<div class="popup__inner baron"></div>
			</div>
			<a class="ico ico--close-white popup__close"></a>
		</div>
	</div>

	<?php if(isset($_popups) && !empty($_popups)):?>
	<?php echo $_popups;?>
	<?php endif;?>

<?php endif;?>

<?php if(($this->router->class == 'categories' || $this->router->class == 'exercises' || $this->router->class == 'programs') && $this->router->method == 'index') :?>

	<div class="popup popup--create-cat">
		<div class="popup__box">
			<div class="popup__body">
				<form class="popup__inner" data-create="<?php echo site_url('categories/add');?>" data-update="<?php echo site_url('categories/edit');?>" method="post">
					<h3 data-create="<?php echo lang('create_new_cat');?>" data-update="<?php echo lang('update_cat');?>"><?php echo lang('create_new_cat');?></h3>
					<label class="input-placeholder">
						<input class="input popup--create__cat_name" name="name" maxlength="40">
						<span class="input-placeholder__label"><?php echo lang('category_title');?> <sup>*</sup></span>
					</label>
					<label class="input-placeholder">
						<textarea class="input popup--create__cat_textarea" name="description"></textarea>
						<span class="input-placeholder__label"><?php echo lang('category_description');?></span>
					</label>
					<label>
						<a class="btn popup--create-cat__btn" data-update="<?php echo lang('category_update_btn');?>" data-create="<?php echo lang('category_create_btn');?>"><?php echo lang('category_create_btn');?></a>
						<input type="submit" class="hide">
					</label>
				</form>
			</div>
			<a class="ico ico--close popup__close"></a>
		</div>
	</div>

<?php endif;?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/jquery.min.js');?>"><\/script>')</script>
	<script src="<?php echo base_url('assets/js/baron.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/js.js');?>"></script>
	<?php if(isset($this->scripts) && !empty($this->scripts)):?>
	<?php foreach ($this->scripts as $key => $script) :?>
	<script src="<?php echo $script;?>"></script>
	<?php endforeach;?>
	<?php endif;?>

<?php if($this->router->class == 'site') :?>

	<script>
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter35342380 = new Ya.Metrika({
						id:35342380,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true,
						webvisor:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/35342380" style="position:absolute; left:-9999px;" alt="" /></div></noscript>

<?php endif;?>

</body>
</html>