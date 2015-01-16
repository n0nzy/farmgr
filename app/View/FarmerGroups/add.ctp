<div class="farmerGroups form">
<?php echo $this->Form->create('FarmerGroup'); ?>
	<fieldset>
		<legend><?php echo __('Add Farmer Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('buying_station_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>