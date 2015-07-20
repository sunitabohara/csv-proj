
<?php
class process{
	// open get data from contracts.csv
	$contracts = array_map("str_getcsv", file("../uploads/contracts/contracts.csv",FILE_SKIP_EMPTY_LINES));
	//get column name of contacts.csv
	$Keys_contracts = array_shift($contracts);

	//open and get data from awards.csv
	$awards = array_map("str_getcsv", file("../uploads/awards/awards.csv",FILE_SKIP_EMPTY_LINES));
	//get column name of awards.cs
	$keys_awards = array_shift($awards);

	//combine columns of both constracts.csv and awards.csv
	$data = array_merge($Keys_contracts,$keys_awards);
	//remove duplicate column
	    unset($data[8]);
	$new_data =$data;
	$file = fopen("../uploads/output/final.csv","w");
	if($file){
		$res = fputcsv($file,$new_data);
		//$res = fputcsv($file,$output);
	}
	
    foreach ($contracts as $i=>$row) 
    {
	    $csv_contracts[$i] = array_combine($Keys_contracts, $row);
	}

	foreach ($awards as $i=>$row) 
	{

		$csv_awards[$i] = array_combine($keys_awards, $row);
	}
		   

	$contracts_count=count($csv_contracts);
	$awards_count=count($csv_awards);
	$output[]='';
	$total = 0;
for($i =0; $i<$contracts_count;$i++ )
{
	for($j =0; $j<$awards_count;$j++ )
	{

	if($csv_contracts[$i]['contractname']==$csv_awards[$j]['contractname'])
	{

	        $output[$i]['contractname'] 			= $csv_contracts[$i]['contractname'];
			$output[$i]['status'] 				= $csv_contracts[$i]['status'];
			$output[$i]['bidPurchaseDeadline']	= $csv_contracts[$i]['bidPurchaseDeadline'];
			$output[$i]['bidSubmissionDeadline'] = $csv_contracts[$i]['bidSubmissionDeadline'];
			$output[$i]['bidOpeningDate'] 		= $csv_contracts[$i]['bidOpeningDate'];
			$output[$i]['tenderid'] 				= $csv_contracts[$i]['tenderid'];
			$output[$i]['publicationDate'] 		= $csv_contracts[$i]['publicationDate'];
			$output[$i]['publishedIn'] 		    = $csv_contracts[$i]['publishedIn'];
			
			$output[$i]['contractDate'] 		= $csv_awards[$j]['contractDate'];		
	        $output[$i]['completionDate']	= $csv_awards[$j]['completionDate'];
	        $output[$i]['awardee'] 			= $csv_awards[$j]['awardee'];
	        $output[$i]['awardeeLocation']	= $csv_awards[$j]['awardeeLocation'];
	        $output[$i]['Amount'] 			= $csv_awards[$j] ['Amount'];


	            $res = fputcsv($file,$output[$i]);
	            if($output[$i]['status']=='Closed'){
	            	// var_dump($output[$i]['Amount']);
	            	$total += $output[$i]['Amount'];
	            }
			
		}
	}
}
$data[0] ='Total';
$data[1] = ' Amount';
$data[2] ='of';
$data[3] ='closed';		
$data[4] ='contracts';
$data[5] =':';
$data[6] ='';
$data[7] =$total;
$data[8] ='';
$data[9] ='';
$data[10] ='';
$data[11] ='';
$data[12] ='';
$data[13] ='';

 $res = fputcsv($file,$data);
//var_dump($total);
//opetn output file final.csv in write mode
	fclose($file);
	if($res)
	{
		header("Location: ../index.php");
	}
	else{
		echo 'There is some problem';
	}
}	

?>