<div class="users index">

		<?php	echo $this->element( 'namebox' );	?>

	<?php
		//Fetching the serial number of the 1st person on the list
		$enumerator = '';
		$enumerator = $this->Paginator->counter(array('format' => __('{:start}')));

	?>
	<h2> <?php echo __('Farmers'); ?> </h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th> S/N </th>
			<th><?php echo $this->Paginator->sort('code'); ?></th>
			<th><?php echo $this->Paginator->sort('title_id'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('mid_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('alias'); ?></th>
			<th><?php echo $this->Paginator->sort('gender_id'); ?></th>
			<th><?php echo $this->Paginator->sort('farmer_group_id'); ?></th>


			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($allFarmers as $user): ?>
	<tr>
		<td><?php echo $enumerator; //h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['code']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Title']['name'], array('controller' => 'titles', 'action' => 'view', $user['Title']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['mid_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['alias']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['gender']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['FarmerGroup']['name'], array('controller' => 'farmer_groups', 'action' => 'view', $user['FarmerGroup']['id'])); ?>
		</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'admin_view', $user['User']['id'])); ?>
		</td>
	</tr>
	<?php $enumerator++; ?>
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
