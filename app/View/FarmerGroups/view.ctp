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


<?php if (!empty($farmerGroup['User'])): ?>
<div class="related">
	<h3><?php echo __('Farmers in this Farmer Group'); ?></h3>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>

		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Mid Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Alias'); ?></th>
		<th><?php echo __('Gender'); ?></th>


		<th><?php echo __('Entered On'); ?></th>
		<th><?php echo __('Last Modified On'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		$counter = 1;
		foreach ($farmerGroup['User'] as $user): ?>
		<tr>
			<td><?php echo $counter; ?></td>

			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['mid_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['alias']; ?></td>
			<td><?php echo $user['gender']; ?></td>


			<td><?php echo $this->Time->format('F jS, Y | h:i:s a', $user['created']); ?></td>
			<td><?php echo $this->Time->format('F jS, Y | h:i:s a', $user['modified']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'farmers', 'action' => 'admin_view', $user['id'])); ?>
			</td>
		</tr>
	<?php $counter++; ?>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
