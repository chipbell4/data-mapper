<?php

require('vendor/autoload.php');

use chipbell4\DataMapper\ObjectToArrayMapper;

class ObjectToArrayMapperTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->obj = new ObjectToArrayMapper();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testMap()
    {
        $class = new stdClass;
        $class->x = 'X';
        $class->y = 'Y';

        $result = $this->obj->map($class);

        $this->assertEquals(array('x' => 'X', 'y' => 'Y'), $result);
    }
}
