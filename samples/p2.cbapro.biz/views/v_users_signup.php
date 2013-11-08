<h2>Sign up to be a GREEN GURU</h2>


<form method='POST' action='/users/p_signup'>


    First Name of GURU
    <br>
    <input type='text' name='first_name' required>
    <br><br>


    Last Name of GURU
    <br>
    <input type='text' name='last_name' required>
    <br><br>


    Email of GURU
    <br>
    <input type='text' name='email' required>
    <br><br>


    Password of GURU
    <br>
    <input type='password' name='password' required>
    <br><br>

	                <?php if(isset($error) && $error == 'missing-input'): ?>
                        <div class='error'>
                        All fields are required to become a Guru.                 
                        </div>
                <?php endif; ?>
                <br>
 


                <?php if(isset($error) && $error == 'email-exists'): ?> 
                        <div class='error'>
                        You may already have a Guru account. Simply <a href="/users/login">Log in</a> or use a different account.
                        </div>
                <?php endif; ?>
                <br>
	
    <input type='submit' value='Ready to be a Green Guru'>

	

</form>

