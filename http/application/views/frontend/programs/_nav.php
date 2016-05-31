<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<ul class="menu_app clr">

<?php if($this->router->method == 'edit' || $this->router->method == 'add'):?>
	<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu', null, TRUE);?>
<?php elseif($this->router->method == 'viewProgram' || $this->router->method == 'printProgram' ) :?>
	<?php echo $this->load->view('frontend/'.$this->router->class.'/_menu_view_print', null, TRUE);?>
<?php endif;?>

</ul>