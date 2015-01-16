<?php $this->layout = 'admin'; ?>
<div class="FieldOfficers index">
	<h2><?php echo __('Field Officers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('mid_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>

			<th><?php echo $this->Paginator->sort('gender'); ?></th>

			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('buying_station_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($fieldOfficers as $fieldOfficer): ?>
	<tr>
		<td><?php echo h($fieldOfficer['FieldOfficer']['id']); ?>&nbsp;</td>

		<td><?php echo h($fieldOfficer['FieldOfficer']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($fieldOfficer['FieldOfficer']['mid_name']); ?>&nbsp;</td>
		<td><?php echo h($fieldOfficer['FieldOfficer']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($fieldOfficer['FieldOfficer']['gender']); ?>&nbsp;</td>

		<td><?php echo h($fieldOfficer['FieldOfficer']['email']); ?>&nbsp;</td>

		<td>
			<?php echo $this->Html->link($fieldOfficer['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $fieldOfficer['BuyingStation']['id'])); ?>
		</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $fieldOfficer['FieldOfficer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $fieldOfficer['FieldOfficer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $fieldOfficer['FieldOfficer']['id']), null, __('Are you sure you want to delete Field Officer: %s?', $fieldOfficer['FieldOfficer']['first_name'].' '.$fieldOfficer['FieldOfficer']['last_name'])); ?>
		</td>
	</tr>
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