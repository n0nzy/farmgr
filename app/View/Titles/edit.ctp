<div class="titles form">
<?php echo $this->Form->create('Title'); ?>
	<fieldset>
		<legend><?php echo __('Edit Title'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Update')); ?>
</div>