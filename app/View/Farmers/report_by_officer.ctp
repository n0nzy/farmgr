<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<?php //print_r($farmers); ?>

<div class="farmers report_by_officers">
	<h2> <?php echo __('Report: Farmers by Field Officers'); ?> </h2>
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

	<?php   //Capture the 1st element of the farmers array  ?>
	<?php	$farmerGroupNamePrev = $farmers[0]['FieldOfficer']['id'];	?>

	<?php   //This checks if there exists a value in the 1st index in the farmers array  ?>
	<?php if (!empty($farmers[0]['FieldOfficer']['id'])) : ?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Field Officer: '); echo $this->Html->link( $farmers[0]['FieldOfficer']['full_name'], array('controller' => 'field_officers', 'action' => 'view', $farmers[0]['FieldOfficer']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>

	<?php
		$total_land_area = 0;		$total_production_area = 0; $total_production_estimate = 0;
		$sub_total_land_area = 0;	$sub_total_area_size = 0;	$sub_total_estimated = 0;
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
	<?php	if ($farmerGroupNamePrev != $user['FieldOfficer']['id']) :	?>
		<tr class="total">
			<td colspan="5"> Sub-Total: </td>
			<td class="align-right"><?php echo h($this->Number->precision($sub_total_land_area, 2)); $sub_total_land_area = 0; ?>&nbsp;</td>
			<td class="align-right"><?php echo h($this->Number->precision($sub_total_area_size, 2)); $sub_total_area_size = 0; ?>&nbsp;</td>
			<td class="align-right"><?php echo h($this->number->format($sub_total_estimated, $num_format)); $sub_total_estimated = 0; ?>&nbsp;</td>
		</tr>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Field Officer: '); echo $this->Html->link($user['FieldOfficer']['first_name'], array('controller' => 'field_officers', 'action' => 'admin_view', $user['FieldOfficer']['id'])); ?> </td>
		</tr>
	<?php
		$farmerGroupNamePrev = $user['FieldOfficer']['id'];
		endif;
	?>
		<tr>
			<td><?php echo $enumerator; //h($user['Farmer']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['code']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($user['Farmer']['full_name'], array('controller' => 'Farmers', 'action' => 'admin_view', $user['Farmer']['id'])); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['alias']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['gender']); ?>&nbsp;</td>
			<td class="align-right"><?php echo h( $this->Number->precision($user['Production']['land_area'], 2) ); ?>&nbsp;</td>
			<td class="align-right"><?php echo h( $this->Number->precision($user['Production']['area_size'], 2) ); ?>&nbsp;</td>
			<td class="align-right"><?php echo h( $this->Number->format($user['Production']['estimated'], $num_format) ); ?>&nbsp;</td>
		</tr>
	<?php $enumerator++; ?>

	<?php
		$sub_total_land_area			+= $user['Production']['land_area'];	$total_land_area			+= $sub_total_land_area;
		$sub_total_area_size			+= $user['Production']['area_size'];	$total_production_area		+= $sub_total_area_size;
		$sub_total_estimated			+= $user['Production']['estimated'];	$total_production_estimate	+= $sub_total_estimated;
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