<?php
include_once 'control/file_uploader.php';
$img = new imageupload();
$res = $img->upload($_FILES);
if($res)
{
	echo 'uploader successfully';
}

?>
<html>
<head>
<title>Uploading Complete</title>
</head>
<body>
<h2>Contracts file uploaded successfully</h2>
<h3>upload Awards file</h3>
<form action="file_uploader.php" method="post"
                        enctype="multipart/form-data">
<input type="file" name="file" size="50" />
<br />
<input type="submit" value="Upload File" />
</form>
</body>
</html>