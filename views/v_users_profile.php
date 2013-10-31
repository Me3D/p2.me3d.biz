

<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/index/"><strong>Read Posts!</strong></a></li>')
	$("#nav ul").append('<li><a href="/posts/add/">Post New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	

<div class="well well-sm">
	<div class="row">

		<?php 

				echo '<div class="col-md-4"><img src="/uploads/avatars/'.$user_id.'.png" '.'class="img-thumbnail .img-responsive">';
		
		?>
		
			
			
			<form method='POST' enctype="multipart/form-data" action='/users/p_upload/' role="form">
				<div class="form-group">
				<input type='file' name='avatar_pic' >
					<!-- $file_type_error passed from users/profile() after being set by p_upload() -->
				<?php
					if($file_type_error != NULL)
					 { 
						echo '<p class="help-block alert alert-danger"><strong>We only accept jpg/jpeg, png, or gif.</strong></p>'; 
					 } 
					 else 
					 { 
						echo '<p class="help-block">We only accept jpg/jpeg, png, or gif. Depending on your browser you may have to hit reload to see your new image!</p>'; 
					 }
				?>
				
				
				<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
		</div>
		

		<div class="col-md-4"><h2><?php echo $first_name.' '.$last_name; ?><br><?php echo $email; ?></h2>
		<a href="/users/edit">Edit Profile</a>
		
		</div>
	</div> 

</div>

	 

		
