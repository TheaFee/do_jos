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
class NormalTickTest extends TestCase {
    
    protected function setUp(): void {
        $this->product = new Product();
    }

    public function test_before_sell_in_date_updates_normally() {
        $item = new GildedRose('', 10, 8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 9);
        $this->assertEquals($item->product->getsellIn(), 7);
    }

    public function test_on_sell_in_date_update_normally() {
        $item =  new GildedRose('', 8, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 6);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_after_sell_in_date_update_normally() {
        $item =  new GildedRose('', 10, -5);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 8);
        $this->assertEquals($item->product->getsellIn(), -6);
    }

    public function test_before_sell_in_with_maximum_quality() {
        $item =  new GildedRose('', 50, 8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 49);
        $this->assertEquals($item->product->getsellIn(), 7);
    }

    public function test_on_sell_in_date_near_maximum_quality() {
        $item =  new GildedRose('', 49, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 47);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_on_sell_in_date_with_maximum_quality() {
        $item =  new GildedRose('', 50, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 48);
        $this->assertEquals($item->product->getsellIn(), -1);
    }

    public function test_after_sell_in_date_with_maximum_quality() {
        $item =  new GildedRose('', 50, -8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 48);
        $this->assertEquals($item->product->getsellIn(), -9);
    }

}
