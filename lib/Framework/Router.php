<?php

namespace Framework;

class Router
{
    // PROPERTY //

    protected $routes = [];

    const NO_ROUTE = 1;

    // METHOD //

    public function addRoute(Route $route)
    {
        if (!in_array($route, $this->routes)) :
            $this->routes[] = $route;
        endif;
    }

    // METHOD //

    public function getRoute($url)
    {
        foreach ($this->routes as $route) :

            if (($varsValues = $route->match($url)) !== false) :

                if ($route->hasVars()) :
                    $varsNames = $route->varsNames();
                    $listVars = [];


                    foreach ($varsValues as $key => $match) {

                        if ($key !== 0) {
                            $listVars[$varsNames[$key - 1]] = $match;
                        }
                    }

                    $route->setVars($listVars);
                endif;
                return $route;
            endif;
        endforeach;
        throw new \RuntimeException('Aucune route ne correspond à l\'URL', self::NO_ROUTE);
    }
}
