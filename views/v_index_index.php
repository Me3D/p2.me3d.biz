

<div class="container">
	
	<div class="jumbotron">
		<h1>Welcome to OPA!</h1>
		<p class="lead">The worlds greatest microblogging site! It's Greek, so it's gotta be cool, right?</p>
		<p class="lead">OPA offers the +1 feature of uploading avatar pictures!</p>
		<p class="lead">We also offer the abilty to edit one's profile info! +1 Woot!</p>
	</div>
	<hr>
	<div class="row-fluid padtop">
            	<div class="left">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
					  	<div class="panel-heading">
						    	<h3 class="panel-title">Please sign in</h3>
					 	</div>
						<div class="panel-body">
							<form accept-charset="UTF-8" role="form" method='POST' action='/users/p_login'>
								<fieldset>
									<div class="form-group controls control-group">
									    <input class="form-control" placeholder="E-mail" name="email" type="email"  required/>
									 <p class="help-block"></p>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" value="" required/>
									</div>
									
									<input class="btn btn-lg btn-success btn-block" type="submit" value="Sign in">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="right">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Please sign up!</h3>
						</div>
							<div class="panel-body">
								<form accept-charset="UTF-8" role="form" method='POST' action='/users/p_signup'>
									<fieldset>
										<div class="form-group controls control-group">
											<input class="form-control" minlength="2" placeholder="Firstname" name='first_name' type="text" required/>
											<p class="help-block"></p>
										</div>
										<div class="form-group controls control-group">
											<input class="form-control" minlength="2" placeholder="Lastname" name='last_name' type="text" required/>
											<p class="help-block"></p>
										</div>
										<div class="form-group controls control-group">
											<input class="form-control" placeholder="E-mail" name="email" type="email" required/>
											<p class="help-block"></p>
										</div>
										<div class="form-group controls control-group">
											<input class="form-control" minlength="10" placeholder="Password" name="password" type="password" value="" required/>
											<p class="help-block"></p>
										</div>
										
						   
										<input class="btn btn-lg btn-success btn-block" type="submit" value="Sign Up">
									</fieldset>
								</form>
							</div>
					</div>
				</div>
			</div>
		</div>     
            	
        </div>	
</div>