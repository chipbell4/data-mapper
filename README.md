# Schema Mapper
Utility for mapping a flat array of data to a complex object tree via 
their constructors. The best way to observe is to see an example.

Suppose you have a class ```Person``` that represents a Person (go figure).
The constructor looks something like this:
```PHP
__construct($name)
{
    $this->name = $name;
}
```
Pretty generic stuff. This library will take a schema like this:
```JSON
{
    "type" : "Person",
    "fields" : {
        "name" : {
            "type" : "string",
            "value" : "name_value"
        }
    }
}
```
And an array like this:
```PHP
array('name_value' => 'Chip')
```
and spit out a ```Person``` object with a name field of 'Chip'. This may
seem like overkill, but the structure allows for more complex objects.

Consider a class ```Couple``` with a constructor that looks like this:
```PHP
__construct(Person $p1, Person $p2, $hobby)
{
   // ...
}
``` 
Again, typical fare, but it now has a little deeper dependency. In order to 
construct a ```Couple``` object, you're going to need two ```Person```s and
also a hobby. Given a schema like this:
```JSON
{
    "type" : "Couple",
    "fields" : {
        "p1" : {
            "type" : "Person",
            "fields" : {
                "name" : {
						"type" : "string",
						"value" : "name_value_1"
                }
            }
        }
        "p2" : {
            "type" : "Person",
            "fields" : {
                "name" : {
						"type" : "string",
						"value" : "name_value_2"
                }
            }
        }
    }
}
```
and an data array like
```PHP
array('name_value_1' => 'Chip', 'name_value_2' => 'April');
```

