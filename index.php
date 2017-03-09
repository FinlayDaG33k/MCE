<?php
function finishBuildings($data){
	for($i = 0;$i < count($data['buildings']);$i++){
		$data['buildings'][$i]['isUnderConstruction'] = 0;
		$data['buildings'][$i]['constructionCounter'] = 0;
		$data['buildings'][$i]['constructionPercentage'] = 0;
		$data['buildings'][$i]['constructionProgress'] = null;
		$data['buildings'][$i]['constructionTotal'] = 0;
		$data['buildings'][$i]['constructionCounter'] = 0;
		if($data['buildings'][$i]['acceptsWorkers'] > 0){
			$data['buildings'][$i]['jobsAvailable'] = $data['buildings'][$i]['acceptsWorkers'];
		}
	}
	return $data;
}

function topUp($data){
	foreach($data['resources'] as $resource => $value){
		if($data['resources'][$resource]['unlocked'] && $data['resources'][$resource]['storageCapacity'] > 0){
			$data['resources'][$resource]['amount'] = $data['resources'][$resource]['storageCapacity'];
		}
	}
	return $data;
}

function setMoney($data,$total){
	$data['resources']['Money']['amount'] = intval($total);
	$data['resources']['Money']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Money']['inflows']['total']['Gold Mint']);
	$data['resources']['Money']['inflows']['total']['Gold Mint'] = intval ($total_earned);
	$data['resources']['Money']['inflows']['allCurrent'] = intval($data['resources']['Money']['inflows']['allCurrent'] + $total);
	$data['resources']['Money']['inflows']['allTime'] = intval ($data['resources']['Money']['inflows']['allTime'] + $total);
	return $data;
}

function setOre($data,$total){
	$data['resources']['Ore']['amount'] = intval($total);
	$data['resources']['Ore']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Ore']['inflows']['total']['Harvesting']);
	$data['resources']['Ore']['inflows']['total']['Harvesting'] = intval ($total_earned);
	$data['resources']['Ore']['inflows']['allCurrent'] = intval($data['resources']['Ore']['inflows']['allCurrent'] + $total);
	$data['resources']['Ore']['inflows']['allTime'] = intval ($data['resources']['Ore']['inflows']['allTime'] + $total);
	return $data;
}

function setGold($data,$total){
	$data['resources']['Gold']['amount'] = intval($total);
	$data['resources']['Gold']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Money']['inflows']['total']['Harvesting']);
	$data['resources']['Gold']['inflows']['total']['Harvesting'] = intval ($total_earned);
	$data['resources']['Gold']['inflows']['allCurrent'] = intval($data['resources']['Gold']['inflows']['allCurrent'] + $total);
	$data['resources']['Gold']['inflows']['allTime'] = intval ($data['resources']['Gold']['inflows']['allTime'] + $total);
	return $data;
}

function setCivics($data,$total){
	$data['resources']['Civics']['amount'] = intval($total);
	$data['resources']['Civics']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Civics']['inflows']['total']['Civic Center']);
	$data['resources']['Civics']['inflows']['total']['Civic Center'] = intval ($total_earned);
	$data['resources']['Civics']['inflows']['allCurrent'] = intval($data['resources']['Civics']['inflows']['allCurrent'] + $total);
	$data['resources']['Civics']['inflows']['allTime'] = intval ($data['resources']['Civics']['inflows']['allTime'] + $total);
	return $data;
}

function setAtmosphere($data,$total){
	$data['resources']['Atmosphere']['amount'] = intval($total);
	$data['resources']['Atmosphere']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Money']['inflows']['total']['Ore Refinery']);
	$data['resources']['Atmosphere']['inflows']['total']['Ore Refinery'] = intval ($total_earned);
	$data['resources']['Atmosphere']['inflows']['allCurrent'] = intval($data['resources']['Atmosphere']['inflows']['allCurrent'] + $total);
	$data['resources']['Atmosphere']['inflows']['allTime'] = intval ($data['resources']['Atmosphere']['inflows']['allTime'] + $total);
	return $data;
}

