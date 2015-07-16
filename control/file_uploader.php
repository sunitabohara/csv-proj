
<?php
/*class imageupload{

	public function upload($data)
	{*/
		
			if( $_FILES['file']['name'] != "" )
		{
			if($_FILES['file']['name']=='contracts.csv')
			{
			move_uploaded_file ($_FILES['file'] ['tmp_name'], 
		       "../uploads/contracts/{$_FILES['file'] ['name']}");

			header("Location: ../upload_awards.php");
			}elseif($_FILES['file']['name']=='awards.csv'){
				move_uploaded_file ($_FILES['file'] ['tmp_name'], 
		       "../uploads/awards/{$_FILES['file'] ['name']}");
			header("Location: process.php");		
			}

			else {
				die('We can not upload this file please upload contracts.csv.or awards.csv file');
			}
		}
		else
		{
		    die("No file specified!");
		}
/*}
}*/
?>