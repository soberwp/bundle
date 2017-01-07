<?php

namespace Sober\Themer\Module;

use Sober\Themer\Module;

class Template extends Module
{
    protected $config;
    protected $filename;

    public function run ()
    {
        if ($this->isDisabled()) return;
    }

    /**
     * Get
     *
     * @return boolean|string|array
     */
    public function get($config, $filename)
    {
        $this->config = $config;
        $this->filename = $filename;
        
        if ($this->data->get('template') === $this->filename) {
            return (is_array($this->config) ? $this->match() : $this->config());
        }
    }

    /**
     * Return config
     *
     * @return boolean|string|array
     */
    protected function config()
    {
        return $this->data->get('config.' . $this->config);
    }

    /**
     * Return match
     *
     * @return boolean
     */
    protected function match()
    {
        $match = $this->data->get('config.' . $this->config[0]);
        return ($match === $this->config[1] ? true : false);
    }

    /**
     * Debug
     *
     * @return array
     */
    public function debug($filename)
    {
        if ($this->data->get('template') === $filename) {
            return $this->data->get('config');
        }
    }
}
