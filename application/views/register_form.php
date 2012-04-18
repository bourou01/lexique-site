<div id="register_form">

<h1>Formulaire d'enregistrement</h1>
<p>Merci de bien vouloir remplir le formulaire<p>

<?php
	echo form_open('users/register');
	  
	$username = array(
		'name'	=>	'username',
		'id'	=>	'username',
		'value'	=>	set_value('username')
	);
	
	$name = array(
		'name'	=>	'name',
		'id'	=>	'name',
		'value'	=>	set_value('name')
	);
	
	$email = array(
		'name'	=>	'email',
		'id'	=>	'email',
		'value'	=>	set_value('email')
	);
	
	$password = array(
		'name'	=>	'password',
		'id'	=>	'password',
		'value'	=>	''
	);
	
	$password_conf = array(
		'name'	=>	'password_conf',
		'id'	=>	'password_conf',
		'value'	=>	''
	);
?>

<ul>
	<li>
		<label>Utilisateur</label>
		<div>
			<?php echo form_input($username); ?>
		</div>
	</li>
	
	<li>
		<label>Nom</label>
		<div>
			<?php echo form_input($name); ?>
		</div>
	</li>
	
	<li>
		<label>Adresse mail</label>
		<div>
			<?php echo form_input($email); ?>
		</div>
	</li>
	
	<li>
		<label>Mot de passe</label>
		<div>
			<?php echo form_password($password); ?>
		</div>
	</li>
	
	
	<li>
		<label>Confirmation</label>
		<div>
			<?php echo form_password($password_conf); ?>
		</div>
	</li>
	
	
	<li>
		<?php echo validation_errors(); ?>
	</li>
	
	
	
	<li>
	<div>
	<br/>
		<?php echo form_submit(array('name' => 'register'), 'Enregistrer');?>
	
	</div>
	</li>
</ul>



<?php echo form_close();?>

</div>