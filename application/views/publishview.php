
<div id="pub">

<?php

	//$this->load->view('register');
echo "<ul>";

	echo "<li class='cat'>";
    echo "Compte";
	echo "</li>\n";

	echo "\n<li class='subcat'>";
	
	/*DŽbut formulaire*/
	if ($this->session->userdata('logged_in'))
	{
		echo "<br/>";
		echo "<h4/>";
		echo "Login : ".$this->session->userdata('username');
		echo "<br/>";
		echo "Rang : ".$this->session->userdata('privilege');
		echo "<br/>";
		echo "Traffic : ".$this->session->userdata('traffic');
		echo "</h4>";
		echo anchor('users/logout/',"<h5  style='text-align:center';>:-( Deconnecter )-: </h5>") . "\n";
	}
	else
	{
		$this->load->view('login_form');
		echo "<br/>";
	}
	/*Fin Formulaire*/
	
	/*Publication*/
	//*
  	echo "</li>";

  	
  	echo "<li class='cat'>";
    echo "Publication";
	echo "</li>\n";

	foreach ($sidef as $key => $list)
  	{
  		if ($list['francais']!='')
  		{

			echo "\n<li class='item'>";
		    echo anchor('welcome/product/'.$list['id'],$list['francais']) . "\n";
		    
		    //echo anchor('welcome/addCart/'.$list['id'],'<h4>favoris</h4>') . "\n";
		    echo "</li>";
  		}
  	}
  	//*/
  	/*Fin Publication*/
  	
  	
  	
  echo "</ul>\n";
?>

</div>