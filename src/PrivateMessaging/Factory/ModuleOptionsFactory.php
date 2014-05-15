<?php

namespace PrivateMessaging\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use PrivateMessaging\Options\ModuleOptions;

class ModuleOptionsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        $moduleConfig = isset($config['privatemessaging']) ? $config['privatemessaging'] : array();
        return new ModuleOptions($moduleConfig);
    }
}
