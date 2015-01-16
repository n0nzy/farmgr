<div class="products view">
<h2><?php  echo __('Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($product['Product']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($product['Product']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entered On'); ?></dt>
		<dd>
			<?php echo h( $this->Time->format('F jS, Y | h:i:s a', $product['Product']['created']) ); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified On'); ?></dt>
		<dd>
			<?php echo h( $this->Time->format('F jS, Y | h:i:s a', $product['Product']['modified']) ); ?>
			&nbsp;
		</dd>
	</dl>
</div>