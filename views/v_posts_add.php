
<script>
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	



<div class="container">
    <div class="row">
	<div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">                
                    <form accept-charset="UTF-8" method='post' action='/posts/p_add'>
                        <textarea class="form-control " name="content" placeholder="Type in your OPA!" rows="4" style="margin-bottom:10px;"></textarea>
                        <h6 class="pull-right">200 characters Max!</h6>
                        <button class="btn btn-info" type="submit">Post OPA!</button>
                    </form>
                </div>
            </div>
        </div>
     </div>
</div>




