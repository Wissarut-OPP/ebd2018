<html>
<head></head>
<body>
<?php
	$name="ip";
	$sum = 0;
	$count = 0;
	$date;
	$mean;
	$variance;
	$element = array();
	for($i = 1; $i <= 10; $i++)
	{
		$ip = $_POST[$name.strval($i)];
		if($ip != '')
		{
			$json_url = "http://".$ip."/temperaturejson.php";
			$json = file_get_contents($json_url);
			$data = json_decode($json, TRUE);
			$lastIndex = (sizeof($data) - 1) ;
			$date = $data[$lastIndex]["Date"];
			$temp = $data[$lastIndex]["Temp"];
			array_push($element, $temp);
			$sum += $temp;
			$count++;
		}
	}
	
	$mean = $sum/$count;
	$sum = 0;
	
	for($i = 0; $i < $count; $i++)
	{
		$sum += pow($element[$i] - $mean, 2);
	}
	
	$variance = $sum/$count;
	
	echo "Date ".$date."<br> Temperature is ".$mean."<br> Variance is ".$variance;
?>
</body>
</html>
