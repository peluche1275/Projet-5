<?php

class SplClassLoader
{
    // PROPERTIES //

    private
        $_fileExtension = '.php',
        $_namespace,
        $_includePath,
        $_namespaceSeparator = '\\';

    // CONSTRUCTOR //

    public function __construct($namespace = null, $includePath = null)
    {
        $this->_namespace = $namespace;
        $this->_includePath = $includePath;
    }

    // METHODS //

    public function register()
    {
        spl_autoload_register(array($this, 'loadClass'));
    }

    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    public function LoadClass($className)
    {
        if (null === $this->_namespace || $this->_namespace . $this->_namespaceSeparator === substr($className, 0, strlen($this->_namespace . $this->_namespaceSeparator))) :
            $fileName = '';
            $namespace = '';
            if (false !== ($lastNsPos = strripos($className, $this->_namespaceSeparator))) :
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName = str_replace($this->_namespaceSeparator, DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            endif;
            $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . $this->_fileExtension;
            require ($this->_includePath !== null ? $this->_includePath . DIRECTORY_SEPARATOR : '') . $fileName;
        endif;
    }

    // GETTERS //

    public function getNamespaceSeparator()
    {
        return $this->_namespaceSeparator;
    }

    public function getIncludePath()
    {
        return $this->_includePath;
    }

    public function getFileExtension()
    {
        return $this->_fileExtention;
    }

    // SETTERS //

    public function setNamespaceSeparator($separator)
    {
        $this->_namespaceSeparator = $separator;
    }

    public function setIncludePath($includePath)
    {
        $this->_includePath = $includePath;
    }

    public function setFileExtention($fileExtension)
    {
        $this->_fileExtention = $fileExtension;
    }
}
