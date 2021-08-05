<?php
  @date_default_timezone_set("GMT");

  ini_set('memory_limit', '512M');
  ini_set('max_execution_time', '300');
  ini_set('auto_detect_line_endings', TRUE);

  //File data
  $fileCode = array("188", "203", "206","209", "213", "215","228", "270", "271","375","395","452","447","459","463","500","501");
  
  //Loop over each xml data
  for ($i=0; $i < sizeof($fileCode) ; $i++) { 
    $doc = new DOMDocument();
    $doc->load("data_".$fileCode[$i].".xml");
    
    //Check if its valid
    $is_valid_xml = $doc->schemaValidate('air-quality.xsd');
    if ($is_valid_xml) {
      header('Content-type: text/plain'); //Makes output tidy
      echo "This data_".$fileCode[$i].".xml file is valid...";
      echo "\n";
  
    }
  }
?>