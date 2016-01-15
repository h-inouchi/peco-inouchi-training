<h2><?php echo h($post['Post']['title']); ?></h2>
 
<p><?php echo h($post['Post']['body']); ?></p>

<h2>Comments</h2>

<ul>
<?php foreach ($post['Comment'] as $comment): ?>
<li><?php echo h($comment['body']) ?> by <?php echo h($comment['commenter']); ?></li>
<?php endforeach ; ?>
</ul>

<h2>Add Comment</h2>

<?php
echo $this->Form->create('Comment',array('action'=>'add'));
echo $this->Form->create('commenter');
echo $this->Form->create('body',array('rows'=>3));
echo $this->Form->create('Comment.post_id',array('type'=>'hidden','value'=>$post['Post']['id']));
