<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/posts/add">New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>
	<div class="jumbotron">
		<h1>Welcome to OPA!</h1>
		<p class="lead">I built this site for CSCI E-15.</p>
		<p class="lead">Per the <a href="http://www.urbandictionary.com/define.php?term=opa" target="_blank">Urban Dictionary</a>, OPA means, <em>"a word that Greek people use for no apparent reason at all."</em> </p>
	</div>
	