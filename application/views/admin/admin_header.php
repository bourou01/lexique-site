
<!-- Navbar
================================================== -->
<section id="navbar">
  <div class="page-header">

  
  
  <div class="navbar">
    <div class="navbar-inner">
      <div class="container" style="width: auto;">
      

        <a class="brand" href="#">Parlons Mahorais</a>
        <div class="nav-collapse">
          <ul class="nav">
          

            <li><?php echo anchor("admin/dashboard/index","DASHBOARD");?></li>
            
            <li><?php echo anchor("admin/products/", "EXPRESSIONS");?></li>
            <li><?php echo anchor("admin/categories/","CATEGORIES");?></li>
            
            <li><?php echo anchor("admin/dashboard/logout/", "SITE");?></li>
            
            
            
            
          </ul>
          

<?php

$attributes = array(
                    'class' => 'navbar-search pull-left',
                    'id' => 'myform'
);

echo form_open("admin/products/search", $attributes);

$data = array(
    "class"       => "search-query span2",
    "placeholder" =>"Search",
    "name"        => "term",
    "id"          => "term",
    "maxlength"   => "30",
    "size"        => "10"
);


echo form_input($data);
//echo form_submit("submit","search");

echo form_close();
?>

          <!--
          <form class="navbar-search pull-left" action="">
            <input type="text" class="search-query span2" placeholder="Search">
          </form>
          -->
          
          <ul class="nav pull-right">

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Options <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><?php echo anchor("admin/admins/", "UTILISATEURS");?></li>
                <li><?php echo anchor("admin/pages/", "PAGES");?></li>
                <li><?php echo anchor("admin/adminchat/", "Chat");?></li>
                <li><?php echo anchor("admin/webservice/", "Webservice");?></li>
                <li class="divider"></li>
                <li><a href="#">Separated link</a></li>
              </ul>
            </li>
          </ul>
          
          
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div><!-- /navbar -->
  
  