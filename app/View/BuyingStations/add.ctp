<div class="buyingStations form">
<?php echo $this->Form->create('BuyingStation'); ?>
	<fieldset>
		<legend><?php echo __('Add Buying Station'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('state_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
