<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link('Home', '/'); ?></h1>
			<h1><?php
			    if($auth->loggedIn())
			    {
			    	echo 'こんにちは、';
			    	echo $auth->user('username');
			    	echo '　さん。　';
			        echo $this->Html->link('ログアウト', '/users/logout/');
			    }else{
			        echo $this->Html->link('ログイン', '/users/login/');
			    }
			?></h1>
			<fieldset>
			<legend><?php if($auth->loggedIn()){ echo 'メニュー'; }?></legend>
			<?php
			if($auth->loggedIn()){
				echo $this->Html->link('ユーザ一覧', array('controller'=>'users','action'=>'index'));
				echo '　　';
				echo $this->Html->link('フォローユーザ一覧', array('controller'=>'followUsers','action'=>'index'));
				echo '　　';
				echo $this->Html->link('フォローユーザの記事一覧', array('controller'=>'posts','action'=>'followPostIndex'));
			}
			?>
			</fieldset>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
<script>
$(function() {
    setTimeout(function() {
        $('#flashMessage').fadeOut("slow");
    }, 800);
});
</script>
</body>
</html>
