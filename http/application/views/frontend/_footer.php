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

	<div class="popup popup--msg">
		<div class="popup__box">
			<div class="popup__body">
				<p></p>
				<a class="btn popup__close btn-cancel-popup hide" href="#"><?php echo lang('cancel');?></a>
				<a class="btn popup__close btn-no-popup hide" href="#"><?php echo lang('close');?></a>
				<a class="btn btn-yes-popup hide"><?php echo lang('yes');?></a>
			</div>
			<a class="icon-cancel-outline popup__close"></a>
		</div>
	</div>

	<?php if(isset($_popups) && !empty($_popups)):?>
	<?php echo $_popups;?>
	<?php endif;?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo base_url('assets/js/jquery.min.js');?>"><\/script>')</script>
	<script src="<?php echo base_url('assets/js/js.js');?>"></script>
	<?php if(isset($this->scripts) && !empty($this->scripts)):?>
	<?php foreach ($this->scripts as $key => $script) :?>
	<script src="<?php echo $script;?>"></script>
	<?php endforeach;?>
	<?php endif;?>

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

</body>
</html>