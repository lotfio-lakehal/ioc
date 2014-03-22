<?php

namespace DC\IoC;

class ClassNameRegistration extends Registration {

    /**
     * @var string
     */
    private $className;

    function __construct($className, Container $container)
    {
        $this->className = $className;
        parent::__construct($className, $container);
        $this->withPerResolveLifetime();
    }

    function to($classOrInterfaceName)
    {
        if (!is_subclass_of($this->className, $classOrInterfaceName)) {
            throw new \InvalidArgumentException("$this->className does not implement or extend $classOrInterfaceName");
        }
        return parent::to($classOrInterfaceName);
    }

    function create()
    {
        $oInjector = new ConstructorInjector($this->container);
        return $oInjector->construct($this->className);
    }
}