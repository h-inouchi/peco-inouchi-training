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

    public function getFriendStateIndexes($loginUserId){
        $state_status = Configure::read("friend_state_status");
        $sql = "SELECT
                    `FriendState`.*,
                    `FriendUser`.*,
                    `LoginUser`.*
                FROM
                    `friend_states` AS `FriendState`
                LEFT JOIN
                    `users` AS `LoginUser`
                ON (`LoginUser`.`id` = `FriendState`.`friend_user_id`)
                LEFT JOIN
                    `users` AS `FriendUser`
                ON (`FriendUser`.`id` = `FriendState`.`user_id`)
                WHERE
                    `FriendState`.`friend_user_id` = :userId
                AND `FriendState`.`status` = :status;";

        $params = array(
            'userId'=> $loginUserId,
            'status'=> $state_status["WAITING"]
        );
 
        $data = $this->query($sql,$params);
        return $data;
    }

    public function updateFriendStateApproved($loginUserId = null, $frienUserId = null){
        $state_status = Configure::read("friend_state_status");
        $datasource = $this->getDataSource();
        try{
            $datasource->begin();

            // １件目　通常承認のレコードを UPDATE
            $friendState = $this->find(
                'all',
                array(
                    'conditions' => array(
                        'user_id' => $frienUserId,
                        'friend_user_id' => $loginUserId
                    )
                )
            );

            $data = array(
                'FriendState' => array(
                    'id' => $friendState[0]['FriendState']['id'],
                    'status' => $state_status["APPROVED"]
                ));

            if ($this->save($data)) {
            } else {
                throw new Exception();
            }

            // ２件目　逆方向の承認レコード作成
            $friendState = $this->find(
                'all',
                array(
                    'conditions' => array(
                        'user_id' => $loginUserId,
                        'friend_user_id' => $frienUserId
                    )
                )
            );

            if(empty($friendState)){
                $friendStateId = null;
            } else {
                $friendStateId = $friendState[0]['FriendState']['id'];                
            }

            $data = array(
                'FriendState' => array(
                    'id' => $friendStateId,
                    'user_id' => $loginUserId,
                    'friend_user_id' => $frienUserId,
                    'status' => $state_status["APPROVED"]
                ));

            if ($this->save($data)) {
            } else {
                throw new Exception();
            }

            $datasource->commit();

            return true;
            
        } catch(Exception $e) {
            $datasource->rollback();
        }
    }
    
}