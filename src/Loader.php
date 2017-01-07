<?php

namespace Sober\Themer;

use Noodlehaus\Config;
use Sober\Themer\ConfigNoFile;
use Sober\Themer\Module\Template;
use Sober\Themer\Module\Plugin;

class Loader
{
    // expose template configs for theming
    public $templates = [];

    // protected
    protected $file;
    protected $types = ['template', 'plugin'];
    protected $type;
    protected $config;

    public function __construct()
    {
        $this->getFiles();
    }

    /**
     * Get files
     */
    protected function getFiles()
    {
        foreach ($this->types as $this->type) {
            $this->file = (has_filter('sober/themer/' . $this->type . '/file') ?  apply_filters('sober/themer/' . $this->type . '/file', rtrim($this->type)) : get_stylesheet_directory() . '/' . $this->type . 's.json');
            $this->load();
        }
    }

    /**
     * Load
     */
    protected function load()
    {
        if (!file_exists($this->file)) return;
        if (!$this->isJson()) return;

        $this->config = new Config($this->file);
        ($this->isMultiple() ? $this->loadEach($this->type) : $this->route($this->config));
    }

    /**
     * Is JSON file
     *
     * @return boolean
     */
    protected function isJson()
    {
        return (pathinfo($this->file, PATHINFO_EXTENSION) === 'json');
    }

    /**
     * Is multidimensional config
     *
     * @return boolean
     */
    protected function isMultiple()
    {
        return (is_array(current($this->config->all())));
    }

    /**
     * Load each from multidimensional config
     */
    protected function loadEach()
    {   
        foreach ($this->config as $config) {
            $this->route(new ConfigNoFile($config));
        }
    }

    /**
     * Route to class
     */
    protected function route($config)
    {   
        if ($this->type === 'template') {
            $this->templates[] = new Template($config);
        }
        if ($this->type === 'plugin') (new Plugin($config))->run();
    }
}
