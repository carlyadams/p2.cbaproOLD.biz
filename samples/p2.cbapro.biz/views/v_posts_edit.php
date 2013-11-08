<h2>Edit your Greener</h2>
<h3>Your Original Greener</h3>


<?php foreach($posts as $post): ?>
        <?=$post['content']?>
        <br>
        <span class = "date">
            <time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
                <?=Time::display($post['created'])?>
            </time>
        </span>


    <!-- Display Greener edit area -->
        <form method='POST' action="/posts/p_edit/<?=$post['post_id']?>">


            <h3>Here is your edited Greener</h3>
            <textarea name='content' id='content'></textarea>


            <br><br>
            <input type='submit' value='Edit Greener'>


        </form> 
<?php endforeach; ?>

