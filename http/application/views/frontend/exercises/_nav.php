<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if($this->router->method == 'edit' || $this->router->method == 'add'):?>
<nav>
	<ul class="menu_app">
		<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu', null, TRUE);?>
	</ul>
	<p class="name-programme"><?php echo $header;?></p>
</nav>
<?php endif;?>