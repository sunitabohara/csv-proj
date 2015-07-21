
<?php
class process {

//private data =array();
	public function contracts($contracts){
		//var_dump(array_shift($contracts));die;
		$data['Keys_contracts'] = array_shift($contracts);
		foreach ($contracts as $i=>$row) 
	    {
		    $data['csv_contracts'][$i] = array_combine($data['Keys_contracts'], $row);
		}
		return $data;

	}
	public function awards($awards){
		$data['keys_awards'] = array_shift($awards);
		foreach ($awards as $i=>$row) 
		{

			$data['csv_awards'][$i] = array_combine($data['keys_awards'], $row);
		}
		return $data;
	}
	public function processData($awards,$contracts,$file){

		$contracts = $this->contracts($contracts);
		$awards    = $this->awards($awards);
		$data = array_merge($contracts['Keys_contracts'],$awards['keys_awards']);
		//remove duplicate column
	    unset($data[8]);
	$new_data =$data;
	if($file){
		$res = fputcsv($file,$new_data);
	}
		$contracts_count=count($contracts['csv_contracts']);
		$awards_count=count($awards['csv_awards']);
		$output[]='';
		$total = 0;
		// var_dump($contracts_count);
		$csv_contracts = $contracts['csv_contracts'];
		$csv_awards    = $awards['csv_awards'];
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

	}
}
?>