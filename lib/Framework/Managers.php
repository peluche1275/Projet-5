<?php

namespace Framework;

class Managers
{
    // PROPERTIES //

    protected $api = null;
    protected $dao = null;
    protected $managers = [];

    // CONSTRUCTOR //

    public function __construct($api, $dao)
    {
        $this->api = $api;
        $this->dao = $dao;
    }

    // METHOD //

    public function getManagerOf($module)
    {
        if (!is_string($module) || empty($module)) :

            throw new \InvalidArgumentException('Le module spécifié est invalide');
        endif;

        if (!isset($this->managers[$module])) :

            $manager = '\\App\Frontend\Modules\\' . $module . '\\' . $module . 'Manager' . $this->api;

            $this->managers[$module] = new $manager($this->dao);
        endif;

        return $this->managers[$module];
    }
}
