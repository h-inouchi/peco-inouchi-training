<?php

class Post extends AppModel {
	public $hasMany = "Comment";
	public $belongsTo = "User";
	public $validate = array(
		'title' => array(
				'rule' => 'notEmpty',
				'message' => '空じゃだめだし'
			),
		'body' => array(
				'rule' => 'notEmpty'
			)
	);

	public function isOwnedBy($post, $user) {
	    return $this->field('id', array('id' => $post, 'user_id' => $user)) !== false;
	}
}