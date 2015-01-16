<?php $this->layout = 'admin'; ?>
<div class="users form">
<?php echo $this->Form->create('FieldOfficer'); ?>
	<fieldset>
		<legend><?php echo __('Field Officer: Create Account'); ?></legend>
	<?php
		//echo $this->Form->input('title_id', array('label' => 'Title'));
		echo $this->Form->input('first_name');
		echo $this->Form->input('mid_name', array('label' => 'Middle name'));
		echo $this->Form->input('last_name');
		//echo $this->Form->input('alias');

		$genders = array('male' => 'male', 'female' => 'female');
		echo $this->Form->input('gender', array('options' => $genders, 'default' => 'male'));

		//echo $this->Form->input('farmer_group_id');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('buying_station_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Create Account')); ?>
</div>