<?php $this->layout = 'admin'; ?>
<div class="inspections index">
	<h2><?php echo __('Report: Latest Inspection Information on each Farmer'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th> S/N </th>
			<th><?php echo 'Farmer Code'; ?></th>
			<th><?php echo 'Farmers Name'; ?></th>
			<th><?php echo 'Gender'; ?></th>
			<th><?php echo 'Farmer Group'; ?></th>
			<th> Address/Location </th>
			<th> Telephone Number </th>
			<th> Total Land Area (Hectares)  </th>
			<th> Production Area Size (Hectares) </th>
			<th> Estimated Production(Kg) </th>
			<th><?php echo 'Inspection Date'; ?></th>
			<th><?php echo 'Last Inspection Date'; ?></th>
			<th><?php echo 'Current UTZ Status'; ?></th>
			<th><?php echo 'Year of Compliance'; ?></th>
	</tr>
	<?php
	//Set the indexCounter that will parse through the $farmerNames array and extract the farmer's full_name
	$indexCounter = 0;

	//Set the S/N counter
	$counter = 1;
	$total_land_area = 0;
	$total_production_area = 0;
	$total_production_estimate = 0;

	foreach ($inspections as $inspection):
		//print_r($inspection); echo '<hr />';
		//$farmerName = $farmers[$indexCounter]['User']['full_name'];
	?>
	<tr>
		<td><?php echo h($counter); ?>&nbsp;</td>
		<td><?php echo h($inspection['Farmer']['code']); ?>&nbsp;</td>
		<td>
			<?php echo h( $inspection['Farmer']['first_name'].' '.$inspection['Farmer']['mid_name'].' '.$inspection['Farmer']['last_name'] ); ?>
		</td>
		<td><?php echo h($inspection['Farmer']['gender']); ?>&nbsp;</td>
		<td><?php echo h($inspection['FarmerGroup']['name']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Farmer']['address']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Farmer']['phone']); ?>&nbsp;</td>
		<td class="align-right">
			<?php echo h($inspection['Production']['land_area']); ?> &nbsp;
		</td>
		<td class="align-right">
			<?php echo h($inspection['Production']['production_area_size']); ?> &nbsp;
		</td>
		<td class="align-right">
			<?php $production_estimate = $inspection['Production']['production_area_size'] * $inspection['Production']['yield'];  ?>
			<?php echo h($production_estimate); ?> &nbsp;
		</td>
		<td><?php echo h( $this->Time->format('M jS, Y', $inspection['Inspection']['date_inspected'])); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspector']['first_name'].' '.$inspection['Inspector']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspection']['utz_status']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspection']['compliance_year']); ?>&nbsp;</td>
	</tr>
<?php $counter++; ?>
<?php $indexCounter++; ?>
<?php $total_land_area += $inspection['Production']['land_area']; ?>
<?php $total_production_area += $inspection['Production']['production_area_size']; ?>
<?php $total_production_estimate += $production_estimate; ?>
<?php endforeach; ?>
	<tr class="total">
		<td  colspan="7"> Total: </td>
		<td class="align-right"> <?php echo $total_land_area; ?> </td>
		<td class="align-right"> <?php echo $total_production_area; ?> </td>
		<td class="align-right"> <?php echo $total_production_estimate; ?> </td>
		<td  colspan="4">  </td>
	</tr>
	</table>

</div>
