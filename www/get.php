<?php

$config = parse_ini_file("../config.ini", true);

$filename 	= $_GET[$config["urltags"]["file_tag"]];
if(!isset($_GET[$config["urltags"]["encryption_tag"]]))
{
	$path		= $config["urltags"]["file_location"].$filename;
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
	$key 		= $_GET[$config["urltags"]["encryption_tag"]];
	$path		= $config["urltags"]["encrypt_location"]."$filename.enc";
	if(file_exists($path))
	{
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		//header('Content-Length: ' . filesize($path));
		echo passthru(escapeshellcmd("openssl enc -aes-256-cbc -d -in $path -k $key"));
		exit;
		
	}
}
