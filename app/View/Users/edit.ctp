<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title_id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('mid_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('alias');
		echo $this->Form->input('gender');
		echo $this->Form->input('user_category_id');
		echo $this->Form->input('farmer_group_id');
		echo $this->Form->input('buying_station_id');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('entered_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>