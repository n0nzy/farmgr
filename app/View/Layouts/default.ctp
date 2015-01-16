<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$appDescription = __d('FarmMgr', 'Farm Manager: The Farm Management Web App');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $appDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap');
		//echo $this->Html->css('bootstrap.min');
		echo $this->Html->script('jquery-1.7.2.min.js'); // This MUST go before bootstrap.min.js
		echo $this->Html->script('bootstrap.min.js');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body style="padding-top:45px">
	<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Cocoa Farmers Manager</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
            </ul>
          </div><!--/.nav-collapse -->
		<ul class="nav">
		  <li class="dropdown">
		    <a href="#"	class="dropdown-toggle" data-toggle="dropdown"> Account	<b class="caret"></b> </a>
		    <ul class="dropdown-menu">
				<!-- <li><a href="#">View Profile</a></li> 
				<li class="divider"></li> -->
				<li> <?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
		    </ul>
		  </li>
		  <li class="dropdown">
		    <a href="#"	class="dropdown-toggle" data-toggle="dropdown"> Farmers <b class="caret"></b></a>
		    <ul class="dropdown-menu">
				<li> <?php echo $this->Html->link(__('Farmers >> Add'),  array('controller' => 'farmers', 'action' => 'add'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmers >> List'), array('controller' => 'farmers', 'action' => 'index')); ?> </li>
		    </ul>
		  </li>
		  <li class="dropdown">
		    <a href="#"	class="dropdown-toggle" data-toggle="dropdown"> Info Entry <b class="caret"></b></a>
		    <ul class="dropdown-menu">
				<li> <?php echo $this->Html->link(__('Farmers >> Enter Farm Produce'),			array('controller' => 'farmers', 'action' => 'entered'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmers >> Update/Delete Farm Produce'),	array('controller' => 'productions', 'action' => 'index')); ?> </li>
				<li class="divider"></li>
				<li> <?php echo $this->Html->link(__('Farmers >> Enter Inspection Info'),			array('controller' => 'productions', 'action' => 'toinspect'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmers >> Update/Delete Inspection Info'),	array('controller' => 'inspections', 'action' => 'index')); ?> </li>
		    </ul>
		  </li>
		  <li class="dropdown">
		    <a href="#"	class="dropdown-toggle" data-toggle="dropdown"> Information <b class="caret"></b></a>
			<ul class="dropdown-menu">
				<li> <?php echo $this->Html->link(__('Farmer Groups >> List'),			array('controller' => 'farmer_groups', 'action' => 'index'));  ?> </li>
		    </ul>
		  </li>
		</ul>
        </div>
      </div>
    </div>
	<div id="container">

		<div id="content">
			            
                        <?php if (AuthComponent::user('BuyingStation')): 
                            $buyingStation = AuthComponent::user('BuyingStation');
                            $buyingStationName = $buyingStation['name']; 
                        ?>
                            <div class="pull-right title-box"> [Buying Station: <?php echo $buyingStationName; ?> ] </div>
                        <?php endif; ?>
                        
                        <?php if (AuthComponent::user('id')): ?>                            
                            <div id="name-box" class="navbar-text pull-right"> [Logged in: <?= AuthComponent::user('name') ?>] </div>
                        <?php endif; ?>

			<?php echo $this->Session->flash(); ?>
			<?php echo $this->Session->flash('auth'); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

			Copyright

		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
