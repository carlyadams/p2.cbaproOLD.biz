<h2>Ready to Log in Green Guru</h2>
<form method='POST' action='/users/p_login'>
    Email<br>
    <input type='text' name='email' required>


    <br><br>


    Password<br>
    <input type='password' name='password' required>


    <br><br>


    <?php if(isset($error)): ?>
        <div class='error'>
            Please check your email and/or password, login failed.
        </div>
        <br>
    <?php endif; ?>




    <input type='submit' value='Log me in'>


</form>

