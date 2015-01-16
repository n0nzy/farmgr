<div class="products view">
<h2><?php  echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($product['Product']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($product['Product']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product'), array('action' => 'edit', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Product'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inspections'), array('controller' => 'inspections', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inspection'), array('controller' => 'inspections', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Productions'), array('controller' => 'productions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Production'), array('controller' => 'productions', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Inspections'); ?></h3>
	<?php if (!empty($product['Inspection'])): ?>
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
		foreach ($product['Inspection'] as $inspection): ?>
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

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inspection'), array('controller' => 'inspections', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Productions'); ?></h3>
	<?php if (!empty($product['Production'])): ?>
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
		foreach ($product['Production'] as $production): ?>
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
