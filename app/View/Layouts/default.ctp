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

$voyage = ( 'Voyage Étudiant');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
    
	<title>
		<?php echo $voyage ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($voyage, array('controller' => 'usersInformations', 'action' => 'index')); ?>
                       
                        <div class="collapse navbar-right navbar-right">
                        <ul class="nav navbar-right">
			<li class="active">
			<?php 
			if ($this->Session->check('Auth.User')){
			$username = $this->Session->read('Auth.User.username');
			$userid = $this->Session->read('Auth.User.id');
			$userrole = $this->Session->read('Auth.User.role');
                        
                         
			echo 'Bonjours ' . $username;
			echo '</li><li>';
			echo $this->Html->link(__('Déconnexion'), array('controller' => 'users', 'action' => 'logout'));
                        
			}
			else{
			echo $this->Html->link(__('Connection'), array('controller' => 'users', 'action' => 'login'));
			echo '</li><li>';
			echo $this->Html->link(__('Inscription'), array('controller' => 'usersInformations', 'action' => 'add'));
			}
			?>
			</li>
			
			
		</ul><!-- /.nav navbar-nav -->
	</div><!-- /.navbar-collapse -->
                        </h1>
		</div>
            
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $voyage, 'border' => '0')),
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
</body>
</html>
