<div class="users index">
	<p> <?php
			$full_name = '';
			$full_name = '['.AuthComponent::user('first_name').' '.AuthComponent::user('last_name').']';
			echo $full_name;
		?>
	</p>
	<?php
		$category_id = '';	$sub_title_msg = '';
		$category_id = AuthComponent::user('user_category_id');

		//This check the status of the logged in user and returns an appropriate sub-title msg
		if ($category_id == '1') {
			$sub_title_msg = ': All ';
		}
		elseif ($category_id == '2') {
			$sub_title_msg = ': In Your Buying Station';
		}
	?>
	<h2> <?php echo __('Farmers'); echo $sub_title_msg; ?> </h2>

	<p>
		You haven't added any farmer's record yet!!!
	</p>

</div>