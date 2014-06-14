<?php namespace chipbell4\DataMapper;

class DataMapper
{
    /**
     * Maps an array to an object structure based on the
     * passed schema
     *
     * @param array $schema The object schema to use
     * @param array $data The raw data to use
     *
     * @return The object structure
     */
    public function map(array $schema, array $data)
    {
        return $this->parseField($schema, $data);
    }

    /**
     * Parses a single field description into an object
     *
     * @return An object structure
     */
    public function parseField(array $schema, array $data)
    {
        // If the type is primitive, simply cast the value to that primitive type
        $instance_type = $schema['type'];
        if ($this->fieldTypeIsPrimitive($instance_type)) {
            $value = $data[ $schema['source'] ];
            return $this->castToPrimitive($value, $instance_type);
        }

        $constructor_args= array();
        foreach ($schema['fields'] as $field_description) {
            $constructor_args[] = $this->parseField($field_description, $data);
        }

        return $this->instantiate($instance_type, $constructor_args);
    }

    /**
     * Returns true if the field type is a primitive
     */
    protected function fieldTypeIsPrimitive($field_type)
    {
        $primitive_types = array('string', 'int', 'bool', 'float');

        return in_array($field_type, $primitive_types);
    }

    /**
     * Casts a field value to a primitive
     */
    protected function castToPrimitive($value, $type)
    {
        switch($type) {
            case 'string':
                return (string) $value;
            case 'int':
                return (int) $value;
            case 'bool':
                return (bool) $value;
            case 'float':
                return (float) $value;
        }
    }

    /**
     * Mockable method for instantiating a class with the provided
     * parameters.
     *
     * From: http://stackoverflow.com/a/1858400
     */
    protected function instantiate($type, array $parameters)
    {
        if (count($parameters) == 0) {
            return new $type;
        }

        $reflection = new \ReflectionClass($type);
        return $reflection->newInstanceArgs($parameters);
    }
}
