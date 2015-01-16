<?php $this->layout = 'admin'; ?>
<div class="inspections index">
	<h2><?php echo __('Report: Farmer\'s Registry'); ?></h2>

	<div class="form-group">
	<?php echo $this->Form->create('Inspection'); ?>
	<fieldset>
			<table class="table-in-form">
				<tr class="row-in-form">
					<td>
					<?php echo $this->Form->input(null, array(
						'label' => 'Inspection Date From',
						'type'  => 'text',
                                                'class' => 'form-control datetype',
                                                //'readonly' => 'readonly',
                                                'placeholder' => '2011-08-08',
                                                'value' => '2011-08-08',
						'name'  => 'data[DateInspected][From]'
						)); ?>
					</td>
					<td>
					<?php
					echo $this->Form->input(null, array(
						'label' => 'Inspection Date To',
						'type' => 'text',
                                                'class' => 'form-control datetype',
						//'div'  => 'pull-right'
                                                'placeholder' => '2012-12-12',
                                                'value' => '2012-12-12',
						'name' => 'data[DateInspected][To]'
					));
                                        
                                        //echo $this->Form->input('date_inspected');
					?>
					</td>
				</tr>
				<tr class="item-title">
					<td colspan="2"> UTZ Status </td>
				</tr>
				<tr>
					<td>
						<?php	echo $this->Form->checkbox('UtzStatus-approved', array(
									'value' => 'approved', 'hiddenField' => false, 'checked' => 'checked'
								)); ?>
					</td>
					<td>
						<?php echo $this->Form->label('utz_status', 'Approved', array('id' => '')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php	echo $this->Form->checkbox('UtzStatus-suspended', array(
									'value' => 'suspended', 'hiddenField' => false, 'checked' => 'checked'
								)); ?>
					</td>
					<td>
						<?php echo $this->Form->label('utz_status', 'Suspended', array('id' => '')); ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php	echo $this->Form->checkbox('UtzStatus-sanctioned', array(
								'value' => 'sanctioned', 'checked' => 'checked'
							)); ?>
					</td>
					<td>
						<?php echo $this->Form->label('utz_status', 'Sanctioned', array('id' => '')); ?>
					</td>
				</tr>
			</table>
		</fieldset>
					<?php echo $this->Form->end(__('Filter Result')); ?>
		</div><!-- Form Filter -->

	<table cellpadding="0" cellspacing="0">
	<tr>
			<th> S/N </th>
			<th><?php echo $this->Paginator->sort('code', 'Farmer Code'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', 'Farmers Name'); ?></th>
			<th><?php echo $this->Paginator->sort('gender'); ?></th>
			<th><?php echo $this->Paginator->sort('farmer_group_id', 'Farmer Group'); ?></th>
			<th> Address/Location </th>
			<th> Telephone Number </th>
			<th> Total Land Area (Hectares)  </th>
			<th> Production Area (Hectares) </th>
			<th> Production Yield (Kg/Hectare) </th>
			<th> Estimated Production (Hectares) </th>
			<th><?php echo $this->Paginator->sort('date_inspected', 'Inspection Date'); ?></th>
			<th><?php echo $this->Paginator->sort('start_time'); ?></th>
			<th><?php echo $this->Paginator->sort('end_time'); ?></th>
			<th><?php echo $this->Paginator->sort('inspected_by'); ?></th>
			<th><?php echo $this->Paginator->sort('utz_status'); ?></th>
			<th><?php echo $this->Paginator->sort('compliance_year', 'Year of Compliance'); ?></th>
	</tr>
	<?php
	//Set the indexCounter that will parse through the $farmerNames array and extract the farmer's full_name
	$indexCounter = 0;

	//Set the S/N counter
	$counter = 1;

	foreach ($inspections as $inspection):
		//print_r($inspection); echo '<hr />';
		//$farmerName = $farmers[$indexCounter]['User']['full_name'];
	?>
	<tr>
		<td><?php echo h($counter); ?>&nbsp;</td>
		<td><?php echo h($inspection['User']['code']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($inspection['User']['full_name'], array('controller' => 'farmers', 'action' => 'admin_view', $inspection['Production']['user_id'])); ?>
		</td>
		<td><?php echo h($inspection['User']['gender']); ?>&nbsp;</td>
		<td><?php echo h($inspection['FarmerGroup']['name']); ?>&nbsp;</td>
		<td><?php echo h($inspection['User']['address']); ?>&nbsp;</td>
		<td><?php echo h($inspection['User']['phone']); ?>&nbsp;</td>
		<td>
			<?php echo h($inspection['Production']['land_area']); ?> &nbsp;
		</td>
		<td>
			<?php echo h($inspection['Production']['production_area_size']); ?> &nbsp;
		</td>
		<td>
			<?php echo h($inspection['Production']['yield']); ?> &nbsp;
		</td>
		<td>
			<?php echo h($inspection['Production']['production_area_size'] * $inspection['Production']['yield']); ?> &nbsp;
		</td>
		<td><?php echo h( $this->Time->format('M jS, Y', $inspection['Inspection']['date_inspected'])); ?>&nbsp;</td>
		<td><?php echo h( $this->Time->format('h:ia', $inspection['Inspection']['start_time'])); ?>&nbsp;</td>
		<td><?php echo h( $this->Time->format('h:ia', $inspection['Inspection']['end_time'])); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspector']['full_name']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspection']['utz_status']); ?>&nbsp;</td>
		<td><?php echo h($inspection['Inspection']['compliance_year']); ?>&nbsp;</td>
	</tr>
<?php $counter++; ?>
<?php $indexCounter++; ?>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>

<script type="text/javascript">
    $(".datetype").datepicker({format: 'yyyy-mm-dd', startView: 1});
</script>
