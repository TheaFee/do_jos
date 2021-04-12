<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GildedRose;

/**
 * Description of AgedBrie
 *
 * @author thea
 */
class AgedBrie extends ProductBase {

    public function tick($product) {

        if ($product->getQuality() < 50) {
            $this->increaseQuality($product);
        }        
        $this->decreaseSellIn($product);
        if ($product->getSellIn() < 0 && $product->getQuality() < 50) {
            $this->increaseQuality($product);
        }
    }
}
