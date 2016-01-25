<?php

App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    //public $hasOne = "Post";
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule'     => 'email',
                'required' => true,
                'message' => 'An email is required'
            )
        ),
        'password' => array(
            'required' => array(
                //2.7系以降だと、notEmptyではなくnotBlank推奨。
                'rule' => 'notEmpty',
                'message' => 'A password is required'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    public function getFriendStateStatus($loginUserId, $friendUserId){
        $sql = "SELECT
                    `User`.*,
                    `FriendState`.*
                FROM
                    `users` AS `User`
                LEFT JOIN
                    `friend_states` AS `FriendState`
                ON (`User`.`id` = `FriendState`.`user_id`)
                AND (:friendUserId = `FriendState`.`friend_user_id`)
                WHERE
                    `User`.`id` = :userId;";

        $params = array(
            'userId'=> $loginUserId,
            'friendUserId'=> $friendUserId
        );
 
        $data = $this->query($sql,$params);
        return $data;
    }

}