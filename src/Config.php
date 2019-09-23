<?php

namespace Zaoub\ComposerChecker;

class Config implements \ArrayAccess
{
    private $container = [];

    public function __construct($options) {
        $this->container = [
            'composer_lock_path' => __DIR__.'/../../../../composer.lock'
        ];

        $this->container['type_results'] = (!isset($options['type'])) ? 'text' : $options['type'];
        $this->container['secret_key'] = (isset($options['secret_key'])) ? $options['secret_key'] : '';
        $this->container['send'] = (isset($options['send'])) ? $options['send'] : '';
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
}