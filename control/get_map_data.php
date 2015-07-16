<?php
class Data{
    private data=array();
    pubic function getDatabyId($id){

        $awards = array_map("str_getcsv", file("uploads/final.csv",FILE_SKIP_EMPTY_LINES));
                
        $keys_awards = array_shift($awards);
                 //echo '<pre>';print_r($keys_awards);
                 //echo '<pre>';print_r($awards);
        foreach ($awards as $i=>$row) {
            $csv_awards[$i] = array_combine($keys_awards, $row);
        }
            $data['contractname']=$csv_awards[$id]['contractname'];
            $data['bidPurchaseDeadline']=$csv_awards[$id]['bidPurchaseDeadline'];
            $data['awardee']=$csv_awards[$id]['awardee'];
            $data['awardeeLocation']=$csv_awards[$id]['awardeeLocation'];

              return $data;
  }
}   	  

?>