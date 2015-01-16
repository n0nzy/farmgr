<?php $this->layout = 'admin'; ?>
<div class="inspections form">
	<?php //var_dump($production); ?>
	<?php //var_dump($inspectors); ?>
<?php echo $this->Form->create('Inspection'); ?>
	<fieldset>
		<legend><?php echo __('Report: Latest Inspection Information for each Farmer'); ?></legend>

		<div class="two-column">
			<?php
                        //This form is not used in project, anything you do here will not reflect in site...
			echo $this->Form->input(null, array(
				'label' => 'From',
                                'placeholder' => 'today',
                                'value' => 'today',
				'type' => 'text',
				'name' => 'data[DateInspected][From]'
			));

			echo $this->Form->input(null, array(
				'label' => 'To',
				'type' => 'text',
				//'div'  => 'pull-right'
				'name' => 'data[DateInspected][To]'
			));
			?>
		</div>

		<div class="three-column">
			<div> UTZ Status </div>
			<?php
			echo $this->Form->checkbox('UtzStatus approved', array(
				'value' => 'approved'
			));
			echo $this->Form->label('utz_status', 'Approved', array('id' => ''));
			?> <br />

			<?php
			echo $this->Form->checkbox('UtzStatus suspended', array(
				'value' => 'suspended'
			));
			echo $this->Form->label('utz_status', 'Suspended', array('id' => ''));
			?> <br />

			<?php
			echo $this->Form->checkbox('UtzStatus sanctioned', array(
				'value' => 'sanctioned'
			));
			echo $this->Form->label('utz_status', 'Sanctioned', array('id' => ''));
			?>
		</div>
	<?php

		//$options = ''; $options = array('approved' => 'approved', 'suspended' => 'suspended', 'sanctioned' => 'sanctioned');
		//echo $this->Form->input( 'utz_status', array('options' => $options, 'empty' => true) );

		//echo $this->Form->label('Inspection.compliance_year', 'Year of Compliance');
		//echo $this->Form->year('compliance_year', 2000, date('Y'), array('empty' => false));
		//echo $this->Form->input('entered_by');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div><!-- inspections form -->