<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoxPlotTest
 *
 * @author thea
 */
class GetBoxPlotTest extends TestCase {

    private $boxPlot;

    public function setUp(): void {
        $this->boxPlot = new \BoxPlot\GetBoxPlot();
    }

    public function testGetBoxPlot() {
        $formValue['array'] = array(38, 49, 32, 64, 45);

        $filename = 'tests/src/BoxPlot/images/GetBoxPlotTest/actual.png';
        $this->boxPlot->getBoxPlot($formValue, $filename);
        $stringActual = file_get_contents($filename);

        $stringExpected = file_get_contents('tests/src/BoxPlot/images/GetBoxPlotTest/expected.png');
        $this->assertEquals($stringExpected, $stringActual);
    }

    public function testGetBoxPlot_ChangedChartParameter() {
        $formValue['array'] = array(38, 49, 32, 64, 45);
        $formValue['chartHeight'] = 500;
        $formValue['chartWidth'] = 700;
        $formValue['chartTitle'] = "Dies ist ein Test";
        $formValue['barWidth'] = 10;

        $filename = 'tests/src/BoxPlot/images/GetBoxPlotTest/actual_ChangedParameters.png';
        $this->boxPlot->getBoxPlot($formValue, $filename);
        $stringActual = file_get_contents($filename);

        $stringExpected = file_get_contents('tests/src/BoxPlot/images/GetBoxPlotTest/expected_ChangedParameters.png');
        $this->assertEquals($stringExpected, $stringActual);
    }

}
