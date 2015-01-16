<div class="farmerGroups form">
	<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FarmerGroup.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FarmerGroup.id'))); ?>
<?php echo $this->Form->create('FarmerGroup'); ?>
	<fieldset>
		<legend><?php echo __('Update Farmer Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('buying_station_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>