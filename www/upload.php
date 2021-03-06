<?php
$config = parse_ini_file("../config.ini", true);


function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	$pageURL .= $_SERVER["SERVER_NAME"];
	return $pageURL;
}

$key 			= $config["urltags"]["key_tag"];
$enc 			= $config["urltags"]["encryption_tag"];
$encryptTest	= isset($_POST[$enc]) && filter_var($_POST[$enc], FILTER_VALIDATE_BOOLEAN);

if(!(isset($_POST[$key]) && $_POST[$key] == $config["security"]["key"]))
{
	echo json_encode(["success" => false,
						"url" => $config["urltags"]["redirect_url"],
						"debug" => $_FILES
	]);
	exit(1);
}

if($encryptTest)
{
	$target_dir	= $config["urltags"]["encrypt_location"];
}
else
{
	$target_dir	= $config["urltags"]["file_location"];
}

$file			= $_FILES[$config["urltags"]["file_tag"]];
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

if($encryptTest)
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
					"delete" => "$prepend/d/$append",
					"debug" => $_FILES
				]);
}
else
{		echo json_encode(["success" => false,
	"url" => $config["urltags"]["redirect_url"],
	"debug"=> $_FILES
				]);
}

?>
