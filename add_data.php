
<?php
include_once 'dbMySql.php';
$con = new DB_con();

// data insert code starts here.
if(isset($_POST['btn-save']))
{
 $fname = $_POST['first_name'];
 $lname = $_POST['last_name'];
 $city = $_POST['city_name'];
 
 //$res=$con->insert($fname,$lname,$city);
 $fh = fopen('uploads/awards/awards.csv', 'r');
 if($fh){
 //$awards = array_map("str_getcsv", file("../awards.csv",FILE_SKIP_EMPTY_LINES));
 $res = $con->insert_awards($fh);
 if($res)
 {
  ?>
  <script>
  alert('Record inserted...');
        window.location='index.php'
        </script>
  <?php
 }
 else
 {
  ?>
  <script>
  /*alert('error inserting record...');
        window.location='index.php'*/
        </script>
  <?php
 }
}
else{
  echo 'can not openn input file';
}
}
// data insert code ends here.

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHP Data Insert and Select Data Using OOP - By Cleartuts</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<center>

<div id="header">
 <div id="content">
    <label>PHP Data Insert and Select Data Using OOP - By Cleartuts</label>
    </div>
</div>
<div id="body">
 <div id="content">
    <form method="post">
    <table align="center">
    <tr>
    <td><input type="text" name="first_name" placeholder="First Name" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="last_name" placeholder="Last Name" required /></td>
    </tr>
    <tr>
    <td><input type="text" name="city_name" placeholder="City" required /></td>
    </tr>
    <tr>
    <td>
    <button type="submit" name="btn-save"><strong>SAVE</strong></button></td>
    </tr>
    </table>
    </form>
    </div>
</div>

</center>
</body>
</html>