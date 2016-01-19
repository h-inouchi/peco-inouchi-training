<?php

class CommentsController extends AppController {
    public $helpers = array('Html', 'Form');

    public function add() {
        if ($this->request->is('post')) {
            //Added this line
            $this->request->data['Comment']['user_id'] = $this->Auth->user('id');

            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('Success!');
                $this->redirect(array('controller'=>'posts','action'=>'view',$this->data['Comment']['post_id']));
            } else {
                $this->Session->setFlash('failed!');
            }
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
            
        }

        if ($this->Comment->delete($id)) {
           $this->Session->setFlash('success!');
        }

        $this->redirect(array('controller'=>'posts','action'=>'index'));
    }
    
    public function isAuthorized($user) {
        // 登録済ユーザーは投稿できる
        if ($this->action === 'add') {
            return true;
        }

        // 投稿のオーナーは編集や削除ができる
        if (in_array($this->action, array('edit', 'delete'))) {
            
            $commentId = (int) $this->request->params['pass'][0];
            if ($this->Comment->isOwnedBy($commentId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

}

