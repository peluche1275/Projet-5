<?php

namespace App\Frontend;

use \OCFram\Application;

class FrontendApplication extends Application
{

    // CONSTRUCTOR //

    public function __construct()
    {
        parent::__construct();

        $this->name = 'Frontend';
    }

    // METHOD //

    public function run()
    {
        $controller = $this->getController();
        $controller->execute();

        $this->httpResponse->setPage($controller->page());
        $this->httpResponse->send();
    }
}
