<?php 

namespace Gabela\Core;

class EventDispatcher 
{
    private $listeners = [];

    public function addListener($eventName, $listener) {
        $this->listeners[$eventName][] = $listener;
    }

    public function dispatch($eventName, $event) {
        if (isset($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $listener) {
                $listener($event);
            }
        }
    }
}