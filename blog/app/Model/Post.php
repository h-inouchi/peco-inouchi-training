<?php

class Post extends AppModel {
	public $hasMany = "Comment";
	public $belongsTo = "User";
	
	public function getData($id){
		$sql = "SELECT
					`Post`.*,
					`User`.*
				FROM
					`posts` AS `Post`
				LEFT JOIN
					`users` AS `User`
				ON (`Post`.`user_id` = `User`.`id`)
				WHERE
					EXISTS (SELECT *
							FROM
								follow_users
							WHERE
								`Post`.`user_id` = follow_users.follow_user_id
							AND follow_users.user_id = :id);";

        $params = array(
            'id'=> $id
        );
 
        $data = $this->query($sql,$params);
        return $data;
    }

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