<?php

namespace Zaoub\Dependo;

class Config implements \ArrayAccess
{
    private $container = [];

    public function __construct($options, $clientConfig = []) {
        
        $this->container = [
            'composer_lock_path' => __DIR__.'/../../../../composer.lock',
            'send' => (isset($options['send'])) ? $options['send'] : '',
            'base_uri' => 'http://security.zaoub.test/'
        ];

        $keys = (isset($options['keys'])) ? $options['keys'] : false;

        if ($keys) {
            $this->setkeys($keys);
        }

        $this->container = array_replace_recursive($this->container, $clientConfig);
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
            die(\Zaoub\Dependo\Core\Console::log('The key structure is incorrect'.PHP_EOL.'The structure should be: <project_key>:<project_secret>:<secret_key>', 'red'));
        }

        $keys = explode(':', $keys);

        $this->container['project_key'] = $keys[0];
        $this->container['project_secret'] = $keys[1];
        $this->container['secret_key'] = $keys[2];
    }
}