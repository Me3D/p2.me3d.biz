

<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/posts/add">New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	

<!--
This page will list users and a link to follow or unfollow.
As it loops through EVERY users on the system, it will display their name.
It will then look in the $connections array to see if that persons user_id exists as an array element.
Mark = user_id 13...If he is followed then the $connections[13] should exist.
-->

<br> <br>
<?php foreach($posts as $post): ?>
	<?=$post['first_name']?><br>
	<?=$post['content']?><br><br>

<?php endforeach; ?>

	