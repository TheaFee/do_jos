<?php

declare(strict_types=1);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GildedRose;

use \PHPUnit\Framework\TestCase;

/**
 * Description of AgedBrieTest
 *
 * @author thea
 */
class AgedBrieTest extends TestCase {

    public function test_aged_brie_type_before_sell_in_date_update_normally() {
        $item = new GildedRose('Aged Brie', 10, 10);
        $item->tick();
        
        $this->assertEquals($item->product->getQuality(), 11);
        $this->assertEquals($item->product->getsellIn(), 9);
    }

    public function test_aged_brie_type_on_sell_in_date_update_normally() {
        $item = new GildedRose('Aged Brie', 10, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 12);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_aged_brie_type_after_sell_in_date_update_normally() {
        $item = new GildedRose('Aged Brie', 10, -5);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 12);
        $this->assertEquals($item->product->getsellIn(), -6);
    }

    public function test_aged_brie_type_before_sell_in__with_maximum_quality() {
        $item = new GildedRose('Aged Brie', 50, 5);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), 4);
    }

    public function test_aged_brie_type_on_sell_in__date_near_with_maximum_quality() {
        $item = new GildedRose('Aged Brie', 49, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_aged_brie_type_on_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('Aged Brie', 50, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_aged_brie_type_after_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('Aged Brie', 50, -7);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), -8);
    }

}
