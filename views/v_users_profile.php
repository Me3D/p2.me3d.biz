

<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/posts/add/">New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	

<div class="well well-sm">
	<div class="row">
		<!--pic the correct avatar -->
		<?php 
			if(file_exists('uploads/avatars/'.$user_id.'.png'))
			{
				echo '<div class="col-md-4"><img src="/uploads/avatars/'.$user_id.'.png" '.'class="img-thumbnail .img-responsive">';
				
			}
			else
			{
				echo '<div class="col-md-4"><img src="/uploads/avatars/default.png" class="img-thumbnail .img-responsive">';
				echo '<h4>Why don\'t you upload your own avatar pic!</h4>';
				
			}
		
		?>
		
			
			
			<form method='POST' enctype="multipart/form-data" action='/users/p_upload/' role="form">
				<div class="form-group">
				<input type='file' name='avatar_pic' >
					<!-- bad file type error passed from profile controller -->
				<?php
					if($file_type_error != NULL)
					 { 
						echo '<p class="help-block alert alert-danger"><strong>We only accept jpg/jpeg, png, or gif.</strong></p>'; 
					 } 
					 else 
					 { 
						echo '<p class="help-block">We only accept jpg/jpeg, png, or gif.  </p>'; 
					 }
				?>
				
				
				<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
		</div>
		

		<div class="col-md-4"><h2><?php echo $first_name.' '.$last_name; ?><br><?php echo $email; ?></h2></div>
	</div> 

</div>

	 

		
