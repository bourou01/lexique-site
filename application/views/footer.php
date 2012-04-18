<?php
if ($this->session->flashdata('error')){
	echo "<div class='message'>".$this->session->flashdata('error')."</div>";
}
?>
Copyright <?php echo date("Y"); ?> 
<?php echo anchor("welcome/pages/privacy","privacy policy");?>
&nbsp;&nbsp;&nbsp;
<?php echo anchor("users/verify","dashboard");?>
