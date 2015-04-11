<?php

namespace Nagoya\Dk9;

class Dk9Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Dk9
     */
    protected $skeleton;

    protected function setUp()
    {
        parent::setUp();
        $this->skeleton = new Dk9;
    }

    public function testNew()
    {
        $actual = $this->skeleton;
        $this->assertInstanceOf('\Nagoya\Dk9\Dk9', $actual);
    }

    public function testException()
    {
        $this->setExpectedException('\Nagoya\Dk9\Exception\LogicException');
        throw new Exception\LogicException;
    }
}
