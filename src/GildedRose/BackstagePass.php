<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GildedRose;

/**
 * Description of BackstagePass
 *
 * @author thea
 */
class BackstagePass extends ProductBase {

    public function tick($product) {
        if ($product->getQuality() < 50) {
            $product = $this->setQualityDependendOfSellInDate($product);
        }
        $this->decreaseSellIn($product);
        if ($product->getSellIn() < 0) {
            $this->setQualityToZero($product);
        }
    }

    public function setQualityDependendOfSellInDate($product) {
        $this->increaseQuality($product);

        if ($product->getSellIn() < 11 && $product->getQuality() < 50) {
            $this->increaseQuality($product);
        }
        if ($product->getSellIn() < 6 && $product->getQuality() < 50) {
            $this->increaseQuality($product);
        }
        return $product;
    }
}