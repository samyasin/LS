<?php   
include 'includes/config.php';
global $con;


$sql = "SELECT * FROM subscribe";
$res = mysqli_query($con, $sql);
$export_data = array();
$i = 1;
while($row = mysqli_fetch_assoc($res)){
    $email = $row['subscribe_email'];
    array_push($export_data,array('NO.' => $i, 'Email' => $email));
    $i++;
}


  $now = new \DateTime('now');
  $fileName = "export_subscribers_data_"  . date_format($now,'Y-m-d(h.i.s-A)') . ".xls";

if ($export_data) {
	function filterData(&$str) {
		$str = preg_replace("/\t/", "\\t", $str);
		$str = preg_replace("/\r?\n/", "\\n", $str);
		if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
	}

	// headers for download
    header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header("Content-Disposition: attachment; filename=\"$fileName\"");


	$flag = false;
	foreach($export_data as $row) {
		if(!$flag) {
			// display column names as first row
			echo implode("\t", array_keys($row)) . "\n";
			$flag = true;
		}
		// filter data
		array_walk($row, 'filterData');
		echo implode("\t", array_values($row)) . "\n";
	}
	exit;			
}


?>