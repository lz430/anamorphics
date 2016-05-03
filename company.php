<!DOCTYPE html>
<html lang="en">
<head>
<?php 

$pageID = 'company';
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
            <nav class="navbar navbar-default">
                <div class="nav-container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation-container-sm" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    

                    <!-- SMALL SCREEN NAV -->
                    <div class="collapse navbar-collapse" id="navigation-container-sm">
                    	<div class="main-section-sm on" id="explore-trigger-sm">EXPLORE</div>
                		<ul class="nav-items-sm" id="explore-sm">
                            <li><a class="on" href="company.php">Company</a></li>
                            <li><a href="team.php">Team</a></li>
                            <li><a href="events.php">Events</a></li>
                            <li><a href="news.php">News</a></li>
                        </ul>
                    	<div class="main-section-sm" id="sample-trigger-sm">SAMPLE</div>
                		<ul class="nav-items-sm" id="sample-sm">
                            <li><a href="projects.php">Our Projects</a></li>
                        </ul>
                    	<div class="main-section-sm" id="analyze-trigger-sm">ANALYZE</div>
                		<ul class="nav-items-sm" id="analyze-sm">
                            <li><a href="services.php">Services</a></li>
                            <li><a href="markets.php">Markets</a></li>
                            <li><a href="culture.php">Culture</a></li>
                        </ul>
                        <div class="main-section-sm">CONTACT US</div>
                    </div>
                    <!-- SMALL SCREEN NAV end -->


                    <!-- LARGE SCREEN NAV -->
                	<div class="navigation-container collapse navbar-collapse">
                    	
                    	<div class="main-section on" id="explore-trigger">EXPLORE<span class="divider">/</span></div>
                    	<div class="main-section" id="sample-trigger">SAMPLE<span class="divider">/</span></div>
                    	<div class="main-section" id="analyze-trigger">ANALYZE</div>
                    	
                    	<div class="subnav-container" id="explore">
                    		<ul class="nav-items">
                                <li class="on"><a href="company.php">Company</a></li>
                                <li><a href="team.php">Team</a></li>
                                <li><a href="events.php">Events</a></li>
                                <li><a href="news.php">News</a></li>
                                <li class="contact"><a href="contact-us.php">Contact Us</a></li>
                            </ul>
                            <div class="nav-shadow"></div>
                    	</div>
                    	
                    	<div class="subnav-container" id="sample">
                    		<ul class="nav-items">
                                <li><a href="projects.php">Our Projects</a></li>
                                <li class="contact"><a href="contact-us.php">Contact Us</a></li>
                            </ul>
                            <div class="nav-shadow"></div>
                    	</div>
                    	
                    	<div class="subnav-container" id="analyze">
                    		<ul class="nav-items">
                                <li><a href="services.php">Services</a></li>
                                <li><a href="markets.php">Markets</a></li>
                                <li><a href="culture.php">Culture</a></li>
                                <li class="contact"><a href="contact-us.php">Contact Us</a></li>
                            </ul>
                            <div class="nav-shadow"></div>
                    	</div>

                    </div>
                    <!-- LARGE SCREEN NAV end-->



                </div>
                <!-- /.container-fluid -->
            </nav>
        </div><!-- end col-lg-->
        <div class="clearfix"></div>
    </div><!-- end container-->
    <div class="shadow"></div>
</header><!-- end Header-->


<div class="header-spacer2 bg-grey"></div>


<div class="jumbotron bg-grey">
    <div class="container">
	    <div class="row">
		    <p>Established in 1980 as an Arizona Corporation, Speedie & Associates, Inc. embarked on a demanding and rewarding path with a small group of 13 loyal employees and 10 clients. Today, Speedie & Associates is owned and managed by three of its long-time employees.</p>
	    </div><!-- end row-->
    </div><!-- end jumbotron/jumbo-shaodow-->
</div>


<section>
  	<div class="main-body">
    <div class="row company">
        <div class="container">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <h1 class="heading-lg">Who we are</h1>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 btn-container">
            <a href="#" class="btn-blk btn-icon-right">Culture</a>
            <a href="#" class="btn-blk btn-icon-down">Gallery</a>
          </div>
        </div> <!-- end container-->
      </div> <!-- end row-->
      <div class="row meet-team">
         <div class="container">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            <p>
              Together with a staff of 125 engineers, geologists, technicians and support personnel, Speedie & Associates offers quality geotechnical, environmental and construction materials testing and inspection services to thousands of clients statewide. 
            </p>
            <p> 
              Headquartered in Phoenix with branch offices in Flagstaff and Tucson, Arizona, each of Speedie’s offices are fully staffed and equipped to provide the following services:
            </p>
            <ul class="arrow">
              <li>Geotechnical Investigations and Site Development Reports</li>
              <li>Construction Materials Testing and Construction QC/QA</li>
              <li>Special Geotechnical, Structural, and Architectural Inspection </li>
              <li>Specialized Testing Services including FSA and GPR </li>
              <li>Full In-House Geotechnical and Materials Laboratory Testing </li>
              <li>Environmental Engineering and Site Assessments </li>
              <li>Asbestos Inspections, Management Plans and Abatement Oversight</li>
              <li>Additional Engineering &amp; Consulting Services</li>
            </ul>
          </div>
         </div>
       </div> <!-- end row-->
      
      <div class="row bg-construction-single">
      	

        <div class="container gallery">
           <div class="final-tiles-gallery effect-zoom effect-fade-out caption-top">
		      <div class="ftg-items">
		        
		        <div class="tile">
		          <a data-lightbox="gallery" data-title="This is a test" class="tile-inner" href="img/gallery-1.jpg">
		            <img class="item" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="img/gallery-1.jpg" />
		            <span class='title'>This is a test title</span>
		            <span class='subtitle'>This is a test sub title</span>
		          </a>
		        </div>

		        <div class="tile">
		          <a data-lightbox="gallery" data-title="This is a test" class="tile-inner" href="img/gallery-7.jpg">
		            <img class="item" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="img/gallery-7.jpg" />
		          </a>
		        </div>

		        <div class="tile">
		          <a data-lightbox="gallery" data-title="This is a test" class="tile-inner" href="img/gallery-4.jpg">
		            <img class="item" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="img/gallery-4.jpg" />
		          </a>
		        </div>

		        <div class="tile">
		          <a data-lightbox="gallery" data-title="This is a test" class="tile-inner" href="img/gallery-3.jpg">
		            <img class="item" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="img/gallery-3.jpg" />
		          </a>
		        </div>

		      </div>
		    </div>
        </div> <!-- end container-->
      </div> <!-- end row bg-construction-single-->
  	</div> <!-- end main-body-->
</section>



<?php include_once("footer.php") ?>


<!-- PAGE SPECIFIC DOC READY FUNCTIONS -->
<script>
$(document).ready(function(){


	//// -------- Navigation Defaults (Other Nav Functionality: custom.js)
	$( "#explore" ).show();
	$( "#sample" ).hide();
	$( "#analyze" ).hide();
	$( "#explore-sm" ).show();
	$( "#sample-sm" ).hide();
	$( "#analyze-sm" ).hide();


	//// -------- Final Tiles Gallery /*!James Padolsey http://james.padolsey.com/ http://www.final-tiles-gallery.com/ */
	$('.final-tiles-gallery').finalTilesGallery({
		margin: 6,
		minTileWidth: 160,
		gridCellSize: 20, 
		imageSizeFactor: [[4000, .9],[1024, .8],[800, .7],[600, .6],[480, .5]]
	});

});
</script>

</body>
</html>