This is a control version, kept it incase i need to derive total hectorage entered by each field officer
<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<?php print_r($officers); ?>

<div class="officers report_by_stations">
	<h2> <?php echo __('Report: Field Officers by Buying Station'); ?> </h2>
	<div> Total Numbers of Field Officers:	 <?php echo count($officers); ?> </div> <br />
	<table cellpadding="0" cellspacing="0" class="online-report">
		<tr>
			<th> S/N </th>

			<th> Field Officer Name					<?php //echo $this->Paginator->sort('name'); ?>		</th>


			<th> 						<?php //echo $this->Paginator->sort('code'); ?>				</th>
			<th> Gender						<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
			<th> Number of Farmers						<?php //echo $this->Paginator->sort('alias'); ?>			</th>
			<th> Land Area (Hectares)		<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
			<th> Production Area (Hectares)		<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
			<th> Estimated Production (kg)	<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
		</tr>

	<?php   //Capture the 1st element of the officers array  ?>
	<?php	$farmerGroupNamePrev = $officers[0]['BuyingStation']['name'];	?>

	<?php   //This checks if there exists a value in the 1st index in the officers array  ?>
	<?php if (!empty($officers[0]['BuyingStation']['name'])) : ?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Buying Station: '); echo $this->Html->link( $officers[0]['BuyingStation']['name'], array('controller' => 'buying_station', 'action' => 'view', $officers[0]['BuyingStation']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>

	<?php
		$total_land_area = 0;		$total_production_area = 0; $total_production_estimate = 0;
		$sub_total_land_area = 0;	$sub_total_area_size = 0;	$sub_total_estimated = 0;
	?>

	<?php	foreach ($officers as $user): ?>
	<?php
				//Each farmer can have multiple production values, so i'm making arrangements to parse thru each farmer's production values and put in the main farmers array.

				//Creating and Initializing the array elements that will be added to the main farmers array.
				$user['Farmer']['land_area'] = 0; $user['Production']['area_size'] = 0; $user['Production']['estimated'] = 0;
				$farmersNum = 0;

				//Creating a variable that will be used as a parameter in the CakeNumber or NumberHelper Class to display numeric values in the table
				$num_format = '';
				$num_format = array(   'places' => 2,    'before' => ' ',    'decimals' => '.',    'thousands' => ','  );

				$farmersNum = count($user['Farmer']);
	?>

	<?php  // Detecting when the farmer group name changes and adding a new table row	?>
	<?php	if ($farmerGroupNamePrev != $user['BuyingStation']['name']) :	?>
		<tr class="total">
			<td colspan="5"> Sub-Total: </td>
			<td class="align-right"><?php echo h($farmersNum); //echo h($this->Number->precision($sub_total_land_area, 2)); $sub_total_land_area = 0; ?>&nbsp;</td>
			<td class="align-right"><?php //echo h($this->Number->precision($sub_total_area_size, 2)); $sub_total_area_size = 0; ?>&nbsp;</td>
			<td class="align-right"><?php //echo h($this->number->format($sub_total_estimated, $num_format)); $sub_total_estimated = 0; ?>&nbsp;</td>
		</tr>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Buying Station: '); echo $this->Html->link($user['BuyingStation']['name'], array('controller' => 'buying_station', 'action' => 'admin_view', $user['BuyingStation']['id'])); ?> </td>
		</tr>
	<?php
		$farmerGroupNamePrev = $user['BuyingStation']['name'];
		endif;
	?>
		<tr>
			<td><?php echo $enumerator; //h($user['Farmer']['id']); ?>&nbsp;</td>

			<td><?php echo $this->Html->link($user['FieldOfficer']['full_name'], array('controller' => 'Field_Officers', 'action' => 'view', $user['FieldOfficer']['id'])); ?>&nbsp;</td>
			<td><?php echo h($user['FieldOfficer']['alias']); ?>&nbsp;</td>
			<td><?php echo h($user['FieldOfficer']['gender']); ?>&nbsp;</td>
			<td><?php echo h($farmersNum); ?>&nbsp;</td>
			<td class="align-right"><?php //echo h( $this->Number->precision($user['Production']['land_area'], 2) ); ?>&nbsp;</td>
			<td class="align-right"><?php //echo h( $this->Number->precision($user['Production']['area_size'], 2) ); ?>&nbsp;</td>
			<td class="align-right"><?php //echo h( $this->Number->format($user['Production']['estimated'], $num_format) ); ?>&nbsp;</td>
		</tr>
	<?php $enumerator++; ?>

	<?php
		//$sub_total_land_area			+= $user['Production']['land_area'];	$total_land_area			+= $sub_total_land_area;
		//$sub_total_area_size			+= $user['Production']['area_size'];	$total_production_area		+= $sub_total_area_size;
		//$sub_total_estimated			+= $user['Production']['estimated'];	$total_production_estimate	+= $sub_total_estimated;
	?>

	<?php	endforeach;	?>
		<tr class="total">
			<td colspan="5"> Total: </td>
			<td class="align-right"><?php //echo h($this->Number->precision($total_land_area, 2)); ?>&nbsp;</td>
			<td class="align-right"><?php //echo h($this->Number->precision($total_production_area, 2)); ?>&nbsp;</td>
			<td class="align-right"><?php //echo h($this->Number->format($total_production_estimate, $num_format)); ?>&nbsp;</td>
		</tr>
	</table>

</div> <!-- class="farmer Groups report_farmers" -->