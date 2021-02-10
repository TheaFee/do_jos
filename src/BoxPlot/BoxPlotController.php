<?php

/*
 * Hier findest du die entsprechende Kata: https://ccd-school.de/coding-dojo/class-katas/box-plot/
 */

namespace BoxPlot;

/**
 * Description of BoxPlotController
 *
 * @author thea
 */
class BoxPlotController {

    public function createBoxPlot($filename, $formValue) {
        $calculatedValues = new CalculateValues();
        $getBoxPlot = new GetBoxPlot();

        $numbers = explode(',', $formValue['array']);
        $datay = $calculatedValues->getCalculatedValues($numbers);
        $formValue['array'] = $datay;

        $getBoxPlot->getBoxPlot($formValue, $filename);
    }

}
