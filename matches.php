<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Matches</title>
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
	    	<h1>Matches<span>Individually picked, just for you.</span></h1>
	    	
	    	<!-- Main Alert For Page -->
	    	<div class="alert alert-error main hide">
	    		<strong>Oops! </strong> You must be logged in to view this page!
	    		&nbsp<button href="#login-modal" class="btn btn-small" data-toggle="modal">Login Now</button>
	    	</div>
        
	    	<!-- Page Content -->
	    	<div class="page-body results row-fluid margin-below hide">
				
				<!-- Matches Will Go Here -->
						    
		    </div><!-- End Page Content -->
        </article>
      	<div id="push"></div>
    </section>
    
    <!-- Same Footer For Every Page (jQuery & Bootstrap) -->
    <?php require('include/footer.php'); ?>
    <script type="text/javascript">
    	<?php if (!empty($username)): ?>
    		/* If Logged In Get All Matches */ 
	    	$(document).ready(function() {
				getMatches();
			});
			
	    	/* Get Matches (Ajax) */
	    	function getMatches() {
		    	$.post('/handleAjax', { type : 'matches' },
					function(data) {
						if (data.error) {
							alert(data.error.message);
						}
						else {
							$.each(data.matches, function(index, match) {
		                        $('.results').append("<div class='span3 thumbnail' onclick=\"location.href='/profile/" + match.username + "';\">" +
	                                                   "<img src='" + match.image + "' />" +
	                                                   "<div class='caption'>" +
	                                                   		"<h4>" +
	                                                   			match.name + "<br>" + 
	                                                   			"<small>" + match.city + ", " + match.state + "</small>" + 
	                                                   		"</h4>" +
	                                                   		"<span>" + match.sign + "<br><small>" + match.age + ", " + match.gender + ", " + match.interestedIn + "</small></span>" +
	                                                   "</div>" +
	                                                 "</div>" );
		                    });
		                    $('.results').show();
						}
				}, 'json');
	    	}
    	<?php else: ?>
    		/* If Not Logged In, Show Error */
    		$(document).ready(function() {
	    		$('.alert.main').show();
  			});
    	<?php endif; ?>
    </script>
</body>
</html>