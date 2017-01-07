<?php

namespace Sober\Themer;

class Module
{
    protected $data;

    public function __construct($data)
    {
        if ($this->isDisabled()) return;
        
        $this->data = $data;
    }

    /**
     * Check to see if config has been disabled
     *
     * @return boolean
     */
    protected function isDisabled()
    {
        return (($this->data['active'] === false) ? true : false);
    }
}
