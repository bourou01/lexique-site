<div class="navbar-inner">
	<div class="container-fluid">
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		          
		<a class="brand" href="#">Parlons Mahorais</a>
		          
		<div class="nav-collapse">
		
			<ul class="nav">

			<?php $this->load->view('header');?>
						
			</ul>
			<?php 
			if ($this->session->userdata('logged_in'))
			{
				//echo '<p class="navbar-text pull-right"><a href="welcome/profile">';
				echo anchor("welcome/profile", '<p class="navbar-text pull-right">'.$this->session->userdata('username'));
				echo '</a></p>';
			}
			?>
			 
			
		</div><!--/.nav-collapse -->
	          
	</div>
</div>