<?php

class users_controller extends base_controller {

    public function __construct(){
        parent::__construct();
/*        echo "users_controller contructor called <br><br>";*/
    }

    public function index() {
        echo "Index called.";
    }

    public function signup(){
       /* echo "Signup called.";*/
	# First, set the content of the template with a view file
	$this->template->content = View::instance('v_users_signup');

	# Now set the <title> tag
	$this->template->title = "OPA! Signup";

	# Render the view
	echo $this->template;


    }
    
    public function login(){
        echo "Login called";
    }
    
    public function logout(){
        echo "logout called";
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
