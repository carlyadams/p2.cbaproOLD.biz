<?php
class users_controller extends base_controller {


    public function __construct() {
        parent::__construct();
        //echo "users_controller construct called<br><br>";
    } 

    #Set View
    public function signup() {




        $this->template->content = View::instance('v_users_signup');
        $this->template->title   = "Sign Up for an CBA eBlog Account";
        //$this->template->content->error   = $error;

        echo $this->template; }

    #Sign up code
    public function p_signup($error = NULL) {

 	#Search for blanks 
                foreach($_POST as $field => $value) {
                        if(empty($value)) {
                        Router::redirect('/users/signup/missing-input');
                }
        }

        # Create/Modified dates
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();


        # Creates Encrypts password 
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);            


        # Creates Encryption Token
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 


        # Adds user to db
        $user_id = DB::instance(DB_NAME)->insert('users', $_POST);


        # Sets view
        $this->template->content = View::instance('v_users_signedup');
        $this->template->title   = "Welcome to CBA eBlog";
        echo $this->template;
    }

	# Code promotes login
    public function login($error = NULL) {

	$this->template->content = View::instance("v_users_login");
        $this->template->content->error = $error;
        echo $this->template;}



	#Login and security
    public function p_login() {

	# Prevent sql inject and pw (password) hash
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);


        # Search email/pw
        # Retrieve the token if it's available
        $q = "SELECT token FROM users WHERE email = '".$_POST['email']."' AND password = '".$_POST['password']."'";
	$token = DB::instance(DB_NAME)->select_field($q);

	# Login failure
        if(!$token) {Router::redirect("/users/login/error"); }
        # Login success
        else {setcookie("token", $token, strtotime('+1 week'), '/');
            Router::redirect("/");
        }
    }




    public function logout() {


        # Next login token
        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        $data = Array("token" => $new_token);
        DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");


        # Delete token and log user out
        setcookie("token", "", strtotime('-1 week'), '/');
        Router::redirect("/");} 


    public function profile($user_name = NULL) {


        # Determine if logged in
        if(!$this->user) {
            Router::redirect('/users/login');
        }


        # If logged code continues
        $this->template->content = View::instance('v_users_profile');
        $this->template->title   = "Profile of ".$this->user->first_name;
        


        # The following deals with retrieving all of a user's posts
        # Placing it in the users controller was a tough design choice. 
        
        # Build the query to get all the users posts
        $q = "SELECT * FROM posts WHERE user_id = ".$this->user->user_id;
        $posts = DB::instance(DB_NAME)->select_rows($q);
        $this->template->content->posts       = $posts;
        echo $this->template;
		
		echo '<pre>';
print_r($this->user);
echo '</pre>';
    }



} # end of the class

