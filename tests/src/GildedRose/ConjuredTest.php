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
class ConjuredTest extends TestCase {

    public function test_conjured_before_sell_in_date_updates_normally() {
        $item = new GildedRose('conjured', 10, 8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 8);
        $this->assertEquals($item->product->getSellIn(), 7);
    }

    public function test_conjured_on_sell_in_date_update_normally() {
        $item = new GildedRose('conjured', 8, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 4);
        $this->assertEquals($item->product->getSellIn(), -1);
    }

    public function test_conjured_after_sell_in_date_update_normally() {
        $item = new GildedRose('conjured', 10, -5);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 6);
        $this->assertEquals($item->product->getSellIn(), -6);
    }

    public function test_conjured_before_sell_in_with_maximum_quality() {
        $item = new GildedRose('conjured', 50, 8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 48);
        $this->assertEquals($item->product->getSellIn(), 7);
    }

    public function test_conjured_on_sell_in_date_near_maximum_quality() {
        $item = new GildedRose('conjured', 49, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 45);
        $this->assertEquals($item->product->getSellIn(), -1);
    }

    public function test_conjured_on_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('conjured', 50, 0);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 46);
        $this->assertEquals($item->product->getSellIn(), -1);
    }

    public function test_conjured_after_sell_in_date_with_maximum_quality() {
        $item = new GildedRose('conjured', 50, -8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 46);
        $this->assertEquals($item->product->getSellIn(), -9);
    }

    public function test_conjured_after_sell_in_date_quality_on_zero() {
        $item = new GildedRose('conjured', 0, -8);
        $item->tick();

        $this->assertEquals($item->product->getQuality(), 0);
        $this->assertEquals($item->product->getSellIn(), -9);
    }

}
