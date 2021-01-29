<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

//use \Mockery;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GameTest
 *
 * @author thea
 */
final class GameTest extends TestCase {
    
    private \Bowling\Game $bowlingGame;

    protected function setUp(): void {
        parent::setUp();

        $this->bowlingGame = new \Bowling\Game();
    }

    public function testAddRoll_1Roll() {

        $pins = 4;

        $this->bowlingGame->addRoll($pins);

        $allFrames = $this->bowlingGame->getFrames();
        $pinsRolled = $allFrames[0]->getPinsRolled();
        $this->assertEquals($pins, $pinsRolled[0]);
    }

    public function testAddRoll_1Roll_Strike() {
        $this->bowlingGame->addRoll(10);

        $allFrames = $this->bowlingGame->getFrames();
        $pinsRolled = $allFrames[0]->getPinsRolled();
        $this->assertEquals(10, $pinsRolled[0]);
    }

    public function testGetFrames_2Rounds_1Strike() {
        $this->bowlingGame->addRoll(10);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([10]);
        $frame1->setScore(17);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([5, 2]);
        $frame2->setScore(7);

        $this->assertEquals([$frame1, $frame2], $this->bowlingGame->getFrames());
    }

    public function testGetFrames_3Rounds_3Strikes() {
        $this->bowlingGame->addRoll(10);
        $this->bowlingGame->addRoll(10);
        $this->bowlingGame->addRoll(10);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([10]);
        $frame1->setScore(30);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([10]);
        $frame2->setScore(20);

        $frame3 = new \Bowling\Frame();
        $frame3->setPinsRolled([10]);
        $frame3->setScore(10);

        $this->assertEquals([$frame1, $frame2, $frame3], $this->bowlingGame->getFrames());
    }

    public function testGetFrames_2Rounds_1Spare() {
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(2);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([5,5]);
        $frame1->setScore(12);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([2, 2]);
        $frame2->setScore(4);

        $this->assertEquals([$frame1, $frame2], $this->bowlingGame->getFrames());
    }

    public function testGetFrames_3Rounds_1Strike_1Spare() {
        $this->bowlingGame->addRoll(10);
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(6);
        $this->bowlingGame->addRoll(1);
        $this->bowlingGame->addRoll(0);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([10]);
        $frame1->setScore(20);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([4,6]);
        $frame2->setScore(11);

        $frame3 = new \Bowling\Frame();
        $frame3->setPinsRolled([1,0]);
        $frame3->setScore(1);

        $this->assertEquals([$frame1, $frame2, $frame3], $this->bowlingGame->getFrames());
    }

    public function testAddRoll_2Rolls() {

        $pins1 = 4;
        $pins2 = 5;

        $this->bowlingGame->addRoll($pins1);
        $this->bowlingGame->addRoll($pins2);

        $allFrames = $this->bowlingGame->getFrames();
        $pinsRolled = $allFrames[0]->getPinsRolled();
        $this->assertEquals($pins1, $pinsRolled[0]);
        $this->assertEquals($pins2, $pinsRolled[1]);
    }

