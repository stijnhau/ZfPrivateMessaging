<?php

namespace PrivateMessaging\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;
use PrivateMessaging\Mapper\UserMapper;

class UserMapperFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $zfcuserOptions = $serviceLocator->get('zfcuser_module_options');
        $options = $serviceLocator->get('PrivateMessaging\ModuleOptions');

        $mapper = new UserMapper();
        $mapper->setDbAdapter($serviceLocator->get('PrivateMessaging\DbAdapter'));
        $entityClass = $zfcuserOptions->getUserEntityClass();
        $mapper->setEntityPrototype(new $entityClass);
        $mapper->setHydrator(new \ZfcUser\Mapper\UserHydrator());
        $mapper->setTableName($zfcuserOptions->getTableName());
        $mapper->setCurrentUser($serviceLocator->get('zfcuser_auth_service')->getIdentity());
        $mapper->setUserColumn($options->getUserColumn());

        return $mapper;
    }
}
