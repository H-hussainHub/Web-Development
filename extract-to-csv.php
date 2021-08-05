<?php
  @date_default_timezone_set("GMT");

  ini_set('memory_limit', '512M');
  ini_set('max_execution_time', '300');
  ini_set('auto_detect_line_endings', TRUE);

  #timer script
  $start_time = microtime(true);

  //File Data
  $fileCode = array("188", "203", "206","209", "213", "215","228", "270", "271","375","395","452","447","459","463","481","500","501");
  $locationName = array('AURN Bristol Centre', 'Brislington Depot', 'Rupert Street','IKEA M32','Old Market','Parson Street School','Temple Meads Station','Wells Road','Trailer Portway P&R','Newfoundland Road Police Station',"Shiner's Garage",'AURN St Pauls','Bath Road','Cheltenham Road \ Station Road','Fishponds Road',"CREATE Centre Roof",'Temple Way','Colston Avenue');
  $header = "";

  echo "Start Reading Files ...";
  if (($handle = fopen("air-quality-data-2004-2019.csv", "r")) !== FALSE) {
    
    //First We Will Extract Header..
    $data = fgetcsv($handle, 0, ";");
    $header = "siteID,ts,nox,no2,no,pm10,nvpm10,vpm10,nvpm2.5,pm2.5,vpm2.5,co,o3,so2,loc,lat,long";
    
    // Now make a 2d array to store data of every location separately...
    $csvFileData = array (
      array($header),array($header),array($header),array($header),array($header),array($header),
      array($header),array($header),array($header),array($header),array($header),array($header),
      array($header),array($header),array($header),array($header),array($header),array($header)
    );

    //Reorder the csv header to match new $header
    $order = array(4,0,1,2,3,5,6,7,8,9,10,11,12,13,14,15,16,17,18);

    //Read data from file
    while(! feof($handle)) 
    {
      $new = array();
      $data = fgetcsv($handle, 0, ";");
      foreach($order as $index) //Call upon the array and change the csv header
      $new[] = $data[$index];
      if(is_array($new)){
      $new[1] = date('U', strtotime($data[0])); //Convert ts to UNIX timestamp
      $indexWhereValueMatch = array_search($new[17], $locationName);
      //If records from NOx & CO are empty then exclude the record
      if ($new[2] == "" && $new[11] == "") {
        
      }
      else{
        //Store the data into an array base of there matching location
        $csvFileData[$indexWhereValueMatch][] = $new[0] . "," . $new[1]. "," . $new[2] . "," . $new[3]. "," . $new[4] . "," . $new[5]. "," . $new[6] . "," . $new[7]. "," . $new[8] . "," . $new[9]. "," . $new[10] . "," . $new[11]. "," . $new[12] . "," . $new[13]. "," . $new[17] . "," . $new[18];
      }
    }
}

    echo "Done with reading files... ";
    echo "Start saving data into file... ";
  
    //Do a loop over the new array and write to new csv files
    for ($row = 0; $row < sizeof($csvFileData); $row++) {
      $myfile = fopen("data_".$fileCode[$row].".csv", "a") ;
      for ($col = 0; $col < sizeof($csvFileData[$row]); $col++) {
        fputcsv($myfile, explode (",", $csvFileData[$row][$col]));;
      }
      fclose($myfile);  
    }
    
    // End clock time in seconds
    $end_time = microtime(true);
    echo "Done with saving files... ";
    echo '<p>It took ';
    // Calculate script execution time
    $execution_time = ($end_time - $start_time);
    echo $execution_time. ' seconds '.'</p>';
    fclose($handle);
  }

?>