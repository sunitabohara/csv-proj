
<html>
<head>
<title>File Uploading Form</title>
</head>
<body>
<h3>Upload File :</h3>
Select a file to upload: <br />
<form action="control/file_uploader.php" method="post"
                        enctype="multipart/form-data">
<input type="file" name="file" size="50" />
<br />
<input type="submit" value="Upload File" />
</form>
</body>
</html>