<div class="inspections form">
<?php echo $this->Form->create('Inspection'); ?>
	<?php //echo $this->Html->link(__('List Inspections'), array('action' => 'index')); ?>
	<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Inspection.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Inspection.id'))); ?>

	<fieldset>
		<legend><?php echo __('Update Inspection Information'); ?></legend>

		<div class="my-label"> <span class="label-title"> Farmer Name: </span>  <?php echo $production['User']['full_name'] ?> </div>

		<div class="my-label"> <span class="label-title"> Product Name: </span> <?php echo $production['Product']['name'] ?> </div>

		<div class="my-label"> <span class="label-title"> Total Land Area: </span> <?php echo $inspection['Production']['land_area'] ?> Hectares  </div>

		<div class="my-label"> <span class="label-title"> Production Area Size: </span> <?php echo $inspection['Production']['production_area_size'] ?> Hectares  </div>

		<div class="my-label"> <span class="label-title"> Estimated Production: </span> <?php echo $inspection['Production']['production_area_size'] * $inspection['Production']['yield'] ?> Kg  </div>
	<?php

		echo $this->Form->input('date_inspected');
		echo $this->Form->input('start_time');
		echo $this->Form->input('end_time');
		echo $this->Form->input('inspector_id');

		$options = ''; $options = array('approved' => 'approved', 'suspended' => 'suspended', 'sanctioned' => 'sanctioned');
		echo $this->Form->input('utz_status', array('options' => $options));

		echo $this->Form->label('Inspection.compliance_year', 'Year of Compliance');
		echo $this->Form->year('compliance_year', 2000, date('Y'), array('empty' => false));

	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>