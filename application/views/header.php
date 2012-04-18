
<li <?php if($this->uri->uri_string()=='welcome/home') {echo 'class="active"';}?> >
<?php echo anchor("welcome/home","ACCUEIL")?>
</li>

<li <?php if($this->uri->uri_string()=='welcome') {echo 'class="active"';}?> >
<?php //echo anchor("welcome","EXPRESSIONS")?>
</li>

<li <?php if($this->uri->uri_string()=='welcome/pages/about_us') {echo 'class="active"';}?>>
<?php echo anchor("welcome/pages/about_us","A PROPOS");?>
</li>

<li <?php if($this->uri->uri_string()=='welcome/pages/contact') {echo 'class="active"';}?>>
<?php echo anchor("welcome/pages/contact", "CONTACT");?>
</li>

<li <?php if($this->uri->uri_string()=='welcome/mobile') {echo 'class="active"';}?>>
<?php echo anchor("welcome/mobile", "MOBILE");?>
</li>


<li><?php //echo anchor("welcome/pages/grammaire", "grammaire");?></li>
<li <?php if($this->uri->uri_string()=='welcome/cart') {echo 'class="active"';}?>>
<?php 
if ($this->session->userdata('logged_in')){
	//echo anchor("welcome/cart", "FAVORIS");
}
?>
</li>

<li>

<?php

if (!$this->session->userdata('logged_in'))
{

	$attributes = array('class' => 'navbar-form pull-right');
	echo form_open("users/login", $attributes);
	$username = array(
		'class' 		=> 	'input-small',
		'placeholder' 	=>  "Login",
		'name'			=>	'username',
		'id'			=>	'username',
		'value'			=>	set_value('username')
	);
	
	$password = array(
		'class' 		=> 	'input-small',
		'placeholder' 	=>  'Mot de passe',
		'name'			=>	'password',
		'id'			=>	'password',
		'value'			=>	set_value('password')
	);
	
	$loginButton = array(
		'class'		=> 'btn btn-warning',
		'name' 		=> 'button',
		'value' 	=> 'true',
		'type' 		=> 'submit',
		'content' 	=> 'Login'
	);
	
	echo form_input($username);
	echo form_password($password);



	echo form_button($loginButton);

//echo form_submit("submit","chercher");

	echo form_close();

}


?>
</li>


<li>
&nbsp;
</li>

<li>

<?php 

/*register*/
if (!$this->session->userdata('logged_in'))
{
	$attributes = array('class' => 'navbar-form pull-right');
	echo form_open("users/register", $attributes);

	$registerButton = array(
		'class'		=> 'btn btn-info',
		'name' 		=> 'button',
		'value' 	=> 'true',
		'type' 		=> 'submit',
		'content' 	=> 'Inscription'
	);
	
	echo form_button($registerButton);

	echo form_close();
}
else
{

	$attributes = array('class' => 'navbar-form pull-right');
	echo form_open("users/logout", $attributes);

	$registerButton = array(
		'class'		=> 'btn btn-danger',
	    'name' 		=> 'button',
	    'value' 	=> 'true',
	    'type' 		=> 'submit',
	    'content' 	=> 'Logout'
	);
	
	echo form_button($registerButton);

	echo form_close();
}

?>
</li>
