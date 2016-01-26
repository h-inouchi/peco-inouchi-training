<h2>フレンド承認依頼一覧</h2>
<ul>
<?php foreach ($friendStates as $friendState) : ?>
<li id="friendState_<?php echo h($friendState['FriendState']['id']); ?>">
<?php
echo $friendState['FriendUser']['username'];
echo 'さんからの承認依頼　';
echo $this->Form->postLink('承認',array('controller'=>'friendStates','action'=>'approve', $friendState['FriendUser']['id']));
echo '　';
echo $this->Form->postLink('却下',array('controller'=>'friendStates','action'=>'reject', $friendState['FriendUser']['id']));
?> 
</li>
<?php endforeach; ?>
</ul>


