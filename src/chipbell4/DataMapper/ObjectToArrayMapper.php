<?php namespace chipbell4\DataMapper;

class ObjectToArrayMapper
{
    /**
     * map 
     *
     * Maps a stdClass instance to a simple array version
     * 
     * @param \stdClass $obj The object to convert to an array
     * @access public
     * @return A key-value array of the public properties of $obj
     */
    public function map(\stdClass $obj)
    {
        $ary = [];

        // Loop over each property in the object, building an array
        foreach ($obj as $key => $value) {
            $ary[ $key ] = $value;
        }

        return $ary;
    }
}
