<h2>フォローユーザ一覧</h2>

<ul>
<?php foreach ($followUsers as $followUser) : ?>
<li id="followUser_<?php echo h($followUser['FollowUser']['id']); ?>">
<?php
//debug($followUser);
echo $this->Html->link($followUser['User']['username'],'/users/view/'.$followUser['User']['id']);
?> 
</li>
<?php endforeach; ?>
</ul>


