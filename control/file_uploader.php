
<?php
		$awards = Array(
				    0 => 'contractname',
				    1 => 'contractDate',
				    2 => 'completionDate',
				    3 => 'awardee',
				    4 => 'awardeeLocation',
				    5 => 'Amount'
				);
		$contracts = Array(
					    0 => 'contractname',
					    1 => 'status',
					    2 => 'bidPurchaseDeadline',
					    3 => 'bidSubmissionDeadline',
					    4 => 'bidOpeningDate',
					    5 => 'tenderid',
					    6 => 'publicationDate',
					    7 => 'publishedIn'
					);
		$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
		//if(in_array($_FILES['file']['type'],$mimes)){

		
			if( $_FILES['file']['name'] != "" )
		{
			if(in_array($_FILES['file']['type'],$mimes)){
			
				$tempName = $_FILES['file'] ['tmp_name'];
				$handle 	= array_map("str_getcsv", file("$tempName",FILE_SKIP_EMPTY_LINES));
				$data = array_shift($handle);
				if ($data === $contracts) 
				{
				    $newName = 'contracts.csv';
				    move_uploaded_file ($_FILES['file'] ['tmp_name'], 
		       "../uploads/contracts/".$newName);
				    header("Location: index.php");die;
				}
				elseif($data === $awards){
				    $newName = 'awards.csv';
				    move_uploaded_file ($_FILES['file'] ['tmp_name'], 
		       		"../uploads/awards/".$newName);
		       		header("Location: ../index.php");die;
				}else{
					echo
					'File does not contain reuired data please upload file having appropriate data data';
					echo'<br/>';
					echo'<a href="../upload_contracts.php">here...</a>';die;
				}
			move_uploaded_file ($_FILES['file'] ['tmp_name'], 
		       "../uploads/contracts/{$_FILES['file'] ['name']}");

			header("Location: ../upload_awards.php");
			}
		}
		else
		{
		    die("No file specified!");
		}
?>