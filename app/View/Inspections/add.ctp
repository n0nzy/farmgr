<div class="inspections form">
	<?php //var_dump($production); ?>
	<?php //var_dump($inspectors); ?>
<?php echo $this->Form->create('Inspection'); ?>
	<fieldset>
		<legend><?php echo __('Farmer\'s Produce: Enter Inspection Information'); ?></legend>

		<div class="my-label"> <span class="label-title"> Farmer Name: </span>  <?php echo $production['User']['full_name'] ?> </div>

		<div class="my-label"> <span class="label-title"> Product Name: </span> <?php echo $production['Product']['name'] ?> </div>

		<div class="my-label"> <span class="label-title"> Total Land Area: </span> <?php echo $production['Production']['land_area'] ?> Hectares  </div>

		<div class="my-label"> <span class="label-title"> Production Area Size: </span> <?php echo $production['Production']['production_area_size']; ?> Hectares  </div>

		<div class="my-label"> <span class="label-title"> Estimated Production: </span> <?php echo $production['Production']['production_area_size'] * $production['Production']['yield'] ?> Kg  </div>
	<?php
		//echo "<div class> Farmer: ".$production['User']['full_name']."</div>";
		//echo "<div> Product: ".$production['Product']['name']."</div>";

		echo $this->Form->input('date_inspected');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('inspector_id');

		$options = ''; $options = array('approved' => 'approved', 'suspended' => 'suspended', 'sanctioned' => 'sanctioned');
		echo $this->Form->input('utz_status', array('options' => $options));

		echo $this->Form->label('Inspection.compliance_year', 'Year of Compliance');
		echo $this->Form->year('compliance_year', 2000, date('Y'), array('empty' => false));
		//echo $this->Form->input('entered_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div><!-- inspections form -->