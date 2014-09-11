<div class='container header'>
	<div class="col-md-4">
		<p>Column 1</p>
	</div>
	<div class="col-md-4">
		<p>Column 2</p>
	</div>
	<div class="col-md-4">
		<?php if(!isset($_SESSION['username'])): ?>
			<h3>Login</h3>
			<form id="journalSubmit" id="login" method="post">
				<p>Username: <input type="text" name="username" id="username"></p>
				<p>Password: <input type="password" name="password" id="password"></p>
				<input type="button" name="submit" id="loginSubmit" value="Submit" />
			</form>
			<div id="response"></div>
			<p><a href="register.php">Register</a></p>
		</div>
		<script type="text/javascript">
			$("#loginSubmit").click(function(event) {
				var response;
				event.preventDefault();
				var $form = $( this );
				var	username = $("#username").val();
				var	password = $("#password").val();
				var posting = $.post( './verifyLogin.php',{user: username, pass: password});
				posting.done(function( data ) {
					$( "#response" ).html( "<b>" + data + "</b>");
					response = data;
				})
				.done(function() {
					if(response == "Successfully logged in!") {
						location.reload();
					}
				})
			})
		</script>
	<?php else: ?>
		<p><b>Logged in as <?php echo $_SESSION['username']; ?>.</b></p>
		<form>
			<input type="button" name="submit" id="loginSubmit" value="Logout" />
		</form>
		<div id="response"></div>
		<script type="text/javascript">
			$("#loginSubmit").click(function(event) {
				var response;
				event.preventDefault();
				$.get("logout.php", function(data) {
					$("#response").html(data);
					response = data;
				})
				.done(function() {
					if(response == "Successfully logged out.") {
						location.reload();
					}
				})
			})
		</script>
	</div>
<?php endif; ?>
