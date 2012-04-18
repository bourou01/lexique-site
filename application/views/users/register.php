<div class="" style="text-align:center">
<?php
	echo form_open('users/register');
	  
	$username = array(
		'name'			=>	'username',
		'id'			=>	'username',
		'class' 		=> 'input-large',
		'placeholder' 	=> 'Utilisateur ',
		'value'			=>	set_value('username')
	);
	
	$name = array(
		'name'			=>	'name',
		'id'			=>	'name',
		'class' 		=> 'input-large',
		'placeholder' 	=> 'Prenom',
		'value'			=>	set_value('name')
	);
	
	$email = array(
		'name'			=>	'email',
		'id'			=>	'email',
		'class' 		=> 'input-large',
		'placeholder' 	=> 'Email',
		'value'			=>	set_value('email')
	);
	
	$password = array(
		'name'			=>	'password',
		'id'			=>	'password',
		'class' 		=> 	'input-large',
		'placeholder' 	=> 	'Mot de passe',
		'value'			=>	''
	);
	
	$password_conf = array(
		'name'			=>	'password_conf',
		'id'			=>	'password_conf',
		'class' 		=> 'input-large',
		'placeholder' 	=> 'Confirmation',
		'value'			=>	''
	);
	
	
	
	/*Button*/
	$submitButton = array(
		'class'		=> 'btn btn-success',
	    'name' 		=> 'button',
	    'value' 	=> 'true',
	    'type' 		=> 'submit',
	    'content' 	=> 'Enregistrer'
	);
	
?>





<fieldset>

<legend>Formulaire d'enregistrement</legend>
<hr>
	<div class="clearfix">
		<?php echo form_input($username); ?>
	</div>
	
	<div class="clearfix">
		<?php echo form_input($name); ?>
	</div>

	<div class="clearfix">
		<?php echo form_input($email); ?>
	</div>

	<div class="clearfix">
		<?php echo form_password($password); ?>
	</div>

	<div class="clearfix">
		<?php echo form_password($password_conf); ?>
	</div>

	<br/>
	
	<div class="alert alert-error">
		<?php echo validation_errors(); ?>
	</div>

	<div>
	
		<?php echo form_button($submitButton);?>
		<?php //echo form_submit(array('name' => 'register'), 'Enregistrer');?>
	</div>
	


</fieldset>


<?php echo form_close();?>
</div>