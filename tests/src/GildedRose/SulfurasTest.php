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
class SulfurasTest extends TestCase {

    public function test_sulfuras_before_sell_in_date_updates_normally() {
        $item = new GildedRose('Sulfuras, Hand of Ragnaros', 10, 8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 10);
        $this->assertEquals($item->product->getsellIn(), 8);
    }

    public function test_sulfuras_on_sell_in_date_update_normally() {
        $item = new GildedRose('Sulfuras, Hand of Ragnaros', 8, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 8);
        $this->assertEquals($item->product->getsellIn(), 0);
    }

    public function test_sulfuras_after_sell_in_date_update_normally() {
        $item = new GildedRose('Sulfuras, Hand of Ragnaros', 10, -5);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 10);
        $this->assertEquals($item->product->getsellIn(), -5);
    }

    public function test_sulfuras_before_sell_in__with_maximum_quality() {
        $item = new GildedRose('Sulfuras, Hand of Ragnaros', 50, 8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), 8);
    }

    public function test_sulfuras_on_sell_in_date_near_maximum_quality() {
        $item = new GildedRose('Sulfuras, Hand of Ragnaros', 49, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 49);
        $this->assertEquals($item->product->getsellIn(), 0);
    }

    public function test_sulfuras_on_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('Sulfuras, Hand of Ragnaros', 50, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), 0);
    }

    public function test_sulfuras_after_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('Sulfuras, Hand of Ragnaros', 50, -8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 50);
        $this->assertEquals($item->product->getsellIn(), -8);
    }

}
