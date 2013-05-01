<!DOCTYPE html>
<html lang='en'>
	<head>
		<title>Template Chooser</title>
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		
		<script src="js/bootstrap.min.js"></script>
	</head>
	
	<body>
		<div class='container'>
			<div class='row'>
				<div class='span12'>
					<h2>Click on a template to customize it</h2>
					<?php 
						$dir = getcwd() . "/templates";
						
						// Open a known directory, and proceed to read its contents
						if (is_dir($dir)) {
							if ($dh = opendir($dir)) {
								while (($file = readdir($dh)) !== false) {
									if ($file != '.' && $file != '..') {
										echo "<a href='templateEditorIframe.php?file=$file\\".$file."Template.html'>$file</a>";
										$premadeDir = $dir . "/$file/Premade";
										if (is_dir($premadeDir) && $premadeHandle = opendir($premadeDir)) {
											echo "<div class='row'>";
											while (($premade = readdir($premadeHandle)) !== false) {
												if ($premade != '.' && $premade != '..') {
													echo "<div class='offset1 span10'><a href='templateEditorIframe.php?template=$file/Premade/$premade'>".str_replace(".template", "", $premade)."</a></div>";
												}
											}
											echo "</div>";
										}
										
									}
								}
								closedir($dh);
							}
						}
					?>
					<h3>Or upload template to edit</h3>
					<form action='templateEditorIframe.php' method='post' enctype="multipart/form-data">
						<label for="file">template file: <input type="file" name="file" id="file"></label>
						<input type="submit" name="submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
