<?php 

if ($this->session->flashdata('message')){
	echo "<div class='message'>".$this->session->flashdata('message')."</div>";
}
	//echo "&nbsp;";

	echo "</p>";
	
	echo "<table border='1' rules=none cellspacing='0' cellpadding='3' width='698'>\n";
	echo "<tr style='text-align:left' bgcolor='pink' valign='top'>\n";
	echo "<th>Nom</th><th>Description</th>\n";
	echo "</tr>\n";
	foreach ($categories as $key => $list){
		
		echo "<tr valign='top'>\n";
		echo "<td width='200' >".$list['name']."</td>\n";
		echo "<td>".$list['description']."</td>\n";
		echo "</tr>\n";
	}
	
	echo "</table>";
?>