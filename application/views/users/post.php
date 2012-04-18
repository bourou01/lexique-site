<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/media/images/favicon.ico" />
		
		<title>DataTables example</title>
		
		<style type="text/css" title="currentStyle">
			@import "<?= base_url();?>assets/datatables/css/demo_page.css";
			@import "<?= base_url();?>assets/datatables/css/demo_table.css";
			@import "<?= base_url();?>assets/bootstrap/css/bootstrap.css";
		</style>
		
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/datatables/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/datatables/js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/bootstrap/js/bootstrap-pagination.js"></script>
		<script type="text/javascript" charset="utf-8">

			$(document).ready(function() {

				$('#example').dataTable( {

					"sPaginationType": "bootstrap",

					"bProcessing": false,
					"bServerSide": true,
					"sAjaxSource": "<?php base_url();?>site/getdatabyajax",

					"sServerMethod": "POST"
				} );
			} );
			
			
		</script>
	</head>
	
	
	

	<body>

		<div id="container">
		
		
			<div class="full_width big">
				DataTables server-side processing with POST example
			</div>
 			
			<h1>Preamble</h1>
			<p>The default HTTP method that DataTables uses to get data from the server-side if GET, however, there are times when you may wish to use POST. This is very easy using the sServerMethod initialisation parameter, which is simply set to the HTTP method that you want to use - the default is 'GET' and this example shows 'POST' being used.</p>
			
			<h1>Live example</h1>
			<br/>
			<div id="dynamic">

<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
	<thead>
		<tr>
			<th width="5%">id</th>
			<th width="50%">Mahorais</th>
			<th width="50%">Francais</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="5" class="dataTables_empty">Loading data from server</td>
		</tr>
	</tbody>
</table>

<br/>
<br/>
<br/>


			</div>
	
		</div>
	</body>
</html>