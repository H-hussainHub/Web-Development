<?php
# always include this line
@date_default_timezone_set("GMT"); 

$file = fopen("data_188.csv","r");
$count = 1;
$rno = 1;

$xml = '<records>';

while(! feof($file)) {
            
        $rec = fgetcsv($file, 2000 ,',');
        
        if ($count == 1) {
            $elms = $rec;
            $count++;
        }
        else {
            
            $xml .= '<record id="' .  $rno . '">';
            
            for ($i=0; $i < count($elms); $i++) {
                
                $xml .= '<' . $elms[$i] . '>' . $rec[$i] . '</' . $elms[$i] . '>';
                
            }
            $xml .= '</record>';
            $rno++;
        }
   
  }

fclose($file);
$xml .= "</records>";

header("Content-type: text/xml");
echo $xml;
?>