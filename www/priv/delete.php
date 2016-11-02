<?php

$filename 	= $_GET["file"];
if(array_pop((array_slice(explode(".",$filename),-1))) == "enc")
{
	$target_dir = "../../e/";
}
else
	$target_dir = "../../f/";
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
