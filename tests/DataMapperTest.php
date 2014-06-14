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

    public function testMapPrimitive()
    {
        $schema = array(
            'type' => 'int',
            'source' => 'value'
        );

        $data = array('value' => 1);

        $this->assertEquals(1, $this->obj->map($schema, $data));
    }

    public function testMapBasicObject()
    {
        $schema = array(
            'type' => 'stdClass',
            'fields' => array()
        );

        $this->assertInstanceOf('stdClass', $this->obj->map($schema, array()));
    }

    public function testMapSimpleObject()
    {
        $schema = array(
            'type' => 'Person',
            'fields' => array(
                'name' => array(
                    'type' => 'string',
                    'source' => 'name'
                ),
            )
        );

        $data = array('name' => 'CHIP');

        $result = $this->obj->map($schema, $data);

        $this->assertInstanceOf('Person', $result);
        $this->assertEquals('CHIP', $result->name);
    }

    public function testMapComplexObject()
    {
        $schema = array(
            'type' => 'Couple',
            'fields' => array(
                'person_1' => array(
                    'type' => 'Person',
                    'fields' => array(
                        'name' => array(
                            'type' => 'string',
                            'source' => 'name1'
                        ),
                    ),
                ),
                'person_2' => array(
                    'type' => 'Person',
                    'fields' => array(
                        'name' => array(
                            'type' => 'string',
                            'source' => 'name2'
                        ),
                    ),
                ),
            ),
        );
        
        $data = array('name1' => 'Chip', 'name2' => 'April');

        $result = $this->obj->map($schema, $data);

        $this->assertInstanceOf('Couple', $result);
        $this->assertEquals('Chip', $result->person_1->name);
        $this->assertEquals('April', $result->person_2->name);
    }
}
