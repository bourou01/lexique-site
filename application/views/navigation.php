<div class="span2">
<div class="form-actions sidebar-nav">


<?php

if (count($navlist)){
  echo "<ul class ='nav nav-list'>";
  
	if($this->uri->uri_string()=='welcome')
	{
	  echo "<li class='nav-header active'>";
	}
	else
	{
	  echo "<li class='nav-header'>";
	}
	
	echo anchor("welcome/","Toute les expressions");
	echo "</li>";
  
  foreach ($navlist as $key => $list){
  	foreach ($list as $topkey => $toplist)
	{
	  echo "<li class='nav-header'>";
	  //echo anchor("welcome/cat/$topkey",$toplist['name']);
	  echo $toplist['name'];
	  echo "</li>";
	  if (count($toplist['children']))
	  {
		  foreach ($toplist['children'] as $subkey => $subname)
		  {
			  if($this->uri->uri_string()=='welcome/cat/'.$subkey) 
			  {
				  echo "<li class='active'>";
			  }
			  else
			  {
				  echo "<li>";
			  }
			  echo anchor("welcome/cat/$subkey",$subname);	
			  echo "</li>";
		  }
	  }
	}
  }
  echo "</ul>";
}

?>
</div><!--/.well -->
</div><!--/span-->