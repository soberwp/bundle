<?php

namespace Sober\Bundle;

class Bundle
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;

        if ($this->isDisabled()) return;

        $this->config()->register();
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

    /**
     * Config
     *
     * Required config for tgmpa()
     * @return $this
     */
    protected function config()
    {
        $this->config = [
            'id' => 'sober',
            'menu' => 'install-plugins',
            'parent_slug' => 'plugins.php',
            'is_automatic' => true
        ];
        return $this;
    }

    /**
     * Register
     *
     * Hook into tgmpa_register and run function
     */
    protected function register() 
    {
        add_action('tgmpa_register', function () {
            tgmpa(array($this->data->all()), $this->config);
        });
    }
}
