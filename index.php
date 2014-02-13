<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Kismet</title>
	<meta name="description" content="">
	<meta name="author" content="">
	<style type="text/css">
		#header {
			background: none;
		}
		#footer {
			position: relative;
			top: 70px;
		}
		h1 {
			isibility: hidden;
		}
	</style>
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
			<h1>Kismet</h1>
			
			<!-- Page Content -->
			<div class="page-body">
				
				<div class="row-fluid">
					Tabbed
				</div>

			</div><!-- End Page Content -->
		</article>
		<div id="push"></div>
	</section>
	
	<!-- Same Footer For Every Page (jQuery & Bootstrap) -->
	<?php require('include/footer.php'); ?>
</body>
</html>