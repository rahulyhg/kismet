<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>About Us</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require('include/styles.php'); ?>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAVXiURlKN_qOvleKvMsjgX_KXIB5ytRKo&sensor=false">
    </script>
    <script type="text/javascript">
        function initialize() {
	        var mapOptions = {
	        	center: new google.maps.LatLng(28.541458, -81.379209),
	        	zoom: 15,
	        	mapTypeId: google.maps.MapTypeId.ROADMAP,
	        	disableDefaultUI: true,
	        };
	        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
	        var marker = new google.maps.Marker({
				position: new google.maps.LatLng(28.541458, -81.379209),
				map: map,
				title: "Kismet!"
			});
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
    <!-- Everything Except Footer Goes Here -->
    <section id="wrap">
    	<!-- Same Header For Every Page -->
    	<?php require('include/header.php'); ?>

    	<!-- Content Unique To Every Page -->
    	<article class="container-fluid">
	    	<!-- Heading For Every Page -->
	    	<h1>About Us<span>We help you find your life partner. That's it.</span></h1>
        
	    	<!-- Page Content -->
	    	<div class="page-body row-fluid margin-below">
        
		        <div class="span8 row-fluid">
		        	<h3>Our Story</h3>
		        	<div class="row-fluid thumbnail padded">
		        		<div class="span12 img-bordered" style="height:300px; margin-bottom:20px;" id="map-canvas"></div>
		        		<div class="span3" style="margin-left:0;">
			        		<address>
								<strong>Kismet, Inc.</strong><br>
								30 S Orange Ave, Suite 600<br>
								Orlando, FL 32801<br><br>
								<strong>Call Us</strong><br>
								1 800 456-7890<br><br>
								<strong>Email Us</strong><br>
								<a href="mailto:#">hello@kismet.com</a>
							</address>
		        		</div>
			        	
			        	<!-- Contact Us Form -->
			        	<form class="contact-form span9">
							<fieldset>
							  	<h4>Contact Us</h4>
							  	<hr>
							    <div class="row-fluid">
							    	<div class="span6">
							    		<label>Name</label>
								    	<input type="text" placeholder="John Appleseed" class="span12">
							    	</div>
								    <div class="span6">
								    	<label>Email</label>
								    	<input type="text" placeholder="john@example.com" class="span12">
								    </div>
							    </div>
							    <label>Message</label>
							    <div class="row-fluid">
								    <textarea class="span12" placeholder="message here..." rows="5"></textarea>
							    </div>
							    <div class="alert hide">
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									  <strong>Warning!</strong> Best check yo self, you're not looking too good.
								</div>
							    <div class="row-fluid" style="padding-top: 10px;">
								    <button type="submit" class="btn btn-medium btn-info pull-right">Send</button>
								</div>
							</fieldset>
						</form>
		        	</div>
	        	</div>
	        	
	        	<div class="span4 row-fluid margin-below">
		        	<h3 class="span12">The Founders</h3>
		        	<div class="span12 thumbnail" style="margin-left:0;">
			        	<img src="/img/1.jpg">
			        	<div class="caption">
			        		<h4 class="text-right">
			        			Dulcineah Tsambiras<br>
			        			<small>Co-Founder & CEO</small>
			        		</h4>
			        		<p class="justify">
				        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
				        		sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
				        		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
				        		nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
				        		reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
			        		</p>
			        	</div>
		        	</div>
		        	
		        	<div class="span12 thumbnail" style="margin:0;">
			        	<img src="/img/2.jpg">
			        	<div class="caption">
			        		<h4 class="text-right">
			        			Himanshu Chaudhary<br>
			        			<small>Co-Founder & President</small>
			        		</h4>
			        		<p class="justify">
				        		Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
				        		sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
				        		Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris 
				        		nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
				        		reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
			        		</p>
			        	</div>
		        	</div>
	        	</div>
	        	
        	
		    </div><!-- End Page Content -->
        </article>
      	<div id="push"></div>
    </section>
    
    <!-- Same Footer For Every Page (jQuery & Bootstrap) -->
    <?php require('include/footer.php'); ?>
</body>
</html>