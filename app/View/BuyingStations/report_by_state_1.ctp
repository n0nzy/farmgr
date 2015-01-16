<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<?php //print_r($stations); ?>

<div class="BuyingStations report_by_state">
	<h2> <?php echo __('Report: Buying Stations by State'); ?> </h2>
	<div> Total Numbers of Buying Stations:	 <?php echo count($stations); ?> </div> <br />
	<table cellpadding="0" cellspacing="0" class="online-report">
		<tr>
			<th> S/N </th>
			<th> Name			<?php //echo $this->Paginator->sort('first_name'); ?>		</th>
			<th> Number of Field Officers	<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th> Number of Farmer Groups	<?php //echo $this->Paginator->sort('mid_name'); ?>			</th>
			<th> Number of Farmers			<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th> Total Land Area			<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th> Total Production Area		<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th> Total Expected Production	<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
		</tr>

	<?php	/** @var string $previous  */ ?>
	<?php	$previous = $stations[0]['State']['id'];	?>

	<?php if (!empty($stations[0]['State']['id'])) : ?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('State: '); echo $this->Html->link( $stations[0]['State']['name'], array('controller' => 'states', 'action' => 'view', $stations[0]['State']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>


	<?php
			$sub_total_land_area = 0;
			$sub_total_farmer_groups = 0;
			$sub_total_farmers = 0;
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

				if (!empty($station['farmerGroup'])) :
					foreach ($station['FarmerGroup'] as $farmerGroup) :

						//$sub_total_farmer_groups += count($farmerGroup);
						//$sub_total_farmer_groups += $sub_total_farmer_groups2;

						if (!empty($farmerGroup['farmer'])):
							//$sub_total_farmers = count($farmerGroup['farmer']);

							$sub_total_farmers += count($farmerGroup['farmer']); echo 'Sub Total Farmers: -> '.$sub_total_farmers;
							foreach ($farmerGroup['farmer'] as $farmer):

								if (!empty($farmer['production'])) :
									foreach($farmer['production'] as $production):
									//$sub_total_land_area += $production['land_area'];
									endforeach;
								endif;

							endforeach;
						endif;
						//$sub_total_land_area = $land_area;

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
			<td class="align-right"> <?php echo h(10); ?> &nbsp; </td>
			<td class="align-right"> <?php echo h(10); ?> &nbsp; </td>
		</tr>
	<?php $enumerator++; ?>

	<?php	endforeach;	?>

	<?php //print_r($stations[0]['FarmerGroup'][0]['Farmer']);  ?>
	<?php //print_r($stations[0]['FarmerGroup'][0]['Farmer'][0]['full_name']);  ?>
	<?php //print_r($stations[0]['FarmerGroup'][0]['Farmer'][0]['Production'][0]['land_area']);  ?>
	</table>

</div> <!-- class="Buying Stations report_by_state" -->