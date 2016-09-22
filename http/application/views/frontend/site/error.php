<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<article class="page page-login">
	<div class="align-center">
		<h1><?php echo $header;?></h1>
		<p><?php echo $text;?></p>
	</div>
	<p><a href="<?php echo base_url();?>"><?php echo lang('home');?></a></p>
	<p><a href="<?php echo base_url('recovery');?>"><?php echo lang('restore_link');?></a></p>
	<p><a href="<?php echo base_url('registration');?>"><?php echo lang('register_link');?></a></p>
</article>