<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<?php $this->load->view('tools/view_ref');?>
		
		<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/media/images/favicon.ico" />
		
		<title><?php //echo $title; ?> Parlons Mahorais | Site sur la langue mahoraise, Mayotte</title>
		

	</head>
	<body>
                
                <?php
                                
                    echo "</p>";
                    echo "<table border='1' cellspacing='0' cellpadding='3' width='698'>\n";
                    echo "<tr style='text-align:left' bgcolor='pink' valign='top'>\n";
                    echo "<th>Francais</th><th>Mahorais</th>\n";
                    echo "</tr>\n";
                    foreach ($result as $key => $list){
                            
                            echo "<tr valign='top'>\n";
            
                            echo "<td width='180' >".$list['francais']."</td>\n";
                            
                            echo "<td width='180'>".$list['mahorais']."</td>\n";
                            

                            
                            echo "</tr>\n";
                    }
                    
                    echo "</table>";                
                
                
                ?>
		
                
                
                <hr>
                <?php echo anchor("welcome/index","source: www.jugemento.com");?>
		
	</body>


</html>
