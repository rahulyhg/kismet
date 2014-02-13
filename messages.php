<?php require('include/session.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Message Center</title>
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
	    	<h1>Messages<span>All your messages, in one place.</span></h1>
	    	
	    	<!-- Main Alert -->
	    	<div class="alert alert-error main hide">
	    		<strong>Oops! </strong> You must be logged in to view messages!
	    		&nbsp<button href="#login-modal" class="btn btn-small" data-toggle="modal">Login Now</button>
	    	</div>
        
	    	<!-- Page Content -->
	    	<div class="row-fluid messages hide">
        
    			<!-- Messages Side -->
    			<ul id="messages-list" class="media-list span4">
			        <!-- All Conversations (Ajax) -->
			        
    			</ul>
    			
    			<!-- Conversation Side -->
    			<ul id="conversation-list" class="media-list span8">
    				<div id="conversation-ajax">
    					<!-- Conversation With Member (Ajax) -->
        				
    				</div>
    				
			        <!-- Send Message (Ajax) -->
			        <div class="send-message hide">
					    <textarea id="message" placeholder="Write a message..."></textarea>
					    <button type="submit" class="btn btn-info" onclick="sendMessage();">Send</button>
			    	</div>
    			</ul>
        	
		    </div><!-- End Page Content -->
        </article>
      	<div id="push"></div>
    </section>
    
    <!-- Same Footer For Every Page (jQuery & Bootstrap) -->
    <?php require('include/footer.php'); ?>
    <script type="text/javascript">
    	var tOut = null;
    	var activeUser = null;
    	var firstCall = true;
    	
    	<?php if (!empty($username)): ?>
    	/* If Logged In Get All Conversations */ 
	    $(document).ready(function() {
	    	resize();
	    	getAllConversations();
  		});
    	
    	/* Resize Items */
    	function resize() {
	    	/* Adjust Height & Get All Conversations */
	    	$('#messages-list, #conversation-list').css('height', ($('#wrap').height() - 220));
	    	$('#conversation-ajax').css('height', ($('#wrap').height() - 325));
	    }
    	
    	/* Send Message */
    	function sendMessage() {
	    	$.post('/handleAjax', { type : 'sendMessage', toUser : activeUser, message : $('#message').val() },
				function(data) {
					if (data.error) {
						alert(data.error.message);
					}
					else {
						$('#message').val('');
						clearTimeout(tOut);
						getConversation(true);
						getAllConversations();
					}
			}, 'json');
    	}
    	
    	/* Delete Message */
    	function deleteMessage(msgId) {
	    	$.post('handleAjax', { type : 'deleteMessage', msgId : msgId },
				function(data) {
					if (data.error) {
						alert(data.error.message);
					}
					else {
						clearTimeout(tOut);
						getConversation(true);
						getAllConversations();
					}
			}, 'json');

    	}
    
    	/* Get Conversation with User (Accepts scrollUp as true of false) */
    	function getConversation(scrollUp) {
	    	$.post('handleAjax', { type : 'getConversation', withUser : activeUser },
				function(data) {
					if (data.error) {
						$('#conversation-ajax').append(data.error.message);
					}
					else {
						$('#conversation-ajax').empty();
						$.each(data.messages, function(index, message) {
	                        $('#conversation-ajax').append("<li class='media'>" +
	                                                       "<img class='media-object pull-left' src='" + message.image + "' style='width: 47px; height: 35px' />" +
	                                                       "<div class='media-body'><a href='profile/" + message.username + "'><h4 class='media-heading'>" 
	                                                       + message.name + "</h4></a>" + message.message +
	                                                       "<span>" + message.timeAgo + "</span>" + 
	                                                       "<button class=\"close\" onclick=\"deleteMessage('" + message.msgId + "')\">&times;</button></div>" +
	                                                     "</li>" );
	                    });	
					}
					if (scrollUp == true) {
						$('#conversation-ajax').scrollTop('5000');
					}
					/* Poll Every 5 Seconds */
					tOut = setTimeout(getConversation, 5000);
			}, 'json');
    	}
    	
    	/* Get All Conversations */
    	function getAllConversations() {
		    $.post('handleAjax', { type : 'conversations' },
				function(data) {
					if (data.error) {
						alert(data.error.message);
					}
					else {
						$('#messages-list').empty();
						$.each(data.messages, function(index, message) {
	                        $('#messages-list').append("<li class='media' data-user='" + message.username + "' onclick='conversationClick(this);'>" +
	                                                       "<img class='media-object pull-left' src='" + message.image + "' style='width: 67px; height: 50px' />" +
	                                                       "<div class='media-body'><h4 class='media-heading'>" + message['name'] + "</h4>" + message['message'] +
	                                                       "<span>" + message['timeAgo'] + "</span>" + 
	                                                       "<button class=\"close\" onclick=\"event.stopPropagation();deleteConversation('" + message.username + "')\">&times;</button></div>" +
	                                                     "</li>" );
	                    });
	                    $('.messages').show();
	                    /* If this is first call, load first conversation */
	                    if (firstCall == true) {
		                    firstCall = false;
		                    conversationClick($('#messages-list li:first-child'));
	                    }	
					}
			}, 'json');
		}
		
		/* Delete Conversation */
		function deleteConversation(withUser) {
			if(	confirm('Are you sure you want to delete this conversation?') ) {
				/* Delete Message */
				alert(withUser);
			}
		}
    	
    	/* Click Events */
    	function conversationClick(el) {
    		$('.send-message').show();
    		$('.media').removeClass('active');
    		$(el).addClass('active');
    		
    		activeUser = $(el).data('user');
    		
    		if (tOut !== null) {
	    		clearTimeout(tOut);
    		}
    		$('#conversation-ajax').empty();
    		getConversation(true);
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