<?php echo form_open('users/login'); ?>

<ul>
	<li>
	<br/>
		<label>Utilisateur</label>
		<div>
		<?php echo form_input(array('id' => 'username',
									'size' => 20,
									'name' => 'username'
		)); ?>
		
		</div>
	</li>

	<li>
		<label>Mot de passe</label>

		<div>
		<?php echo form_password(array('id' => 'password',
										'size' => 20,
										'name' => 'password'
		)); ?>
		</div>
		
	</li>

	<li>
		<label>
		
		<?php 
		if ($this->session->flashdata('login_error'))
		{
			echo '<br/>';
			echo "Nom d'utilisateur ou mot de passe incorrect";
		}
		
		echo validation_errors(); ?>
		</label>
		
		</li>
		<br/>
		
	<li><?php echo form_submit(array('name' => 'submit'), 'Se connecter');
	echo anchor('users/register/',"Creer un compte") . "\n";?>
	
</ul>
<?php echo form_close(); ?>

