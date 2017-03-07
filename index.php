<?php
error_reporting(E_ALL);
print_r();

function update($data){
	for($i = 0;$i <= count($data);$i++){
		$data['buildings'][$i]['isUnderConstruction'] = 0;
		$data['buildings'][$i]['constructionCounter'] = 0;
		$data['buildings'][$i]['constructionPercentage'] = 0;
		$data['buildings'][$i]['constructionProgress'] = null;
		$data['buildings'][$i]['constructionTotal'] = 0;
		$data['buildings'][$i]['constructionCounter'] = 0;
	}

	return $data;
}


if (!empty($_FILES)){
	$mcz = json_decode(base64_decode(file_get_contents($_FILES['mcz']['tmp_name'])),1);
	echo json_encode(update($mcz['buildings']));
}else{

?>
<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    .mcz file: <input name="mcz" type="file" /><br />
		<input type="checkbox" name="finishbuildings" value="finishbuildings"> Finish all my buildings<br>
    <input type="submit" value="Send File" />
</form>
<?php } ?>
