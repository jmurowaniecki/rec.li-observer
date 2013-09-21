<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
	
		<title>Rec.li observer proto</title>
		
	</head>

	<body>
		<?php
		for ($n = 60; $n < 201; $n++) {
			$video = file_get_contents("http://rec.li/" . $n);
			$video = explode("<video src=\"", $video);
			$video = explode("\" width", $video[1]);
			$video = $video[0];
			?>
			<video src="<?php echo $video ?>" width="304" height="224" loop autoplay onclick="this.play()"></video>
			<?php
		}
		?>
	</body>
</html>
