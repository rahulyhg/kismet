<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Search</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <?php require('include/styles.php'); ?>
</head>
<body>
    <!-- Everything Except Footer Goes Here -->
    <section id="wrap">
    	<!-- Same Header For Every Page -->
    	<?php require('include/header.php'); ?>
        <?php
			$gender = "man";
			$genderInterested = "women";
			$ageLow = "25";
			$ageHigh = "35";
			$cityState = "Orlando, FL"; 
			if (count($_GET) > 0 ) {
				if (isset($_GET['g'])) {
					$gender = $_GET['g'];
				}
				if (isset($_GET['gi'])) {
					$genderInterested = $_GET['gi'];
				}
				if (isset($_GET['al'])) {
					$ageLow = $_GET['al'];
				}
				if (isset($_GET['ah'])) {
					$ageHigh = $_GET['ah'];
				}
				if (isset($_GET['cs'])) {
					$cityState = $_GET['cs'];
				}	
			}
			if ($gender == "man") {
				$genderNot = "woman";
			}
			else {
				$genderNot = "man";
			}
			if ($genderInterested == "women") {
				$genderNotInterested = "men";
			}
			else {
				$genderNotInterested = "women";
			}
		?>


    	<!-- Content Unique To Every Page -->
    	<article class="container-fluid">
	    	<!-- Heading For Every Page -->
	    	<h1>Search<span>Get started and find that perfect match.</span></h1>
	    	
	    	<div class="row-fluid form-inline search-form">
	    		<label>I'm a</label>
	    		<select id="gender">
	            	<option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
	            	<option value="<?php echo $genderNot; ?>"><?php echo $genderNot; ?></option>
	            </select>
	            <label>interested in</label>
	            <select id="gender-search">
	            	<option value="<?php echo $genderInterested; ?>"><?php echo $genderInterested; ?></option>
	               	<option value="<?php echo $genderNotInterested; ?>"><?php echo $genderNotInterested; ?></option>
	            </select>
	            <label>age</label>
	            <input type="text" id="age-low" value="<?php echo $ageLow; ?>"/>
	            <label>to</label>
	            <input type="text" id="age-high" value="<?php echo $ageHigh; ?>"/>
	            <label>in</label>
	            <input type="text" id="city-state" class="input-medium" value="<?php echo $cityState; ?>"/>
			    <button type="submit" id="search-button" class="btn btn-info pull-right">Search</button>
			    <div class="loading pull-right"/></div>
			</div>
        
	    	<!-- Page Content -->
	    	<div class="page-body results row-fluid margin-below hide">
		    	
		    	<!-- Results Will Go Here -->
  
		    </div><!-- End Page Content -->
        </article>
      	<div id="push"></div>
    </section>
    
    <!-- Same Footer For Every Page (jQuery & Bootstrap) -->
    <?php require('include/footer.php'); ?>
    <script type="text/javascript">
    	var recordCount = 0;
    	
    	/* On Scroll Get More Results */
		var scrollFunction = function() {
		   if($(window).scrollTop() + $(window).height() > $(document).height() - 200) {
		       $(window).unbind("scroll");
		       getSearch();
		   }
		};
			
		/* Get Searches */
    	function getSearch() {
	    	$.post('http://kismet-api.aws.af.cm/_search/', {
	    							gender : $('#gender').val(),
									genderInterested : $('#gender-search').val(),
									ageLow : $('#age-low').val(),
									ageHigh	: $('#age-high').val(),
									cityState	: $('#city-state').val(),
									recordCount : recordCount
	    							 },
				function(data) {
					if (data.error) {
						$('#load-more').html(data.error.message);
						$('.loading').hide();
					}
					else {
						$.each(data.results, function(index, match) {
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
	                    /* */
	                    $(".thumbnail img").error(function(){
		                    $(this).attr("src", 'img/person.jpg');
		                });
		                /* Update Record Count, Hide Loading Spinner */
	                    recordCount = data.recordCount;
	                    $('.loading').hide();
	                    $('.results').show();
	                    /* Bind Window Scroll to Function */
	                    $(window).scroll(scrollFunction);
					}
			}, 'json');
    	}
		
		/* On Search Button Click */
		$(document).ready(function() {
			getSearch();
					
			$('#search-button').click(function() {
				window.location.href = "search?g=" + $('#gender').val() 
									 + "&gi=" + $('#gender-search').val() 
									 + "&al=" + $('#age-low').val() 
									 + "&ah=" + $('#age-high').val()
									 + "&cs=" + $('#city-state').val();
			});
		});
		
		/* Bootstrap Typeahead Suggest */
		$('#city-state').typeahead({
		    source: function (query, process) {
		        return $.post('http://kismet-api.aws.af.cm/_suggest/', { query : $('#city-state').val() }, function (data) {
		            return process(data.cities);
		        }, 'json');
		    }
		});
	</script>
</body>
</html>