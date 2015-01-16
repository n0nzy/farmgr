<?php $this->layout = 'admin'; ?>
<div class="farmerGroups index">
	<h2><?php echo __('Farmer Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id', 'S/N'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('buying_station_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Added on'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Last modified on'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	$counter = 1;
	foreach ($farmerGroups as $farmerGroup): ?>
	<tr>
		<td><?php echo h($counter); ?>&nbsp;</td>
		<td><?php echo h($farmerGroup['FarmerGroup']['name']); ?>&nbsp;</td>
		<td><?php echo h($farmerGroup['FarmerGroup']['description']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($farmerGroup['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $farmerGroup['BuyingStation']['id'])); ?>
		</td>
		<td><?php echo h( $this->Time->format('F jS, Y | h:i:s a', $farmerGroup['FarmerGroup']['created']) ); ?>&nbsp;</td>
		<td><?php echo h( $this->Time->format('F jS, Y | h:i:s a', $farmerGroup['FarmerGroup']['modified']) ); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'admin_view', $farmerGroup['FarmerGroup']['id'])); ?>
			<?php echo $this->Html->link(__('Update'), array('action' => 'edit', $farmerGroup['FarmerGroup']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $farmerGroup['FarmerGroup']['id']), null, __('Are you sure you want to delete Farmer Group: %s?', $farmerGroup['FarmerGroup']['name'])); ?>
		</td>
	</tr>
<?php $counter++; ?>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>