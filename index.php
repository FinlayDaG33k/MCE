<?php
if (!empty($_FILES)){
	$mcz = json_decode(base64_decode(file_get_contents($_FILES['mcz']['tmp_name'])),1);
}else{

?>
<form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    .mcz file: <input name="mcz" type="file" /><br />
		<input type="checkbox" name="finishbuildings" value="finishbuildings"> Finish all my buildings<br>
    <input type="submit" value="Send File" />
</form>
<?php } ?>