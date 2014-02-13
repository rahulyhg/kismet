<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Profile</title>
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
	    	<h1><!-- Name -->Profile Page<span><!-- Zodiac Sign - City, State -->Loading...</span></h1>
	    	
	    	<div class="alert alert-error main hide">
	    		<strong>Oops! </strong>You must be logged in to view this page!
	    		&nbsp<button href="#login-modal" class="btn btn-small" data-toggle="modal">Login Now</button>
	    	</div>
        
	    	<!-- Page Content -->
	    	<div id="profile-page" class="page-body page-border row-fluid margin-below hide">
	    		<!-- Profile Top -->
		    	<div class="span12 row-fluid profile-top">
	    			<img id="profile-img" src="/img/345.jpg" class="span4"/>
	        		<div class="span5 caption">
		        		<h4 id="profile-name">
		        			<!--
		        			Dulcineah Tsambiras<br>
		        			<small>Tampa, FL</small><br>
		        			<small class="light">30, Cancer, Straight</small>
		        			-->
		        		</h4>
		        		<p class="text-success">Last Online Today</p>
		        		<div><strong>About...</strong></div>
		        		<p id="profile-about" class="justify">
		        			<!-- About Person -->
		        		</p>
		        		<div><strong>I'm looking for...</strong></div>
		        		<p id="profile-looking" class="justify">
			        		<!-- Person's Looking For -->
		        		</p>
		        	</div>
		        	<div class="span3">
			        	<a href="sendMessage" class="btn btn-block">Send Message</a>
			        	<a href="sendMessage" class="btn btn-block">Wink</a>
			        	<a href="sendMessage" class="btn btn-block">Add To Favorites</a>
		        	</div>
	        	</div>
	        	
	        	<div class="row-fluid span12 profile-info">
		        	<div class="span3">
			        	<div class="heading">Information</div>
			        	<ul class="unstyled">
				        	<li>
				        		Career / Job
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Education
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Faith
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Ethnicity
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Politics
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Children
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Height
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Exercise
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Drink
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Smoke
				        		<span>Software Engineer</span>
				        	</li>
			        	</ul>
		        	</div>
		        	<div class="span7">
			        	<div class="heading">Information</div>
			        	<ul class="unstyled">
				        	<li>
				        		An awesome place I've visited
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		My perfect Sunday
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		The movie I've watched the most times
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		My life history in a few sentences
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		Obscure knowledge I possess
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		A story you should remind me to tell you on our first date
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		I secretly want to be
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		If I won the lottery and quit my job, I would
				        		<span>Software Engineer</span>
				        	</li>
				        	<li>
				        		One thing my mother would want you to know about me
				        		<span>Software Engineer</span>
				        	</li>
			        	</ul>
		        	</div>
		        	<div id="additional-photos" class="span2 row-fluid">
			        	<div class="heading">More Photos</div>
			        	<img src="/img/345.jpg" class="span12"/>
			        	<img src="/img/345.jpg" class="span12"/>
			        	<img src="/img/345.jpg" class="span12"/>
			        	<img src="/img/345.jpg" class="span12"/>
		        	</div>
	        	</div>
        	
		    </div><!-- End Page Content -->
        </article>
      	<div id="push"></div>
    </section>
    
    <!-- Same Footer For Every Page (jQuery & Bootstrap) -->
    <?php require('include/footer.php'); ?>
    <script type="text/javascript">
    	<?php if (($_GET['user'] == '.php' || empty($_GET['user'])) && !empty($username)): ?>
  			window.location = '/profile/<?php echo $username; ?>';
    	/* If Logged In Get All Conversations */
    	<?php elseif (!empty($username) && !empty($_GET['user'])): ?>
    		$(document).ready(function() {
    			getProfileInfo('<?php echo $_GET['user']; ?>');
  			});
  			
  			/* Send Message */
	    	function getProfileInfo(user) {
		    	$.post('/handleAjax', { type : 'getUser', username : user },
					function(data) {
						if (data.error) {
							$('.alert.main').html('<strong>Oops! </strong>' + data.error.message).show();
						}
						else {
							$('.container-fluid h1').html(data.name + "<span>" + data.sign + " - " + data.city + ", " + data.state + "</span>");
							$('#profile-page .lead').html(data.name);
							$('#profile-name').html(data.name + "<br>" +
			        								"<small>" + data.city + ", " + data.state + "</small><br>" +
			        								"<small class='light' style='color:#222;'>" + data.age + ", " + data.sign + ", " + data.interestedIn + "</small>");
			        		$('#profile-about').html(data.about);
			        		$('#profile-looking').html(data.lookingFor);
			        		$('#profile-img').attr("src", data.image);
			        		$('#profile-page').show();
						}
				}, 'json');
	    	}
  		<?php else: ?>
  			$(document).ready(function() {
	    		$('.alert.main').show();
  			});
	    <?php endif; ?>
    </script>
</body>
</html>