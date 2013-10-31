
<script>
	$("#nav ul").append('<li><a href="/users/index/"><strong>Read Posts!</strong></a></li>')
	$("#nav ul").append('<li><a href="/posts/users">Follow Users!</a></li>')
	$("#nav ul").append('<li><a href="/users/profile/<?php echo $user_id; ?>">Profile</a></li>')
	$("#nav ul").append('<li><a href="/users/logout">Logout</a></li>')
	
</script>	



<div class="container">
    <div class="row">
	<div class="col-sm-4 col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">                
                    <form class=" control-group" accept-charset="UTF-8" method='post' action='/posts/p_add'>
                        <textarea class="" minlength="2" maxlength="125" name="content" placeholder="Type in your OPA!" rows="4" style="margin-bottom:10px;" type="text"></textarea>
                        <p class="help-block"></p>
			
			<?php 
				if($error != NULL)
					 { 
						echo '<h6 class="pull-right help-block alert alert-danger">125 characters Max!</h6>';
					 } 
					 else 
					 { 
						echo '<h6 class="pull-right">125 characters Max!</h6>'; 
					 }
			?>
                        <button class="btn btn-info" type="submit">Post OPA!</button>
                    </form>
                </div>
            </div>
        </div>
     </div>
</div>




