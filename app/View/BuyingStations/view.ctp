<div class="buyingStations view">
<h2><?php  echo __('Buying Station Details'); ?></h2>
		<?php //echo $this->Html->link(__('Edit Buying Station'), array('action' => 'edit', $buyingStation['BuyingStation']['id'])); ?>
		<?php //echo $this->Form->postLink(__('Delete Buying Station'), array('action' => 'delete', $buyingStation['BuyingStation']['id']), null, __('Are you sure you want to delete # %s?', $buyingStation['BuyingStation']['id'])); ?>
		<?php //echo $this->Html->link(__('List Buying Stations'), array('action' => 'index')); ?>
		<?php //var_dump($buyingStation); ?>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($buyingStation['BuyingStation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($buyingStation['BuyingStation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($buyingStation['BuyingStation']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('State'); ?></dt>
		<dd>
			<?php echo $this->Html->link($buyingStation['State']['name'], array('controller' => 'states', 'action' => 'view', $buyingStation['State']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number of Farmer Groups'); ?></dt>
		<dd>
			<?php echo h($farmerGroupNum); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Number of Farmers'); ?></dt>
		<dd>
			<?php echo h($farmersNum); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Hectorage'); ?></dt>
		<dd>
			<?php echo h($total_land_area); ?> Hectares
			&nbsp;
		</dd>
		<dt><?php echo __('Total Expected Production'); ?></dt>
		<dd>
			<?php echo h($total_production_estimate); ?> Kg
			&nbsp;
		</dd>
		<dt><?php echo __('Information Entered On'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y | h:i:s a', $buyingStation['BuyingStation']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified On'); ?></dt>
		<dd>
			<?php echo h( $this->Time->format('F jS, Y | h:i:s a', $buyingStation['BuyingStation']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="related">
	<h3><?php echo __('Farmer Groups Under this Buying Station'); ?></h3>
	<?php if (!empty($buyingStation['FarmerGroup'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Entered On'); ?></th>
		<th><?php echo __('Last Modified On'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($buyingStation['FarmerGroup'] as $farmerGroup): ?>
		<tr>
			<td><?php echo $farmerGroup['id']; ?></td>
			<td><?php echo $farmerGroup['name']; ?></td>
			<td><?php echo $farmerGroup['description']; ?></td>
			<td><?php echo $this->Time->format('F jS, Y | h:i:s a', $farmerGroup['created']) ?></td>
			<td><?php echo $this->Time->format('F jS, Y | h:i:s a', $farmerGroup['modified'])  ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'farmer_groups', 'action' => 'admin_view', $farmerGroup['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'farmer_groups', 'action' => 'edit', $farmerGroup['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'farmer_groups', 'action' => 'delete', $farmerGroup['id']), null, __('Are you sure you want to delete Farmer Group: %s?', $farmerGroup['name'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<!--	<div class="actions">
		<ul>
			<li><?php //echo $this->Html->link(__('New Farmer Group'), array('controller' => 'farmer_groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>-->
</div>
<div class="related">
	<h3><?php echo __('Field Officers in this Buying Station'); ?></h3>
	<?php if (!empty($buyingStation['FieldOfficer'])): ?>

	<?php //print_r($buyingStation['FieldOfficer']); ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>

		<th><?php echo __('First Name'); ?></th>

		<th><?php echo __('Gender'); ?></th>

		<th><?php echo __('Email'); ?></th>

		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$enumerator = 1;
		foreach ($buyingStation['FieldOfficer'] as $user): ?>
		<tr>
			<td><?php echo $enumerator; //$user['id']; ?></td>

			<td><?php echo $user['full_name']; ?></td>

			<td><?php echo $user['gender']; ?></td>

			<td><?php echo $user['email']; ?></td>

			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'fieldOfficers', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'fieldOfficers', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'fieldOfficers', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete this Field Officer %s?', $user['full_name'] )); ?>
			</td>
		</tr>
		<?php $enumerator++; ?>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>