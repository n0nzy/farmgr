<?php $this->layout = 'admin'; ?>
<?php $entry_person = $user['FieldOfficer']['first_name'].' '.$user['FieldOfficer']['last_name']; ?>
<div class="users view">

	<h2><?php  echo __('Farmer: View Information'); ?></h2>

	<dl>
		<dt><?php echo __('I.D'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Title']['name'], array('controller' => 'titles', 'action' => 'view', $user['Title']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['mid_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($user['User']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Unique Code'); ?></dt>
		<dd>
			<?php echo h($user['User']['code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['User']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Phone Number'); ?></dt>
		<dd>
			<?php echo h($user['User']['phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Farmer Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['FarmerGroup']['name'], array('controller' => 'farmer_groups', 'action' => 'admin_view', $user['FarmerGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buying Station'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $user['BuyingStation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Information was entered by'); ?></dt>
		<dd>
			<?php echo $this->Html->link($entry_person, array('controller' => 'field_officers', 'action' => 'view', $user['User']['entered_by'])); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Information Entered on'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y h:i:s a', $user['User']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Information Last Modified on'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y h:i:s a', $user['User']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //var_dump($user); ?>