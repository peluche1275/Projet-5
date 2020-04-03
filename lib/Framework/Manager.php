<?php

namespace Framework;

abstract class Manager
{
    // PROPERTY //

    protected $dao;

    // CONSTRUCTOR //
    
    public function __construct($dao)
    {
        $this->dao = $dao;
    }
}
