<?php

namespace BoxPlot;
require_once('./libraries/jpgraph-4.3.4/src/jpgraph.php');
require_once ('./libraries/jpgraph-4.3.4/src/jpgraph_line.php');
require_once ('./libraries/jpgraph-4.3.4/src/jpgraph_stock.php');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GetBoxPlot {

    //public array $sortedArray;
// Data must be in the format : open,close,min,max,median

    public function getBoxPlot($formValue, $filename) {
        $chartWidth = (isset($formValue['chartWidth'])) ? $formValue['chartWidth'] : 300;
        $chartHeight = (isset($formValue['chartHeight'])) ? $formValue['chartHeight'] : 200;
        $datay = $formValue['array'];
        $chartTitle = (isset($formValue['chartTitle'])) ? $formValue['chartTitle'] : 'Box Plot';
        $barWidth = (isset($formValue['barWidth'])) ? $formValue['barWidth'] : 20;

        $graph = new \Graph($chartWidth, $chartHeight);
        $graph->SetScale('textlin');
        $graph->SetMarginColor('lightblue');
        $graph->title->Set($chartTitle);
        //$graph->Set90AndMargin();

        $plot = new \BoxPlot($datay);
        $plot->SetCenter();
// Width of the bars (in pixels)
        $plot->SetWidth($barWidth);
// Uncomment the following line to hide the horizontal end lines
       // $plot->HideEndLines();
// Add the plot to the graph and send it back to the browser
        $graph->Add($plot);

        @unlink($filename);
        $graph->Stroke($filename);
    }

}
