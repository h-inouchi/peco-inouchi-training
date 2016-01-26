<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $helpers = array('Html', 'Form');

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('add');

        // ユーザー自身による登録とログアウトを許可する
        $this->Auth->allow('add','logout');
    }

    public function login() {
        $this->Session->delete('Auth.redirect');
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            } else {
                //$this->Flash->error(__('Invalid username or password, try again'));
                $this->Session->setFlash('Invalid username or password, try again');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                //$this->Session->setFlash('Success!');
                $this->Session->setFlash('Success!');
                //$this->redirect(array('action'=>'index'));
                $this->redirect(array('controller'=>'posts','action'=>'index'));
            } else {
                //$this->Session->setFlash('failed!');
                $this->Session->setFlash('failed!');
            }
        }
    }

    public function index() {
        $this->set('users', $this->User->find('all'));
        $this->set('title_for_layout', 'ユーザ一覧');
    }
    public function profile($id = null) {
        $data = $this->User->getFriendStateStatus(
                                    $this->Auth->user('id'),
                                    $id);
        $this->set('user', $data);
        $this->set('title_for_layout', 'ユーザプロフィール');

    }

    public function isAuthorized($user) {
        // ログインしていれば
        if ($this->Auth->loggedIn()) {
            if (in_array($this->action, array('profile'))) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
