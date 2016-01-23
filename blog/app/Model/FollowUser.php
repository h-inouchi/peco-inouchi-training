<?php

class FollowUser extends AppModel {
	public $belongsTo = array('User' => array('foreignKey' => 'follow_user_id'));
}