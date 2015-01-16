<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<?php //print_r($farmers); ?>

<div class="farmerGroups report_farmers">
	<h2> <?php echo __('Report: Farmers by Farmer Groups'); ?> </h2>
	<div> Total Numbers of Farmers:	 <?php echo count($farmers); ?> </div> <br />
	<table cellpadding="0" cellspacing="0" class="online-report">
		<tr>
			<th> S/N </th>
			<th> Code						<?php //echo $this->Paginator->sort('code'); ?>				</th>
			<th> Farmer Name					<?php //echo $this->Paginator->sort('first_name'); ?>		</th>
			<th> Alias						<?php //echo $this->Paginator->sort('alias'); ?>			</th>
			<th> Gender						<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
			<th> Land Area (Hectares)		<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
			<th> Production Area (Hectares)		<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
			<th> Estimated Production (kg)	<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
		</tr>

	<?php
		//Extract the very first farmer in the array and extract the Farmer Group name he/she belongs to
		$farmerGroupNamePrev = $farmers[0]['FarmerGroup']['name'];

		//Extract the very last farmer's ID; will use it to generate the sub-total for the last farmer group
		$last_farmer = end($farmers);
		$last_farmer_id = $last_farmer['User']['id']; // Change this later to -> ['Farmer']['id']
		//echo 'Last Farmer ID: '.$last_farmer_id;
	?>

	<?php if (!empty($farmers[0]['FarmerGroup']['name'])) : ?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Farmer Group: '); echo $this->Html->link( $farmers[0]['FarmerGroup']['name'], array('controller' => 'farmer_groups', 'action' => 'admin_view', $farmers[0]['FarmerGroup']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>

	<?php
		$total_land_area = 0;			$total_production_area = 0;		$total_production_estimate = 0;
		$sub_total_land_area = 0;		$sub_total_area_size = 0;		$sub_total_estimated = 0;
		$set_sub_total_land_area = 0;	$set_sub_total_area_size = 0;	$set_sub_total_estimated = 0;
	?>

	<?php	foreach ($farmers as $user): ?>
	<?php
				//Each farmer can have multiple production values, so i'm making arrangements to parse thru each farmer's production values and put in the main farmers array.

				//Creating and Initializing the array elements that will be added to the main farmers array.
				$user['Production']['land_area'] = 0; $user['Production']['area_size'] = 0; $user['Production']['estimated'] = 0;

				//Creating a variable that will be used as a parameter in the CakeNumber or NumberHelper Class to display numeric values in the table
				$num_format = '';
				$num_format = array(   'places' => 2,    'before' => ' ',    'decimals' => '.',    'thousands' => ','  );

				//Running an interation through every production belonging to the current farmer and adding them up.
				foreach ($user['Production'] as $production):
					$user['Production']['land_area']  += $production['land_area'];
					$user['Production']['area_size']  += $production['production_area_size'];
					$user['Production']['estimated']  += $production['production_area_size'] * $production['yield'];
				endforeach;
	?>

	<?php  // Detecting when the farmer group name changes and adding a new table row	?>
	<?php  if ( $farmerGroupNamePrev != $user['FarmerGroup']['name'] ) :	?>
		<tr class="total">
			<td colspan="5"> Sub-Total: </td>
			<td class="align-right"><?php echo h($this->Number->precision($sub_total_land_area, 2));		$sub_total_land_area = 0; ?>&nbsp;</td> <?php //At this point, sub-total land area for a particular group is displayed, then it is reset ?>
			<td class="align-right"><?php echo h($this->Number->precision($sub_total_area_size, 2));		$sub_total_area_size = 0; ?>&nbsp;</td>
			<td class="align-right"><?php echo h($this->number->format($sub_total_estimated, $num_format)); $sub_total_estimated = 0; ?>&nbsp;</td>
		</tr>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Farmer Group: '); echo $this->Html->link($user['FarmerGroup']['name'], array('controller' => 'farmer_groups', 'action' => 'admin_view', $user['FarmerGroup']['id'])); ?> </td>
		</tr>
	<?php
				$farmerGroupNamePrev = $user['FarmerGroup']['name'];
			endif;
	?>
		<tr>
			<td><?php echo $enumerator; //h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['code']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($user['User']['full_name'], array('controller' => 'Farmers', 'action' => 'admin_view', $user['User']['id'])); ?>&nbsp;</td>
			<td><?php echo h($user['User']['alias']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['gender']); ?>&nbsp;</td>
			<td class="align-right"><?php echo h( $this->Number->precision($user['Production']['land_area'], 2) ); ?>&nbsp;</td>
			<td class="align-right"><?php echo h( $this->Number->precision($user['Production']['area_size'], 2) ); ?>&nbsp;</td>
			<td class="align-right"><?php echo h( $this->Number->format($user['Production']['estimated'], $num_format) ); ?>&nbsp;</td>
		</tr>
	<?php $enumerator++; ?>

	<?php
		/*
		 * $sub_total_land_area		: will not be reset at this point, its purpose is strictly for displaying sub-totals of all land area in each farmer group
		 * $set_sub_total_land_area : will be reset at this point, its purpose is to help accumulate and calculate the total land area, but it has to be reset each time through the loop
		 */

		//Add the current Farmer's production values to sub-total...	intermediary variables that duplicates the code on its left 	Accumulate total production values for each sub-total		reset each $set_sub_total
		$sub_total_land_area	+= $user['Production']['land_area'];	$set_sub_total_land_area += $user['Production']['land_area'];	$total_land_area			+= $set_sub_total_land_area;	$set_sub_total_land_area = 0;
		$sub_total_area_size	+= $user['Production']['area_size'];	$set_sub_total_area_size += $user['Production']['area_size'];	$total_production_area		+= $set_sub_total_area_size;	$set_sub_total_area_size = 0;
		$sub_total_estimated	+= $user['Production']['estimated'];	$set_sub_total_estimated += $user['Production']['estimated'];	$total_production_estimate	+= $set_sub_total_estimated;	$set_sub_total_estimated = 0;
	?>

	<?php //Check to see if this is the last farmer row in the $user array ?>
	<?php	if ( $last_farmer_id == $user['User']['id'] ) :	?>
		<tr class="total">
			<td colspan="5"> Sub-Total: </td>
			<td class="align-right"><?php echo h($this->Number->precision($sub_total_land_area, 2));		$sub_total_land_area = 0; ?>&nbsp;</td>
			<td class="align-right"><?php echo h($this->Number->precision($sub_total_area_size, 2));		$sub_total_area_size = 0; ?>&nbsp;</td>
			<td class="align-right"><?php echo h($this->number->format($sub_total_estimated, $num_format)); $sub_total_estimated = 0; ?>&nbsp;</td>
		</tr>
	<?php	endif;	?>

	<?php
		//$sub_total_land_area = 0;
		//$sub_total_area_size = 0;
		//$sub_total_estimated = 0;
	?>

	<?php	endforeach;	?>
		<tr class="total">
			<td colspan="5"> Total: </td>
			<td class="align-right"><?php echo h($this->Number->precision($total_land_area, 2)); ?>&nbsp;</td>
			<td class="align-right"><?php echo h($this->Number->precision($total_production_area, 2)); ?>&nbsp;</td>
			<td class="align-right"><?php echo h($this->Number->format($total_production_estimate, $num_format)); ?>&nbsp;</td>
		</tr>
	</table>

</div> <!-- class="farmer Groups report_farmers" -->