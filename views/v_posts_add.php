
<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	

<h1>Post an OPA! </h1>

<form method='post' action='/posts/p_add'>

	<textarea name='content'></textarea>

	<input type='submit' value='Add new post'>

</form>


