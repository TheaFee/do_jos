<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GildedRose;

/**
 * Description of ProductBase
 *
 * @author thea
 */
class ProductBase {

    protected function decreaseSellIn($product) {
        $product->setSellIn($product->getSellIn() - 1);
    }

    protected function decreaseQualityByTwo($product) {
        $product->setQuality($product->getQuality() - 2);
    }

    protected function decreaseQuality($product) {
        $product->setQuality($product->getQuality() - 1);
    }

    protected function increaseQuality($product) {
        $product->setQuality($product->getQuality() + 1);
    }

    protected function setQualityToZero($product) {
        $product->setQuality(0);
    }
}
