<div id='pleft'>	
<?php
  echo "<h2>".$category['name']."</h2>\n";
  echo "<p>".$category['description'] . "</p>\n";
  
//  foreach ($listing as $key => $list){

	switch($level)
	{
		case "1":
		/*
		echo "<div class='productlisting'>\n";
    	echo "<h4>";
		echo anchor('welcome/cat/'.$list['id'],$list['name']);
		echo "</h4>\n";
    	echo $list['description']. "<br/>"."</div>";
    	*/
			$this->load->view('listcategory');
			echo $this->pagination->create_links();
			
		break;
		
		case "2":
		/*
		echo "<div class='productlisting'>\n";
    	echo "<h4>";
		echo anchor('welcome/product/'.$list['id'],$list['francais']);
		echo "</h4>\n";
    	echo $list['mahorais']. "<br/>"."</div>";
    	*/
		 	$this->load->view('listproduct');
			echo $this->pagination->create_links();
		
		break;
	}
	
 // }
?>

</div>