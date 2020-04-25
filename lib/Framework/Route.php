<?php

namespace Framework;

class Route
{
    // PROPERTIES //

    protected $action;
    protected $module;
    protected $url;
    protected $varsNames;
    protected $vars = [];

    // CONSTRUCTOR //

    public function __construct($url, $module, $action, array $varsNames)
    {
        $this->setUrl($url);
        $this->setModule($module);
        $this->setAction($action);
        $this->setVarsNames($varsNames);
    }

    public function hasVars()
    {
        return !empty($this->varsNames);
    }

    public function match($url)
    {
        if (preg_match('`^' . $this->url . '$`', $url, $matches)) :
            return $matches;
        else :
            return false;
        endif;
    }

    // SETTERS //

    public function setAction($action)
    {
        if (is_string($action)) :
            $this->action = $action;
        endif;
    }

    public function setModule($module)
    {
        if (is_string($module)) :
            $this->module = $module;
        endif;
    }

    public function setUrl($url)
    {
        if (is_string($url)) :
            $this->url = $url;
        endif;
    }

    public function setVarsNames(array $varsNames)
    {
        $this->varsNames = $varsNames;
    }

    public function setVars(array $vars)
    {
        $this->vars = $vars;
    }

    // GETTER //

    public function action()
    {
        return $this->action;
    }

    public function module()
    {
        return $this->module;
    }

    public function vars()
    {
        return $this->vars;
    }

    public function varsNames()
    {
        return $this->varsNames;
    }
}
