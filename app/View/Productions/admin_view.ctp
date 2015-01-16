<div class="productions view">
<h2><?php  echo __('View Farm Produce Info For Farmer: '.$production['User']['name'].' '); ?></h2>
	<dl>
		<dt><?php echo __('Farmer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($production['User']['name'], array('controller' => 'farmers', 'action' => 'view', $production['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($production['Product']['name'], array('controller' => 'products', 'action' => 'view', $production['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Land Area (Ha)'); ?></dt>
		<dd>
			<?php echo h($production['Production']['land_area']); ?> Hectares
			&nbsp;
		</dd>
		<dt><?php echo __('Production Area Size (Kg)'); ?></dt>
		<dd>
			<?php echo h($production['Production']['production_area_size']); ?> Kg
			&nbsp;
		</dd>
		<dt><?php echo __('Estimated Production (Ha)'); ?></dt>
		<dd>
			<?php echo h($production['Production']['estimated_production']); ?> Hectares
			&nbsp;
		</dd>
		<dt><?php echo __('Information Entered On'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y | h:i:s a', $production['Production']['created'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Information Last Modified On'); ?></dt>
		<dd>
			<?php echo h($this->Time->format('F jS, Y | h:i:s a', $production['Production']['modified'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>