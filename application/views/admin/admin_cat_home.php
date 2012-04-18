<h1><?php echo $title;?></h1>

<p>

 <div class="form-actions">
<?php

//echo anchor("admin/categories/export","Export");
// Export Category
	$attributes = array('class' => 'navbar-form pull-right');
	echo form_open("admin/categories/export", $attributes);

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
	
//echo anchor("admin/categories/create", "Create new category");

// New Cathegory
	$attributes = array('class' => 'navbar-form');
	echo form_open("admin/categories/create", $attributes);
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
if ($this->session->flashdata('message')){
	echo "<div class='alert alert-success'>".$this->session->flashdata('message')."</div>";
}

if (count($categories)){
	echo "<table class='table table-striped table-bordered table-condensed'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Name</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($categories as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td>".$list['id']."</td>\n";
		echo "<td><h6>".$list['name']."</h6></td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/categories/edit/'.$list['id'],'edit');
		echo " | ";
		echo anchor('admin/categories/delete/'.$list['id'],'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
}
?>