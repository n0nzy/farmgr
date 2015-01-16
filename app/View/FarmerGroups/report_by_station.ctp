<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<div class="FarmerGroups report_by_station">
	<h2> <?php echo __('Report: Farmer Groups by Buying Station'); ?> </h2>
	<div> Total Numbers of Farmer Groups:	 <?php echo count($farmerGroups); ?> </div> <br />
	<table cellpadding="0" cellspacing="0" class="online-report">
		<tr>
			<th> S/N </th>
			<th> Name			<?php //echo $this->Paginator->sort('first_name'); ?>		</th>
			<th> Description		<?php //echo $this->Paginator->sort('mid_name'); ?>			</th>
			<th> Created			<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
		</tr>

	<?php	$previous = $farmerGroups[0]['BuyingStation']['name'];	?>

	<?php if (!empty($farmerGroups[0]['BuyingStation']['name'])) : ?>
		<tr class="sub-heading">
			<td colspan="4"> <?php echo h('Buying Station: '); echo $this->Html->link( $farmerGroups[0]['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $farmerGroups[0]['BuyingStation']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>

	<?php	foreach ($farmerGroups as $farmerGroup): ?>

	<?php	if ($previous != $farmerGroup['BuyingStation']['name']) :	?>
		<tr class="sub-heading">
			<td colspan="4"> <?php echo h('Buying Station: '); echo $this->Html->link(    $farmerGroup['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $farmerGroup['BuyingStation']['id'])); ?> </td>
		</tr>
	<?php
		$previous = $farmerGroup['BuyingStation']['name'];
		endif;
	?>
		<tr>
			<td><?php echo $enumerator; ?>&nbsp;</td>
			<td><?php echo h($farmerGroup['FarmerGroup']['name']); ?>&nbsp;</td>
			<td><?php echo h($farmerGroup['FarmerGroup']['description']); ?>&nbsp;</td>
			<td><?php echo h($farmerGroup['FarmerGroup']['created']); ?>&nbsp;</td>
		</tr>
	<?php $enumerator++; ?>

	<?php	endforeach;	?>
	</table>

</div> <!-- class="Farmer Groups report_by_station" -->