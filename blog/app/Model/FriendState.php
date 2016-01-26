<?php

class FriendState extends AppModel {
	public function getFriends($loginUserId){
		$state_status = Configure::read("friend_state_status");
        $sql = "SELECT
                    `FriendState`.*,
                    `FriendUser`.*
                FROM
                    `friend_states` AS `FriendState`
                LEFT JOIN
                    `users` AS `FriendUser`
                ON (`FriendUser`.`id` = `FriendState`.`friend_user_id`)
                WHERE
                	`FriendState`.`user_id` = :userId
                AND `FriendState`.`status` = :status;";

        $params = array(
            'userId'=> $loginUserId,
            'status'=> $state_status["APPROVED"]
        );
 
        $data = $this->query($sql,$params);
        return $data;
    }
}