<h2><?php echo h($user[0]['FriendUser']['username']); ?> のプロフィール</h2>

<?php
	$state_status = Configure::read("friend_state_status");
    if((int)$user[0]['FriendState']['status'] === $state_status["WAITING"])
    {
    	echo '現在、フレンド申請中です。';
    } else if((int)$user[0]['FriendState']['status'] === $state_status["REJECTED"]) {
    	echo 'フレンド申請が却下されました。';
    	echo $this->Form->postLink('再度、フレンド申請する', array('controller'=>'friendStates','action'=>'add', $user[0]['FriendUser']['id']), array('confirm'=>'フレンド申請しますか？'));
    } else if((int)$user[0]['FriendState']['status'] === $state_status["APPROVED"]) {
        echo 'フレンド承認済';
    } else {
    	echo $this->Form->postLink('フレンド申請', array('controller'=>'friendStates','action'=>'add', $user[0]['FriendUser']['id']), array('confirm'=>'フレンド申請しますか？'));
    }
?>
