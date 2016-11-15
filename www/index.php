<?php
$config = parse_ini_file("../config.ini", true);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" 
			content="File sharing and URL shortener for Wents">
        <meta name="robots" content="noarchive">        
        
        <title>Went.IO File Sharing</title>

		<link href="css/reset200802.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/style-upload.css" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> 
		<style>
			.photo{
				-webkit-transition: -webkit-transform .8s ease-in-out;
				transition: transform .8s ease-in-out; }
			.photo:hover {
    			-webkit-transform: rotate(180deg);
    			transform: rotate(180deg); }
		</style>

		<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
		<link rel="manifest" href="/favicon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">

    </head>
    
    <body>
        <!-- contents -->
		<div class="container">

            <div class="jumbotron">
                
				<h1><a href="https://mwent.info"><img class="photo" src="img/logo.png" style="width:200px;vertical-align:middle;"></a>&nbsp;Share Files</h1>
<p class="lead">
    Maximum file size: 5G</p>

	<input id="ukey" type="text" name="<?php echo $config["urltags"]["key_tag"];?>" placeholder="Upload Key"/>
	<label><input id="encrypt" type="checkbox" name="<?php echo $config["urltags"]["encryption_tag"];?>" checked="checked" />Encrypted</label>
<form method="post" action="upload.php" novalidate class="box">


		
		<div class="box__input">
			<svg class="box__icon" xmlns="http://www.w3.org/2000/svg" width="50" height="43" viewBox="0 0 50 43"><path d="M48.4 26.5c-.9 0-1.7.7-1.7 1.7v11.6h-43.3v-11.6c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v13.2c0 .9.7 1.7 1.7 1.7h46.7c.9 0 1.7-.7 1.7-1.7v-13.2c0-1-.7-1.7-1.7-1.7zm-24.5 6.1c.3.3.8.5 1.2.5.4 0 .9-.2 1.2-.5l10-11.6c.7-.7.7-1.7 0-2.4s-1.7-.7-2.4 0l-7.1 8.3v-25.3c0-.9-.7-1.7-1.7-1.7s-1.7.7-1.7 1.7v25.3l-7.1-8.3c-.7-.7-1.7-.7-2.4 0s-.7 1.7 0 2.4l10 11.6z"/></svg>
			<input type="file" name="<?php echo $config["urltags"]["file_tag"];?>" id="file" class="box__file" />
			<label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
			<button type="submit" class="box__button">Upload</button>
		</div>

		
		<div class="box__uploading">Uploading&hellip;</div>
		<div class="box__success">Done! <a id="successURL"><span id="successText"></span></a></div>
		<div class="box__error">Error! </div>
	</form>



	<p><sub>You can also upload screenshots and files directly from your desktop by setting up <a target="_blank" href="http://getsharex.com/">ShareX</a>. You can download the config <a href="https://share.went.io/f/shareXConfig.json">HERE</a></sub></p>
            </div>
            
            <div class="footer jumbotron">
                <h6>
                    If the above boxes are completely opaque or completely 
                    transparent, I highly recommend that you upgrade to a 
                    more up-to-date browser, such as Google Chrome 
				</h6>
			</div>

		</div>
	<script src="upload.js"></script>
	</body>
</html>
