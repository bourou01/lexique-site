<br>
<?php 
if ($this->session->flashdata('alert-info'))
{
	echo "<div class='alert alert-info'>".$this->session->flashdata('alert-info');
	echo "<a class='close' data-dismiss='alert'>&times;</a>"."</div>";
}

if ($this->session->flashdata('alert-success'))
{
	echo "<div class='alert alert-success'>".$this->session->flashdata('alert-success');
	echo "<a class='close' data-dismiss='alert'>&times;</a>"."</div>";
	
}

if ($this->session->flashdata('alert-error'))
{
	echo "<div class='alert alert-error'>".$this->session->flashdata('alert-error');
	echo "<a class='close' data-dismiss='alert'>&times;</a>"."</div>";
}
?>
