<?php
	require("../main.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload</title>
</head>
<body>
	<form action="<?php echo site_url()."php/upload.php"?>" method="post" enctype="multipart/form-data">
		Select image to upload:
	    <input type="file" name="fileToUpload" id="fileToUpload">
	    <input type="submit" value="Upload Image" name="submit">
	</form>
</body>
</html>