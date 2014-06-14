<?php

require('vendor/autoload.php');

use chipbell4\DataMapper\DataMapper;

class DataMapperTest extends PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->obj = new DataMapper();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testNothing()
    {
    }
}
