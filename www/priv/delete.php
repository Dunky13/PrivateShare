<?php

$config = parse_ini_file("../../config.ini",true);

$filename 	= $_GET[$config["urltags"]["file_tag"]];
$filename_exp	= explode(".",$filename);
$filename_slice	= array_slice($filename_exp,-1);
$filename_pop	= array_pop($filename_slice);
if($filename_pop == "enc")
{
	$target_dir = "../".$config["urltags"]["encrypt_location"];
}
else
	$target_dir = "../".$config["urltags"]["encrypt_location"];
$path		= $target_dir.$filename;
if(file_exists($path))
{
	$dir = dirname($path);
	unlink($path);
	rmdir($dir);
	echo "File successfully deleted";
}
else
	echo "File does not exist";
