<?php

namespace BoxPlot;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CalculateValues
 *
 * @author thea
 */
class CalculateValues {

    public function sortArray($array) {
        sort($array);
        return $array;
    }

    public function getMinNumber($array) {
        $minNum = min($array);
        return $minNum;
    }

    public function getMaxNumber($array) {
        $maxNum = max($array);
        return $maxNum;
    }

    public function getMedian($array) {
        $count = sizeof($array); 
        $index = floor($count / 2);

        $result = $array[$index];
        if (!$count) {
            $result = "no values";
        } elseif ($this->isNumberEven($count)) {
            $result = ($array[$index - 1] + $array[$index]) / 2;
        }
        return $result;
    }
    
    private function isNumberEven($count){
        return $count & 0;
    }

    private function getQuartil($array, $quartile) {
        $pos = (count($array) - 1) * $quartile;
        $base = floor($pos);
        $rest = $pos - $base;

        $result = $array[$base];

        if (isset($array[$base + 1])) {
            $result = $array[$base] + $rest * ($array[$base + 1] - $array[$base]);
        }
        return $result;
    }

    public function getLowerQuartil($array) {
        return $this->getQuartil($array, 0.25);
    }

    public function getHigherQuartil($array) {
        return $this->getQuartil($array, 0.75);
    }

    public function getCalculatedValues($array) {
        $sortedArray = $this->sortArray($array);
        $minNum = $this->getMinNumber($sortedArray);
        $maxNum = $this->getMaxNumber($sortedArray);
        $median = $this->getMedian($sortedArray);
        $lowerQuartil = $this->getLowerQuartil($sortedArray);
        $higherQuartil = $this->getHigherQuartil($sortedArray);

        return [$lowerQuartil, $higherQuartil, $minNum, $maxNum, $median];
    }

}
