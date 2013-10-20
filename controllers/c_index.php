<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index() {
		
		/*The goal is to route users to the users index page if they are already logged in.
		 *Or route them to the main page where a person can login or signup.
		 */
			
		
		#Not logged in (or signed up) send to login or signup page
		if(!$this->user) {
			# First, set the content of the template with a view file
			$this->template->content = View::instance('v_index_index');

			# Now set the <title> tag
			$this->template->title = "OPA!";

			# Render the view
			echo $this->template;
			
		}
		
		else {
			Router::redirect('/users/index');
		}						

	} # End of method
	
	/* About */    
	public function about() {
        
        # First, set the content of the template with a view file
	$this->template->content = View::instance('v_index_about');

	# Now set the <title> tag
	$this->template->title = "OPA!";

	# Render the view
	echo $this->template;
    }
	
} # End of class
