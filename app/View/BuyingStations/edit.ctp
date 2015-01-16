<div class="buyingStations form">
	<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('BuyingStation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('BuyingStation.id'))); ?>
<?php echo $this->Form->create('BuyingStation'); ?>
	<fieldset>
		<legend><?php echo __('Update Buying Station'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('state_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>