    public function testGetFrames_1Roll() {
        $this->bowlingGame->addRoll(4);

        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4]);
        $frame->setScore(4);

        $this->assertEquals([$frame], $this->bowlingGame->getFrames());
    }

    public function testGetFrames_1Frame() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);

        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);

        $this->assertEquals([$frame], $this->bowlingGame->getFrames());
    }

    public function testGetFrames2Rounds() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([4, 5]);
        $frame1->setScore(9);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([2, 3]);
        $frame2->setScore(5);

        $this->assertEquals([$frame1, $frame2], $this->bowlingGame->getFrames());
    }

    public function testGetFrames3Rounds() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);
        $this->bowlingGame->addRoll(1);
        $this->bowlingGame->addRoll(7);

        $frame1 = new \Bowling\Frame();
        $frame1->setPinsRolled([4, 5]);
        $frame1->setScore(9);

        $frame2 = new \Bowling\Frame();
        $frame2->setPinsRolled([2, 3]);
        $frame2->setScore(5);

        $frame3 = new \Bowling\Frame();
        $frame3->setPinsRolled([1, 7]);
        $frame3->setScore(8);

        $this->assertEquals([$frame1, $frame2, $frame3], $this->bowlingGame->getFrames());
    }

    public function testCalculateTotalScore() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);
        $this->bowlingGame->addRoll(1);
        $this->bowlingGame->addRoll(7);

        $totalScore = 22;

        $this->assertEquals($totalScore, $this->bowlingGame->getTotalScore());
    }

    public function testGetTotalScore_AfterEveryFrame() {
        $this->bowlingGame->addRoll(4);
        $this->bowlingGame->addRoll(5);
        $this->assertEquals(9, $this->bowlingGame->getTotalScore());
        $this->bowlingGame->addRoll(2);
        $this->bowlingGame->addRoll(3);
        $this->assertEquals(14, $this->bowlingGame->getTotalScore());
        $this->bowlingGame->addRoll(1);
        $this->bowlingGame->addRoll(7);

        $this->assertEquals(22, $this->bowlingGame->getTotalScore());
    }

    public function testGetTotalScore_AfterEveryRoll() {
        // when
        $this->bowlingGame->addRoll(4);
        $this->assertEquals(4, $this->bowlingGame->getTotalScore());
        $this->bowlingGame->addRoll(5);
        $this->assertEquals(9, $this->bowlingGame->getTotalScore());
        $this->bowlingGame->addRoll(2);
        $this->assertEquals(11, $this->bowlingGame->getTotalScore());
        $this->bowlingGame->addRoll(3);
        $this->assertEquals(14, $this->bowlingGame->getTotalScore());
        $this->bowlingGame->addRoll(1);
        $this->assertEquals(15, $this->bowlingGame->getTotalScore());
        $this->bowlingGame->addRoll(7);

        // then
        $this->assertEquals(22, $this->bowlingGame->getTotalScore());
    }

    public function testIsGameOver_True() {
        //given
        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);
        $allFrames = [$frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame];

        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when then
        $this->assertTrue($mock->isGameOver());
    }

    public function testIsGameOver_False() {
        //given
        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);
        $allFrames = [$frame, $frame, $frame, $frame, $frame, $frame];

        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when then
        $this->assertFalse($mock->isGameOver());
    }
    public function testIsGameOver_False_incompleteFrame() {
        //given
        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);
        
        $incompleteFrame = new \Bowling\Frame();
        $incompleteFrame->setPinsRolled([4]);
        $incompleteFrame->setScore(4);
        $allFrames = [$frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $incompleteFrame];

        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when then
        $this->assertFalse($mock->isGameOver());
    }
    
   
        public function testIsGameOver_True_ThirdRollInLastFrame() {
        //given
        $frame = new \Bowling\Frame();
        $frame->setPinsRolled([4, 5]);
        $frame->setScore(9);
        
        $incompleteFrame = new \Bowling\Frame();
        $incompleteFrame->setPinsRolled([10, 5, 5]);
        $incompleteFrame->setScore(20);
        $allFrames = [$frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $frame, $incompleteFrame];

        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when then
        $this->assertTrue($mock->isGameOver());
    }

    public function testCreateNewFrame() {
        //given
        $pins = 4;

        $lastFrame = new \Bowling\Frame();
        $lastFrame->setPinsRolled([4, 5]);
        $lastFrame->setScore(9);

        $allFrames = [$lastFrame];
        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        $currentFrame = new \Bowling\Frame();
        $currentFrame->setPinsRolled([4]);
        $currentFrame->setScore(4);

        //when
        $createNewFrameMock = $this->getPrivateMethod($mock, 'createNewFrame');
        $result = $createNewFrameMock->invokeArgs($mock, [$pins]);

        //then
        $expected = [$lastFrame, $currentFrame];
        $this->assertEquals($expected, $result);
    }

    public function testUpdateLastFrame_2Roll() {
        //given
        $pins = 5;

        $lastFrame = new \Bowling\Frame();
        $lastFrame->setPinsRolled([4]);
        $lastFrame->setScore(4);

        $allFrames = [$lastFrame];
        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when
        $updateFrame = $this->getPrivateMethod($mock, 'updateFrame');
        $result = $updateFrame->invokeArgs($mock, [$pins]);

        //then
        $updatedFrame = new \Bowling\Frame();
        $updatedFrame->setPinsRolled([4, 5]);
        $updatedFrame->setScore(9);

        $expected = [$updatedFrame];
        $this->assertEquals($expected, $result);
    }

    public function testUpdateLastFrame_1Roll() {
        //given
        $pins = 5;

        $lastFrame = new \Bowling\Frame();
        $allFrames = [$lastFrame];
        $mock = new \Bowling\Game();
        $allFramesMock = $this->getPrivateProperty($mock, 'allFrames');
        $allFramesMock->setValue($mock, $allFrames);

        //when
        $updateFrame = $this->getPrivateMethod($mock, 'updateFrame');
        $result = $updateFrame->invokeArgs($mock, [$pins]);

        //then
        $updatedFrame = new \Bowling\Frame();
        $updatedFrame->setPinsRolled([5]);
        $updatedFrame->setScore(5);

        $expected = [$updatedFrame];
        $this->assertEquals($expected, $result);
    }

    private function getPrivateMethod($className, $methodName) {
        $reflector = new ReflectionClass($className);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }

    private function getPrivateProperty($className, $propertyName) {
        $reflector = new ReflectionClass($className);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

}
