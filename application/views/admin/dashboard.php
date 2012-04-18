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
			        padding: 9px 0;
			}
                        
                        .home
                        {
                          /*border:outset 1px;*/
                          width: 80%;
                          margin:auto;
                          padding: 20px;
                          
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

		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/bootstrap/js/bootstrap.js"></script>
		<script type="text/javascript" language="javascript" src="<?= base_url();?>assets/bootstrap/js/bootstrap-pagination.js"></script>
		<script type="text/javascript" src="<?php echo base_url() . 'assets/js/';?>chat.js"></script>
		<script type="text/javascript" charset="utf-8">
                
		</script>

	</head>
	<body>
	
        

                  
                
		<div class="container">

                <?php $this->load->view('admin/admin_header');?>
                
			<div class="home row-fluid">

					<?php $this->load->view($main);?>
			</div>

		<hr>
		
		<footer>
			<p><?php $this->load->view('admin/admin_footer');?></p>
		</footer>

		  
	      </div><!--/.fluid-container-->
		
		
	</body>


</html>
