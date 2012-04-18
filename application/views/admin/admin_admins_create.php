<h1><?php echo $title;?></h1>

<?php
echo form_open('admin/admins/create');
echo "<p><label for='uname'>Username</label><br/>";
$data = array('name'=>'username','id'=>'uname','size'=>25);
echo form_input($data) ."</p>";

echo "<p><label for='email'>Email</label><br/>";
$data = array('name'=>'email','id'=>'email','size'=>50);
echo form_input($data) ."</p>";

echo "<p><label for='pw'>Password</label><br/>";
$data = array('name'=>'password','id'=>'pw','size'=>25);
echo form_password($data) ."</p>";

echo "<p><label for='privilege'>Privilege</label><br/>";
$options = array('Utilisateur' => 'Utilisateur', 'Moderateur' => 'Moderateur', 'Super Moderateur' => 'Super Moderateur');
echo form_dropdown('privilege',$options) ."</p>";

echo "<p><label for='status'>Status</label><br/>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</p>";

echo form_submit('submit','create admin');
echo form_close();


?>