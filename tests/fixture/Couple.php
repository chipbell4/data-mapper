<?php

class Couple
{
    public function __construct(Person $person_1, Person $person_2)
    {
        $this->person_1 = $person_1;
        $this->person_2 = $person_2;
    }
}
