<?php

class FollowUsersController extends AppController {
    public $helpers = array('Html', 'Form');

    public function add($id = null) {

        $followUser = $this->FollowUser->find(
            'all',
            array(
                'conditions' => array(
                    'user_id' => $this->Auth->user('id'),
                    'follow_user_id' => $id
                )
            )
        );

        if ($this->request->is('post')) {
            $this->request->data['FollowUser']['id'] = $followUser[0]['FollowUser']['id'];
            $this->request->data['FollowUser']['user_id'] = $this->Auth->user('id');
            $this->request->data['FollowUser']['follow_user_id'] = $id;

            if ($this->FollowUser->save($this->request->data)) {
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
        // ログインしていればフォローできる、フォローユーザー一覧を表示できる
        if ($this->Auth->loggedIn()) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}

