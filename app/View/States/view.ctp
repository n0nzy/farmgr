<div class="states view">
<h2><?php  echo __('State'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($state['State']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($state['State']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Buying Stations in this State'); ?></h3>
	<?php if (!empty($state['BuyingStation'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Created On'); ?></th>
		<th><?php echo __('Last Modified On'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		$counter = 1;
		foreach ($state['BuyingStation'] as $buyingStation): ?>
		<tr>
			<td><?php echo $counter; ?></td>
			<td><?php echo $buyingStation['name']; ?></td>
			<td><?php echo $buyingStation['description']; ?></td>
			<td><?php echo $this->Time->format('F jS, Y | h:i:s a', $buyingStation['created']); ?></td>
			<td><?php echo $this->Time->format('F jS, Y | h:i:s a', $buyingStation['modified']);  ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'buying_stations', 'action' => 'view', $buyingStation['id'])); ?>
				<?php echo $this->Html->link(__('Update'), array('controller' => 'buying_stations', 'action' => 'edit', $buyingStation['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'buying_stations', 'action' => 'delete', $buyingStation['id']), null, __('Are you sure you want to delete # %s?', $buyingStation['id'])); ?>
			</td>
		</tr>
	<?php $counter++; ?>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
