<h1><?php echo $title;?></h1>


 <div class="form-actions">
<p><?php
//echo anchor("admin/pages/create", "Create new page");
	$attributes = array('class' => 'navbar-form');
	echo form_open("admin/admins/create", $attributes);

	$exportButton = array(
		'class'		=> 'btn btn-danger',
		'name' 		=> 'button',
		'value' 	=> 'true',
		'type' 		=> 'submit',
		'content' 	=> 'Nouveau'
	);
	echo form_button($exportButton);
	echo form_close();
	

?></p>
 </div>
 
<?php
if ($this->session->flashdata('message')){
	echo "<div class='alert alert-success'>".$this->session->flashdata('message')."</div>";
}

if (count($admins)){
	echo "<table class='table table-striped table-bordered table-condensed'>\n";
	echo "<tr valign='top'>\n";
	echo "<th>ID</th>\n<th>Username</th><th>Status</th><th>Actions</th>\n";
	echo "</tr>\n";
	foreach ($admins as $key => $list){
		echo "<tr valign='top'>\n";
		echo "<td>".$list['id']."</td>\n";
		echo "<td><h4>".$list['username']."</h4></td>\n";
		echo "<td align='center'>".$list['status']."</td>\n";
		echo "<td align='center'>";
		echo anchor('admin/admins/edit/'.$list['id'],'edit');
		echo " | ";
		echo anchor('admin/admins/delete/'.$list['id'],'delete');
		echo "</td>\n";
		echo "</tr>\n";
	}
	echo "</table>";
}
?>

<?php echo $this->pagination->create_links(); ?>