<?php
		//Fetching the serial number of the 1st person on the list
		$enumerator = '';
		$enumerator = $this->Paginator->counter(array('format' => __('{:start}')));


?>
<div class="inspections index">
	<h2><?php echo __('Inspection Information on Farm Produce'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th> S/N </th>
			<th><?php echo $this->Paginator->sort('user_id', 'Farmer'); ?></th>
			<th><?php echo $this->Paginator->sort('production_id', 'Land Area'); ?></th>
			<th><?php echo $this->Paginator->sort('date_inspected'); ?></th>
			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
			<th><?php echo $this->Paginator->sort('inspected_by'); ?></th>
			<th><?php echo $this->Paginator->sort('utz_status'); ?></th>
			<th><?php echo $this->Paginator->sort('compliance_year', 'Yr Of Comp'); ?></th>

			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	//Set the indexCounter that will parse through the $farmerNames array and extract the farmer's full_name
	$indexCounter = 0;
	foreach ($inspections as $inspection):
		//print_r($inspection); echo '<hr />';
		//$farmerName = $farmerNames[$indexCounter]['User']['full_name'];
	?>
	<tr>
		<td><?php echo h($enumerator); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inspection['User']['full_name'], array('controller' => 'farmers', 'action' => 'view', $inspection['Production']['user_id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($inspection['Production']['land_area'], array('controller' => 'productions', 'action' => 'view', $inspection['Production']['id'])); ?>
		</td>
		<td><?php echo h( $this->Time->format('M jS, Y', $inspection['Inspection']['date_inspected']) ); ?>&nbsp;</td>
		<td><?php echo h( $this->Time->format('h:i a', $inspection['Inspection']['start_time']) ); ?>&nbsp;</td>
		<td><?php echo h( $this->Time->format('h:i a', $inspection['Inspection']['end_time']) ); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspector']['full_name']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspection']['utz_status']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspection']['compliance_year']); ?>&nbsp;</td>

		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $inspection['Inspection']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $inspection['Inspection']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $inspection['Inspection']['id']), null, __('Are you sure you want to delete this Farmer\'s Inspection Info?')); ?>
		</td>
	</tr>
<?php $indexCounter++; ?>
<?php $enumerator++; ?>
<?php endforeach; ?>
	</table>

	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div><!-- paging -->
</div>
<!--<div class="actions">
	<h3><?php //echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('List Farmers'), array('controller' => 'farmers', 'action' => 'index')); ?> </li>
	</ul>
</div>-->
