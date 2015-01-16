<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<?php //print_r($stations); ?>

<div class="BuyingStations report_by_state">
	<h2> <?php echo __('Report: Buying Stations by State'); ?> </h2>
	<div> Total Numbers of Buying Stations:	 <?php echo count($stations); ?> </div> <br />
	<table cellpadding="0" cellspacing="0" class="online-report">
		<tr class="align-center">
			<th> S/N </th>
			<th class="align-center"> Name			<?php //echo $this->Paginator->sort('first_name'); ?>		</th>
			<th class="align-center"> Number of Field Officers				<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th class="align-center"> Number of Farmer Groups				<?php //echo $this->Paginator->sort('mid_name'); ?>			</th>
			<th class="align-center"> Number of Farmers						<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th class="align-center"> Total Land Area (Hectares)				<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th class="align-center"> Total Production Area	(Hectares)		<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th class="align-center"> Total Expected Production (KG)			<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
		</tr>

	<?php	/** @var string $previous  */ ?>
	<?php	$previous = $stations[0]['State']['id'];	?>

	<?php if (!empty($stations[0]['State']['id'])) : ?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('State: '); echo $this->Html->link( $stations[0]['State']['name'], array('controller' => 'states', 'action' => 'view', $stations[0]['State']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>


	<?php
			$total_officers = 0;
			$total_groups = 0;
			//$sub_total_farmer_groups	= 0;
			$total_farmers			= 0;
			$total_land_area		= 0;
			$total_production_area = 0;
			$total_production_estimate = 0;

	?>

	<?php	foreach ($stations as $station) : ?>

		<?php	if ($previous != $station['State']['id']) :	?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('State: '); echo $this->Html->link(    $station['State']['name'], array('controller' => 'states', 'action' => 'view', $station['State']['id'])); ?> </td>
		</tr>
		<?php
					$previous = $station['State']['id'];
				endif;
		?>
		<?php
				$sub_total_farmers   = 0;//Total Number of farmers in a buying station reset.
				$sub_total_land_area = 0;//This initializes, then resets the value after output to screen
				$sub_total_area_size = 0;
				$sub_total_estimated = 0;

				if (!empty($station['FarmerGroup'])) :
					foreach ($station['FarmerGroup'] as $farmerGroup) :

						if (!empty($farmerGroup['Farmer'])) :

							//This accumulates all farmers per buying station
							$sub_total_farmers  += count($farmerGroup['Farmer']);

							foreach ($farmerGroup['Farmer'] as $farmer) :

								if (!empty($farmer['Production'])) :
									foreach($farmer['Production'] as $production) :
										$sub_total_land_area += $production['land_area'];
										$sub_total_area_size += $production['production_area_size'];
										$sub_total_estimated += $production['production_area_size'] * $production['yield'];
									endforeach;
								endif;

							endforeach;

						endif;

					endforeach;
				endif;

		?>
		<tr>
			<td> <?php echo $enumerator; ?>&nbsp;</td>
			<td> <?php echo h($station['BuyingStation']['name']) ?>		<?php //echo $this->Paginator->sort('last_name'); ?>		</td>
			<td class="align-right"> <?php echo h( count($station['FieldOfficer']) ); ?> </td>
			<td class="align-right"> <?php echo h( count($station['FarmerGroup']) ); ?>		<?php //echo $this->Paginator->sort('last_name'); ?>		</td>
			<td class="align-right"> <?php echo h( $sub_total_farmers ); ?>		<?php //echo $this->Paginator->sort('last_name'); ?>		</td>
			<td class="align-right"> <?php echo h( $sub_total_land_area ); ?> </td>
			<td class="align-right"> <?php echo h( $sub_total_area_size ); ?> &nbsp; </td>
			<td class="align-right"> <?php echo h( $sub_total_estimated ); ?> &nbsp; </td>
		</tr>
	<?php $enumerator++; ?>

	<?php
		$total_officers += count($station['FieldOfficer']);
		$total_groups += count($station['FarmerGroup']);
		$total_farmers += $sub_total_farmers;
		$total_land_area += $sub_total_land_area;
		$total_production_area += $sub_total_area_size;
		$total_production_estimate += $sub_total_estimated;
	?>

	<?php	endforeach;	?>

		<tr class="total">
			<td colspan="2"> Total </td>
			<td class="align-right"> <?php echo h( $total_officers ); ?> </td>
			<td class="align-right"> <?php echo h( $total_groups ); ?>		<?php //echo $this->Paginator->sort('last_name'); ?>		</td>
			<td class="align-right"> <?php echo h( $total_farmers ); ?>		<?php //echo $this->Paginator->sort('last_name'); ?>		</td>
			<td class="align-right"> <?php echo h( $total_land_area ); ?> </td>
			<td class="align-right"> <?php echo h( $total_production_area ); ?> &nbsp; </td>
			<td class="align-right"> <?php echo h( $total_production_estimate ); ?> &nbsp; </td>
		</tr>

	</table>

</div> <!-- class="Buying Stations report_by_state" -->