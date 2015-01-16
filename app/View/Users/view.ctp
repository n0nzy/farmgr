<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
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
		<dt><?php echo __('Mid Name'); ?></dt>
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
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['User']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['UserCategory']['name'], array('controller' => 'user_categories', 'action' => 'view', $user['UserCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Farmer Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['FarmerGroup']['name'], array('controller' => 'farmer_groups', 'action' => 'view', $user['FarmerGroup']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buying Station'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $user['BuyingStation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entered By'); ?></dt>
		<dd>
			<?php echo h($user['User']['entered_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('Related Inspections'); ?></h3>
	<?php if (!empty($user['Inspection'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Date Inspected'); ?></th>
		<th><?php echo __('Start Time'); ?></th>
		<th><?php echo __('End Time'); ?></th>
		<th><?php echo __('Inspector Id'); ?></th>
		<th><?php echo __('Utz Status'); ?></th>
		<th><?php echo __('Compliance Year'); ?></th>
		<th><?php echo __('Entered By'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Inspection'] as $inspection): ?>
		<tr>
			<td><?php echo $inspection['id']; ?></td>
			<td><?php echo $inspection['user_id']; ?></td>
			<td><?php echo $inspection['product_id']; ?></td>
			<td><?php echo $inspection['date_inspected']; ?></td>
			<td><?php echo $inspection['start_time']; ?></td>
			<td><?php echo $inspection['end_time']; ?></td>
			<td><?php echo $inspection['inspector_id']; ?></td>
			<td><?php echo $inspection['utz_status']; ?></td>
			<td><?php echo $inspection['compliance_year']; ?></td>
			<td><?php echo $inspection['entered_by']; ?></td>
			<td><?php echo $inspection['created']; ?></td>
			<td><?php echo $inspection['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'inspections', 'action' => 'view', $inspection['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'inspections', 'action' => 'edit', $inspection['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'inspections', 'action' => 'delete', $inspection['id']), null, __('Are you sure you want to delete # %s?', $inspection['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
<div class="related">
	<h3><?php echo __('Related Productions'); ?></h3>
	<?php if (!empty($user['Production'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Land Area'); ?></th>
		<th><?php echo __('Production Area Size'); ?></th>
		<th><?php echo __('Estimated Production'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Production'] as $production): ?>
		<tr>
			<td><?php echo $production['id']; ?></td>
			<td><?php echo $production['user_id']; ?></td>
			<td><?php echo $production['product_id']; ?></td>
			<td><?php echo $production['land_area']; ?></td>
			<td><?php echo $production['production_area_size']; ?></td>
			<td><?php echo $production['estimated_production']; ?></td>
			<td><?php echo $production['created']; ?></td>
			<td><?php echo $production['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'productions', 'action' => 'view', $production['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'productions', 'action' => 'edit', $production['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'productions', 'action' => 'delete', $production['id']), null, __('Are you sure you want to delete # %s?', $production['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
