<?php

class FollowUser extends AppModel {
	//public $belongsTo = "User";
	public $belongsTo = array('User' => array('foreignKey' => 'follow_user_id'));
}