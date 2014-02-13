<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Favorites</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require('include/styles.php'); ?>
</head>
<body>
    <!-- Everything Except Footer Goes Here -->
    <section id="wrap">
    	<!-- Same Header For Every Page -->
    	<?php require('include/header.php'); ?>

    	<!-- Content Unique To Every Page -->
    	<article class="container-fluid">
	    	<!-- Heading For Every Page -->
	    	<h1>Register<span>Find out what you're missing.</span></h1>
        
	    	<!-- Page Content -->
	    	<div class="page-body row-fluid margin-below">
        
		        <!-- Show User Details -->
	        	<div class="span7">
	        		<div class="row-fluid">
		    			  <img src="img/345.jpg" class="span6"/>
		        		<div class="span6 caption">
			        		<h4>
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
	        	</div>
	        	
	        	<!-- Registration Form -->
	        	<div class="span5">
		        	<form class="well registration">
						<fieldset>
						  	<legend>Registration Form</legend><br>
						  	<div class="row-fluid">
						    	<label>Full Name</label>
						    	<input type="text" placeholder="John Appleseed" class="span12">
						  	</div>
						    <div class="row-fluid">
						    	<div class="span6">
						    		<label>Username</label>
							    	<input type="text" placeholder="john_appleseed" class="span12">
						    	</div>
							    <div class="span6">
							    	<label>Email</label>
							    	<input type="text" placeholder="john@example.com" class="span12">
							    </div>
						    </div>
						    <label>Password</label>
						    <div class="row-fluid">
							    <input type="password" placeholder="password" class="span6">
							    <input type="password" placeholder="re-type password" class="span6 pull-right">
						    </div>
						    <div class="row-fluid">
						    	<div class="span6">
						    		<label>Date of Birth</label>
							    	<input type="text" placeholder="05/25/1985" class="span12"/>
						    	</div>
							    <div class="span6">
						    		<label>Gender</label>
							    	<select id="gender" class="span12">
										<option value="M">Male</option>
										<option value="F">Female</option>
									</select>
						    	</div>
						    </div>
						    <div class="row-fluid">
						    	<div class="span4">
						    		<label>Zip</label>
							    	<input type="text" placeholder="32801" class="span12">
						    	</div>
							    <div class="span8">
							    	<label>City, State</label>
							    	<input type="text" placeholder="City, State" class="span12">
							    </div>
						    </div>
						    <div class="alert hide">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <strong>Warning!</strong> Best check yo self, you're not looking too good.
							</div>
						    <div class="row-fluid" style="padding-top: 10px;">
							    <button type="submit" class="btn btn-info span5 pull-right">Register</button>
							</div>
						</fieldset>
					</form>
				</div><!-- End of Form -->
        	
		    </div><!-- End Page Content -->
        </article>
      	<div id="push"></div>
    </section>
    
    <!-- Same Footer For Every Page (jQuery & Bootstrap) -->
    <?php require('include/footer.php'); ?>
</body>
</html>