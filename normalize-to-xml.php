<?php
  @date_default_timezone_set("GMT");

  ini_set('memory_limit', '512M');
  ini_set('max_execution_time', '300');
  ini_set('auto_detect_line_endings', TRUE);

  #timer script
  $start_time = microtime(true);

  //File Data
  $fileCode = array("188", "203", "206","209", "213", "215","228", "270", "271","375","395","452","447","459","463","481","500","501");
  
  echo "Start Writing XML file...";
  //Loop over the data and convert csv to xml
  for ($i=0; $i < sizeof($fileCode) ; $i++) { 
    if (($handle = fopen("data_".$fileCode[$i].".csv", "r")) !== FALSE)
    {
      $data = fgetcsv($handle);
      $myXMLfile = fopen("data_".$fileCode[$i].".xml", "a") ;
      $xml = new XMLWriter();
      $xml->openURI("data_".$fileCode[$i].".xml");
      $xml->setIndent(true);
      //create the document tag
      $xml->startDocument('1.0', 'utf-8');
      $xml->startElement('station');
      $data = fgetcsv($handle);
      $xml->writeAttribute('id', $data[0]);
      $xml->writeAttribute('name', $data[14]);
      $xml->writeAttribute('geocode', $data[15] . ",". $data[16]);
      $xml->startElement('rec');
      $xml->writeAttribute('ts', $data[1]);
      $xml->writeAttribute('nox', $data[2]);
      $xml->writeAttribute('no', $data[4]);
      $xml->writeAttribute('no2', $data[3]);
      $xml->endElement();


      while(! feof($handle)) 
      {
        $data = fgetcsv($handle);
        if ($data != "") { //No empty values
          $xml->startElement('rec');
          $xml->writeAttribute('ts', $data[1]);
          $xml->writeAttribute('nox', $data[2]);
          $xml->writeAttribute('no', $data[4]);
          $xml->writeAttribute('no2', $data[3]);
          $xml->endElement();
        }     
      }
      $xml->endElement();

      
      fclose($myXMLfile);
      fclose($handle);
    }
  }
   // End clock time in seconds
   $end_time = microtime(true);
   echo "Done with Writing XML file...";
   echo '<p>It took ';
   // Calculate script execution time
   $execution_time = ($end_time - $start_time);
   echo $execution_time. ' seconds ' .'</p>';
?>