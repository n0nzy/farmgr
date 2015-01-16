<?php $this->layout = 'admin'; ?>
<div class="users view">
<h2><?php  echo __('Field Officer: View Information'); ?></h2>

		<?php //echo $this->Html->link(__('Edit FieldOfficer'), array('action' => 'edit', $fieldOfficer['FieldOfficer']['id'])); ?>
		<?php //echo $this->Form->postLink(__('Delete FieldOfficer'), array('action' => 'delete', $fieldOfficer['FieldOfficer']['id']), null, __('Are you sure you want to delete # %s?', $fieldOfficer['FieldOfficer']['id'])); ?>

	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd>
			<?php echo h($fieldOfficer['FieldOfficer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($fieldOfficer['FieldOfficer']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Middle Name'); ?></dt>
		<dd>
			<?php echo h($fieldOfficer['FieldOfficer']['mid_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($fieldOfficer['FieldOfficer']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($fieldOfficer['FieldOfficer']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($fieldOfficer['FieldOfficer']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($fieldOfficer['FieldOfficer']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buying Station'); ?></dt>
		<dd>
			<?php echo $this->Html->link($fieldOfficer['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $fieldOfficer['BuyingStation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Numbers of Farmers entered'); ?></dt>
		<dd>
			<?php echo h($farmersNum); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Created On'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y | h:i:s a', $fieldOfficer['FieldOfficer']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Account Last Modified On'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y | h:i:s a', $fieldOfficer['FieldOfficer']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>