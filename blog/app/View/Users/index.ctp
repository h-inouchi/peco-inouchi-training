<h2>ユーザ一覧</h2>

<ul>
<?php foreach ($users as $user) : ?>
<li id="user_<?php echo h($user['User']['id']); ?>">
<?php
//debug($user);
echo $this->Html->link($user['User']['username'],'/users/view/'.$user['User']['id']);
?> 
</li>
<?php endforeach; ?>
</ul>


