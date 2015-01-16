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
				
		echo $this->Html->script('jquery-1.8.3.min.js'); // This MUST go before bootstrap.min.js
		echo $this->Html->script('bootstrap.min.js');   // Bootstrap js file -> depends on jquery
                echo $this->Html->script('bootstrap-datepicker.js');  //Bootstrap datepicker plugin -> depends on datepicker

                //echo $this->Html->css('bootstrap.min');  // overridden by bootstrap.admin.css
                echo $this->Html->css('bootstrap.admin');
		echo $this->Html->css('cake.generic.admin');
                echo $this->Html->css('cake.custom.admin');  //my own added customization to the look of the admin section
                echo $this->Html->css('datepicker');
                echo $this->Html->css('datepicker3');

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
		    <a href="#"	class="dropdown-toggle" data-toggle="dropdown">Account	<b class="caret"></b> </a>
		    <ul class="dropdown-menu">
<!--				<li><a href="#">Preferences</a></li>
				<li><a href="#">Security</a></li>
				<li class="divider"></li>-->

				<li> <?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
		    </ul>
		  </li>
		  <li class="dropdown">
		    <a href="#"	class="dropdown-toggle" data-toggle="dropdown"> Users <b class="caret"></b></a>
		    <ul class="dropdown-menu">
				<li> <?php echo $this->Html->link(__('Farmers >> List'), array('controller' => 'farmers', 'action' => 'index')); ?> </li>
				<li class="divider"></li>
				<li> <?php echo $this->Html->link(__('Field Officers >> Add'),  array('controller' => 'fieldOfficers', 'action' => 'add'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Field Officers >> List'), array('controller' => 'fieldOfficers', 'action' => 'index')); ?> </li>
		    </ul>
		  </li>
		  <li class="dropdown">
			<a href="#"	class="dropdown-toggle" data-toggle="dropdown"> Config <b class="caret"></b></a>
		    <ul class="dropdown-menu">
				<li> <?php echo $this->Html->link(__('Farmer Group >> Add'),  array('controller' => 'farmer_groups', 'action' => 'add'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmer Group >> List'), array('controller' => 'farmer_groups', 'action' => 'admin_index')); ?> </li>
				<li class="divider"></li>
				<li> <?php echo $this->Html->link(__('Buying Station >> Add'),  array('controller' => 'buying_stations', 'action' => 'add'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Buying Station >> List'), array('controller' => 'buying_stations', 'action' => 'index')); ?> </li>
				<li class="divider"></li>
				<li> <?php echo $this->Html->link(__('User Titles >> Add'),  array('controller' => 'titles', 'action' => 'add'));  ?> </li>
				<li> <?php echo $this->Html->link(__('User Titles >> List'), array('controller' => 'titles', 'action' => 'index')); ?> </li>
		    </ul>
		  </li>
		  <li class="dropdown">
		    <a href="#"	class="dropdown-toggle" data-toggle="dropdown"> Reports <b class="caret"></b></a>
		    <ul class="dropdown-menu">
				<li> <?php echo $this->Html->link(__('Farmers >> Farmer Registry'),  array('controller' => 'inspections', 'action' => 'registry'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmers >> Latest Inspection Status'), array('controller' => 'inspections', 'action' => 'current_each')); ?> </li>
				<li> <?php echo $this->Html->link(__('Farmers >> Farmer Groups'),  array('controller' => 'farmers', 'action' => 'report_by_group'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmers >> Farmer Groups(Simple)'),  array('controller' => 'farmer_groups', 'action' => 'report_farmers'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmers >> Field  Officers'),  array('controller' => 'farmers', 'action' => 'report_by_officer'));  ?> </li>
				<li class="divider"></li>
				<li> <?php echo $this->Html->link(__('Field Officers >> Buying Stations'),  array('controller' => 'field_officers', 'action' => 'report_by_station'));  ?> </li>
				<li class="divider"></li>
				<li> <?php echo $this->Html->link(__('Buying Stations >> States'),  array('controller' => 'buying_stations', 'action' => 'report_by_state'));  ?> </li>
				<li class="divider"></li>
				<li> <?php echo $this->Html->link(__('Farmer Groups >> Buying Station'),  array('controller' => 'farmer_groups', 'action' => 'report_by_station'));  ?> </li>
				<li> <?php echo $this->Html->link(__('Farmer Groups >> Farmers'),  array('controller' => 'farmer_groups', 'action' => 'report_farmers'));  ?> </li>
				<!-- <li> <?php echo $this->Html->link(__('Farmer Groups >> By State'), array('controller' => 'farmer_groups', 'action' => 'admin_index')); ?> </li> -->
		    </ul>
		  </li>
		</ul>
        </div>
      </div>
    </div>
	<div id="container">       

		<div id="content">                                      
    
                <?php if (AuthComponent::user('id')): ?>
                    <p class="navbar-text pull-right"> Logged in as: [ <a href="#" class="navbar-link"><?= AuthComponent::user('name') ?></a> ] </p>
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
