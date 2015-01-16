<div class="productions form">
<?php //echo $info['User']['name']; ?>
<?php echo $this->Form->create('Production'); ?>
	<fieldset>
		<legend><?php echo __('Update Farm Produce Info For Farmer: '.$info['User']['name']); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('land_area', array('label' => 'Total Land Area (Hectares)'));
		echo $this->Form->input('production_area_size', array('label' => 'Production Area (Hectares)'));
		echo $this->Form->input('yield', array('label' => 'Yield') );
		//echo $this->Form->input('estimated_production', array('label' => 'Estimated Production (Hectares)') );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>