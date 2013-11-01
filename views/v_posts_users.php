<script>
        $("#nav ul").append('<li><a href="/users/index/"><strong>Read Posts!</strong></a></li>')
        $("#nav ul").append('<li><a href="/posts/add/">Post New OPA!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>

<!--
This page will list users and a link to follow or unfollow.
As it loops through EVERY users on the system, it will display their name.
It will then look in the $connections array to see if that persons user_id exists as an array element.
Mark = user_id 13...If he is followed then the $connections[13] should exist.
-->

<br> <br>




<?php foreach($users as $user): ?>
        <div class="row well col-md-8">

                <div class=""><a class=""><img src="/uploads/avatars/<?=$user['user_id'].'.png'?>" alt=""></a></div>
                    <div class=""><p><?=$user['first_name']?> <?=$user['last_name']?></p></div>
                <?php if (isset($connections[$user['user_id']])): ?>
                    <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>
                <?php else: ?>
                    <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
                <?php endif; ?>
               

        </div>
        <!-- row well -->
<?php endforeach ?>





