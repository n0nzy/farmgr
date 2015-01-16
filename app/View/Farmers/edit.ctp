<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Update Farmer Bio-Data'); ?></legend>
	<?php

		echo $this->Form->input('title_id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('mid_name', array('label' => 'Middle Name'));
		echo $this->Form->input('last_name');
		echo $this->Form->input('alias');
		echo $this->Form->input('code', array('title' => 'The farmer\'s unique identification code number' ));

		$genders = array('male' => 'male', 'female' => 'female');
		echo $this->Form->input('gender', array('options' => $genders, 'default' => 'male'));
		echo $this->Form->input('address');
		echo $this->Form->input('phone', array(
			'label' => 'Phone Number',
			'title' => 'Phone number should be 11 characters in length AND in this format: 080******** or 070********. Do not use the +234 extension'
			)	);
		echo $this->Form->input('farmer_group_id');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>