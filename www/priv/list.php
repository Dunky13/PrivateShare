<?php
$config 	= parse_ini_file("../../config.ini", true);
$target_dir = "../".$config["urltags"]["file_location"];
$target_enc = "../".$config["urltags"]["encrypt_location"];
function rsearch($folder, $pattern) {
    $dir = new RecursiveDirectoryIterator($folder,RecursiveDirectoryIterator::SKIP_DOTS);
    $ite = new RecursiveIteratorIterator($dir);
    $files = new RegexIterator($ite, $pattern, RegexIterator::GET_MATCH);
    $fileList = array();
    foreach($files as $file) {
	    $fileList = array_merge($fileList, str_replace($folder, "", $file));
    }
    return $fileList;
}
function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

function tableList($list, $dirLoc)
{
	$listTableStr		= "";
	foreach($list as $item)
	{
		$name 			= basename($item);
		$time 			= date ("F d Y H:i:s.", filemtime($dirLoc.$item));
		$size			= human_filesize(filesize($dirLoc.$item));
		$viewURL		= $dirLoc === "../../f/" ? "<a href='/f/$item'>View</a>" : "";
		$deleteURL 		= "/d/$item";
		$listTableStr 	.="<tr><td>$time</td><td>$name</td><td>$size</td><td>$viewURL</td><td><button onclick=\"deleteURL('$name','$deleteURL');\">Delete</button></td></tr>";	
	}
	return $listTableStr;
}

$list 		= rsearch($target_dir, "/.*/");
$listenc 	= rsearch($target_enc, "/.*/");

?>


<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/css/sortable-theme-bootstrap.css"> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js"></script>
<script>
function deleteURL(name,url)
{
	if(confirm("Are you sure you want to delete "+name)){
		$.get(
			url,
			'',
			function(response){
				location.reload();
			}
		);
	}
}
</script>

</head>
<body>

<table class="sortable-theme-bootstrap" data-sortable>
<thead><tr><th>Date</th><th>Name</th><th>Size</th><th>View</th><th>Delete</th></tr></thead>
<tbody>
<?php

	echo tableList($list, $target_dir);
	echo tableList($listenc, $target_enc);

?>
</tbody>
</table>

</body>
</html>

