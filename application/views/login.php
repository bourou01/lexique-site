<div id='pleft'>
<h2>Please login to Access the Dashboard</h2>
<?php
if ($this->session->flashdata('error')){ 
	echo "<div class='message'>";
	echo $this->session->flashdata('error');
	echo "</div>";
}
?>

<?php
$udata = array('name'=>'username','id'=>'u','size'=>15);
$pdata = array('name'=>'password','id'=>'p','size'=>15);


echo form_open("users/verify");
echo "<p><label for='u'>Username</label><br/>";
echo form_input($udata) . "</p>";
echo "<p><label for='p'>Password</label><br/>";
echo form_password($pdata) . "</p>";
echo form_submit('submit','login');
echo form_close();
?>
</div>