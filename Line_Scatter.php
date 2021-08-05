<?php
//A scatter chart to show a years worth of data (averaged by month) from a 
//specific station for Carbon Monoxide (NO) at a certain time of day - say 08.00 hours.
@date_default_timezone_set("GMT");
header('Content-Type: application/json');
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '300');
ini_set('auto_detect_line_endings', TRUE);

//open csv
$file = fopen('data_188.csv', 'r');
$date_time = 1; //index of date & time header
$data = [];

function calcSum($var1, $var2)
{
    return $var1 + $var2;
}

$DisplayChart = [];

//Get file
if (($handle = $file) !== FALSE) {
    while (($datacsv = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($datacsv);



        //get date & time column
        $date = $datacsv[$date_time];
        $convert = date($date, time()); //Convert UNIX timestamp back to date & time

        //Get date & time and separate the necessary variables i.e time, year, month
        $time = date('H', $convert);
        $year = date('Y', $convert);
        $month = date('m', $convert);
        $key = date('M-Y', $convert);
        $day = date('d', $convert);

        //only display if its 08.00 am & within 2004
        if ($time == '8' && $year == '2004') {
            //get CO data from column
            if ($CO = 11) {
                // Push to array
                $data[$key][] = (float)$datacsv[$CO];
            }
        }
        //Get a days worth of data (14.05.2004)
        if ($day == '14' && $year == '2004' && $month == '5') {
            //push time, nox, no, no2 to array
            array_push($DisplayChart, array((float)$time, (float)$datacsv[2], (float)$datacsv[3], (float)$datacsv[4]));
        }
    }
    fclose($handle);
}

$push = [];
//2 dimensional array to push the months & average data from each month
$formatted_array = [['Month', 'Carbon monoxide level']];
foreach ($data as $key => $value) {
    $sum = array_sum($value);
    $avg = $sum / count($value);
    array_push($formatted_array, array($key, $avg));
}
//Sort the time from the morning to night
usort($DisplayChart, function ($a, $b) {
    return $a[0] > $b[0];
});

$push[] = $formatted_array;
$push[] = $DisplayChart;

//send scatter & line graph data to index page
echo json_encode(array('scatter_graph' => $formatted_array, 'line_graph' => $DisplayChart));


