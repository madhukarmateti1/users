<?php

//read json data
$json = file_get_contents('read.json');
  
// Decode the JSON file
$json_data = json_decode($json,true);
  
// Display data
print_r($json_data);


<?php

//read json data
$scoff = '[
{
"id": 1234,
"violation_type": "Overtime Parking",
"issue_date_utc": "2022-01-01 12:22:05",
"fee_in_paisa": 2500,
"amount_paid": 1000,
"lpn": "JASON"
},
{
"id": 4312,
"violation_type": "Parking on Curb",
"issue_date_utc": "2022-01-04 11:23:00",
"fee_in_paisa": 500,
"amount_paid": 0,
"lpn": "JASON"
},
{
"id": 8765,
"violation_type": "Overtime Parking",
"issue_date_utc": "2021-12-30 04:33:15",
"fee_in_paisa": 3500,
"amount_paid": 0,
"lpn": "PASSPORT"
},
{
"id": 8271,
"violation_type": "Handicap",
"issue_date_utc": "2021-12-29 22:40:34",
"fee_in_paisa": 10000,
"amount_paid": 9000,
"lpn": "JASON"
},
{
"id": 8730,
"violation_type": "Meter Violation",
"issue_date_utc": "2022-01-02 18:15:01",
"fee_in_paisa": 1500,
"amount_paid": 0,
"lpn": "PASSPORT"
},
{
"id": 8572,
"violation_type": "Parking on Curb",
"issue_date_utc": "2022-01-01 12:45:00",
"fee_in_paisa": 6500,
"amount_paid": 0,
"lpn": "MADDIE"
},
{
"id": 9183,
"violation_type": "Parking on Curb",
"issue_date_utc": "2022-01-01 21:43:14",
"fee_in_paisa": 300,
"amount_paid": 0,
"lpn": "JASON"
},
{
"id": 5827,
"violation_type": "Parking on Curb",
"issue_date_utc": "2021-12-31 20:20:05",
"fee_in_paisa": 300,
"amount_paid": 0,
"lpn": "PASSPORT"
},
{
"id": 4563,
"violation_type": "Parking on Curb",
"issue_date_utc": "2021-12-28 23:45:02",
"fee_in_paisa": 300,
"amount_paid": 300,
"lpn": "PASSPORT"
}
]';
//$json = file_get_contents('read.json');
  
// Decode the JSON file
$json_data = json_decode($scoff,true);
  
// Display data
//print_r($json_data);

/*

$arr= array_count_values(array_column($json_data, 'lpn'));

print_r($arr);

$arr1= array_count_values(array_column($json_data, 'violation_type'));

print_r($arr1);

*/

$tmp = array();

echo$len=count($json_data);

for($i=0;$i<$len;$i++){ 

	$fee_in_paisa=(int)trim($json_data[$i]['fee_in_paisa']);
	$amount_paid=(int)trim($json_data[$i]['amount_paid']);

	//for out-standing
	if(($fee_in_paisa/100)>50){
		$out_sta[]=$json_data[$i]['lpn'];
	}

	//for open fines
	if($fee_in_paisa!=$amount_paid){
		$lpn=$json_data[$i]['lpn'];
		$json_data[$i]['id'];
		$violation_type=$json_data[$i]['violation_type'];
		$cnt=0;
		for($j=0;$j<$len;$j++){

			if($lpn==$json_data[$j]['lpn'] && $violation_type==$json_data[$j]['violation_type'] && $fee_in_paisa!=$amount_paid){
				$cnt++;
				//$tmp[]=$json_data[$j]['lpn'];

				$lpn=$json_data[$i]['lpn'];
				$violation_type=$json_data[$i]['violation_type'];
			}

			if($cnt>=2){
				if(!in_array($json_data[$i]['lpn'],$tmp))
				$tmp[]=$json_data[$i]['lpn'];
			}

		}

	}
}


 

$key = array_search('Parking on Curb',$json_data);


echo "<br> Following LPN's have out standing fine more that Rs.50";
print_r($out_sta);

echo "<br>======================================";

echo "<br> Following LPN's have 2 open fines which are the same violation type.";
print_r($tmp);



?>

?>