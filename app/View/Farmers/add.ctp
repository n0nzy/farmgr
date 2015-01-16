<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Enter Farmer Information'); ?></legend>
	<?php
		echo $this->Form->input('title_id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('mid_name', array('label' => 'Middle Name'));
		echo $this->Form->input('last_name');
		echo $this->Form->input('alias');
		echo $this->Form->input('code', array('title' => 'Please enter the farmer\'s unique identification code number' ));

		$genders = array('male' => 'male', 'female' => 'female');
		echo $this->Form->input('gender', array('options' => $genders, 'default' => 'male'));
		echo $this->Form->input('address');
		echo $this->Form->input('phone', array(
			'label' => 'Phone Number',
			'title' => 'Phone number should be 11 characters in length AND in this format: 080******** or 070********. Do not use the +234 extension'
			)	);
		echo $this->Form->input('farmer_group_id');

		//echo $this->Form->input('email');
		//echo $this->Form->input('username');
		//echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Enter Information')); ?>
</div>