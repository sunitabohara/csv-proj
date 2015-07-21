
<?php
include_once 'control/process.php';
$con = new process();
if(file_exists("uploads/contracts/contracts.csv")){
	$contracts 	= array_map("str_getcsv", file("uploads/contracts/contracts.csv",FILE_SKIP_EMPTY_LINES));
}else{
	echo
	'File does not exist please upload file for cotracts data';
	echo'<br/>';
	echo'<a href="upload_contracts.php">here...</a>';die;
}
if(file_exists("uploads/awards/awards.csv")){
	$awards		= array_map("str_getcsv", file("uploads/awards/awards.csv",FILE_SKIP_EMPTY_LINES));
}else{
	echo
	'File does not exist please upload file for awards data';
	echo'<br/>';
	echo'<a href="upload_contracts.php">here...</a>';die;


}

$file = fopen("uploads/output/final.csv","w");
// $data = $con->contracts($contracts) ;
// $con->awards($awards);
$data = $con->processData($awards,$contracts,$file);
//$res=$con->select($table);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP csv Data process </title>
</head>
<body>
<center>

<div id="header">
 <div id="content">
    <label>Output</label>
    </div>
</div>
<div id="body">
 <div id="content" >
 

  <span><a href="upload_contracts.php">add data here...</a></span><br/>
  <span><a href="uploads/output/final.csv">Download here</a></span><br/>
  <span><a href="show.php">See award locations in map </a></span>
  
   
    </div>
</div>

<div id="footer">

</div>

</center>
</body>
</html>