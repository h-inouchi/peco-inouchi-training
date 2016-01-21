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

}
