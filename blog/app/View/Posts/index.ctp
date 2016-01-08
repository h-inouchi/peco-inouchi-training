<h2>記事一覧</h2>
 
<ul>
<?php foreach ($posts as $post) : ?>
<li>
<?php
// debug($post);
echo h($post['Post']['title']);
?>
</li>
<?php endforeach; ?>
</ul>