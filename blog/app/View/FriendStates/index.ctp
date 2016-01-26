<h2>フレンド一覧</h2>

<ul>
<?php foreach ($friends as $friend) : ?>
<li id="friend_<?php echo h($friend['FriendState']['id']); ?>">
<?php
echo $this->Form->postLink($friend['FriendUser']['username'],array('controller'=>'users','action'=>'profile', $friend['FriendUser']['id']));
?> 
</li>
<?php endforeach; ?>
</ul>


