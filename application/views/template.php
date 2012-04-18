<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		
		<?php $this->load->view('tools/view_ref');?>
		
		<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/media/images/favicon.ico" />
		
		<title><?php //echo $title; ?> Parlons Mahorais | Site sur la langue mahoraise, Mayotte</title>
		
		

		
		<style type="text/css" title="currentStyle">
			@import "<?= base_url();?>assets/datatables/css/demo_page.css";
			@import "<?= base_url();?>assets/datatables/css/demo_table.css";
			@import "<?= base_url();?>assets/bootstrap/css/bootstrap.css";
			@import "<?= base_url();?>assets/bootstrap/css/bootstrap-responsive.css";
			
			body {
			        padding-top: 60px;
			        padding-bottom: 40px;
				
			}

			
			.sidebar-nav {
			        padding: 9px 0px;
			}

		</style>

		<noscript>
		Javascript is not enabled! Please turn on Javascript to use this site.
		</noscript>
		
		<script type="text/javascript">
		//<![CDATA[
		base_url = '<?= base_url();?>';
		//]]>
		</script>
		
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/datatables/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/datatables/js/jquery.dataTables.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/bootstrap/js/bootstrap-pagination.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/bootstrap/js/bootstrap-carousel.js"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/';?>chat.js"></script>
		<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {

			$('#example').dataTable( {
				
				"sPaginationType": "bootstrap",

			        "iDisplayLength": 25,
				"aLengthMenu": [[10, 25, 50, 100, 200], [10, 25, 50, 100,200]],			
				
				
				"bProcessing": false,
				"bServerSide": true,
				"sAjaxSource": "<?php echo base_url(); ?><?php echo $get_data_method;?>",

				"sServerMethod": "POST"
			} );
		} );
		</script>

	</head>
	<body>
	
	
		<div class="navbar navbar-fixed-top">
			<?php $this->load->view('topbar');?>
		</div>

		<div class="container-fluid">

			<div class="row-fluid">
			
				
				<?php $this->load->view('navigation');?>
				
				<div class="span7">
					<?php $this->load->view('users/messages')?>
					<?php //$this->load->view('title');?>
					<?php $this->load->view($main);?>
				</div>
				
				<div class="span3">
					<?php $this->load->view('chat/view_chat');?>
				</div>				
				

			</div>

		<hr>
		
		<footer>
			<p><?php $this->load->view('footer');?></p>
		</footer>

		  
		</div><!--/.fluid-container-->

	</body>


</html>
