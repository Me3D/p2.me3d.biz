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

	# Now set the <title> tag
	$this->template->title = "OPA!";

	# Render the view
	echo $this->template;
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
    
    public function profile($user_name = NULL) {
        if($user_name == NULL){
            echo "No user specified";
        }
        else {
            echo "This is user: ".$user_name;
        }
    }
            
            
            
           
            
            
            
            
}//end of users_controller class

?>
