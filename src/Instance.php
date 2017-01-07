<?php

namespace Sober\Themer;

class Instance 
{
    protected $configs;
    protected $request;
    protected $view;
    protected $output;
    protected $result;

    public function __construct($request, $output, $view)
    {
        $this->view = $view;
        $this->request = $request;
        $this->output = $output;
        $this->view()->configs()->request();
    }

    /**
     * Request
     *
     * Retrieve the request config
     */
    protected function request()
    {
        foreach ($this->configs as $template) {
            $result = $template->get($this->request, $this->view);
            if ($result) $this->result = $result;
        }
    }

    /**
     * Config
     *
     * Retrieve the global templates config
     * @return $this
     */
    protected function configs()
    {
        $this->configs = $GLOBALS['sober_themer_config']->templates;
        return $this;
    }

    /**
     * View
     *
     * Retrieve the view automatically if user does not specify
     * @return $this
     */
    protected function view()
    {
        if (!$this->view) {
            $this->view = debug_backtrace();
            $this->view = basename($this->view[2]['file'], '.php');
        }
        return $this;
    }

    /**
     * Returns
     *
     * Return the result
     * @return string
     */
    public function returns()
    {
        return $this->result;
    }

    /**
     * Echos
     *
     * Return the output string if set, else return the result
     * @return string
     */
    public function echos()
    {
        return (($this->output && ($this->result === true)) ? $this->output : $this->result);
    }

    /**
     * Debug
     *
     * Return the template name and the config for that template
     * @return string
     */
    public function debug()
    {
        foreach ($this->configs as $template) {
            $result[] = $template->debug($this->view);
        }
        return '<pre>Template: ' . $this->view . '</pre><pre>Config: ' . json_encode($result[0]) . '</pre>';
    }
}
