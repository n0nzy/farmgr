<?php $this->layout = 'admin'; ?>
<div class="fieldOfficers form">
	<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FieldOfficer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FieldOfficer.id'))); ?>
<?php echo $this->Form->create('FieldOfficer'); ?>
	<fieldset>
		<legend><?php echo __('Field Officers: Edit Information'); ?></legend>
	<?php

		echo $this->Form->input('first_name');
		echo $this->Form->input('mid_name', array('label'=>'Middle name'));
		echo $this->Form->input('last_name');

		$genders = array('male' => 'male', 'female' => 'female');
		echo $this->Form->input('gender', array('options' => $genders, 'default' => 'male'));

		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('buying_station_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>