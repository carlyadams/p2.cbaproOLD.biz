<h2>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h2>
<p>
        CBA Professionals presents CBA eBlog.  CBA has a tradition of being an outstanding Consulting Firm and is trending green.  This blog will carry you along with our pursuits. Post your green actions and we will share ours. Better life starts here. Please sign up for an account and join the green revolution; if you haven't already.  <br><br> 
<strong>+1 Features:</strong> View and delete posts /users/profile.</p>
<p><strong>+1 Features:</strong> Account Verification.<br>
  <br> 
  
</p>


<?php if(!$user): ?>
    <!-- If user isnt logged in, show signup/login panel -->
        <div id='leftColumn'>
                <h3>New to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?>
                ? Sign up!</h3>
                <form method='POST' action='/users/p_signup'>


                    First Name of GURU<br>
                    <input type='text' name='first_name' required>
                    <br><br>


                    Last Name of GURU<br>
                    <input type='text' name='last_name' required>
                    <br><br>


                    Email of GURU<br>
                    <input type='text' name='email' required>
                    <br><br>


                    Password of GURU<br>
                    <input type='password' name='password' required>
                    <br><br>


                    <input type='submit' value='Sign me up!'>


                </form>
        </div>


        <div id='rightColumn'>
                <h3>Got a GREENER Account? Log in then</h3>
                <form method='POST' action='/users/p_login'>


                    Email<br>
                    <input type='text' name='email' required>


                    <br><br>


                    Password<br>
                    <input type='password' name='password' required>


                    <br><br>


                    <?php if(isset($error)): ?>
                        <div class='error'>
                            Login failed. Please double check your email and password.
                        </div>
                        <br>
                    <?php endif; ?>
                        <input type='submit' value='Log in'>
                </form>
        </div>
        <hr>
    <!-- Otherwise, hide it follow link -->
    <?php else: ?>
        


    <?php endif; ?>
