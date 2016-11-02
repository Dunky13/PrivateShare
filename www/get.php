<?php
$filename 	= $_GET["file"];
if(!isset($_GET['enc']))
{
	$path		= "../f/$filename";
	if(file_exists($path))
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($path).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($path));
		readfile($path);
		exit;
	}
	else
		echo "File does not exist";
}
else
{
	$key 		= $_GET['enc'];
	$path		= "../e/$filename.enc";
	if(file_exists($path))
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		//header('Content-Length: ' . filesize($path));
		echo passthru("openssl enc -aes-256-cbc -d -in $path -k $key");
		exit;
		
	}
}
