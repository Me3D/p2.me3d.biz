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
    /*This will take in an image and save a png copy of it on the server.  */
    public function p_upload(){
        //get file extension
        $parts = pathinfo( ($_FILES['avatar_pic']['name']) );
        //boolean set to FALSE for incorrect file extension uploading
        $upload_ok = FALSE;
        
         if($parts['extension'] == "jpg")
             $upload_ok = TRUE;
         if($parts['extension'] == "jpeg")
             $upload_ok = TRUE;    
         if($parts['extension'] == "png")
             $upload_ok = TRUE;
         if($parts['extension'] == "gif")
             $upload_ok = TRUE;    
     
        if($upload_ok) {     
            //upload the chosen file and rename it temp-user_id.original extension
            Upload::upload($_FILES, "/uploads/avatars/", array("jpg", "jpeg", "gif", "png"), "temp-".$this->user->user_id);               
            //resize the image to 258x181 -- usually it's 258 wide then optimal height.
            $imgObj = new Image(APP_PATH.'uploads/avatars/'.'temp-'.$this->user->user_id.'.'.$parts['extension']);
            
            $imgObj->resize(100, 100);
            $imgObj->save_image(APP_PATH.'uploads/avatars/'.$this->user->user_id.'.'.png);    //save the file as user_id.png
            unlink('uploads/avatars/'.'temp-'.$this->user->user_id.'.'.$parts['extension']);  //delete the temp file
            Router::redirect("/users/profile/".$this->user->user_id);
        }
        else {
            //send the user back to the profile but this time have error set.
            Router::redirect("/users/profile/".$this->user->user_id."/error");
        } //else
    }//p_upload
   
    
    
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

        $q = 'SELECT user_id
                FROM users
                WHERE token = "'.$_POST['token'].'"';
         
        $image_user_id = DB::instance(DB_NAME)->select_field($q);
        
        
        echo $image_user_id;
        
        //grab the default image then save it as the user's default image
        copy(APP_PATH.'/uploads/avatars/default.png', APP_PATH.'/uploads/avatars/'.$image_user_id.'.'.'png');
        
        //auto follow onself
        $data = Array(
	    "created" => Time::now(),
	    "user_id" => $image_user_id,
	    "user_id_followed" => $image_user_id
	    );

	# Do the insert
	DB::instance(DB_NAME)->insert('users_users', $data);
        
        
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
    
    public function profile($user_id = NULL, $file_type_error = NULL ) {
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

            #pass the user id
            $this->template->content->user_id = $this->user->user_id;
            
            #pass the first_name
            $this->template->content->first_name = $profile['first_name'];
        
            #pass the last_name
            $this->template->content->last_name = $profile['last_name'];
        
            #pass the email
            $this->template->content->email = $profile['email'];
            
            #Now set the <title> tag
            $this->template->title = "OPA!";
             
            #Tell the view there was a bad file type error, passed from p_upload(). 
            $this->template->content->file_type_error = $file_type_error;            
                        
            # Render the view
            echo $this->template; 
            
        }//else
    }//profile()
            
     
    public function edit($error = NULL) {
        #are they logged in?
        if(!$this->user) {
            Router::redirect('/');
        }        
        # First, set the content of the template with a view file
        $this->template->content = View::instance('v_users_edit');
        #Now set the <title> tag
        $this->template->title = "OPA!";
        #pass the first_name
        $this->template->content->first_name = $this->user->first_name;
        
        #pass the last_name
        $this->template->content->last_name = $this->user->last_name;
        
           #pass the email
        $this->template->content->email = $this->user->email;
        #Tell the view there was a entry error 
        $this->template->content->error = $error;
        # Render the view
        echo $this->template; 
    }
     
    public function p_edit() {
        #are they logged in?
        if(!$this->user) {
            Router::redirect('/');
        }
        
        
        $q = 'SELECT first_name, last_name, email
                FROM users
                WHERE user_id = "'.$this->user->user_id.'"';
        $user = DB::instance(DB_NAME)->select_row($q);
                
        print_r($user);
        
        //echo $user['first_name'];
        //print_r($_POST);
        //just in case they bypass client side checks
        //if($_POST['first_name'] == NULL || $_POST['last_name'] == NULL) {
        //    Router::redirect('/users/edit/error');
        //} else {
            //echo $this->user->user_id;
            
        $q = 'SELECT count(*)
                FROM users
                WHERE email = "'.$_POST['email'].'"';   
        $count = DB::instance(DB_NAME)->select_rows($q);            
        //if the user enters an email which already exists in the data base kick them back
            if(intval($count[0]['count(*)']) >= 1) {
                Router::redirect('/users/edit/error');
            } else {
            
                if($_POST['first_name'] != NULL)
                {
                    $user['first_name'] = $_POST['first_name'];
                }
                if($_POST['last_name'] != NULL )
                {
                    $user['last_name'] = $_POST['last_name'];
                }
                if($_POST['email'] != NULL )
                {
                    $user['email'] = $_POST['email'];
                }
                
                echo "new user:";
                print_r($user);
                
                
                DB::instance(DB_NAME)->update("users", $user, "WHERE user_id =".$this->user->user_id);
                Router::redirect('/users/profile/'.$this->user->user_id);
            }
              
            
    }//end p_edit
    
    
    
            
       
            
}//end of users_controller class

?>
