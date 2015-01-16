<?php $this->layout = 'admin'; ?>
<div class="farmerGroups view">
<h2><?php  echo __('Farmer Group Details'); ?></h2>
<!--		<li><?php //echo $this->Html->link(__('Edit Farmer Group'), array('action' => 'edit', $farmerGroup['FarmerGroup']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Farmer Group'), array('action' => 'delete', $farmerGroup['FarmerGroup']['id']), null, __('Are you sure you want to delete # %s?', $farmerGroup['FarmerGroup']['id'])); ?> </li>
		<li><?php //echo $this->Html->link(__('List Farmer Groups'), array('action' => 'index')); ?> </li>-->

	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($farmerGroup['FarmerGroup']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($farmerGroup['FarmerGroup']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($farmerGroup['FarmerGroup']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Buying Station'); ?></dt>
		<dd>
			<?php echo $this->Html->link($farmerGroup['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $farmerGroup['BuyingStation']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Number of Farmers'); ?></dt>
		<dd>
			<?php echo h($farmersNum); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created On'); ?></dt>
		<dd>
			<?php echo h( $this->Time->format('F jS, Y | h:i:s a', $farmerGroup['FarmerGroup']['created']) ); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified On'); ?></dt>
		<dd>
			<?php echo h( $this->Time->format('F jS, Y | h:i:s a', $farmerGroup['FarmerGroup']['modified']) ); ?>
			&nbsp;
		</dd>
	</dl>
</div>


<?php if (!empty($farmerGroup['Farmer'])): ?>
<div class="related">
	<h3><?php echo __('Farmers in this Farmer Group'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Farmer Code'); ?></th>
		<th><?php echo __('Full Name'); ?></th>
		<th><?php echo __('Alias'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		$counter = 1;
		foreach ($farmerGroup['Farmer'] as $user): ?>
		<tr>
			<td><?php echo $counter; ?></td>
			<td><?php echo $user['code']; ?></td>
			<td><?php echo $user['full_name']; ?></td>
			<td><?php echo $user['alias']; ?></td>
			<td><?php echo $user['gender']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'farmers', 'action' => 'admin_view', $user['id'])); ?>
			</td>
		</tr>
	<?php $counter++; ?>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
