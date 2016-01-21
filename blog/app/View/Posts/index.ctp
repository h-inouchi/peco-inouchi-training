<h2>記事一覧</h2>

<ul>
<?php foreach ($posts as $post) : ?>
<li id="post_<?php echo h($post['Post']['id']); ?>">
<?php
// debug($post);
// echo h($post['Post']['title']);
// 
echo $this->Html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);
?> 
<?php echo $this->Html->link('編集', array('action'=>'edit', $post['Post']['id'])); ?> 
<?php
    echo $this->Form->postLink('削除', array('action'=>'delete', $post['Post']['id']), array('confirm'=>'sure?'));
?>
-> この記事の作成者：
<?php
    echo $post['User']['username'];
?>
</li>
<?php endforeach; ?>
</ul>

<h2>Add Post</h2>
<?php echo $this->Html->link('Add post', array('controller'=>'posts','action'=>'add'));
?>


