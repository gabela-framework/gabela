<?php 

namespace Gabela\Core;
class ClassManager
{
    private $instances = [];

    public function createInstance(string $className)
    {
        if (!class_exists($className)) {
            throw new \InvalidArgumentException("Class $className not found");
        }

        if (!array_key_exists($className, $this->instances)) {
            $this->instances[$className] = new $className();
        }

        return $this->instances[$className];
    }
}
