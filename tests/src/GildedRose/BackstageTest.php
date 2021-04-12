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
class BackstageTest extends TestCase {

    public function test_backstage_pass_before_sell_in_date_updates_normally() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 12, 15);
        $item->tick();
        
        $this->assertEquals($item->product->getQuality(), 13);
        $this->assertEquals($item->product->getsellIn(), 14);
    }
    
        public function test_backstage_pass_5_days_before_sell_in_date_updates_normally() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 8, 5);
        $item->tick();
        
        $this->assertEquals($item->product->getQuality(), 11);
        $this->assertEquals($item->product->getsellIn(), 4);
    }
    
        public function test_backstage_pass_10_days_before_sell_in_date_updates_normally() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 30, 10);
        $item->tick();
        
        $this->assertEquals($item->product->getQuality(), 32);
        $this->assertEquals($item->product->getsellIn(), 9);
    }

    public function test_backstage_pass_on_sell_in_date_update_normally() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 8, 0);
        $item->tick();
        
        $this->assertEquals($item->product->getQuality(), 0);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_backstage_pass_after_sell_in_date_update_normally() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 10, -5);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 0);
        $this->assertEquals($item->product->getsellIn(), -6);
    }

    public function test_backstage_pass_before_sell_in_with_maximum_quality() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 50, 8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), 7);
    }

    public function test_backstage_pass_on_sell_in_date_near_maximum_quality() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 49, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 0);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_backstage_pass_on_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 50, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 0);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_backstage_pass_after_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('Backstage passes to a TAFKAL80ETC concert', 50, -8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 0);
        $this->assertEquals($item->product->getsellIn(), -9);
    }

}
