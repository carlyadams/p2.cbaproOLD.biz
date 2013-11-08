<h2>This Green Profile is for <?=$user->first_name?> <?=$user->last_name?></h2>
<h3>Guru Details</h3>
    <!-- User Info -->
    <p><strong>First Name of Guru:</strong> <?=$user->first_name?></p>
    <p><strong>Last Name of Guru:</strong> <?=$user->last_name?></p>
    <p><strong>Email of Guru:</strong> <?=$user->email?></p>
        <p><strong>Greener Member since:</strong> <?=Time::display($user->created)?></p>


<h3>Guru Posts</h3>
<ul>
        <?php foreach($posts as $post): ?>
            <li>
                    <?=$post['content']?>
                    <br>
                    <span class = "date"><?=Time::display($post['modified'])?></span>
                    <br>
                    <a href='/posts/edit/<?=$post['post_id']?>'>Edit</a><br><br> <a href='/posts/p_delete/<?=$post['post_id']?>'>Delete</a>
            </li>
        <?php endforeach; ?>
</ul>

