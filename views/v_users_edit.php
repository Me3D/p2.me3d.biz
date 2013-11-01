

<script>
	$("#nav ul").append('<li><a href="/users/index/"><strong>Read Posts!</strong></a></li>')
	$("#nav ul").append('<li><a href="/posts/add/">Post New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	

<div class="row-fluid padtop">
            	<div class="left">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
					  	<div class="panel-heading">
	<!-- $error passed from users/p_edit() -->
				<?php
					if($error != NULL)
					 { 
						echo '<p class="help-block alert alert-danger"><strong>Invalid data entered or email in use.</strong></p>'; 
					 } 
					 else 
					 { 
						echo '<p class="help-block">Only edit the item(s) to be changed.</p>'; 
					 }
				?>
					 	</div>
						<div class="panel-body">
							<form accept-charset="UTF-8" role="form" method='POST' action='/users/p_edit'>
								<fieldset>
									<div class="form-group controls control-group">
									    <input class="form-control" minlength="2" placeholder=<?=$first_name?> name="first_name" type="text">
									    <p class="help-block"></p>
									</div>
									<div class="form-group controls control-group">
									    <input class="form-control" minlength="2" placeholder=<?=$last_name?> name="last_name" type="text">
									    <p class="help-block"></p>
									</div>
									<div class="form-group controls control-group">
									    <input class="form-control" placeholder=<?=$email?> name="email" type="email">
									    <p class="help-block"></p>
									</div>									
									<input class="btn btn-lg btn-success btn-block" type="submit" value="Update">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>              	
        </div>
</div>	 

		
