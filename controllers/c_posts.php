<?php
class posts_controller extends base_controller {


	//Throws the view out to add a post
	public function add($error = NULL){
		if(!$this->user) {
			Router::redirect('/');
		}
		$this->template->content = View::instance("v_posts_add");
		$this->template->content->error = $error;
		$this->template->content->user_id = $this->user->user_id;
		echo $this->template;

	}//end add

	//takes the form data and stuffs it into the DB.
	public function p_add() {
		if(!$this->user) {
			Router::redirect('/');
		}
		$_POST['user_id'] = $this->user->user_id;
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();

		//if they get past the JS text limit, we block them here and route them right back.
		if(strlen($_POST['content']) >=126 ){
			Router::redirect("/posts/add/error");
		} else {
			DB::instance(DB_NAME)->insert('posts', $_POST);
			
		}
		# Send them back
		Router::redirect("/users/index");
	}


	/* deprecated and moved to users/index
	public function index(){
		if(!$this->user) {
			Router::redirect('/');
		}
		$this->template->content = View::instance('v_users_index');
		$this->template->content = DB::instance(DB_NAME)->sanitize($this->template->content);

		$q = 'SELECT 
	            posts.content,
        	    posts.created,
	            posts.user_id AS post_user_id,
        	    users_users.user_id AS follower_id,
	            users.first_name,
        	    users.last_name
	        FROM posts
        	INNER JOIN users_users 
	            ON posts.user_id = users_users.user_id_followed
        	INNER JOIN users 
	            ON posts.user_id = users.user_id
	        WHERE users_users.user_id = '.$this->user->user_id;

		$posts = DB::instance(DB_NAME)->select_rows($q);
		$this->template->content->posts = $posts;
		echo $this->template;

	}//end index
*/
	
	//lists all the users, and allows for follow/unfollow
	public function users() {
		if(!$this->user) {
			Router::redirect('/');
		}
		$this->template->content = View::instance('v_posts_users');
		$this->template->content->user_id = $this->user->user_id;
		
		$this->template->content->user_id = DB::instance(DB_NAME)->sanitize($this->template->content->user_id);
		
		//get a big list of all users, except for this user
		$q = 'SELECT *
			FROM users
			WHERE user_id != '.$this->user->user_id;
		$users = DB::instance(DB_NAME)->select_rows($q);

		//get a big list of who this person is following. This list will be an array with the index
		//of the person being followed. e.g.:
		//    [14] => Array   <--#14 is being followed by ---|
		//(						     |
		//[user_user_id] => 24 				     |
		//[created] => 1382909930    			     |
		//[user_id] => 13               <--this guy----------|
		//[user_id_followed] => 14
		//)
		//user_id_followed will is also set the array index.
		//In the v_posts_users.php the for each will loop through the entire $users' array and determine whether
		//they are being followed or not based upon whether the array index is exisitng or not.	
		$this->user->user_id = DB::instance(DB_NAME)->sanitize($this->user->user_id);
		$q = 'SELECT *
			FROM users_users
			WHERE user_id = '.$this->user->user_id;

		//Notice the use of select_array. The index of the array will be user_id_followed
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		
		//shoot the $users array and the $connections array to the view.
		$this->template->content->users = $users;
		$this->template->content->connections = $connections;

		echo $this->template;


	}//end users



	public function follow($user_id_followed) {
		if(!$this->user) {
			Router::redirect('/');
		}
		# Prepare the data array to be inserted
		$data = Array(
		    "created" => Time::now(),
		    "user_id" => $this->user->user_id,
		    "user_id_followed" => $user_id_followed
		    );

		# Do the insert
		DB::instance(DB_NAME)->insert('users_users', $data);
    
		# Send them back
		Router::redirect("/posts/users");

	}//end follow

	public function unfollow($user_id_followed) {
		if(!$this->user) {
			Router::redirect('/');
		}
		# Delete this connection
		$this->user->user_id = DB::instance(DB_NAME)->sanitize($this->user->user_id);
		$user_id_followed = DB::instance(DB_NAME)->sanitize($user_id_followed);
		
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
		
		
		DB::instance(DB_NAME)->delete('users_users', $where_condition);

		 # Send them back
		Router::redirect("/posts/users");

	}//end unfollow





}//end class



?>
