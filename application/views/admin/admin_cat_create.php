
<h1><?php echo $title;?></h1>

<hr>
<div class="well">
<?php

	/*Button*/
$submitButton = array(
    'class'	=> 'btn btn-danger',
    'name' 	=> 'button',
    'value' 	=> 'true',
    'type' 	=> 'submit',
    'content' 	=> 'Creat Category'
);

echo form_open('admin/categories/create');

echo "<p><label for='catname'>Name</label>";
$data = array('class'=>'span5', 'name'=>'name','id'=>'catname');
echo form_input($data) ."</p>";

echo "<p><label for='descript'>Long Description</label>";
$data = array('class'=>'span5', 'name'=>'description','id'=>'long');
echo form_textarea($data) ."</p>";

echo "<p><label for='status'>Status</label>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options) ."</p>";

echo "<p><label for='parent'>Category Parent</label>";
echo form_dropdown('parentid',$categories) ."</p>";

//echo form_submit('submit','update category');
echo form_button($submitButton);

echo form_close();


?>
</div>