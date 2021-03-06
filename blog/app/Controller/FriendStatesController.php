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

    public function approve($id = null) {

        if ($this->request->is('post')) {
            if ($this->FriendState->updateFriendStateApproved($this->Auth->user('id'), $id)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('controller'=>'friendStates','action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }

    public function reject($id = null) {
        $friendState = $this->FriendState->find(
            'all',
            array(
                'conditions' => array(
                    'user_id' => $id,
                    'friend_user_id' => $this->Auth->user('id')
                )
            )
        );

        if ($this->request->is('post')) {
            $state_status = Configure::read("friend_state_status");
            $this->request->data['FriendState']['id'] = $friendState[0]['FriendState']['id'];
            $this->request->data['FriendState']['status'] = $state_status["REJECTED"];

            if ($this->FriendState->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('controller'=>'friendStates','action'=>'index'));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }

    public function index() {
        $data = $this->FriendState->getFriends(
                                        $this->Auth->user('id')
                                        );
        $this->set('friends', $data);
        $this->set('title_for_layout', 'フレンド一覧');

    }

    public function friendStateIndex() {
        $data = $this->FriendState->getFriendStateIndexes(
                                        $this->Auth->user('id')
                                        );
        $this->set('friendStates', $data);
        $this->set('title_for_layout', 'フレンド承認依頼一覧');
    }

    public function isAuthorized($user) {
        // ログインしていれば申請できる、フレンド一覧を表示できる
        if ($this->Auth->loggedIn()) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}

