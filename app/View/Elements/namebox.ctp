<div id="name-box" class="title-box">
<?php
	$fullName = AuthComponent::user('full_name');
	$buyingStation = AuthComponent::user('BuyingStation');

	if (empty($buyingStation['name'])) {
		$buyingStationName = '';
	}
	else {
		$buyingStationName = "[Buying Station: " . $buyingStation['name'] . " ]";
	}

	echo "[Logged-In: " . $fullName . " ]";
?>
</div>

<div class="pull-right title-box">
<?php
	echo $buyingStationName;
	//var_dump($buyingStation);
	//var_dump($buyingStationName);
?>
</div>