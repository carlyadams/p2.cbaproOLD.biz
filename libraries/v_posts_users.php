<h2>Green Guru following</h2>


<?php foreach($users as $user): ?>
    <p>
    <!-- Post the user's name -->
    <?=$user['first_name']?> <?=$user['last_name']?>


    <!-- Want to follow another Guru, here's the chance -->
    <?php if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Done following this Guru, unfollow them then.</a>


    <!-- If not, show following -->
    <?php else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Want to follow a Green Guru</a>
    <?php endif; ?>
    </p>
<?php endforeach; ?>

