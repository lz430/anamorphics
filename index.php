<!DOCTYPE html>
<html lang="en">
<head>
<?php 

$pageID = 'home';
$pageTitle = 'Speedie';
$metaKeywords = '';
$metaDescription = '';

include("header.php");



?>
</head>
<body>


<?php include_once("analyticstracking.php") ?>


<header class="navbar-fixed-top">
  <div class="container">
    <div class="col-lg-4 col-md-5 col-sm-5 col-xs-12 logo">
      <a href="index.php">
        <img src="img/logo.png" alt="Logo">
      </a>
    </div>
   <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
     <h1>Welcome Back</h1>
   </div>
  </div><!-- end container-->
  <div class="shadow"></div>
</header>


<div class="header-spacer1"></div>


<div class="container main-body">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 splash-image explore">
		<div class="variable-height">
			<a href="company.php" title="Explore our team bios" class="button"><img class="button-arrow" src="img/arrow.png" alt="Explore"/>Explore<div class="tagline-sm"> who we are</div></a>
			<div class="tagline">who we are</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 splash-image sample">
		<div class="variable-height">
			<a href="sample.php" title="Explore our team bios" class="button"><img class="button-arrow" src="img/arrow.png" alt="Sample<"/>Sample<div class="tagline-sm"> our featured projects</div></a>
			<div class="tagline">our featured projects</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 splash-image analyze">
		<div class="variable-height">
			<a href="analyze.php" title="Explore our team bios" class="button"><img class="button-arrow" src="img/arrow.png" alt="Analyze"/>Analyze<div class="tagline-sm"> our services</div></a>
			<div class="tagline">our services</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div><!-- end container-->



<?php include_once("footer.php") ?>


<!-- PAGE SPECIFIC DOC READY FUNCTIONS -->
<script>
$(document).ready(function(){



});
</script>

</body>
</html>