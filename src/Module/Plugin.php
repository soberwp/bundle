<?php

namespace Sober\Themer\Module;

use Sober\Themer\Module;

class Plugin extends Module
{   
    public function run()
    {
        if ($this->isDisabled()) return;
        
        $this->config()->register();
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
