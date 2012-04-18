<h1><?php echo $title;?></h1>

<hr>

<?php
if ($this->session->flashdata('message')){
	echo "<div class='alert alert-success'>".$this->session->flashdata('message')."</div>";
}

if (count($results)){

	echo "</p>";
	echo "<table class='table table-striped table-bordered table-condensed'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Francais</th>\n<th>Mahorais</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($results as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td>".$list['id']."</td>\n";
		echo "<td>".$list['francais']."</td>\n";
		echo "<td>".$list['mahorais']."</td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/products/edit/'.$list['id'],'edit');
		echo " | ";
		echo anchor('admin/products/delete/'.$list['id'],'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
	echo form_close();
}
else
{
	
	echo "<div class='alert alert-danger'>";
	echo "N'existe pas mais vous pouvez le rajouter !";
	echo "</div>";
}

?>
<?php echo $this->pagination->create_links(); ?>
