<!DOCTYPE html>
<html>
<head>
        <title><?php if(isset($title)) echo $title; ?></title>


        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />        
        <link rel="stylesheet" type="text/css" href="/css/cscStyle.css">
                                
        <!-- Controller Specific JS/CSS -->
        <?php if(isset($client_files_head)) echo $client_files_head; ?>
        
</head>


<body>  
    <div id = "wrapper">
        <header>
            <h1><?=APP_NAME?></h1>
            <nav>
                <ul>
                    <li><a href='/'>CBA eBlog</a></li>


                    <!-- Menu for users who are logged in -->
                    <?php if($user): ?>
                        <li><a href='/posts'>View Posts</a></li>
                        <li><a href='/posts/add'>Add a Post</a></li>
                        <li><a href='/posts/users'>Currently Following</a></li>
                        <li><a href='/users/profile'>View your Profile</a></li>
                        <li><a href='/users/logout'>Logout</a></li>


                    <!-- Options for non-logged users -->
                    <?php else: ?>


                        <li><a href='/users/signup'>Sign up for a CBA eBlog Account</a></li>
                        <li><a href='/users/login'>Log in</a></li>


                    <?php endif; ?>
                </ul>
                <hr>
            </nav>
        </header>
        <div id = "content">
            <!-- Load content -->
            <?php if(isset($content)) echo $content; ?>
        </div>
        <footer>
            <!-- Add app and year -->
            <p>Copyright <?=APP_NAME?> <?php echo date('Y')?></p>
        </footer>
    </div>
</body>
</html>

