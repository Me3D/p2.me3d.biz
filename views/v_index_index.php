<div class="container">
	
	<div class="jumbotron">
		<h1>Welcome to OPA!</h1>
		<p class="lead">The worlds greatest microblogging site! It's Greek, so it's gotta be cool, right?</p>
	</div>
	<hr>
	
	
        <div class="row-fluid padtop">
            	<div class="left">
			<form class="form-horizontal form-style" method='POST' action='/users/p_login'>
				<div class="control-group">
					<h2 class="form-signin-heading">Please sign in</h2>
					<div class="controls padder">
						<input type="text" class="input-block-level" placeholder="Email address" name='email'>
					</div>
					<div class="controls padder">
						<input type="password" class="input-block-level" placeholder="Password" name='password'>
					</div>
					<button class="btn btn-large btn-primary" type="submit">Sign in</button>
				</div>
			</form>
		</div>
		<div class="right">
			<form class="form-horizontal form-style" method='POST' action='/users/p_signup'>
				<div class="control-group">
					<h2 class="form-signup-heading">Please sign up</h2>
					<div class="controls padder">
						<input type="text" class="input-block-level" placeholder="Firstname" name='first_name'>
					</div>
					<div class="controls padder">
						<input type="text" class="input-block-level" placeholder="Lastname" name='last_name'>
					</div>
					<div class="controls padder">
						<input type="text" class="input-block-level" placeholder="Email address" name='email'>
					</div>
					<div class="controls padder">
						<input type="password" class="input-block-level" placeholder="Password" name='password'>
					</div>

					<button class="btn btn-large btn-primary" type="submit">Sign up</button>
				</div>
			</form>
		</div>     
            	
        </div>
</div>