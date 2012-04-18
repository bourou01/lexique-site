
<div id="myCarousel" class="carousel slide">
	<div class="carousel-inner">
	    
		<div class="item active">
			<img src="<?php echo base_url();?>public/img/carousel/img1.jpg" alt="">
			<div class="carousel-caption">
			  <h4>Parlons Mahorais</h4>
			<p>Le site de r&eacute;f&eacute;rence sur la langue mahoraise.</p>
			</div>
		</div>
		      
		<div class="item">
			<img src="<?php echo base_url();?>public/img/carousel/img2.jpg" alt="">
			<div class="carousel-caption">
			<h4>Parlons Mahorais</h4>
			<p>Le site de r&eacute;f&eacute;rence sur la langue mahoraise.</p>
			</div>
		</div>
		      
		<div class="item">
			<img src="<?php echo base_url();?>public/img/carousel/img3.jpg" alt="">
			<div class="carousel-caption">
			  <h4>Parlons Mahorais</h4>
			<p>Le site de r&eacute;f&eacute;rence sur la langue mahoraise.</p>
			</div>
		</div>
		
		<div class="item">
			<img src="<?php echo base_url();?>public/img/carousel/img4.jpg" alt="">
			<div class="carousel-caption">
			<h4>Parlons Mahorais</h4>
			<p>Le site de r&eacute;f&eacute;rence sur la langue mahoraise.</p>
			</div>
		</div>
        </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>


<div class="form-actions sidebar-nav">
<?php
	echo "<h3 style='text-align:center;'>MOTS DU JOUR</h3></div>";
	
	echo "<table class='table table-striped'>\n";
	echo "<tr>\n";
	echo "<th>#</th><th>Mahorais</th><th>Francais</th>\n";
	echo "</tr>\n";
	
	foreach ($products as $key => $list){
	
		echo "<tr>\n";
			echo "<td width='2%' >".$list['id']."</td>\n";
			echo "<td width='45%' ><h4>".$list['mahorais']."</h4></td>\n";
			echo "<td width='45%'><h4>".$list['francais']."</h4></td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
?>