function setResearch($data,$total){
	$data['resources']['Research']['amount'] = intval($total);
	$data['resources']['Research']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Money']['inflows']['total']['Small Research Lab']);
	$data['resources']['Research']['inflows']['total']['Small Research Lab'] = intval ($total_earned);
	$data['resources']['Research']['inflows']['allCurrent'] = intval($data['resources']['Research']['inflows']['allCurrent'] + $total);
	$data['resources']['Research']['inflows']['allTime'] = intval ($data['resources']['Research']['inflows']['allTime'] + $total);
	return $data;
}

function setAluminum($data,$total){
	$data['resources']['Aluminum']['amount'] = intval($total);
	$data['resources']['Aluminum']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Money']['inflows']['total']['Harvesting']);
	$data['resources']['Aluminum']['inflows']['total']['Harvesting'] = intval ($total_earned);
	$data['resources']['Aluminum']['inflows']['allCurrent'] = intval($data['resources']['Aluminum']['inflows']['allCurrent'] + $total);
	$data['resources']['Aluminum']['inflows']['allTime'] = intval ($data['resources']['Aluminum']['inflows']['allTime'] + $total);
	return $data;
}

function setUranium($data,$total){
	$data['resources']['Uranium']['amount'] = intval($total);
	$data['resources']['Uranium']['previous'] = intval($total);
	$total_earned = intval ($total + $data['resources']['Money']['inflows']['total']['Harvesting']);
	$data['resources']['Uranium']['inflows']['total']['Harvesting'] = intval ($total_earned);
	$data['resources']['Uranium']['inflows']['allCurrent'] = intval($data['resources']['Uranium']['inflows']['allCurrent'] + $total);
	$data['resources']['Uranium']['inflows']['allTime'] = intval ($data['resources']['Uranium']['inflows']['allTime'] + $total);
	return $data;
}

function maxColonyHappiness($data){
	for($i = 0;$i < count($data['colonists']);$i++){
		$data['colonists'][$i]['happiness'] = 100;
		$statCompress = $data['colonists'][$i]['statCompress'];
		$statCompressArr = explode(',',$statCompress);
		$statCompressArr[4] = 100;
	}
	return $data;
}

if (!empty($_FILES)){
	$mcz = json_decode(base64_decode(file_get_contents($_FILES['mcz']['tmp_name'])),1);
	if($_POST['finishbuildings']){
		$mcz = finishBuildings($mcz);
	}

	if($mcz['resources']['Money']['unlocked']){
		$mcz = setMoney($mcz,$_POST['money']);
	}
	if($mcz['resources']['Ore']['unlocked']){
		$mcz = setOre($mcz,$_POST['ore']);
	}
	if($mcz['resources']['Gold']['unlocked']){
		$mcz = setGold($mcz,$_POST['gold']);
	}
	if($mcz['resources']['Civics']['unlocked']){
		$mcz = setCivics($mcz,$_POST['civics']);
	}
	if($mcz['resources']['Atmosphere']['unlocked']){
		$mcz = setAtmosphere($mcz,$_POST['atmosphere']);
	}
	if($mcz['resources']['Aluminum']['unlocked']){
		$mcz = setAluminum($mcz,$_POST['aluminum']);
	}
	if($mcz['resources']['Uranium']['unlocked']){
		$mcz = setUranium($mcz,$_POST['uranium']);
	}

	if($_POST['topup']){
		$mcz = topUp($mcz);
	}

	if($_POST['maxcolhappiness']){
		$mcz = maxColonyHappiness($mcz);
	}

	//echo json_encode($mcz);
	echo base64_encode(json_encode($mcz));
}else{

?>
<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    .mcz file: <input name="mcz" type="file" /><br />
		Money: <input type="text" name="money" value="100000"><br>
		Ore: <input type="text" name="ore" value="100000"><br>
		Gold: <input type="text" name="gold" value="100000"><br>
		Civics: <input type="text" name="civics" value="100000"><br>
		Microchip: <input type="text" name="microchip" value="100000"><br>
		Atmosphere: <input type="text" name="atmosphere" value="100000"><br>
		Aluminum: <input type="text" name="aluminum" value="100000"><br>
		Uranium: <input type="text" name="uranium" value="100000"><br>
		<input type="checkbox" name="finishbuildings" value="finishbuildings"> Finish all my buildings<br>
		<input type="checkbox" name="topup" value="topup"> Top up all storable resources<br>
		<input type="checkbox" name="maxcolhappiness" value="maxcolhappiness"> 100% colony happiness<br>
    <input type="submit" value="Send File" />
</form>
<?php } ?>
