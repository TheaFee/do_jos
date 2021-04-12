<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GildedRose;

/**
 * Description of Conjured
 *
 * @author thea
 */
class Conjured extends ProductBase{

    public function tick($product) {
        if ($product->getQuality() > 0) {
            $this->decreaseQualityByTwo($product);
        }
        $this->decreaseSellIn($product);        
        if ($product->getSellIn() < 0 && $product->getQuality() > 0) {
            $this->decreaseQualityByTwo($product);
        }
        if ($product->getQuality() < 0) {
            $this->decreaseQualityByTwo($product);
        }
    }
}
