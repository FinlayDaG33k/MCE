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

function setMoney($data){
	$data['resources']['Money']['amount'] = 9999999999;
	$total_goldmint = 9999999999 + $data['resources']['Money']['inflows']['total']['Gold Mint'];
	$data['resources']['Money']['inflows']['total']['Gold Mint'] = $total_goldmint;
	$data['resources']['Money']['inflows']['allCurrent'] = $data['resources']['Money']['inflows']['allCurrent'] + 9999999999;
	$data['resources']['Money']['inflows']['allTime'] = $data['resources']['Money']['inflows']['allTime'] + 9999999999;
	return $data;
}

if (!empty($_FILES)){
	$mcz = json_decode(base64_decode(file_get_contents($_FILES['mcz']['tmp_name'])),1);
	echo json_encode(setMoney($mcz));
	//echo base64_encode(json_encode(finishBuildings($mcz)));
}else{

?>
<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    .mcz file: <input name="mcz" type="file" /><br />
		Money: <input type="text" name="money" value="100000"><br>
		<input type="checkbox" name="finishbuildings" value="finishbuildings"> Finish all my buildings<br>
    <input type="submit" value="Send File" />
</form>
<?php } ?>
