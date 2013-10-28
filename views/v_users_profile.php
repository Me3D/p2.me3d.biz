

<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/posts/add/">New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	


	<div class="row">
		<div class="col-md-4"><img src="/uploads/avatars/<?php echo $user_id; ?>.png" class="img-thumbnail .img-responsive">
		
			<h4>Upload your own avatar pic!</h4>
			
			<form method='POST' enctype="multipart/form-data" action='/users/p_upload/' role="form">
				<div class="form-group">
				<input type='file' name='avatar_pic' >
				<p class="help-block">We only accept jpg/jpeg, png, or gif.  </p>
				<button type="submit" class="btn btn-default">Submit</button>
				</div>
			</form>
		</div>
		

		<div class="col-md-4"><h2><?php echo $first_name.' '.$last_name; ?><br><?php echo $email; ?></h2></div>
	</div> <!--end row -->



	 

		
