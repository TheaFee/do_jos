<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GildedRose;

/**
 * Description of Normal
 *
 * @author thea
 */
class Normal extends ProductBase {

    public function tick($product) {
        if ($product->getQuality() > 0) {
           $this->decreaseQuality($product);
        }
        $product->setSellIn($product->getSellIn() - 1);
        if ($product->getSellIn() < 0 && $product->getQuality() > 0) {
            $this->decreaseQuality($product); 
        }
    }
}
