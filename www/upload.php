<?php

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	$pageURL .= $_SERVER["SERVER_NAME"];
	return $pageURL;
}

$key = "k";
if(!(isset($_POST[$key]) && $_POST[$key] == "WentIO"))
{
	echo json_encode(["success" => false,
					"url" => "https://went.io"]);
	exit(1);
}

if(isset($_POST['enc']) && $_POST['enc'])
{
	$target_dir	= "../e/";
}
else
{
	$target_dir	= "../f/";
}

$file			= $_FILES["file"];
$fileName		= basename($file["name"]);
do
{
	$uniqueID			= bin2hex(openssl_random_pseudo_bytes(4));
	$unique_target_dir	= $target_dir . $uniqueID . "/";
} while(file_exists($unique_target_dir));

mkdir($unique_target_dir, 0755);

$target_file	= $unique_target_dir . $fileName;
$prepend 		= curPageURL();
$append			= "$uniqueID/".urlencode($fileName);

if(isset($_POST['enc']) && $_POST['enc'])
{
	$in			= $file["tmp_name"];
	$passwd		= bin2hex(openssl_random_pseudo_bytes(8));
	exec("openssl enc -aes-256-cbc -salt -in $in -out $target_file.enc -k $passwd &");
	$url = "$prepend/e/$passwd/$append";
}
else
{
	if(move_uploaded_file($file["tmp_name"], $target_file)){
		$url = "$prepend/f/$append";
	}
}
if(isset($url)){
	echo json_encode(["success" => true,
					"url" => $url,
					"delete" => "$prepend/d/$append"
				]);
}
else
{		echo json_encode(["success" => true,
					"url" => "https://went.io",
				]);
}

?>
