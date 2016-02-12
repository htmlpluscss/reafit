<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
	</main>

	<footer>

		<p class="copyright">© <?php echo date('Y');?> «<?php echo $this->settings->site_name;?>»</p>

	</footer>

	<div class="popup popup--content">
		<div class="popup__box">
			<div class="popup__body"></div>
			<a class="icon-cancel-outline popup__close"></a>
		</div>
	</div>

	<?php if(isset($_popups) && !empty($_popups)):?>
	<?php echo $_popups;?>
	<?php endif;?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/jquery.min.js');?>"><\/script>')</script>

	<script src="<?php echo base_url('assets/js/jquery-ui.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.cookie.js');?>"></script>
	<script src="<?php echo base_url('assets/js/js.js');?>"></script>
	<script src="<?php echo base_url('assets/js/admin.js');?>"></script>
	<?php if(isset($this->scripts) && !empty($this->scripts)):?>
	<?php foreach ($this->scripts as $key => $script) :?>
	<script type="text/javascript" src="<?php echo $script;?>"></script>
	<?php endforeach;?>
	<?php endif;?>
	<?php if($this->router->method == 'edit' || $this->router->method == 'add'):?>
	<script type="text/javascript">
	$(document).ready(function() {
		if($('body .editor').length != 0) {
			$('body .editor').trumbowyg({
				fullscreenable: false,
				lang: 'ru',
				btns: [
					'btnGrp-design',
					'|', 'btnGrp-justify',
					'|', 'btnGrp-lists'
				],
				removeformatPasted: true,
				semantic: true
			}).on('tbwchange', function(){
				$('body .btn-save').attr('data-change', 1);
			});
		}
	});
	</script>
	<?php else:?>
	<script type="text/javascript">
	$(document).ready(function() {
		if($('.pagination-items').length != 0) {
			$('.pagination-items').change(function() {
				$(this).closest('form').submit();
			});
		}
	});
	</script>
	<?php endif;?>

</body>
</html>