<div class="productions form">
<?php
	//echo '<h3> Enter farm produce for farmer: '.$farmer['User']['first_name'].' '.$farmer['User']['last_name'].'</h3>';
?>
<?php echo $this->Form->create('Production'); ?>
	<fieldset>
		<legend><?php echo __('Enter Farm Produce For Farmer: '.$farmer['User']['first_name'].' '.$farmer['User']['last_name']); ?></legend>
	<?php
		//echo $this->Form->input('user_id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('land_area', array('label' => 'Total Land Area (Hectares)'));
		echo $this->Form->input('production_area_size', array('label' => 'Production Area Size (Hectares)'));
		echo $this->Form->input('yield', array('label' => 'Yield(Kg/Hectare)') );
		//echo $this->Form->input('estimated_production', array('label' => 'Estimated Production (Hectares)') );
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>