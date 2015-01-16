<?php
		//Fetching the serial number of the 1st person on the list
		$enumerator = '';
		$enumerator = $this->Paginator->counter(array('format' => __('{:start}')));


?>
<div class="productions index">
	<h2><?php echo __('Farmer\'s Produce'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th> S/N </th>
			<th><?php echo $this->Paginator->sort('user_id', 'Farmer'); ?></th>
			<th><?php echo $this->Paginator->sort('product_id'); ?></th>
			<th><?php echo $this->Paginator->sort('land_area', 'Total Land Area (Hectares)'); ?></th>
			<th><?php echo $this->Paginator->sort('production_area_size' , 'Production Area Size (Hectares)'); ?></th>
			<th><?php echo $this->Paginator->sort('yield', 'Yield (Kg/Hectare)'); ?></th>
			<th> Estimated Production (Kg) </th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($productions as $production): ?>
	<?php //print_r($production); ?>
	<tr>
		<td><?php echo h($enumerator); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($production['User']['full_name'], array('controller' => 'farmers', 'action' => 'view', $production['User']['id'])); ?>
		</td>
		<td>
                        <?php echo h($production['Product']['name']); ?>&nbsp;</td>
			
		</td>
		<td><?php echo h($production['Production']['land_area']); ?>&nbsp;</td>
		<td><?php echo h($production['Production']['production_area_size']); ?>&nbsp;</td>
		<td><?php echo h($production['Production']['yield']); ?>&nbsp;</td>
		<td><?php echo h($production['Production']['yield'] * $production['Production']['production_area_size']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $production['Production']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $production['Production']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $production['Production']['id']), null, __('Are you sure you want to delete the farm produce for Farmer: %s?', $production['User']['full_name'])); ?>
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