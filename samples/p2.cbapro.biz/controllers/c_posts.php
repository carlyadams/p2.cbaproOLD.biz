<?php
class posts_controller extends base_controller {
        public function __construct() {
                parent::__construct();


                #Authenticated Users Only
                if(!$this->user) {
                        # Route to signup if not a memer
                    die(Router::redirect("/users/signup"));
                }
        }

	#Code to add post
        public function add() {


        # Sets up the view
        $this->template->content = View::instance('v_posts_add');
        $this->template->title   = "New Post";


        # Reflects template
        echo $this->template;


        }

	#Process the post
        public function p_add() {


        # Post/User Association
        $_POST['user_id']  = $this->user->user_id;


        # Time Stamps
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();


        # Post Entry
        DB::instance(DB_NAME)->insert('posts', $_POST);


          # Setup view
        $this->template->content = View::instance('v_posts_added');
        $this->template->title   = "Your post is now public!";
        echo $this->template;


        }

	#Add Users
        public function users() {


            # Set View
            $this->template->content = View::instance("v_posts_users");
            $this->template->title   = "Users";


            # Query users
            $q = "SELECT * FROM users";


            # Run users query and post results to an array
            $users = DB::instance(DB_NAME)->select_rows($q);


            # Code for user connections 
            $q = "SELECT * FROM users_users WHERE user_id = ".$this->user->user_id;
            $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
            $this->template->content->users       = $users;
            $this->template->content->connections = $connections;
            echo $this->template;}

	#Reflects user following
        public function follow($user_id_followed) {


    # Date/Time Stamp and user info of follower
    $data = Array(
        "created" => Time::now(),
        "user_id" => $this->user->user_id,
        "user_id_followed" => $user_id_followed);
	DB::instance(DB_NAME)->insert('users_users', $data);


   
    Router::redirect("/posts/users");
}

	#Code to unfollow
        public function unfollow($user_id_followed) {


            # Removes the connection
            $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
            DB::instance(DB_NAME)->delete('users_users', $where_condition);


    
            Router::redirect("/posts/users");}
        
	#Reflects list of users being followed
	public function index() {


            # Sets view
            $this->template->content = View::instance('v_posts_index');
            $this->template->title   = "Posts";


            # Follow query
            $q = "SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
        FROM posts INNER JOIN users_users ON posts.user_id = users_users.user_id_followed
        INNER JOIN users ON posts.user_id = users.user_id WHERE users_users.user_id = ".$this->user->user_id;


            # Runs query
            $posts = DB::instance(DB_NAME)->select_rows($q);

            # Increments view
            $this->template->content->posts = $posts;

		echo $this->template; }




        public function edit($post_id) {


        # Sets view
        $this->template->content = View::instance('v_posts_edit');
        $this->template->title   = "Edit Post";

	# All user post query
        $q = "SELECT * FROM posts WHERE post_id = ".$post_id;


        # Executes and stores results
        $posts = DB::instance(DB_NAME)->select_rows($q);
	$this->template->content->posts       = $posts;
	echo $this->template;}

	#Edit Post
        public function p_edit($post_id) {

        $_POST['modified'] = Time::now();


        # Send and test post
        DB::instance(DB_NAME)->update("posts", $_POST, "WHERE post_id = ".$post_id);
        # Setup view (eventually)
        $this->template->content = View::instance('v_posts_edited');
        $this->template->title   = "Your Post has been Edited!";
        echo $this->template;


        }




        public function p_delete($post_id) {


                # Query the DB using post_id param
        $q = "WHERE post_id = ".$post_id;


        # Run the delete query
        DB::instance(DB_NAME)->delete('posts', $q);
        
        # Send them back
            Router::redirect("/users/profile");


        }
}
#EOC

