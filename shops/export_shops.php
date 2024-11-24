<?php

include("../config/config.php");


$user_id = $_SESSION['user_id'];







header("Content-type: text/csv");  
header("Cache-Control: no-store, no-cache");  
header('Content-Disposition: attachment; filename="shops_lists.csv"');


$sWhere = "";

if(isset($_REQUEST['start']) && $_REQUEST['start'] != '')
{
	//echo 'IN IF <br>';
	
	$start = mysqli_real_escape_string($connect,$_REQUEST['start']);
	$start = trim($start)." 00:00:00";
	
	//$daterange_exp = explode(" - ",$daterange);
	
	//print_r($daterange_exp);echo '<br>';
	
	//$date_start = trim($daterange_exp[0]);//." 00:00:00";
	//$date_end = trim($daterange_exp[1]);//." 23:59:59";
	
	if ( empty($sWhere) )
	{
		//echo 'IN IF <br>';
		
		$sWhere .= ' WHERE ';
	}
	else
	{
		$sWhere .= ' AND ';
	}
	
	$sWhere .= " company_created >= '$start' ";
	
	//$sWhere = "WHERE vendory_type = '".$_POST['vendor']."' ";
}

if(isset($_REQUEST['end']) && $_REQUEST['end'] != '')
{
	//echo 'IN IF <br>';
	
	$end = mysqli_real_escape_string($connect,$_REQUEST['end']);
	$end = trim($end)." 23:59:59";

	if ( empty($sWhere) )
	{
		//echo 'IN IF <br>';
		
		$sWhere .= 'WHERE ';
	}
	else
	{
		$sWhere .= ' AND ';
	}
	
	$sWhere .= " company_created <= '$end' ";
}


$checkQry = "SELECT * FROM shops $sWhere ORDER BY created_at ASC";



$query = mysqli_query($connect, $checkQry) or die(mysqli_error($connect));
$numRowsCheckQryTotal = mysqli_num_rows($query);

$outArray = array();
$lastFamID = '';

if($numRowsCheckQryTotal > 0) {

	$outstream = fopen("php://output",'w');  
	
	$my_arraryHeader = array('Name', 'Date');
	fputcsv($outstream, $my_arraryHeader, ',', '"');
	
	//echo '<pre>';print_r($data);echo '</pre><br>';
	$arrayCount = 1;
	$today_date = date("Y-m-d");
	$today = time();
	
	while ($ra = mysqli_fetch_array($query)) 
	{
		//echo 'in loop <br />';


		$name = $ra['name'];


		$my_arrary = array($ra['name'],$ra['created_at']);
		fputcsv($outstream, $my_arrary, ',', '"');
	
	}
	
	fclose($outstream);
}
?>
