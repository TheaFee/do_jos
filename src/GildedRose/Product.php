<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GildedRose;

/**
 * Description of product
 *
 * @author thea
 */
class Product {

    private string $name;
    private string $quality;
    private string $sellIn;

    public function getName() {
        return $this->name;
    }

    public function getQuality() {
        return $this->quality;
    }

    public function getSellIn() {
        return $this->sellIn;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setQuality($quality) {
        $this->quality = $quality;
    }

    public function setSellIn($sellIn) {
        $this->sellIn = $sellIn;
    }

}
