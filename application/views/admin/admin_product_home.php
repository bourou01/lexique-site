<h1><?php echo $title;?></h1>


<p>

 <div class="form-actions">
<?php

// Export Category
	$attributes = array('class' => 'navbar-form pull-right');
	echo form_open("admin/products/export", $attributes);

	$exportButton = array(
		'class'		=> 'btn btn-warning',
		'name' 		=> 'button',
		'value' 	=> 'true',
		'type' 		=> 'submit',
		'content' 	=> 'Exporter'
	);
	echo form_button($exportButton);
	echo form_close();
	
	echo "<br>";

// New Cathegory
	$attributes = array('class' => 'navbar-form');
	echo form_open("admin/products/create", $attributes);
	$newCatButton = array(
		'class'		=> 'btn btn-danger',
		'name' 		=> 'button',
		'value' 	=> 'true',
		'type' 		=> 'submit',
		'content' 	=> 'Nouveau'
	);
	echo form_button($newCatButton);
	echo form_close();
?>

</div>
</p>


<?php
/*
echo form_open_multipart("admin/products/import");
$data = array('name' => 'csvfile', 'size'=>15);
echo form_upload($data);
echo form_hidden('csvinit',true);
echo form_submit('submit','IMPORT');
echo form_close();
*/
?>

<?php
if ($this->session->flashdata('message')){
	echo "<div class='alert alert-success'>".$this->session->flashdata('message')."</div>";
}

if (count($products)){
	
	echo "</p>";
	echo "<table class='table table-striped table-bordered table-condensed'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Francais</th>\n<th>Mahorais</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($products as $key => $list){
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
?>
<?php echo $this->pagination->create_links(); ?>
