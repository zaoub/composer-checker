<?php

namespace Zaoub\Dependo;

class Config implements \ArrayAccess
{
    private $container = [];

    public function __construct($options) {
        $this->container = [
            'composer_lock_path' => __DIR__.'/../../../../composer.lock'
        ];

        $keys = (isset($options['keys'])) ? $options['keys'] : false;

        if ($keys) {
            $this->setkeys($keys);
        }

        $this->container['send'] = (isset($options['send'])) ? $options['send'] : '';

        $this->container['base_uri'] = 'https://postb.in/';
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    public function setKeys($keys)
    {
        if (!preg_match("/([A-Za-z0-9]*):([A-Za-z0-9]*):([A-Za-z0-9]*)/", $keys)) {
            die(\Zaoub\Dependo\Core\Console::log('The key structure is incorrect', 'green'));
        }

        $keys = explode(':', $keys);

        $this->container['project_key'] = $keys[0];
        $this->container['project_secret'] = $keys[1];
        $this->container['secret_key'] = $keys[2];
    }
}