<?php   
 include('librerias/pchart/class/pData.class.php');
 include('librerias/pchart/class/pDraw.class.php');
 include('librerias/pchart/class/pImage.class.php');

 
 $MyData = new pData();  
 $MyData->addPoints(array(150,220,300,250,420,200,300,200,100,150,320,400),"2011");
 $MyData->addPoints(array(140,85,340,300,320,300,200,100,50,80,157,666),"2012");
 $MyData->setAxisName(0,"Visitas");
 $MyData->addPoints(array('Enero','Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre','Diciembre'),"Months");
 $MyData->setSerieDescription("Months","Month");
 $MyData->setAbscissa("Months");

 $myPicture = new pImage(700,230,$MyData);


 $myPicture->Antialias = FALSE;

 
 $Settings = array("R"=>0, "G"=>98, "B"=>149, 'Alpha' => 55, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
 $myPicture->drawFilledRectangle(0,0,700,230,$Settings);


 $Settings = array("StartR"=>2, "StartG"=>71, "StartB"=>105, "EndR"=>5, "EndG"=>100, "EndB"=>147, "Alpha"=>50);
 $myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
 $myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));



 $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));

 
 $myPicture->setFontProperties(array("FontName"=>"librerias/pchart/fonts/pf_arma_five.ttf","FontSize"=>6));

 $myPicture->drawText(50,17,'Ejemplo de gráfica de barras con pChart', array('R'=>255, 'G'=>255, 'B'=>255, 'FontName'=>'librerias/pchart/fonts/calibri.ttf', 'FontSize'=>9));

 
 $myPicture->setGraphArea(40,40,640,200);


 $scaleSettings = array("GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE, 'Mode' => SCALE_MODE_START0);
 $myPicture->drawScale($scaleSettings);

 
 $myPicture->drawLegend(655,110,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_VERTICAL, 'FontR' => 255, 'FontG' => 255, 'FontB' => 255));


 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

 
 $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
 $settings = array("Surrounding"=>-30,"InnerSurrounding"=>30,"Interleave"=>0.2, 'Draw0Line' => true, 'DisplayValues'=>true);
 $myPicture->drawBarChart($settings);

 $myPicture->Stroke();