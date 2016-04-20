<?php
$data=array(100,80,90,120,100);
$fixCoeff=250;
$rectWidth=25;
$rectPedding=10;
$value=0;

header("Content-type: image/jpeg");
    	$img=@ImageCreate(255,255); 
    	$backColor=ImageColorAllocate($img, 222, 247, 245);
    	$lineColor=ImageColorAllocate($img, 0 ,0,0);
$boxColor=array(ImageColorAllocate($img,155,193,251),
ImageColorAllocate($img,128,128,192),
ImageColorAllocate($img,255,128,255),
ImageColorAllocate($img,128,255,0),
ImageColorAllocate($img,255,128,64));
    	
    	ImageLine($img,10,$fixCoeff-10,10,$fixCoeff-240,$lineColor);
    	ImageLine($img,10,$fixCoeff-10,240,$fixCoeff-10,$lineColor);

$startX=20;
$colorIndex=0;
foreach($data as $value)
{	
    	ImageFilledRectangle($img,$startX,$fixCoeff-$value,$startX+$rectWidth,$fixCoeff-10,$boxColor[$colorIndex++]);
    	$startX+=$rectWidth+$rectPedding; 
    	}
    	
    	ImageJPEG($img);	
?>
