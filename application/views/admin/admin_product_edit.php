<h1><?php echo $title;?></h1>

<hr>
<div class="well">

<?php

	/*Button*/
$submitButton = array(
    'class'	=> 'btn btn-success',
    'name' 	=> 'button',
    'value' 	=> 'true',
    'type' 	=> 'submit',
    'content' 	=> 'Update Product'
);


echo form_open_multipart('admin/products/edit');

echo "<p><label for='parent'>Category</label>";
echo form_dropdown('category_id',$categories,$product['category_id']) ."</p>";


echo "<p><label for='pfrancais'>Francais</label>";
$data = array(
                                'class' => 'span5',
				'name'=>'francais',
				'id'=>'pfrancais',
				'value' => $product['francais']
			);
echo form_input($data) ."</p>";

echo "<p><label for='pmahorais'>Mahorais</label>";
$data = array(
                                'class' => 'span5',
				'name'=>'mahorais',
				'id'=>'pmahorais',
				'value' => $product['mahorais']
			);
echo form_input($data) ."</p>";


echo "<p><label for='pexample'>Example</label>";
$data = array(
                                'class' => 'span5',
				'name'=>'example',
				'id'=>'pexample',
				'value' => $product['example']
			);
echo form_textarea($data) ."</p>";


echo "<p><label for='status'>Status</label>";
$options = array('active' => 'active', 'inactive' => 'inactive');
echo form_dropdown('status',$options, $product['status']) ."</p>";

echo form_hidden('id',$product['id']);

//echo form_submit('submit','update product');
echo form_button($submitButton);

echo form_close();


?>

</div>