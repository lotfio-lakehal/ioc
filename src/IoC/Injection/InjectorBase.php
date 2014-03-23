<?php
/**
 * Created by PhpStorm.
 * User: Vegard
 * Date: 3/20/14
 * Time: 7:07 PM
 */

namespace DC\IoC\Injection;

abstract class InjectorBase {
    /**
     * @var \DC\IoC\Container
     */
    protected $container;

    public function __construct(\DC\IoC\Container $container) {
        $this->container = $container;
    }

    protected  function getParameterClassFromPhpDoc(\ReflectionFunctionAbstract $reflectionMethod, $parameterName) {
        $phpDoc = $reflectionMethod->getDocComment();
        if (preg_match_all('/^\s+\*\s+@param\s+\$?(.+?)\s+(?:array\|)?(\S+)/im', $phpDoc, $results, PREG_SET_ORDER)) {
            $matches = array_filter($results, function($r) use ($parameterName) {
                return $r[1] == $parameterName;
            });
            if (count($matches) == 1) {
                return $matches[0][2];
            }
        }
    }
} 