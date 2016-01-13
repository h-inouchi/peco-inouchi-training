<h2><?php echo h($post['Post']['title']); ?></h2>
 
<p><?php echo h($post['Post']['body']); ?></p>

<h2>Comments</h2>

<ul>
<?php foreach (): ?>
<li></li>
<?php endforeach (); ?>
</ul>