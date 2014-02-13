<div id="header">
	<div class="container-fluid">
		<div class="pull-left">
			<a href="/" class="logo"></a>
		</div>
		<div class="pull-right hidden-phone">
				<a href="/search">Search</a>
			<?php if (!empty($username)): ?>
				<a href="/matches">Matches</a>
				<a href="/favorites">Favorites</a>
				<a href="/messages">Messages</a>
				<a href="/profile/<?php echo $username; ?>"><?php echo $name; ?></a>
				<a href="/logout">Logout</a>
			<?php else: ?>
				<a href="/register">Register</a>
				<a href="#login-modal" data-toggle="modal">Login</a>
			<?php endif; ?>
		</div>
		
		<?php if (empty($username)): ?>
		<!-- Login Modal (Show Form Only If User Is Not Logged In) -->
		<form id="login-modal" action="javascript:loginMember();" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 class="text-center light">Login To Kismet</h3>
			</div>
			<div class="modal-body">
				<div class="login-form">
					<div class="row-fluid">
						<label for="login-username">Username</label>
						<input id="login-username" type="text" placeholder="username" class="span12"/>
					</div>
					<div class="row-fluid">
						<label for="login-password">Password</label>
						<input id="login-password" type="password" placeholder="password" class="span12"/>
					</div>
					<div id="login-alert" class="alert hide"></div>
				</div>
			</div>
			<div class="modal-footer login-form">
				<input id="login-remember" type="checkbox" checked="true" class="pull-left"/>
				<label id="remember-label" class="pull-left">Remember Me</label>
				<button id="login-button" type="submit" class="btn btn-info pull-right span2">Login</button>
			</div>
		</form>
		
		<script type="text/javascript">
			/* Login User & Create Session */
			function loginMember() 
			{
				$('#login-alert').hide(); 
					
					/* Validate Form */
					var flag = false;
					if (!$.trim($('#login-password').val())) { 
						$('#login-alert').html('<strong>Password</strong> is required! ').fadeIn(250);
						flag = true;
					}
					if (!$.trim($('#login-username').val())) { 
						$('#login-alert').html('<strong>Username</strong> is required! ').fadeIn(250);
						flag = true;
					}
					/* If form is valid, login person */
					if(!flag) {
						$('#login-button').html('Logging In...').addClass('disabled');
				 		var rememberMe = 'false';
				 		if ($('#login-remember').is(':checked')) {
				 			rememberMe = 'true';
				 		}
					$.post('/handleAjax.php', {	type : 'login',
											username : $('#login-username').val(), 
											password : $('#login-password').val(),
											remember : rememberMe 
										},
						function(data) {
							$('#login-button').html('Login').removeClass('disabled');
							if (data.error) {
								$('#login-alert').addClass('alert-error').html('<strong>Error! </strong>' + data.error.message).fadeIn(250);
							}
							else {
								window.location.reload();	
							}
					}, 'json');
				} else {
					$('#loginButton').val('Login').removeClass('disabled');
					$('.loading').hide();	
				}
				} 
		</script>
		<?php endif; ?>
	</div>
</div>