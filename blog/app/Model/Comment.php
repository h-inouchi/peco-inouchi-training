<?php

class Comment extends AppModel {
	public $belongsTo = 'Post';

	public function isOwnedBy($comment, $user) {
	    return $this->field('id', array('id' => $comment, 'user_id' => $user)) !== false;
	}
}