<?php $this->layout = 'admin'; ?>
<?php $enumerator = 1; ?>

<div class="farmerGroups report_farmers">
	<h2> <?php echo __('Report: Farmers by Farmer Groups'); ?> </h2>
	<div> Total Numbers of Farmers:	 <?php echo count($farmers); ?> </div> <br />
	<table cellpadding="0" cellspacing="0" class="online-report">
		<tr>
			<th> S/N </th>
			<th> Code				<?php //echo $this->Paginator->sort('code'); ?>				</th>
			<th> First Name			<?php //echo $this->Paginator->sort('first_name'); ?>		</th>
			<th> Middle Name		<?php //echo $this->Paginator->sort('mid_name'); ?>			</th>
			<th> Last Name			<?php //echo $this->Paginator->sort('last_name'); ?>		</th>
			<th> Alias				<?php //echo $this->Paginator->sort('alias'); ?>			</th>
			<th> Gender				<?php //echo $this->Paginator->sort('gender_id'); ?>		</th>
		</tr>

	<?php	$farmerGroupNamePrev = $farmers[0]['FarmerGroup']['name'];	?>

	<?php if (!empty($farmers[0]['FarmerGroup']['name'])) : ?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Farmer Group: '); echo $this->Html->link( $farmers[0]['FarmerGroup']['name'], array('controller' => 'farmer_groups', 'action' => 'admin_view', $farmers[0]['FarmerGroup']['id'])); ?> </td>
		</tr>
	<?php	endif;	?>

	<?php	foreach ($farmers as $user): ?>

	<?php	if ($farmerGroupNamePrev != $user['FarmerGroup']['name']) :	?>
		<tr class="sub-heading">
			<td colspan="8"> <?php echo h('Farmer Group: '); echo $this->Html->link($user['FarmerGroup']['name'], array('controller' => 'farmer_groups', 'action' => 'admin_view', $user['FarmerGroup']['id'])); ?> </td>
		</tr>
	<?php
		$farmerGroupNamePrev = $user['FarmerGroup']['name'];
		endif;
	?>
		<tr>
			<td><?php echo $enumerator; //h($user['Farmer']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['code']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['first_name']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['mid_name']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['last_name']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['alias']); ?>&nbsp;</td>
			<td><?php echo h($user['Farmer']['gender']); ?>&nbsp;</td>
		</tr>
	<?php $enumerator++; ?>

	<?php	endforeach;	?>
	</table>

</div> <!-- class="farmer Groups report_farmers" -->