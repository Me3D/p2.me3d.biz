<?php

class users_controller extends base_controller {

    public function __construct(){
        parent::__construct();
/*        echo "users_controller contructor called <br><br>";*/
    }

    
/* main page for logged in users*/    
    public function index() {
        if(!$this->user) {
            Router::redirect('/');
        }
        
        # First, set the content of the template with a view file
	$this->template->content = View::instance('v_users_index');
        
        #pass the user_id over to the actual view
        $this->template->content->user_id = $this->user->user_id;
        
	# Now set the <title> tag
	$this->template->title = "OPA!";
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
		
	# Render the view
	echo $this->template;
        
    } //end index()

    
    /*Avatar upload and resize */
    public function p_upload(){
        
        Upload::upload($_FILES, "/uploads/avatars/", array("jpg", "jpeg", "gif", "png"), $this->user->user_id);
        
        //get file extension
        $parts = pathinfo( ($_FILES['avatar_pic']['name']) );
        //resize the image to 258x181 -- usually it's 258 wide then optimal height.
        $imgObj = new Image(APP_PATH.'uploads/avatars/'.$this->user->user_id.'.'.$parts['extension']);
        //echo $imgObj->exists();
        $imgObj->resize(100, 100); 
        $imgObj->save_image(APP_PATH.'uploads/avatars/'.$this->user->user_id.'.'.$parts['extension']);
        Router::redirect("/users/profile/".$this->user->user_id);
    }
   
    
    
    /*may never be used*/
    public function signup(){
       /* echo "Signup called.";*/
	# First, set the content of the template with a view file
	$this->template->content = View::instance('v_users_signup');

	# Now set the <title> tag
	$this->template->title = "OPA! Signup";

	# Render the view
	echo $this->template;
    }


    public function p_signup(){
        $_POST['created'] = Time::now();
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
        DB::instance(DB_NAME)->insert_row('users',$_POST);
        Router::redirect('/users/login');
    }

    
    public function login($error = NULL){
        # First, set the content of the template with a view file
	$this->template->content = View::instance('v_users_login');
        
        #pass the existance(NULL or not NULL) of $error
        $this->template->content->error = $error;
        
	# Now set the <title> tag
	$this->template->title = "OPA! Login";

	# Render the view
	echo $this->template;
    }
    
    public function p_login(){
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        $q = 'SELECT token
            FROM users
            WHERE email = "'.$_POST['email'].'"
            AND password = "'.$_POST['password'].'"';
           
            
        $token = DB::instance(DB_NAME)->select_field($q);
        
        
        #success
        if($token) {
            //name, actual value, time length, directory access
            //pull out cookie from browser developer tools
            setcookie('token', $token, strtotime('+1 year'), '/');
            Router::redirect('/users/index');
            
        }
        #fail
        else {
            Router::redirect('/users/login/error');
        }
    }
    
    
    
    
    public function logout(){
        # Generate and save a new token for next login
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
        $data = Array("token" => $new_token);

        # Do the update
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

        # Delete their token cookie by setting it to a date in the past - effectively logging them out
        setcookie("token", "", strtotime('-1 year'), '/');

        # Send them back to the main index.
        Router::redirect("/");
    }
    
    public function profile($user_id = NULL) {
        #are they logged in?
        if(!$this->user) {
            Router::redirect('/');
        }
        
        #is there a user_id /users/profile/### ?
        if($user_id == NULL){
            echo "No user specified";
        }
        else {           
            $q = 'SELECT first_name, last_name, email
            FROM users
            WHERE user_id = "'.$user_id.'" ';

            $profile = DB::instance(DB_NAME)->select_row($q);

            
            # First, set the content of the template with a view file
            $this->template->content = View::instance('v_users_profile');

            #oass the user id
            $this->template->content->user_id = $this->user->user_id;
            
            #pass the first_name
            $this->template->content->first_name = $profile['first_name'];
        
            #pass the last_name
            $this->template->content->last_name = $profile['last_name'];
        
            #pass the email
            $this->template->content->email = $profile['email'];
        
            # Now set the <title> tag
            $this->template->title = "OPA!";
       
            # Render the view
            echo $this->template; 
            
        }
    }
            
            
            
           
            
            
            
            
}//end of users_controller class

?>
