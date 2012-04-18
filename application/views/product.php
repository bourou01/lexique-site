<div id='pleft'>

<?php
/*
  echo "<h3>".$mainf['francais']."</h3>\n";
  echo "<p>".$mainf['mahorais'] . "<br/>\n";
  echo anchor('welcome/addCart/'.$mainf['id'],'favoris') . "</p>\n";
  */
?>

<?php 

  

	echo "<table border='1' rules=all cellspacing='0' cellpadding='3' width='698'>\n";
	
	echo "<tr valign='top'>\n";
	//echo "<th>Francais</th><th>Mahorais</th><th>Choix</th>\n";
	echo "</tr>\n";

		echo "<tr>\n";
		echo "<th  style='text-align:left' bgcolor='pink' >Francais</th>\n";
		echo "<td width='600'>".$mainf['francais']."</td>\n";
		echo "</tr>\n";
		
		
		echo "<tr >\n";
		echo "<th style='text-align:left' bgcolor='pink' >Mahorais</th>\n";
		echo "<td width='600'>".$mainf['mahorais']."</td>\n";
		echo "</tr>\n";
		
		
		echo "<tr >\n";
		echo "<th style='text-align:left' bgcolor='pink' >Exemple</th>\n";
		echo "<td width='600'>".$mainf['example']."</td>\n";
		echo "</tr>\n";
		
		echo "<tr >\n";
		echo "<th style='text-align:left' bgcolor='pink' >Choix</th>\n";
		echo "<td width='600'>".anchor('welcome/addCart/'.$mainf['id'],"ajouter aux favoris")."</td>\n";
		echo "</tr>\n";
		
		
		
	echo "</table>";
	
	echo "<br/>";
	
  
?>
</div>



<?php $this->load->view('publishview');?>