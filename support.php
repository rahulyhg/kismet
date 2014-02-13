<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Support</title>
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
	    	<h1>Support<span>Don't worry, we're here for you.</span></h1>
        
	    	<!-- Page Content -->
	    	<div class="page-body row-fluid margin-below">
        
			    <p class="lead">Blash</p>
        	
		    </div><!-- End Page Content -->
        </article>
      	<div id="push"></div>
    </section>
    
    <!-- Same Footer For Every Page (jQuery & Bootstrap) -->
    <?php require('include/footer.php'); ?>
</body>
</html>