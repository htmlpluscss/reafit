<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php if($this->router->method == 'edit' || $this->router->method == 'add'):?>

<ul class="menu_app clr">
	<?php echo $this->load->view('backend/'.$this->router->class.'/_menu', array('list_url'=>$list_url), TRUE);?>
</ul>

<?php endif;?>