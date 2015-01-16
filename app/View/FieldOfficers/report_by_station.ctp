<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<?php //print_r($officers); ?>

<div class="officers report_by_stations">
	<h2> <?php echo __('Report: Field Officers by Buying Station'); ?> </h2>
	<div> Total Numbers of Field Officers:	 <?php echo count($officers); ?> </div> <br />
	<table cellpadding="0" cellspacing="0" class="online-report">
		<tr>
			<th> S/N </th>
			<th> Field Officer Name						<?php //echo $this->Paginator->sort('name'); ?>			</th>
			<th> Gender									<?php //echo $this->Paginator->sort('gender_id'); ?>	</th>
			<th class="align-right"> Number of Farmers	<?php //echo $this->Paginator->sort('alias'); ?>		</th>
		</tr>

	<?php   //Capture the 1st element of the officers array  ?>
	<?php	$farmerGroupNamePrev = $officers[0]['BuyingStation']['id'];	?>

	<?php   //This checks if there exists a value in the 1st index in the officers array  ?>
	<?php if (!empty($officers[0]['BuyingStation']['id'])) : ?>
		<tr class="sub-heading">
			<td colspan="4"> <?php echo h('Buying Station: '); echo $this->Html->link( $officers[0]['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $officers[0]['BuyingStation']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>

	<?php
		$farmersNum = 0;
		$sub_total_farmers = 0;
		$total_farmers = 0;
	?>

	<?php	foreach ($officers as $user) : ?>
	<?php

				//Creating and Initializing the array elements that will be added to the main farmers array.
				//$farmersNum = 0;

				//Over-write number of farmers
				$farmersNum = count($user['Farmer']);
	?>

	<?php  // Detecting when the farmer group name changes and adding a new table row	?>
	<?php	if ($farmerGroupNamePrev != $user['BuyingStation']['id']) :	?>

		<tr class="total">
			<td colspan="3"> Sub-Total: </td>
			<td class="align-right"><?php echo h($sub_total_farmers); ?>&nbsp;</td>
		</tr>
		<tr class="sub-heading">
			<td colspan="4"> <?php echo h('Buying Station: '); echo $this->Html->link($user['BuyingStation']['name'], array('controller' => 'buying_stations', 'action' => 'view', $user['BuyingStation']['id'])); ?> </td>
		</tr>
	<?php
				//Reset the total number of farmers generated from each Buying Station
				$sub_total_farmers = 0;
				$farmerGroupNamePrev = $user['BuyingStation']['name'];
	?>

	<?php	endif;	?>

		<tr>
			<td><?php echo $enumerator; //h($user['Farmer']['id']); ?>&nbsp;</td>

			<td><?php echo $this->Html->link($user['FieldOfficer']['full_name'], array('controller' => 'Field_Officers', 'action' => 'view', $user['FieldOfficer']['id'])); ?>&nbsp;</td>
			<td><?php echo h($user['FieldOfficer']['gender']); ?>&nbsp;</td>
			<td class="align-right"><?php echo h($farmersNum); ?>&nbsp;</td>
		</tr>
	<?php $enumerator++; ?>

	<?php
		$sub_total_farmers	+= $farmersNum;
		$total_farmers		+= $farmersNum;
	?>

	<?php	endforeach;	?>
		<tr class="total">
			<td colspan="3"> Total: </td>
			<td class="align-right"><?php echo h($total_farmers); ?>&nbsp;</td>
		</tr>
	</table>

</div> <!-- class="officers report_by_stations" -->