<div class="userCategories view">
<h2><?php  echo __('User Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($userCategory['UserCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($userCategory['UserCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($userCategory['UserCategory']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($userCategory['UserCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($userCategory['UserCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User Category'), array('action' => 'edit', $userCategory['UserCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User Category'), array('action' => 'delete', $userCategory['UserCategory']['id']), null, __('Are you sure you want to delete # %s?', $userCategory['UserCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List User Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Users'); ?></h3>
	<?php if (!empty($userCategory['User'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title Id'); ?></th>
		<th><?php echo __('First Name'); ?></th>
		<th><?php echo __('Mid Name'); ?></th>
		<th><?php echo __('Last Name'); ?></th>
		<th><?php echo __('Alias'); ?></th>
		<th><?php echo __('Gender'); ?></th>
		<th><?php echo __('User Category Id'); ?></th>
		<th><?php echo __('Farmer Group Id'); ?></th>
		<th><?php echo __('Buying Station Id'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Username'); ?></th>
		<th><?php echo __('Password'); ?></th>
		<th><?php echo __('Entered By'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($userCategory['User'] as $user): ?>
		<tr>
			<td><?php echo $user['id']; ?></td>
			<td><?php echo $user['title_id']; ?></td>
			<td><?php echo $user['first_name']; ?></td>
			<td><?php echo $user['mid_name']; ?></td>
			<td><?php echo $user['last_name']; ?></td>
			<td><?php echo $user['alias']; ?></td>
			<td><?php echo $user['gender']; ?></td>
			<td><?php echo $user['user_category_id']; ?></td>
			<td><?php echo $user['farmer_group_id']; ?></td>
			<td><?php echo $user['buying_station_id']; ?></td>
			<td><?php echo $user['email']; ?></td>
			<td><?php echo $user['username']; ?></td>
			<td><?php echo $user['password']; ?></td>
			<td><?php echo $user['entered_by']; ?></td>
			<td><?php echo $user['created']; ?></td>
			<td><?php echo $user['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'users', 'action' => 'view', $user['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'users', 'action' => 'edit', $user['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'users', 'action' => 'delete', $user['id']), null, __('Are you sure you want to delete # %s?', $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

</div>
