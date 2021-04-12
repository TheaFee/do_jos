<?php

namespace GildedRose;

use \GildedRose\Product;

class GildedRose {

    public $product;

    public function __construct($name, $quality, $sellIn) {
        $this->product = new Product();
        
        $this->product->setName($name);
        $this->product->setQuality($quality);
        $this->product->setSellIn($sellIn);
    }

    public function tick() {
        switch ($this->product->getName()) {
            case 'Sulfuras, Hand of Ragnaros':
                break;
            case 'Aged Brie':
                $agedBrie = new AgedBrie();
                $agedBrie->tick($this->product);
                break;
            case 'Backstage passes to a TAFKAL80ETC concert' :
                $backstagePass = new BackstagePass();
                $backstagePass->tick($this->product);
                break;
            case 'conjured':
                $conjured = new Conjured();
                $conjured->tick($this->product);
                break;
            default:
                $normal = new Normal();
                $normal->tick($this->product);
                break;
        }
    }
}
