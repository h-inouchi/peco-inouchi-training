<h2><?php echo h($user['User']['username']); ?> のプロフィール</h2>

<?php
    echo $this->Form->postLink('フォロー', array('controller'=>'followUsers','action'=>'add', $user['User']['id']), array('confirm'=>'フォローしますか?'));
?>
