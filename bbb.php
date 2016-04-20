<?php // content="text/plain; charset=utf-8"
require_once ('../jpgraph/jpgraph.php');
require_once ('../jpgraph/jpgraph_line.php');
require_once ('../jpgraph/jpgraph_bar.php');

$mysql_db_hostname = "192.168.137.178";
$mysql_db_user = "s13113241";
$mysql_db_password = "hs9m322x";
$mysql_db_database = "new_project_utra";
$con = mysql_connect($mysql_db_hostname, $mysql_db_user, $mysql_db_password);

if (!$con) {
 die('Could not connect: ' . mysql_error());
}
mysql_query("set names 'utf8'");
mysql_select_db($mysql_db_database);
   	$sql = "SELECT * FROM `record` ORDER BY `no` DESC LIMIT 10";
    $result = mysql_query($sql) or die('MySQL query error');
    
    $i = 9;
    $j = 0;
    $arr = array(10);
    $darr = array(10);
    $brr = array(10);
    while($row = mysql_fetch_array($result)){
    	$arr[$i] = $row['BP'];
    	// $darr[$j] = $row['datetime']; 
		// $darr[$j] = date_create_from_format("M-d-g-i",$row['datetime']);
    	// $darr[$j] = "2015-11-23 09:13:00.000000";
    	$darr[$i] = date("d/G/i", strtotime($row['datetime']));
    	$j++;
    	$i--;   
    }


$l1datay = array(11,9,2,4,3,13,17);
$l2datay = array(23,12,5,19,17,10,15);

$datax=$gDateLocale->GetShortMonth();

// Create the graph. 
$graph = new Graph(400,200);	
$graph->SetScale("textlin");
$graph->SetMargin(40,130,20,40);
$graph->SetShadow();
$graph->xaxis->SetTickLabels($datax);

// Create the linear error plot
$l1plot=new LinePlot($arr);
$l1plot->SetColor("red");
$l1plot->SetWeight(2);


//Center the line plot in the center of the bars
$l1plot->SetBarCenter();


// Create the bar plot
$bplot = new BarPlot($l2datay);
$bplot->SetFillColor("orange");
$bplot->SetLegend("Result");

// Add the plots to t'he graph
// $graph->Add($bplot);
$graph->Add($l1plot);


$graph->title->Set("line analysis");
$graph->xaxis->title->Set("Datetime");
$graph->yaxis->title->Set("Blood glucose");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);


// Display the graph
$graph->Stroke();
?>
