<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BoxPlotControllerTest
 *
 * @author thea
 */
class BoxPlotControllerTest extends TestCase {

    private $boxPlotController;

    public function setUp(): void {
        $this->boxPlotController = new \BoxPlot\BoxPlotController();
    }

    public function testCreateBoxPlot() {
        $string = '17, 18, 18, 19, 19, 20, 24, 24, 25';
        $formValue = ['array' => $string];

        $filename = 'tests/src/BoxPlot/images/ControllerTest/actual.png';
        $this->boxPlotController->createBoxPlot($filename, $formValue);
        $stringActual = file_get_contents($filename);

        $stringExpected = file_get_contents('tests/src/BoxPlot/images/ControllerTest/expected.png');
        $this->assertEquals($stringExpected, $stringActual);
    }

    public function testCreateBoxPlot_ChangedChartParameter() {
        $string = '17, 18, 18, 19, 19, 20, 24, 24, 25';
        $formValue['array'] = $string;
        $formValue['chartHeight'] = 500;
        $formValue['chartWidth'] = 700;
        $formValue['chartTitle'] = "Dies ist ein Test";
        $formValue['barWidth'] = 10;

        $filename = 'tests/src/BoxPlot/images/ControllerTest/actual_ChangedChartParameter.png';
        $this->boxPlotController->createBoxPlot($filename, $formValue);
        $stringActual = file_get_contents($filename);

        $stringExpected = file_get_contents('tests/src/BoxPlot/images/ControllerTest/expected_ChangedChartParameter.png');
        $this->assertEquals($stringExpected, $stringActual);
    }

}
