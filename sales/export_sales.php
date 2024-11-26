<?php

include("../config/config.php");


$user_id = $_SESSION['user_id'];







header("Content-type: text/csv");  
header("Cache-Control: no-store, no-cache");  
header('Content-Disposition: attachment; filename="sales_lists.csv"');


$sWhere = "";

if(isset($_REQUEST['start']) && $_REQUEST['start'] != '')
{
	
	$start = mysqli_real_escape_string($connect,$_REQUEST['start']);
	$sWhere .= "AND  date >= '$start' ";
}


if(isset($_REQUEST['end']) && $_REQUEST['end'] != '')
{

	$end = mysqli_real_escape_string($connect,$_REQUEST['end']);	
	$sWhere .= " date <= '$end' ";
}

if(isset($_REQUEST['shop_id_filter']) && $_REQUEST['shop_id_filter'] != '')
{

	$shop_id_filter = mysqli_real_escape_string($connect,$_REQUEST['shop_id_filter']);	
	$sWhere .= " shops.id <= '$shop_id_filter' ";
}
if(isset($_REQUEST['type_filter']) && $_REQUEST['type_filter'] != '')
{

	$type_filter = mysqli_real_escape_string($connect,$_REQUEST['type_filter']);	
	$sWhere .= " shops.id <= '$type_filter' ";
}
if(isset($_REQUEST['product_id_filter']) && $_REQUEST['product_id_filter'] != '')
{

	$product_id_filter = mysqli_real_escape_string($connect,$_REQUEST['product_id_filter']);	
	$sWhere .= " shops.id <= '$product_id_filter' ";
}

 $checkQry = "SELECT sales.id as id,products.name as name,sales.quantity as quantity,sales.date as date,sales.type as type,shops.name as shop_name,categories.name as category_name 
     FROM sales 
    inner join products on sales.product_id = products.id 
    left join shops on sales.shop_id = shops.id
    left join categories on products.category_id = categories.id";
 $checkQry .= " where 1=1  $sWhere ORDER BY date ASC";



$query = mysqli_query($connect, $checkQry) or die(mysqli_error($connect));
$numRowsCheckQryTotal = mysqli_num_rows($query);

$outArray = array();
$lastFamID = '';

if($numRowsCheckQryTotal > 0) {

	$outstream = fopen("php://output",'w');  
	
	$my_arraryHeader = array('Product','Category', 'Sales Type','Quantity','Shops','Date');
	fputcsv($outstream, $my_arraryHeader, ',', '"');
	
	//echo '<pre>';print_r($data);echo '</pre><br>';
	$arrayCount = 1;
	$today_date = date("Y-m-d");
	$today = time();
	
	while ($ra = mysqli_fetch_array($query)) 
	{
		//echo 'in loop <br />';


		$name = $ra['name'];

		$shop = $ra['shop_name'] ?? 'Not Delivered';
		$my_arrary = array($ra['name'],$ra['category_name'],$ra['type'],$ra['quantity'],$shop,$ra['date']);
		fputcsv($outstream, $my_arrary, ',', '"');
	
	}
	
	fclose($outstream);
}
?>
