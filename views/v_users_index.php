

<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/index/"><strong>Read Posts!</strong></a></li>')
	$("#nav ul").append('<li><a href="/posts/add/">Post New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	

<!--
This page will list users and their posts
-->

<br> <br>


<?php foreach($posts as $post): ?>
	<div class="row well col-md-8">
		<div class=""><a class=""><img src="/uploads/avatars/<?=$post['post_user_id'].'.png'?>" alt=""></a></div>
		<div class=""><p><?php echo $post['first_name'].' '.$post['last_name']?></div>
		<span class="wordwrap"><?php echo $post['content']?></span>
	</div>
<?php endforeach ?>
