<h1><?php echo $title;?></h1>
<p>The following products are about to be orphaned. They used to belong to the <b><?php echo $category['name'];?></b> category, but now they need to be reassigned.</p>

<ul>
<?php
foreach ($this->session->userdata('orphans') as $id => $name){
	echo "<li>$name</li>\n";
}
?>
</ul>

<?php
echo form_open('admin/categories/reassign');
unset($categories[$category['id']]);
echo form_dropdown('categories',$categories);
echo form_submit('submit','reassign');
echo form_close();
?>