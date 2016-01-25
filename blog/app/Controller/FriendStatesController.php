<?php

class FriendStatesController extends AppController {
    public $helpers = array('Html', 'Form');

    public function add($id = null) {

        $friendState = $this->FriendState->find(
            'all',
            array(
                'conditions' => array(
                    'user_id' => $this->Auth->user('id'),
                    'friend_user_id' => $id
                )
            )
        );

        if ($this->request->is('post')) {
            $state_status = Configure::read("friend_state_status");
            $this->request->data['FriendState']['id'] = $friendState[0]['FriendState']['id'];
            $this->request->data['FriendState']['user_id'] = $this->Auth->user('id');
            $this->request->data['FriendState']['friend_user_id'] = $id;
            $this->request->data['FriendState']['status'] = $state_status["WAITING"];

            if ($this->FriendState->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('controller'=>'users','action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }

    public function index() {
        //$this->FollowUser->userId = $id;
        //$this->set('followUsers', $this->FollowUser->find('all'));

        $this->set('followUsers', $this->FollowUser->find('all',
            array('conditions' => array('user_id' => $this->Auth->user('id')))));

    }

    public function isAuthorized($user) {
        // ログインしていれば申請できる、フレンド一覧を表示できる
        if ($this->Auth->loggedIn()) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}

