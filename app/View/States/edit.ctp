<div class="states form">
<?php echo $this->Form->create('State'); ?>
	<fieldset>
		<legend><?php echo __('Update State'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>