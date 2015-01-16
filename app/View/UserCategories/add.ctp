<div class="userCategories form">
<?php echo $this->Form->create('UserCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add User Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>