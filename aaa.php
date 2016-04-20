<?php // content="text/plain; charset=utf-8" 
require_once ('/jpgraph/jpgraph.php'); 
require_once ('/jpgraph/jpgraph_line.php'); 
require_once ('/jpgraph/jpgraph_bar.php');
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

    while($row = mysql_fetch_array($result)){
    	$arr[$i] = $row['BP'];

    	// $darr[$j] = $row['datetime']; 
		// $darr[$j] = date_create_from_format("M-d-g-i",$row['datetime']);
    	// $darr[$j] = "2015-11-23 09:13:00.000000";
    	$darr[$i] = date("d/G/i", strtotime($row['datetime']));
    	$j++;
    	$i--;   
    }
// $ydata = array(1.5,3,4,5,6,7,8,9,10,11); 
// $ydata2 = array(1,2,3,4,5,6,7,8,9,10); 
$targ = array("#1","#2","#3","#4","#5","#6","#7","#8","#9","#10");
$alt = array("D1","D2","D3","D4","D5","D6","D7","D8","D9","D10"); 

// Create the graph. 
$graph = new Graph(550,600);     
$graph->SetScale("textlin"); 
$graph->img->SetMargin(40,20,30,40); 
$graph->title->Set("Chart Analysis"); 
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->SetScale('linlin',100,160);
$graph->yaxis->scale->ticks->Set(10);
$graph->xaxis->SetTickLabels($darr);

// Setup axis titles
$graph->xaxis->title->Set("Datetime"); 
$graph->yaxis->title->Set("Blood pressure"); 

// Create the linear plot 
$lineplot=new LinePlot($arr); 
$lineplot->mark->SetType(MARK_FILLEDCIRCLE);
$lineplot->mark->SetWidth(8);
$lineplot->mark->SetColor('black');
$lineplot->mark->SetFillColor('red');
$lineplot->SetCSIMTargets($targ,$alt);

// Create line plot
$barplot=new barPlot($arr); 
$barplot->SetCSIMTargets($targ,$alt);
// $barplot ->mark->SetColor('blue');
$barplot->SetFillColor('#2EFEF7'); 

// Add the plots to the graph 
$graph->Add($lineplot); 
// $graph->Add($barplot); 

$graph->StrokeCSIM();

?> 


