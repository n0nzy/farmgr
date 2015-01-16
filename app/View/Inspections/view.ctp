<div class="inspections view">
<h2><?php  echo __('Inspection Information'); ?></h2>
	<div class="btn-group">
		<button class="btn"> <?php echo $this->Html->link(__('Update Inspection Info'), array('action' => 'edit', $inspection['Inspection']['id'])); ?> </button>
		<button class="btn"> <?php echo $this->Form->postLink(__('Delete Inspection Info'), array('action' => 'delete', $inspection['Inspection']['id']), null, __('Are you sure you want to delete this Farmer\'s Inspection Info?' )); ?> </button>
		<button class="btn"> <?php echo $this->Html->link(__('List Inspection Information'), array('action' => 'index')); ?> </button>
	</div>
	<dl>
		<dt><?php echo __('Farmer Name'); ?></dt>
		<dd>
			<?php echo $this->Html->link($farmer['User']['full_name'], array('controller' => 'farmers', 'action' => 'view', $farmer['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo h($farmer['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Land Area'); ?></dt>
		<dd>
			<?php echo h($inspection['Production']['land_area']); ?> Hectares
			&nbsp;
		</dd>
		<dt><?php echo __('Production Area Size'); ?></dt>
		<dd>
			<?php echo h($inspection['Production']['production_area_size']); ?> Kg
			&nbsp;
		</dd>
		<dt><?php echo __('Estimated Production'); ?></dt>
		<dd>
			<?php echo h($inspection['Production']['estimated_production']); ?> Hectares
			&nbsp;
		</dd>
		<dt><?php echo __('Date Inspected'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y', $inspection['Inspection']['date_inspected'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Start Time'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('h:i:s a', $inspection['Inspection']['start_time'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('End Time'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('h:i:s a', $inspection['Inspection']['end_time'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Inspected By'); ?></dt>
		<dd>
			<?php echo h($inspection['Inspector']['full_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Utz Status'); ?></dt>
		<dd>
			<?php echo h($inspection['Inspection']['utz_status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Year of Compliance'); ?></dt>
		<dd>
			<?php echo h($inspection['Inspection']['compliance_year']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Information Entered On'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y | h:i:s a', $inspection['Inspection']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Information Last Modified On'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y | h:i:s a', $inspection['Inspection']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>