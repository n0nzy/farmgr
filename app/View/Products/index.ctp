<div class="products index">
	<h2><?php echo __('Products'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('created', 'Entered On'); ?></th>
			<th><?php echo $this->Paginator->sort('modified', 'Last Modified On'); ?></th>
<!--			<th class="actions"><?php //echo __('Actions'); ?></th>-->
	</tr>
	<?php
	$counter = 1;
	foreach ($products as $product): ?>
	<tr>
		<td><?php echo h($counter); ?>&nbsp;</td>
		<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
		<td><?php echo h( $this->Time->format('F jS, Y | h:i:s a', $product['Product']['created']) ); ?>&nbsp;</td>
		<td><?php echo h( $this->Time->format('F jS, Y | h:i:s a', $product['Product']['modified']) ); ?>&nbsp;</td>
<!--		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), null, __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
		</td>-->
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
