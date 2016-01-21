<?php
echo 'Please enter your username(email) and password';
echo $this->Form->create('User');
echo $this->Form->input('username',array('label'=>array('text'=>'email')));
echo $this->Form->input('password');
echo $this->Form->end('Login');
